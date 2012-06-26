<?php

class m120318_201254_defaultusergroup extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('UserGroup', 'defaultRegisterGroup', 'boolean NOT NULL DEFAULT false');
		$this->update('UserGroup', array('defaultRegisterGroup' => true), 'name = :name', array(':name' => 'User'));
	}

	public function safeDown()
	{
		$this->dropColumn('UserGroup', 'defaultRegisterGroup');
	}

}
