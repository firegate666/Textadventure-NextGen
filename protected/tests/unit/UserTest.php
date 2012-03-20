<?php

class UserTest extends CDbTestCase
{

	public function testRequiredFields()
	{
		$model = new User();
		$model->attributes = array();
		$this->assertFalse($model->validate());

		$model = new User();
		$model->attributes = array(
				//'username'=>'username',
				'password'=>'password',
				'email'=>'email',
				'groupId'=>1,
		);
		$this->assertFalse($model->validate());
		$this->assertTrue($model->hasErrors('username'), var_export($model->getErrors('username'), true));

		$model = new User();
		$model->attributes = array(
				'username'=>'username',
				//'password'=>'password',
				'email'=>'email',
				'groupId'=>1,
		);
		$this->assertFalse($model->validate());
		$this->assertTrue($model->hasErrors('password'), var_export($model->getErrors('password'), true));

		$model = new User();
		$model->attributes = array(
				'username'=>'username',
				'password'=>'password',
				//'email'=>'email',
				'groupId'=>1,
		);
		$this->assertFalse($model->validate());
		$this->assertTrue($model->hasErrors('email'), var_export($model->getErrors('email'), true));

		$model = new User();
		$model->attributes = array(
				'username'=>'username',
				'password'=>'password',
				'email'=>'email',
				//'groupId'=>1,
		);
		$this->assertFalse($model->validate());
		$this->assertTrue($model->hasErrors('groupId'), var_export($model->getErrors('groupId'), true));

		$model = new User();
		$model->attributes = array(
			'username'=>'username',
			'password'=>'password',
			'email'=>'email',
			'groupId'=>1,
		);
		$this->assertTrue($model->validate(), var_export($model->getErrors(), true));
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

		$model = new User();
		$model->attributes = $post;
		$this->assertFalse($model->validate(), var_export($model->getErrors(), true));

		$post['newPasswordConfirm'] = $post['newPassword'];
		$model = new User();
		$model->attributes = $post;
		$this->assertTrue($model->validate(), var_export($model->getErrors(), true));
	}

	public function testPasswordHashing()
	{
		$model = new User();
		$password = 'test';
		$salt = 'salt';

		$model->salt = $salt;
		$model->password = User::hashPassword($password, $salt);

		$this->assertTrue($model->validatePassword($password), 'Password hashing failed');
	}
}
