<?php

class m131221_005338_add_login_timestamp extends CDbMigration
{
	public function up()
	{
		$this->addColumn('User', 'lastLogin', 'timestamp NULL');
	}

	public function down()
	{
		$this->dropColumn('User', 'lastLogin');
	}
}
