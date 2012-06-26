<?php

class m120404_184103_adventurecreate extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('UserGroup', 'canCreateAdventure', 'boolean NOT NULL DEFAULT false');
	}

	public function safeDown()
	{
		$this->dropColumn('UserGroup', 'canCreateAdventure');
	}

}
