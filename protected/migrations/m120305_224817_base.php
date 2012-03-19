<?php

class m120305_224817_base extends CDbMigration {

	public function safeUp()
	{
		$this->execute ( 'CREATE TABLE `Adventure` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(256) NOT NULL,
				`description` text NOT NULL,
				PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;' );

		$this->execute ( 'CREATE TABLE `AdventureStep` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`adventure` int(11) NOT NULL,
				`name` varchar(256) NOT NULL,
				`description` text NOT NULL,
				PRIMARY KEY (`id`),
				KEY `adventure` (`adventure`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;' );

		$this->execute ( 'CREATE TABLE `AdventureStepOption` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`parent` int(11) NOT NULL,
				`target` int(11) NOT NULL,
				`name` varchar(256) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `parent` (`parent`),
				KEY `target` (`target`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;' );

		$this->execute ( 'CREATE TABLE `User` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`username` varchar(128) NOT NULL,
				`password` varchar(128) NOT NULL,
				`email` varchar(128) NOT NULL,
				`groupId` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `groupid` (`groupId`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;' );

		$this->execute ( 'CREATE TABLE `UserGroup` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` int(11) NOT NULL,
				PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;' );

		$this->execute ( 'ALTER TABLE `AdventureStep`
		ADD CONSTRAINT `adventurestep_ibfk_1` FOREIGN KEY (`adventure`) REFERENCES `Adventure` (`id`);' );

		$this->execute ( 'ALTER TABLE `AdventureStepOption`
		ADD CONSTRAINT `adventurestepoption_ibfk_2` FOREIGN KEY (`target`) REFERENCES `AdventureStep` (`id`),
		ADD CONSTRAINT `adventurestepoption_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AdventureStep` (`id`);' );

		$this->execute ( 'ALTER TABLE `User`
		ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`groupId`) REFERENCES `UserGroup` (`id`),
		ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `User` (`id`);' );

	}

	public function down()
	{
		$this->execute('ALTER TABLE User DROP FOREIGN KEY user_ibfk_1');
		$this->execute('ALTER TABLE User DROP FOREIGN KEY user_ibfk_2');

		$this->execute('ALTER TABLE AdventureStepOption DROP FOREIGN KEY adventurestepoption_ibfk_2');
		$this->execute('ALTER TABLE AdventureStepOption DROP FOREIGN KEY adventurestepoption_ibfk_1');

		$this->execute('ALTER TABLE AdventureStep DROP FOREIGN KEY adventurestep_ibfk_1');

		$this->execute('DROP TABLE UserGroup');
		$this->execute('DROP TABLE User');
		$this->execute('DROP TABLE AdventureStepOption');
		$this->execute('DROP TABLE AdventureStep');
		$this->execute('DROP TABLE Adventure');
	}

}
