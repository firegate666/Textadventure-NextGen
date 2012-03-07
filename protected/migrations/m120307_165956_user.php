<?php

class m120307_165956_user extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE User ADD COLUMN salt varchar(128);');
	}

	public function down()
	{
		echo "m120307_165956_user does not support migration down.\n";
		return false;
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