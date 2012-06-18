<?php

class m120321_144504_modelmetainfo extends CDbMigration
{

	/**
	 * tables to alter in this migration
	 *
	 * @var array
	 */
	protected $tables_to_alter = array(
		'Adventure',
		'AdventureStep',
		'AdventureStepOption',
		'User',
		'UserGroup',
	);

	public function up()
	{
		foreach ($this->tables_to_alter as $table_name)
		{
			$this->addColumn($table_name, 'createdAt', 'DATETIME NULL');
			$this->addColumn($table_name, 'changedAt', 'DATETIME NULL');
			$this->addColumn($table_name, 'createdBy', 'INTEGER NULL');
			$this->addColumn($table_name, 'changedBy', 'INTEGER NULL');
			$this->createIndex('createuser_idx', $table_name, 'createdBy');
			$this->createIndex('changeuser_idx', $table_name, 'changedBy');
			$this->addForeignKey('createuser_fk', $table_name, 'createdBy', 'User', 'id');
			$this->addForeignKey('changeuser_idx', $table_name, 'changedBy', 'User', 'id');
		}
	}

	public function down()
	{
		foreach ($this->tables_to_alter as $table_name)
		{
			$this->dropColumn($table_name, 'createdAt');
			$this->dropColumn($table_name, 'changedAt');
			$this->dropColumn($table_name, 'createdBy');
			$this->dropColumn($table_name, 'changedBy');
		}
	}

}
