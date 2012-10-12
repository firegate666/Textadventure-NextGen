<?php

class m121012_075904_update_defaults_2 extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('Storage', 'createdBy', 'INTEGER NULL');
	}

	public function safeDown()
	{
		$this->alterColumn('Storage', 'createdBy', 'INTEGER NOT NULL');
	}

}
