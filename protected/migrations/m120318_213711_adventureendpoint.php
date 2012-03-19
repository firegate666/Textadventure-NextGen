<?php

class m120318_213711_adventureendpoint extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE AdventureStep ADD COLUMN endingPoint TINYINT NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->execute('ALTER TABLE AdventureStep DROP COLUMN endingPoint');
	}
}
