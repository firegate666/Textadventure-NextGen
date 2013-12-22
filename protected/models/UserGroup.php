<?php

/**
 * This is the model class for table "UserGroup".
 *
 * @property string $name
 * @property boolean $isAdmin
 * @property boolean $canCreateAdventure
 * @property boolean $defaultRegisterGroup
 *
 * @property User[] $users
 *
 * @static UserGroup model
 */
class UserGroup extends MetaInfo
{

	/**
	 * get a list of usergroups
	 *
	 * @static
	 * @return array
	 */
	public static function items()
	{
		$result = array();
		foreach (self::model()->findAll() as $group)
		{
			$result[$group->id] = $group->name;
		}
		return $result;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'UserGroup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max' => 256),
			array('isAdmin, canCreateAdventure, defaultRegisterGroup', 'boolean'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, isAdmin, canCreateAdventure', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'users' => array(self::HAS_MANY, 'User', 'groupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'isAdmin' => 'Is admin?',
			'canCreateAdventure' => 'Can create adventures?',
			'defaultRegisterGroup' => 'Is default register group?',
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see MetaInfo::getSearchCriteria()
	 */
	protected function getSearchCriteria()
	{
		$criteria = parent::getSearchCriteria();
		$criteria->compare('name', $this->name);
		$criteria->compare('isAdmin', $this->isAdmin);
		$criteria->compare('canCreateAdventure', $this->canCreateAdventure);
		$criteria->compare('defaultRegisterGroup', $this->defaultRegisterGroup);
		return $criteria;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @param integer $limit
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($limit = 5)
	{
		$criteria = $this->getSearchCriteria();

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>array(
				'pageSize' => $limit,
			),
		));
	}
}
