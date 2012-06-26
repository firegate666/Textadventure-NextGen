<?php

class m120319_202710_starttopadventure extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('Adventure', 'startDate', 'date NOT NULL');
		$this->addColumn('Adventure', 'startDate', 'stopDate NOT NULL');
		$this->addColumn('Adventure', 'state', 'integer NOT NULL DEFAULT 1');

		$this->update('Adventure', array('state' => 2));
	}

	public function safeDown()
	{
		$this->dropColumn('Adventure', 'startDate');
		$this->dropColumn('Adventure', 'startDate');
		$this->dropColumn('Adventure', 'state');
	}

}
