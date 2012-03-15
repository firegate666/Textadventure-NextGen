<?php

class m120311_193921_adventuring extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('ALTER TABLE Adventure ADD COLUMN adventureId VARCHAR(32) NOT NULL;');
		$this->execute('ALTER TABLE AdventureStep ADD COLUMN stepId VARCHAR(32) NOT NULL;');
		$this->execute('ALTER TABLE AdventureStep ADD COLUMN startingPoint TINYINT NOT NULL DEFAULT 0;');
	}

	public function down()
	{
		echo "m120311_193921_adventuring does not support migration down.\n";
		return false;
	}

}