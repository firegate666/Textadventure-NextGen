<?php

class m120307_192515_defaultuser_fixed extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('DELETE FROM User;');

		$this->truncateTable('UserGroup');
		$this->truncateTable('User');

		$this->insert('UserGroup', array('name' => 'Admin'));
		$admin_group = $this->getDbConnection()->getLastInsertID();

		$this->insert('UserGroup', array('name' => 'User'));
		$user_group = $this->getDbConnection()->getLastInsertID();

		$this->insert('User',
				array(
						'username' => 'admin',
						'password' => md5('admineasysalt'),
						'email' => 'admin@example.org',
						'groupId' => $admin_group,
						'salt' => 'easysalt'
				)
		);

		$this->insert('User',
				array(
						'username' => 'demo',
						'password' => md5('demoeasysalt'),
						'email' => 'demo@example.org',
						'groupId' => $user_group,
						'salt' => 'easysalt'
				)
		);
	}

	public function down()
	{
		echo "m120307_192515_defaultuser_fixed does not support migration down.\n";
		return false;
	}

}
