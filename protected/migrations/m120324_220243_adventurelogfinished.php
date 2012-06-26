<?php

class m120324_220243_adventurelogfinished extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('AdventureLog', 'finalized', 'boolean NOT NULL DEFAULT false');
	}

	public function safeDown()
	{
		$this->dropColumn('AdventureLog', 'finalized');
	}

}
