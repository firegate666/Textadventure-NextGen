<?php

class m120324_220859_adventurelogadventureid extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE AdventureLog ADD COLUMN adventureId INTEGER NOT NULL REFERENCES Adventure');
	}

	public function down()
	{
		$this->execute('ALTER TABLE AdventureLog DROP COLUMN adventureId');
	}

}
