<?php

class m120324_205301_adventurelog extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('AdventureLog',
				array(
						'id' => 'pk',
						'createdAt' => 'DATETIME NULL',
						'changedAt' => 'DATETIME NULL',
						'createdBy' => 'INTEGER NOT NULL',
						'changedBy' => 'INTEGER NOT NULL',
						'userId' => 'INTEGER NOT NULL',
						'adventureStepId' => 'INTEGER NOT NULL',
				)
		);
		$this->addForeignKey('adventurelog_created_fk', 'AdventureLog', 'createdBy', 'User', 'id');
		$this->addForeignKey('adventurelog_changed_fk', 'AdventureLog', 'changedBy', 'User', 'id');
		$this->addForeignKey('adventurelog_user_fk', 'AdventureLog', 'userId', 'User', 'id');
		$this->addForeignKey('adventurelog_adventurestep_fk', 'AdventureLog', 'adventureStepId', 'AdventureStep', 'id');

		$this->createTable('AdventureParticipation',
				array(
						'id' => 'pk',
						'createdAt' => 'DATETIME NULL',
						'changedAt' => 'DATETIME NULL',
						'createdBy' => 'INTEGER NOT NULL',
						'changedBy' => 'INTEGER NOT NULL',
						'userId' => 'INTEGER NOT NULL',
						'adventureStepId' => 'INTEGER NOT NULL',
						'started' => 'DATETIME NOT NULL',
						'ended' => 'DATETIME NULL',
				)
		);
		$this->addForeignKey('adventureparticipation_created_fk', 'AdventureParticipation', 'createdBy', 'User', 'id');
		$this->addForeignKey('adventureparticipation_changed_fk', 'AdventureParticipation', 'changedBy', 'User', 'id');
		$this->addForeignKey('adventureparticipation_user_fk', 'AdventureParticipation', 'userId', 'User', 'id');
		$this->addForeignKey('adventureparticipation_adventure_fk', 'AdventureParticipation', 'adventureId', 'Adventure', 'id');
	}

	public function safeDown()
	{
		$this->dropTable('AdventureLog');
		$this->dropTable('AdventureParticipation');
	}

}
