<?php

class m120318_201254_defaultusergroup extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE UserGroup ADD COLUMN defaultRegisterGroup TINYINT NOT NULL DEFAULT 0;');
		$this->execute('UPDATE UserGroup SET defaultRegisterGroup = 1 WHERE name = :name', array(':name' => 'User'));
	}

	public function down()
	{
		$this->execute('ALTER TABLE UserGroup DROP COLUMN defaultRegisterGroup');
	}

}
