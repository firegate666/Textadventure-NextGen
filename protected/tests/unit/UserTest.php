<?php

class UserTest extends CDbTestCase
{

	/**
	 * hold transcation
	 *
	 * @todo move to parent class
	 * @var CDbTransaction
	 */
	protected $transaction;

	/**
	 * create transaction
	 *
	 * @todo move to parent class
	 * @return void
	 */
	public function setUp()
	{
		parent::setUp();
		$this->transaction = Yii::app()->db->beginTransaction();
	}

	/**
	 * rollback transcation
	 *
	 * @todo move to parent class
	 * @return void
	 */
	public function tearDown()
	{
		parent::tearDown();
		$this->transaction->rollback();
	}

	/**
	 * test metainfo setting
	 *
	 * @todo add second user to test, see if createdBy and changedBy have different users
	 * @return void
	 */
	public function testMetainfo()
	{
		$user = User::model()->findBySql('SELECT * FROM User LIMIT 1');
		$this->assertNotNull($user);
		Yii::app()->user->id = $user->id;

		$model = new UserGroup();
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
		$this->assertEquals($user->id, $model->createdBy);

		$this->assertNull($model->changedAt);
		$this->assertNull($model->changedBy);
		$model->save();
		$this->assertNotNull($model->createdAt);
		$this->assertNotNull($model->changedAt);
		$this->assertEquals($user->id, $model->createdBy);
		$this->assertEquals($user->id, $model->changedBy);

		$model2 = UserGroup::model()->findByPk($model->id);
		$this->assertNotNull($model2->createdAt);
		$this->assertNotNull($model2->changedAt);
		$this->assertNotNull($model2->createdBy);
		$this->assertNotNull($model2->changedBy);
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
