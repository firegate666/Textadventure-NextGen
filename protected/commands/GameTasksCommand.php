<?php
Yii::import('application.commands.AbstractCommand');

/**
 * Yiic command to delete assets and cache
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
		foreach (Island::model()->getWorldIslands($world_id) as $island) {
			if ($island instanceof Island && $island->ownerId !== null)
			{
				$this->verbose('Update island %d:%s with resources', $island->id, $island->name);
				$ts = $island->updateResources();
			}
		}
	}

}
