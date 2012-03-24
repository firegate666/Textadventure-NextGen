<?php

class m120324_205301_adventurelog extends CDbMigration
{
	public function up()
	{
		$this->execute ( 'CREATE TABLE `AdventureLog` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				createdAt DATETIME NULL,
				changedAt DATETIME NULL,
				createdBy INTEGER NULL REFERENCES User,
				changedBy INTEGER NULL REFERENCES User,
				userId INTEGER NOT NULL REFERENCES User,
				adventureStepId INTEGER NOT NULL REFERENCES AdventureStep,
				PRIMARY KEY (`id`),
				KEY `userId` (`userId`),
				KEY `adventureStepId` (`adventureStepId`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;' );

		$this->execute ( 'CREATE TABLE `AdventureParticipation` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				createdAt DATETIME NULL,
				changedAt DATETIME NULL,
				createdBy INTEGER NULL REFERENCES User,
				changedBy INTEGER NULL REFERENCES User,
				userId INTEGER NOT NULL REFERENCES User,
				adventureId INTEGER NOT NULL REFERENCES Adventure,
				started DATETIME NOT NULL,
				ended DATETIME NULL,
				PRIMARY KEY (`id`),
				KEY `userId` (`userId`),
				KEY `adventureId` (`adventureId`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;' );
	}

	public function down()
	{
		$this->execute('DROP TABLE AdventureLog');
		$this->execute('DROP TABLE AdventureParticipation');
	}

}
