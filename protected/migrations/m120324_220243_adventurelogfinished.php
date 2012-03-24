<?php

class m120324_220243_adventurelogfinished extends CDbMigration
{
	public function up()
	{
		$this->execute('ALTER TABLE AdventureLog ADD COLUMN finalized TINYINT NOT NULL DEFAULT 0');
	}

	public function down()
	{
		$this->execute('ALTER TABLE AdventureLog DROP COLUMN finalized');
	}

}
