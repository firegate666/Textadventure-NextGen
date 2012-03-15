<?php

class m120307_165956_user extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('ALTER TABLE User ADD COLUMN salt varchar(128);');
	}

	public function down()
	{
		echo "m120307_165956_user does not support migration down.\n";
		return false;
	}

}
