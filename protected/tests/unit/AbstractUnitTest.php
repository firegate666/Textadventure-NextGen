<?php

abstract class AbstractUnitTest extends CDbTestCase
{

	/**
	 * hold transcation
	 *
	 * @var CDbTransaction
	 */
	protected $transaction;

	/**
	 * create transaction
	 *
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
	 * @return void
	 */
	public function tearDown()
	{
		parent::tearDown();
		$this->transaction->rollback();
	}

}
