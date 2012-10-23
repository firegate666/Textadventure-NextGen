<?php

class m121023_121153_add_stock_lastupdate extends CDbMigration
{

	public function safeUp()
	{
		$this->addColumn('Stock', 'lastResourceUpdate', 'integer NULL');
	}

	public function safeDown()
	{
		$this->dropColumn('Stock', 'lastResourceUpdate');
	}

}
