<?php

/**
 * model parent class that adds create and change data informations
 */
abstract class MetaInfo extends CActiveRecord {

	/**
	 * creation date
	 *
	 * @var datetime
	 */
	public $createdAt;

	/**
	 * date of last change
	 *
	 * @var datetime
	 */
	public $changedAt;

	/**
	 * who created
	 *
	 * @var integer
	 */
	public $createdBy;

	/**
	 * who changed
	 *
	 * @var integer
	 */
	public $changedBy;

	/**
	 *
	 * @var User
	 */
	public $createUser;

	/**
	 *
	 * @var User
	 */
	public $changeUser;

	/**
	 * write dates and user ids to model
	 *
	 * @return boolean
	 */
	protected function beforeSave()
	{
		$before_safe = parent::beforeSave();
		if ($before_safe)
		{
			if ($this->isNewRecord)
			{
				$this->createdAt = date('Y-m-d H:i:s');
				if (isset(Yii::app()->user) && Yii::app()->user->id)
				{
					$this->createdBy = Yii::app()->user->id;
				}
			}
			else
			{
				$this->changedAt = date('Y-m-d H:i:s');
				if (isset(Yii::app()->user) && Yii::app()->user->id)
				{
					$this->changedBy = Yii::app()->user->id;
				}
			}
		}
		return $before_safe;
	}

	/**
	 * get username of user who created this object
	 *
	 * @return string
	 */
	public function getCreateUserName()
	{
		return $this->getRelatedAttribute('createUser', 'username', '', false);
	}

	/**
	 * get username of user who changed this object
	 *
	 * @return string
	 */
	public function getChangeUserName()
	{
		return $this->getRelatedAttribute('changeUser', 'username', '', false);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
				'createUser' => array(self::BELONGS_TO, 'User', 'createdBy'),
				'changeUser' => array(self::BELONGS_TO, 'User', 'changedBy'),
		);
	}

	/**
	 * test if object has this relation
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function isRelationDefined($name)
	{
		$relations = $this->relations();
		return isset($relations[$name]);
	}

	/**
	 * return attribute value of related object
	 *
	 * @param string $related
	 * @param string $attribute
	 * @param mixed $default
	 * @param boolean $with_exception
	 * @throws AttributeNotDefinedException
	 * @throws RelationNotDefinedException
	 * @return mixed
	 */
	public function getRelatedAttribute($related, $attribute, $default = null, $with_exception = false)
	{
		$response = $default;
		if ($this->isRelationDefined($related))
		{
			$relation = $this->getRelated($related);
			if ($relation !== null) {
				if (isset($relation->$attribute))
				{
					$response = $relation->$attribute;
				}
				else if ($with_exception)
				{
					throw new AttributeNotDefinedException($attribute);
				}
			}
		}
		else if ($with_exception)
		{
			throw new RelationNotDefinedException($related);
		}
		return $response;
	}

	/**
	 * get quoted column name from db schema
	 *
	 * @param string $col_name
	 * @return string
	 */
	public function quotedCol($col_name) {
		return $this->getTableSchema()->getColumn($col_name)->rawName;
	}

	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @static
	 * @param string $className active record class name. (deprecated)
	 * @uses get_called_class()
	 * @return CActiveRecord the late static model class
	 */
	public static function model($className=__CLASS__)
	{
		$className = get_called_class();
		return parent::model($className);
	}

	/**
	 * get search criterias for this model
	 *
	 * @return CDbCriteria
	 */
	protected function getSearchCriteria()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('id', $this->id);
		$criteria->compare('createdAt', $this->createdAt);
		$criteria->compare('createdBy', $this->createdBy);
		$criteria->compare('changedAt', $this->changedAt);
		$criteria->compare('changedBy', $this->changedBy);
		return $criteria;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = $this->getSearchCriteria();
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
