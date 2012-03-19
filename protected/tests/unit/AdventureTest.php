<?php

class AdventureTest extends CDbTestCase
{

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

	public function testState()
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
