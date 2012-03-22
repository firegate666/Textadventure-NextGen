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
				if (Yii::app()->user->id)
				{
					$this->createdBy = Yii::app()->user->id;
				}
			}
			else
			{
				$this->changedAt = date('Y-m-d H:i:s');
				if (Yii::app()->user->id)
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
		$user = $this->getRelated('createUser');
		if ($user !== null)
		{
			return $user->username;
		}
		else
		{
			return '';
		}
	}

	/**
	 * get username of user who changed this object
	 *
	 * @return string
	 */
	public function getChangeUserName()
	{
		$user = $this->getRelated('changeUser');
		if ($user !== null)
		{
			return $user->username;
		}
		else
		{
			return '';
		}
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
}
