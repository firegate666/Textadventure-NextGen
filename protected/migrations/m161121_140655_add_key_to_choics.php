<?php

class m161121_140655_add_key_to_choics extends CDbMigration
{
	public function up()
	{
		$this->addColumn('AdventureStepOption', 'key', 'varchar(1)');
	}

	public function down()
	{
		$this->dropColumn('AdventureStepOption', 'key');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
