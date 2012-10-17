<?php

class m121012_071337_update_defaults extends CDbMigration
{
	public function safeUp()
	{
		if ($this->getDbConnection()->getDriverName() == 'pgsql') {
			$this->execute('ALTER TABLE "Archipelago" ALTER COLUMN "createdBy" DROP NOT NULL');
			$this->execute('ALTER TABLE "Island" ALTER COLUMN "createdBy" DROP NOT NULL');
			$this->execute('ALTER TABLE "MapSection" ALTER COLUMN "createdBy" DROP NOT NULL');
			$this->execute('ALTER TABLE "World" ALTER COLUMN "createdBy" DROP NOT NULL');
		} else {
			$this->alterColumn('Archipelago', 'createdBy', 'INTEGER NULL');
			$this->alterColumn('Island', 'createdBy', 'INTEGER NULL');
			$this->alterColumn('MapSection', 'createdBy', 'INTEGER NULL');
			$this->alterColumn('World', 'createdBy', 'INTEGER NULL');
		}
	}

	public function safeDown()
	{
		if ($this->getDbConnection()->getDriverName() == 'pgsql') {
			$this->execute('ALTER TABLE "Archipelago" ALTER COLUMN "createdBy" SET NOT NULL');
			$this->execute('ALTER TABLE "Island" ALTER COLUMN "createdBy" SET NOT NULL');
			$this->execute('ALTER TABLE "MapSection" ALTER COLUMN "createdBy" SET NOT NULL');
			$this->execute('ALTER TABLE "World" ALTER COLUMN "createdBy" SET NOT NULL');
		} else {
			$this->alterColumn('Archipelago', 'createdBy', 'INTEGER NOT NULL');
			$this->alterColumn('Island', 'createdBy', 'INTEGER NOT NULL');
			$this->alterColumn('MapSection', 'createdBy', 'INTEGER NOT NULL');
			$this->alterColumn('World', 'createdBy', 'INTEGER NOT NULL');
		}
	}

}
