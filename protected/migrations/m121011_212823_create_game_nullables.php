<?php

class m121011_212823_create_game_nullables extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('MapSection', 'leftSectionId', 'INTEGER NULL');
		$this->alterColumn('MapSection', 'rightSectionId', 'INTEGER NULL');
	}

	public function safeDown()
	{
		$this->alterColumn('MapSection', 'leftSectionId', 'INTEGER NOT NULL');
		$this->alterColumn('MapSection', 'rightSectionId', 'INTEGER NOT NULL');
	}

}
