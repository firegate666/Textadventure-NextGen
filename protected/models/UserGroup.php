<?php

/**
 * This is the model class for table "UserGroup".
 *
 */
class UserGroup extends MetaInfo
{
	// The following are the available columns in table 'UserGroup':

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $name;

	/**
	 *
	 * @var boolean
	 */
	public $isAdmin;

	/**
	 *
	 * @var boolean
	 */
	public $defaultRegisterGroup;

	/**
	 *
	 * @var User[]
	 */
	public $users;

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
			array('isAdmin, defaultRegisterGroup', 'boolean'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, isAdmin', 'safe', 'on' => 'search'),
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
			'defaultRegisterGroup' => 'Is default register group?',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria();

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name);
		$criteria->compare('isAdmin', $this->isAdmin);
		$criteria->compare('defaultRegisterGroup', $this->defaultRegisterGroup);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
