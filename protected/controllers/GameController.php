<?php

class GameController extends Controller
{
	/**
	 * register basic script files
	 *
	 * @return void
	 */
	public function init()
	{
		parent::init();

		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . 'themes/drachendaemmerung/js/game.js');
	}
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
		$this->redirect(array('game/index'));
	}

	/**
	 * login player to world and redirect to world map
	 *
	 * @param integer $world_id
	 * @return void
	 */
	public function actionPlayWorld($world_id) {
		if (World::model()->findByPk(intval($world_id))->playerIsOnWorld(Yii::app()->user->id)) {
			$this->addSessionValue('player_world', $world_id, true);
			$this->redirect(array('game/worldMap'));
		}
	}
	public function actionWorldMap()
	{
		$this->render('worldMap');
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
				'actions' => array('index', 'worldMap', 'ownIslands', 'research', 'highscore', 'enterWorld', 'playWorld'),
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

}
