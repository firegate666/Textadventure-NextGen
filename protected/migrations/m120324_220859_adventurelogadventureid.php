<?php

class m120324_220859_adventurelogadventureid extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('AdventureLog', 'adventureId', 'integer NOT NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('AdventureLog', 'adventureId');
	}

}
