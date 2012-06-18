<?php

class m120311_193921_adventuring extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('Adventure', 'adventureId', 'string NOT NULL');
		$this->addColumn('AdventureStep', 'stepId', 'string NOT NULL');
		$this->addColumn('AdventureStep', 'startingPoint', 'boolean NOT NULL DEFAULT false');
	}

	public function down()
	{
		$this->dropColumn('Adventure', 'adventureId');
		$this->dropColumn('AdventureStep', 'stepId');
		$this->dropColumn('AdventureStep', 'startingPoint');
	}

}
