<?php
Yii::import('application.commands.AbstractCommand');

/**
 * Yiic command to delete assets and cache
 *
 * @package console
 * @subpackage seawars
 */
class GameTasksCommand extends AbstractCommand
{

	/**
	 * if confirmation prompt is displayed or not
	 *
	 * @var boolean
	 */
	public $interactive = 1;

	/**
	 * @see CConsoleCommand::init()
	 * @return void
	 */
	public function init()
	{
		parent::init();
		$this->defaultAction = 'help';
	}

	/**
	 * update inhabited islands
	 *
	 * @param integer $world_id
	 * @return void
	 */
	public function actionUpdateIslands($world_id)
	{
		$this->printf('[UpdateIslands] %s Start update islands for world %s', date('Y-m-d H:i:s'), $world_id);
		$updated = World::model()->findByPk($world_id)->updateIslands();
		$this->printf('[UpdateIslands] %s End update islands for world %s, updated %d', date('Y-m-d H:i:s'), $world_id, $updated);
	}

}
