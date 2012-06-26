<?php

class m120308_214616_group_admin extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('UserGroup', 'isAdmin', 'boolean NOT NULL DEFAULT false');

		$this->update('UserGroup', array('isAdmin' => true), 'name = :name', array(':name'=>'Admin'));
	}

	public function safeDown()
	{
		$this->dropColumn('UserGroup', 'isAdmin');
	}

}
