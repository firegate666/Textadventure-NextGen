<?php

class GameController extends Controller
{
	public function actionIndex()
	{
		$worlds = World::model()->findAll();
		$this->render('index',
			array(
				'world_list' => $worlds
			)
		);
	}

	public function actionEnterWorld($world_id) {
		$world = World::model()->findByPk(intval($world_id));
		if ($world instanceof World) {
			$world->enterWorld(Yii::app()->user->id);
		}
	}

	public function actionWorldMap()
	{
		$this->render('index');
	}

	public function actionislands()
	{
		$this->render('index');
	}

	public function actionResearch()
	{
		$this->render('index');
	}

	public function actionHighscore()
	{
		$this->render('index');
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array_merge(
			parent::filters(),
			array(
				'accessControl', // perform access control for CRUD operations
			)
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('index', 'worldMap', 'islands', 'research', 'highscore', 'enterWorld'),
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

}
