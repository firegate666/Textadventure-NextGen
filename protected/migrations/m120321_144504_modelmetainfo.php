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
			$this->execute('ALTER TABLE ' . $table_name . ' ADD COLUMN createdAt DATETIME NULL');
			$this->execute('ALTER TABLE ' . $table_name . ' ADD COLUMN changedAt DATETIME NULL');
			$this->execute('ALTER TABLE ' . $table_name . ' ADD COLUMN createdBy INTEGER NULL REFERENCES User');
			$this->execute('ALTER TABLE ' . $table_name . ' ADD COLUMN changedBy INTEGER NULL REFERENCES User');
		}
	}

	public function down()
	{
		foreach ($this->tables_to_alter as $table_name)
		{
			$this->execute('ALTER TABLE ' . $table_name . ' DROP COLUMN createdAt');
			$this->execute('ALTER TABLE ' . $table_name . ' DROP COLUMN changedAt');
			$this->execute('ALTER TABLE ' . $table_name . ' DROP COLUMN createdBy');
			$this->execute('ALTER TABLE ' . $table_name . ' DROP COLUMN changedBy');
		}
	}

}
