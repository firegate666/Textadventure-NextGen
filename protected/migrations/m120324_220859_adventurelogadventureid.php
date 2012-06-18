<?php

class m120324_220859_adventurelogadventureid extends CDbMigration
{
	public function up()
	{
		$this->addColumn('AdventureLog', 'adventureId', 'integer NOT NULL');
	}

	public function down()
	{
		$this->execute('ALTER TABLE AdventureLog DROP COLUMN adventureId');
	}

}
