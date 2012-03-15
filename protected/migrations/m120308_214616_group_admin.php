<?php

class m120308_214616_group_admin extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('ALTER TABLE UserGroup ADD COLUMN isAdmin TINYINT NOT NULL DEFAULT 0');
		$this->execute('UPDATE UserGroup SET isAdmin = 1 WHERE name = :name', array(':name'=>'Admin'));
	}

	public function down()
	{
		echo "m120308_214616_group_admin does not support migration down.\n";
		return false;
	}

}