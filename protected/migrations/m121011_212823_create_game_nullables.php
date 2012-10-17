<?php

class m121011_212823_create_game_nullables extends CDbMigration
{
	public function safeUp()
	{
		if ($this->getDbConnection()->getDriverName() == 'pgsql') {
			$this->execute('ALTER TABLE "MapSection" ALTER COLUMN "leftSectionId" DROP NOT NULL');
			$this->execute('ALTER TABLE "MapSection" ALTER COLUMN "rightSectionId" DROP NOT NULL');
		} else {
			$this->alterColumn('MapSection', 'leftSectionId', 'INTEGER NULL');
			$this->alterColumn('MapSection', 'rightSectionId', 'INTEGER NULL');
		}
	}

	public function safeDown()
	{
		if ($this->getDbConnection()->getDriverName() == 'pgsql') {
			$this->execute('ALTER TABLE "MapSection" ALTER COLUMN "leftSectionId" SET NOT NULL');
			$this->execute('ALTER TABLE "MapSection" ALTER COLUMN "rightSectionId" SET NOT NULL');
		} else {
			$this->alterColumn('MapSection', 'leftSectionId', 'INTEGER NOT NULL');
			$this->alterColumn('MapSection', 'rightSectionId', 'INTEGER NOT NULL');
		}
	}

}
