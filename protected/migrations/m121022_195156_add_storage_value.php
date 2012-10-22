<?php

class m121022_195156_add_storage_value extends CDbMigration
{

	public function safeUp()
	{
		$this->addColumn('Stock', 'amount', 'FLOAT NOT NULL DEFAULT 0');
	}

	public function safeDown()
	{
		$this->dropColumn('Stock', 'amount');
	}

}
