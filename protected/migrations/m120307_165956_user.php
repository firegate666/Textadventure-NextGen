<?php

class m120307_165956_user extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('User', 'salt', 'string NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('User', 'salt');
	}

}
