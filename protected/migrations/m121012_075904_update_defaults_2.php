<?php

class m121012_075904_update_defaults_2 extends CDbMigration
{
	public function safeUp()
	{
		if ($this->getDbConnection()->getDriverName() == 'pgsql') {
			$this->execute('ALTER TABLE "Storage" ALTER COLUMN "createdBy" DROP NOT NULL');
		} else {
			$this->alterColumn('Storage', 'createdBy', 'INTEGER NULL');
		}
	}

	public function safeDown()
	{
		if ($this->getDbConnection()->getDriverName() == 'pgsql') {
			$this->execute('ALTER TABLE "Storage" ALTER COLUMN "createdBy" SET NOT NULL');
		} else {
			$this->alterColumn('Storage', 'createdBy', 'INTEGER NOT NULL');
		}
	}

}
