<?php

class m120307_192515_defaultuser_fixed extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE User DROP CONSTRAINT `user_ibfk_1`;');
		$this->execute('DELETE FROM User;');
		$this->execute("INSERT INTO  User (username, password, email, groupId, salt)
				VALUES ('admin', MD5('admineasysalt'), 'yourmail@example.org', (SELECT id FROM UserGroup WHERE name = 'Admin'), 'easysalt');");
		$this->execute("INSERT INTO  User (username, password, email, groupId, salt)
				VALUES ('demo', MD5('demoeasysalt'), 'yourmail@example.org', (SELECT id FROM UserGroup WHERE name = 'User'), 'easysalt');");
		
	}

	public function down()
	{
		echo "m120307_192515_defaultuser_fixed does not support migration down.\n";
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