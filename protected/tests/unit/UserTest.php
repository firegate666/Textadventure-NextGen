<?php

class UserTest extends CDbTestCase
{

	public function testRequiredFields()
	{
		$user = new User();
		$user->attributes = array();
		$this->assertFalse($user->validate());

		$user = new User();
		$user->attributes = array(
				//'username'=>'username',
				'password'=>'password',
				'email'=>'email',
				'groupId'=>1,
		);
		$this->assertFalse($user->validate());
		$this->assertTrue($user->hasErrors('username'));

		$user = new User();
		$user->attributes = array(
				'username'=>'username',
				//'password'=>'password',
				'email'=>'email',
				'groupId'=>1,
		);
		$this->assertFalse($user->validate());
		$this->assertTrue($user->hasErrors('password'));

		$user = new User();
		$user->attributes = array(
				'username'=>'username',
				'password'=>'password',
				//'email'=>'email',
				'groupId'=>1,
		);
		$this->assertFalse($user->validate());
		$this->assertTrue($user->hasErrors('email'));

		$user = new User();
		$user->attributes = array(
				'username'=>'username',
				'password'=>'password',
				'email'=>'email',
				//'groupId'=>1,
		);
		$this->assertFalse($user->validate());
		$this->assertTrue($user->hasErrors('groupId'));

		$user = new User();
		$user->attributes = array(
			'username'=>'username',
			'password'=>'password',
			'email'=>'email',
			'groupId'=>1,
		);
		$this->assertTrue($user->validate());
	}

	public function testNewPassword()
	{
		$post = array(
			'username' => 'foo',
			'email' => 'email@example.org',
			'newPassword' => 'abc',
			'newPasswordConfirm' => 'abcd',
			'groupId' => 1,
		);

		$user = new User();
		$user->attributes = $post;
		$this->assertFalse($user->validate());

		$post['newPasswordConfirm'] = $post['newPassword'];
		$user = new User();
		$user->attributes = $post;
		$this->assertTrue($user->validate());
	}

	public function testPasswordHashing()
	{
		$user = new User();
		$password = 'test';
		$salt = 'salt';

		$user->salt = $salt;
		$user->password = $user->hashPassword($password, $salt);

		$this->assertTrue($user->validatePassword($password), 'Password hashing failed');
	}
}
