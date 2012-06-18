<?php

class m120324_220243_adventurelogfinished extends CDbMigration
{
	public function up()
	{
		$this->addColumn('AdventureLog', 'finalized', 'boolean NOT NULL DEFAULT false');
	}

	public function down()
	{
		$this->dropColumn('AdventureLog', 'finalized');
	}

}
