<?php

class m120307_170523_defaultuser extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('DELETE FROM User;');
		$this->execute('DELETE FROM UserGroup;');
		
		$this->execute('ALTER TABLE User ADD UNIQUE (username);');
		$this->execute('ALTER TABLE UserGroup CHANGE name name VARCHAR( 256 ) NOT NULL;');
		
		$this->execute("INSERT INTO UserGroup (name) VALUES ('Admin'), ('User');");
		$this->execute("INSERT INTO  User (username, password, email, groupId, salt)
				VALUES ('admin', MD5('admin'), 'yourmail@example.org', (SELECT id FROM UserGroup WHERE name = 'Admin'), 'easysalt');");
		$this->execute("INSERT INTO  User (username, password, email, groupId, salt)
				VALUES ('demo', MD5('demo'), 'yourmail@example.org', (SELECT id FROM UserGroup WHERE name = 'User'), 'easysalt');");
	}

	public function down()
	{
		echo "m120307_170523_defaultuser does not support migration down.\n";
		return false;
	}

}
