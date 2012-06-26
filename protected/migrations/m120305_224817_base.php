<?php

class m120305_224817_base extends CDbMigration {

	public function safeUp()
	{

		$this->createTable('Adventure',
				array(
						'id' => 'pk',
						'name' => 'string NOT NULL',
						'description' => 'text',
				)
		);

		$this->createTable('AdventureStep',
				array(
						'id' => 'pk',
						'adventure' => 'integer NOT NULL',
						'name' => 'string NOT NULL',
						'description' => 'text',
				)
		);
		$this->createIndex('adventurestep_adventure_idx', 'AdventureStep', 'adventure');
		$this->addForeignKey('adventurestep_adventure_fk', 'AdventureStep', 'adventure', 'Adventure', 'id');

		$this->createTable('AdventureStepOption',
				array(
						'id' => 'pk',
						'parent' => 'integer NOT NULL',
						'target' => 'integer NOT NULL',
						'name' => 'string NOT NULL',
				)
		);
		$this->createIndex('adventurestepoption_parent_idx', 'AdventureStepOption', 'parent');
		$this->createIndex('adventurestepoption_target_idx', 'AdventureStepOption', 'target');
		$this->addForeignKey('adventurestepoption_parent_fk', 'AdventureStepOption', 'parent', 'AdventureStep', 'id');
		$this->addForeignKey('adventurestepoption_target_fk', 'AdventureStepOption', 'target', 'AdventureStep', 'id');

		$this->createTable('UserGroup',
				array(
						'id' => 'pk',
						'name' => 'string NOT NULL',
				)
		);

		$this->createTable('User',
				array(
						'id' => 'pk',
						'username' => 'string NOT NULL',
						'password' => 'string NOT NULL',
						'email' => 'string NOT NULL',
						'groupId' => 'integer NOT NULL',
				)
		);
		$this->createIndex('user_groupId_idx', 'User', 'groupId');
		$this->addForeignKey('user_groupId_fk', 'User', 'groupId', 'UserGroup', 'id');

	}

	public function safeDown()
	{
		$this->dropTable('AdventureStepOption');
		$this->dropTable('AdventureStep');
		$this->dropTable('Adventure');
		$this->dropTable('User');
		$this->dropTable('UserGroup');
	}

}
