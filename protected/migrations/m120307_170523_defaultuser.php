<?php

class m120307_170523_defaultuser extends CDbMigration
{
	public function safeUp()
	{
		$this->truncateTable('UserGroup');
		$this->truncateTable('User');

		$this->createIndex('user_username_unq', 'User', 'username', true);

		$this->insert('UserGroup', array('name' => 'Admin'));
		$admin_group = $this->getDbConnection()->getLastInsertID('"UserGroup_id_seq"');

		$this->insert('UserGroup', array('name' => 'User'));
		$user_group = $this->getDbConnection()->getLastInsertID('"UserGroup_id_seq"');

		$this->insert('User',
				array(
						'username' => 'admin',
						'password' => md5('admin'),
						'email' => 'admin@example.org',
						'groupId' => $admin_group,
						'salt' => 'easysalt'
				)
		);

		$this->insert('User',
				array(
						'username' => 'demo',
						'password' => md5('demo'),
						'email' => 'demo@example.org',
						'groupId' => $user_group,
						'salt' => 'easysalt'
				)
		);

	}

	public function safeDown()
	{
		echo "m120307_170523_defaultuser does not support migration down.\n";
		return false;
	}

}
