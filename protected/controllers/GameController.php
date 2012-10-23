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

	/**
	 * show the world list and select game to play
	 *
	 * @return void
	 */
	public function actionIndex()
	{
		$worlds = World::model()->findAll();
		$this->render('index',
			array(
				'world_list' => $worlds
			)
		);
	}

	/**
	 * enter new world and redirect to index
	 *
	 * @param integer $world_id
	 * @return void
	 */
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

	/**
	 * show world map
	 *
	 * @return void
	 */
	public function actionWorldMap()
	{
		$this->render('worldMap');
	}

	/**
	 * show own islands
	 *
	 * @return void
	 */
	public function actionOwnIslands()
	{
		$this->render('ownIslands', array('user_id' => Yii::app()->user->id, 'world_id' => $this->getSessionValue('player_world', false)));
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
				'hasWorld + worldMap, islands, research, highscore', // check that player has entered world
				'gameTasks',
			)
		);
	}

	/**
	 * execute game tasks
	 * depends on app parameter update_every_hit
	 * should only be enabled if no cron task is running to do the job
	 *
	 * @param CFilterChain $filterchain
	 * @return void
	 */
	public function filterGameTasks(CFilterChain $filterchain)
	{
		if (Yii::app()->params['update_every_hit'])
		{
			$world_id = $this->getSessionValue('player_world', false);
			if ($world_id) {
				World::model()->findByPk($world_id)->updateIslands();
			}
		}
		$filterchain->run();
	}

	/**
	 * check if logged in player is continuing a world
	 * otherwise redirect to index
	 *
	 * @param CFilterChain $filterchain
	 * @return void
	 */
	public function filterHasWorld(CFilterChain $filterchain)
	{
		if ($this->getSessionValue('player_world', false) === false) {
			$this->redirect(array('game/index'));
		}
		$filterchain->run();
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
