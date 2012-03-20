<?php

class AdventureTest extends CDbTestCase
{

	/**
	 * test required fields
	 *
	 * @return void
	 */
	public function testRequirements()
	{
		$post = array(
			'name' => 'This is my test name',
			'description' => 'This is my test description'
		);

		$model = new Adventure();
		$model->attributes = $post;
		$model->validate();

		// adventure id is required
		$this->assertTrue($model->hasErrors('adventureId'));
		// state is required
		$this->assertTrue($model->hasErrors('state'));
		// bit gets an auto created value
		$this->assertFalse(empty($model->adventureId));
		$this->assertFalse(stripos($model->adventureId, ' '));

		// a second validation should auto accept the auto created value
		$model->validate();
		$this->assertFalse($model->hasErrors('adventureId'));
		$this->assertTrue($model->hasErrors('state'));
	}

	/**
	 * test if startDate and stopDate are not equal and startDate is lower than stopDate
	 *
	 * @return void
	 */
	public function testValidDates()
	{
		$today = date('Y-m-d');
		$yesterday = date('Y-m-d', time() - 60*60*24);
		$tomorrow = date('Y-m-d', time() + 60*60*24);

		$model = new Adventure();

		$model->attributes = array(
			'startDate' => $today,
			'stopDate' => $today,
		);
		$model->validate();
		$this->assertTrue($model->hasErrors('startDate'));
		$this->assertTrue($model->hasErrors('stopDate'));

		$model->attributes = array(
			'startDate' => $tomorrow,
			'stopDate' => $yesterday,
		);
		$model->validate();
		$this->assertTrue($model->hasErrors('startDate'));
		$this->assertTrue($model->hasErrors('stopDate'));

		$model->attributes = array(
			'startDate' => null,
			'stopDate' => null,
		);
		$model->validate();
		// values must not be altered if null
		$this->assertNull($model->startDate);
		$this->assertNull($model->stopDate);
	}

	/**
	 * test valid states
	 *
	 * @return void
	 */
	public function testState()
	{
		$model = new Adventure();

		foreach(Adventure::validStates() as $valid_state => $state_name)
		{
			$model->attributes = array(
				'state' => $valid_state,
			);
			$model->validate();
			$this->assertFalse($model->hasErrors('state'));
		}

		$model->attributes = array(
			'state' => 'FOO',
		);
		$model->validate();
		$this->assertTrue($model->hasErrors('state'));
	}

	/**
	 * test running states
	 *
	 * @return void
	 */
	public function testRunningState()
	{
		$model = new Adventure();

		$model->attributes = array(
				'startDate' => null,
				'stopDate' => null,
				'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertTrue($model->isRunning());

		$model->attributes = array(
				'startDate' => null,
				'stopDate' => null,
				'state' => Adventure::STATE_DRAFT,
		);
		$this->assertFalse($model->isRunning());
	}

	public function testStartStop()
	{
		$model = new Adventure();

		$model->attributes = array(
				'startDate' => date('Y-m-d', time()),
				'stopDate' => null,
				'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertTrue($model->isRunning());

		$model->attributes = array(
				'startDate' => date('Y-m-d', time()-3600),
				'stopDate' => null,
				'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertTrue($model->isRunning());

		$model->attributes = array(
				'startDate' => date('Y-m-d', time()+3600),
				'stopDate' => null,
				'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertFalse($model->isRunning());

		$model->attributes = array(
				'startDate' => null,
				'stopDate' => date('Y-m-d', time()+3600),
				'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertTrue($model->isRunning());

		$model->attributes = array(
				'startDate' => null,
				'stopDate' => date('Y-m-d', time()),
				'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertFalse($model->isRunning());

		$model->attributes = array(
				'startDate' => null,
				'stopDate' => date('Y-m-d', time()-3600),
				'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertFalse($model->isRunning());
	}
}
