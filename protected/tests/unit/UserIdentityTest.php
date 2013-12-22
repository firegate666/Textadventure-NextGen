<?php
Yii::import('application.tests.unit.AbstractUnitTest');

class UserIdentityTest extends AbstractUnitTest
{
	/**
	 * test valid user authentication
	 */
	public function testAuthenticate()
	{
		$mock = $this->getMockBuilder('UserIdentity')
			->disableOriginalConstructor()
			->setMethods(array('findUserByUsername'))
			->getMock();

		$user = $this->getMockBuilder('User')
			->disableOriginalConstructor()
			->setMethods(array('updateLastLogin'))
			->getMock();

		$user->salt = 'test';
		$user->username = 'test';
		$user->password = User::hashPassword('test', 'test');

		$mock->expects($this->any())
			->method('findUserByUsername')
			->will($this->returnValue($user));

		$mock->username = 'test';
		$mock->password = 'test';

		$result = $mock->authenticate();

		$this->assertTrue($result);
		$this->assertEquals(UserIdentity::ERROR_NONE, $mock->errorCode);
	}

	/**
	 * test password mismatch
	 */
	public function testAuthenticatePasswordInvalid()
	{
		$mock = $this->getMockBuilder('UserIdentity')
			->disableOriginalConstructor()
			->setMethods(array('findUserByUsername'))
			->getMock();

		$user = $this->getMockBuilder('User')
			->disableOriginalConstructor()
			->setMethods(array('updateLastLogin'))
			->getMock();

		$user->salt = 'test';
		$user->username = 'test2';
		$user->password = User::hashPassword('test2', 'test');

		$mock->expects($this->any())
			->method('findUserByUsername')
			->will($this->returnValue($user));

		$mock->username = 'test';
		$mock->password = 'test';

		$result = $mock->authenticate();

		$this->assertFalse($result);
		$this->assertEquals(UserIdentity::ERROR_PASSWORD_INVALID, $mock->errorCode);
	}

	/**
	 * test user not found
	 */
	public function testAuthenticateUserNotFound()
	{
		$mock = $this->getMockBuilder('UserIdentity')
			->disableOriginalConstructor()
			->setMethods(array('findUserByUsername'))
			->getMock();

		$user = null;

		$mock->expects($this->any())
			->method('findUserByUsername')
			->will($this->returnValue($user));

		$mock->username = 'test';
		$mock->password = 'test';

		$result = $mock->authenticate();

		$this->assertFalse($result);
		$this->assertEquals(UserIdentity::ERROR_USERNAME_INVALID, $mock->errorCode);
	}
}
