<?php

class m120318_213711_adventureendpoint extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('AdventureStep', 'endingPoint', 'boolean NOT NULL DEFAULT false');
	}

	public function safeDown()
	{
		$this->dropColumn('AdventureStep', 'endingPoint');
	}
}
