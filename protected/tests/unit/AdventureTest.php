<?php
Yii::import('application.tests.unit.AbstractUnitTest');

class AdventureTest extends AbstractUnitTest
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
		$this->assertTrue($model->hasErrors('adventureId'), var_export($model->getErrors('adventureId'), true));
		// state is required
		$this->assertTrue($model->hasErrors('state'), var_export($model->getErrors('state'), true));
		// bit gets an auto created value
		$this->assertFalse(empty($model->adventureId));
		$this->assertFalse(stripos($model->adventureId, ' '));

		// a second validation should auto accept the auto created value
		$model->validate();
		$this->assertFalse($model->hasErrors('adventureId'), var_export($model->getErrors('adventureId'), true));
		$this->assertTrue($model->hasErrors('state'), var_export($model->getErrors('state'), true));
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
		$this->assertTrue($model->hasErrors('startDate'), var_export($model->getErrors('startDate'), true));
		$this->assertTrue($model->hasErrors('stopDate'), var_export($model->getErrors('stopDate'), true));

		$model->attributes = array(
			'startDate' => $tomorrow,
			'stopDate' => $yesterday,
		);
		$model->validate();
		$this->assertTrue($model->hasErrors('startDate'), var_export($model->getErrors('startDate'), true));
		$this->assertTrue($model->hasErrors('stopDate'), var_export($model->getErrors('stopDate'), true));

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
			$this->assertFalse($model->hasErrors('state'), var_export($model->getErrors('state'), true));
		}

		$model->attributes = array(
			'state' => 'FOO',
		);
		$model->validate();
		$this->assertTrue($model->hasErrors('state'), var_export($model->getErrors('state'), true));
	}

	/**
	 * get adventure model with optional start and stop steps
	 *
	 * @todo move to fictures
	 * @param boolean $with_start
	 * @param boolean $with_end
	 * @return Adventure
	 */
	protected function getAdventureWithSteps($with_start = true, $with_end = true)
	{
		$model = new Adventure();
		$model->attributes = array(
				'name' => 'my name',
				'description' => 'my description',
				'startDate' => null,
				'stopDate' => null,
				'adventureId' => 'MYID',
				'state' => Adventure::STATE_DISABLED,
		);
		$model->save();

		if ($with_start)
		{
			$startStep = new AdventureStep();
			$startStep->attributes = array(
					'adventure' => $model->id,
					'name' => 'step name 1',
					'description' => 'description 1',
					'startingPoint' => 1,
					'endingPoint' => 0,
					'stepId' => 'STEP1',
			);
			$startStep->save();
		}

		if ($with_end)
		{
			$endStep = new AdventureStep();
			$endStep->attributes = array(
					'adventure' => $model->id,
					'name' => 'step name 2',
					'description' => 'description 2',
					'startingPoint' => 0,
					'endingPoint' => 1,
					'stepId' => 'STEP2',
			);
			$endStep->save();
		}

		return $model;
	}

	/**
	 * test running states
	 *
	 * @return void
	 */
	public function testRunningState()
	{
		$model = self::getAdventureWithSteps();

		foreach(Adventure::runningStates() as $state_value => $state_name)
		{
			$model->attributes = array(
				'startDate' => null,
				'stopDate' => null,
				'state' => $state_value,
			);
			$this->assertTrue($model->isRunning());
		}

		foreach(Adventure::stopStates() as $state_value => $state_name)
		{
			$model->attributes = array(
				'startDate' => null,
				'stopDate' => null,
				'state' => $state_value,
			);
			$this->assertFalse($model->isRunning());
		}
	}

	/**
	 * test startDate and stopDate
	 *
	 * @return void
	 */
	public function testStartStop()
	{
		$today = date('Y-m-d');
		$yesterday = date('Y-m-d', time() - 60*60*24);
		$tomorrow = date('Y-m-d', time() + 60*60*24);

		$model = self::getAdventureWithSteps();

		$model->attributes = array(
			'startDate' => $today,
			'stopDate' => null,
			'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertTrue($model->isRunning());

		$model->attributes = array(
			'startDate' => $yesterday,
			'stopDate' => null,
			'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertTrue($model->isRunning());

		$model->attributes = array(
			'startDate' => $tomorrow,
			'stopDate' => null,
			'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertFalse($model->isRunning());

		$model->attributes = array(
			'startDate' => null,
			'stopDate' => $tomorrow,
			'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertTrue($model->isRunning());

		$model->attributes = array(
			'startDate' => null,
			'stopDate' => $today,
			'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertFalse($model->isRunning());

		$model->attributes = array(
			'startDate' => null,
			'stopDate' => $yesterday,
			'state' => Adventure::STATE_PUBLISHED,
		);
		$this->assertFalse($model->isRunning());
	}
}
