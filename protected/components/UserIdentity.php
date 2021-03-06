<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * logged in user is admin
	 *
	 * @var boolean
	 */
	public $isAdmin = false;

	/**
	 * logged in user can create adventure
	 *
	 * @var boolean
	 */
	public $canCreateAdventure = false;

	protected function findUserByUsername($username) {
		return User::model()->find('LOWER(username)=?', array(mb_strtolower($username)));
	}

	/**
	 * Authenticates a user.
	 *
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = $this->findUserByUsername($this->username);

		if ($user === null)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else if (!$user->validatePassword($this->password))
		{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		else
		{
			$user->updateLastLogin();

			$this->_id = $user->id;
			$this->username = $user->username;
			$this->errorCode = self::ERROR_NONE;
			$this->isAdmin = $user->isAdmin();
			$this->canCreateAdventure = $user->canCreateAdventure();
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}
