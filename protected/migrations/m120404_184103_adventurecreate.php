<?php

class m120404_184103_adventurecreate extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE UserGroup ADD COLUMN canCreateAdventure TINYINT NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->execute('ALTER TABLE UserGroup DROP COLUMN canCreateAdventure');
	}

}
