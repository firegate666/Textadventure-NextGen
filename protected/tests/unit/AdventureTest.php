<?php

class AdventureTest extends PHPUnit_Framework_TestCase
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
		// bit gets an auto created value
		$this->assertFalse(empty($model->adventureId));
		$this->assertFalse(stripos($model->adventureId, ' '));
		
		// a second validation should auto accept the auto created value
		$model->validate();
		$this->assertFalse($model->hasErrors('adventureId'));
		
	}
}
