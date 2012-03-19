<?php

class m120307_165956_user extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('ALTER TABLE User ADD COLUMN salt varchar(128);');
	}

	public function down()
	{
		$this->execute('ALTER TABLE DROP COLUMN salt');
	}

}
