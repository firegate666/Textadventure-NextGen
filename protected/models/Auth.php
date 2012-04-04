<?php

/**
 * Auth class.
 * Auth is the data structure for holding
 * user login form data.
 */
class Auth extends CFormModel
{

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
	 * @var boolean
	 */
	public $rememberMe;

	/**
	 *
	 * @var CUserIdentity
	 */
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe' => 'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 *
	 * @return void
	 */
	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			$this->_identity = new UserIdentity($this->username, $this->password);
			if (!$this->_identity->authenticate())
			{
				$this->addError($attribute, 'Incorrect username or password.');
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 *
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if ($this->_identity === null)
		{
			$this->_identity = new UserIdentity($this->username, $this->password);
			$this->_identity->authenticate();
		}

		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
		{
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			Yii::app()->user->setState('isAdmin', $this->_identity->isAdmin);
			Yii::app()->user->setState('canCreateAdventure', $this->_identity->canCreateAdventure);
			return true;
		}
		else
		{
			return false;
		}
	}
}
