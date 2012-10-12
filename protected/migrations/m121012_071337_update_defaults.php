<?php

class m121012_071337_update_defaults extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('Archipelago', 'createdBy', 'INTEGER NULL');
		$this->alterColumn('Island', 'createdBy', 'INTEGER NULL');
		$this->alterColumn('MapSection', 'createdBy', 'INTEGER NULL');
		$this->alterColumn('World', 'createdBy', 'INTEGER NULL');
	}

	public function safeDown()
	{
		$this->alterColumn('Archipelago', 'createdBy', 'INTEGER NOT NULL');
		$this->alterColumn('Island', 'createdBy', 'INTEGER NOT NULL');
		$this->alterColumn('MapSection', 'createdBy', 'INTEGER NOT NULL');
		$this->alterColumn('World', 'createdBy', 'INTEGER NOT NULL');
	}

}
