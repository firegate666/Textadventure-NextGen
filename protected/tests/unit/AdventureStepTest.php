<?php
Yii::import('application.tests.unit.AbstractUnitTest');

class AdventureStepTest extends AbstractUnitTest
{

	public function testRequirements()
	{
		$post = array(
			'adventure' => 1,
			'name' => 'This is my test name',
			'description' => 'This is my test description',
		);

		$model = new AdventureStep();
		$model->attributes = $post;
		$model->validate();

		// step id is required
		$this->assertTrue($model->hasErrors('stepId'), var_export($model->getErrors('stepId'), true));

		// bit gets an auto created value
		$this->assertFalse(empty($model->stepId));
		$this->assertFalse(stripos($model->stepId, ' '));

		$this->assertFalse($model->hasErrors('startingPoint'), var_export($model->getErrors('startingPoint'), true));
		$this->assertTrue(isset($model->startingPoint));
		$this->assertEquals(0, $model->startingPoint);

		// a second validation should auto accept the auto created value
		$model->validate();
		$this->assertFalse($model->hasErrors('stepId'), var_export($model->getErrors('stepId'), true));

	}
}
