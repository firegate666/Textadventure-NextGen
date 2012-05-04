<?php
Yii::import('application.tests.unit.AbstractUnitTest');
Yii::import('application.tests.mocks.UserGroupMock');

class UserTest extends AbstractUnitTest
{

	public function testMetainfo()
	{
		$user_1 = new User();
		$user_1->id = 1;

		$user_2 = new User();
		$user_2->id = 2;

		Yii::app()->user->id = $user_1->id;

		$model = new UserGroupMock();
		$model->attributes = array(
				'name' => 'Test Group',
		);
		$this->assertTrue($model->validate(), var_export($model->getErrors(), true));

		$this->assertNull($model->createdAt);
		$this->assertNull($model->changedAt);
		$this->assertNull($model->createdBy);
		$this->assertNull($model->changedBy);
		$model->save();
		$this->assertNotNull($model->createdAt);
		$this->assertEquals($user_1->id, $model->createdBy);

		$this->assertNull($model->changedAt);
		$this->assertNull($model->changedBy);

		Yii::app()->user->id = $user_2->id;
		$model->save();
		$this->assertNotNull($model->createdAt);
		$this->assertNotNull($model->changedAt);
		$this->assertEquals($user_1->id, $model->createdBy);
		$this->assertEquals($user_2->id, $model->changedBy);
	}

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
