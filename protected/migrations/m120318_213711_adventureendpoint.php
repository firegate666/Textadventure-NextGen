<?php

class m120318_213711_adventureendpoint extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE AdventureStep ADD COLUMN endingPoint TINYINT NOT NULL DEFAULT 0');
	}

	public function down()
	{
		echo "m120318_213711_adventureendpoint does not support migration down.\n";
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