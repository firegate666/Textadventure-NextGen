<?php

class m120319_202710_starttopadventure extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE Adventure ADD COLUMN startDate DATE NULL');
		$this->execute('ALTER TABLE Adventure ADD COLUMN stopDate DATE NULL');
		$this->execute('ALTER TABLE Adventure ADD COLUMN state INTEGER NOT NULL DEFAULT 1');

		$this->execute('UPDATE Adventure SET state = 2');
	}

	public function down()
	{
		$this->execute('ALTER TABLE Adventure DROP COLUMN startDate');
		$this->execute('ALTER TABLE Adventure DROP COLUMN stopDate');
		$this->execute('ALTER TABLE Adventure DROP COLUMN state');
	}

}
