<?php

/**
 * This is the model class for table "User".
 *
 */
class User extends MetaInfo
{
	// The followings are the available columns in table 'User':

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $username;

	/**
	 *
	 * @var string
	 */
	public $password;

	/**
	 *
	 * @var string
	 */
	public $email;

	/**
	 *
	 * @var integer
	 */
	public $groupId;

	// The followings are the available model relations:

	/**
	 *
	 * @var User
	 */
	public $group;

	// The following are non-persisted properties

	/**
	 * new password to be set; is copied to User::password property before save if validates
	 *
	 * @var string
	 */
	public $newPassword = '';

	/**
	 * duplicate of new password to ensure that there are no typos
	 *
	 * @var string
	 */
	public $newPasswordConfirm = '';

	/**
	 * used for captcha validation
	 *
	 * @var string
	 */
	public $verifyCode;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * test if user is admin
	 *
	 * @return boolean
	 */
	public function isAdmin()
	{
		$group = UserGroup::model()->findByPk($this->groupId);
		return (bool)$group->isAdmin;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, salt, email, groupId', 'required'),
			array('groupId', 'numerical', 'integerOnly' => true),
			array('username, password, newPassword, newPasswordConfirm, salt, email', 'length', 'max' => 128),
			array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'register'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, groupId', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'group' => array(self::BELONGS_TO, 'UserGroup', 'groupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'newPassword' => 'New Password',
			'newPasswordConfirm' => 'New Password Confirmation',
			'salt' => 'Salt',
			'email' => 'Email',
			'groupId' => 'Group',
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
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('groupId', $this->groupId);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Checks if the given password is correct.
	 *
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return self::hashPassword($password, $this->salt) === $this->password;
	}

	/**
	 * Generates the password hash.
	 *
	 * @static
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public static function hashPassword($password, $salt)
	{
		return md5($password.$salt);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * @static
	 * @return string the salt
	 */
	protected static function generateSalt()
	{
		return uniqid('', true);
	}


	/**
	 * (non-PHPdoc)
	 * @see CModel::beforeValidate()
	 * @return boolean
	 */
	protected function beforeValidate()
	{
		$isValid = parent::beforeValidate();
		if (empty($this->salt))
		{
			$this->salt = self::generateSalt();
		}

		if (!empty($this->newPassword))
		{
			if ($this->newPassword == $this->newPasswordConfirm)
			{
				$this->password = self::hashPassword($this->newPassword, $this->salt);
			}
			else
			{
				$this->addError('newPasswordConfirm', 'Passwords do not match');
			}
		}

		if ($this->isNewRecord && $this->getScenario() == 'register')
		{
			$userGroup = UserGroup::model()->findByAttributes(array('defaultRegisterGroup'=>1));
			if ($userGroup === null)
			{
				$this->addError('groupId', 'There is no public usergroup to register to');
			}
			else
			{
				$this->groupId = $userGroup->id;
			}
		}

		return $isValid;
	}

}
