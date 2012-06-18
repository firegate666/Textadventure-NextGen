<?php

class m120318_213711_adventureendpoint extends CDbMigration
{
	public function up()
	{
		$this->addColumn('AdventureStep', 'endingPoint', 'boolean NOT NULL DEFAULT false');
	}

	public function down()
	{
		$this->dropColumn('AdventureStep', 'endingPoint');
	}
}
