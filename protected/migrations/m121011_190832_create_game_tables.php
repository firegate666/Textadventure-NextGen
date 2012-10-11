<?php

class m121011_190832_create_game_tables extends CDbMigration
{
	public function safeUp()
	{	
		$this->createTable('Archipelago',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'name' => 'string NOT NULL',
				'xPos' => 'INTEGER NOT NULL',
				'yPos' => 'INTEGER NOT NULL',
				'magnitude' => 'INTEGER NOT NULL',
				'mapSectionId' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('Island',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'name' => 'string NOT NULL',
				'size' => 'INTEGER NOT NULL',
				'xPos' => 'INTEGER NOT NULL',
				'yPos' => 'INTEGER NOT NULL',
				'archipelagoId' => 'INTEGER NOT NULL',
				'ownerId' => 'INTEGER NULL',
				'storageId' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('MapSection',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'leftSectionId' => 'INTEGER NOT NULL',
				'rightSectionId' => 'INTEGER NOT NULL',
				'worldId' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('Storage',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'capacity' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('Stock',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'storageId' => 'INTEGER NOT NULL',
				'resourceId' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('Resource',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'name' => 'string NOT NULL',
				'description' => 'TEXT NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('ResourceProduction',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'islandId' => 'INTEGER NOT NULL',
				'resourceId' => 'INTEGER NOT NULL',
				'growthFactor' => 'FLOAT NOT NULL',
				'productionValue' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('TechTreeCategory',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NULL',
				'changedBy' => 'INTEGER NULL',
				'name' => 'string NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('TechTreeType',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NULL',
				'changedBy' => 'INTEGER NULL',
				'name' => 'string NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('TechTreeEntry',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NULL',
				'changedBy' => 'INTEGER NULL',
				'name' => 'string NOT NULL',
				'description' => 'string NOT NULL',
				'costs' => 'INTEGER NOT NULL',
				'categoryId' => 'INTEGER NOT NULL',
				'typeId' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('TechTreeEntryDependency',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'techId' => 'INTEGER NOT NULL',
				'dependencyId' => 'INTEGER NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('TechTreeEntryResearch',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'userId' => 'INTEGER NOT NULL',
				'techId' => 'INTEGER NOT NULL',
				'start' => 'timestamp NOT NULL',
				'end' => 'timestamp NULL',
				'finished' => 'boolean NOT NULL DEFAULT false',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable('World',
			array(
				'id' => 'pk',
				'createdAt' => 'timestamp NOT NULL',
				'changedAt' => 'timestamp NULL',
				'createdBy' => 'INTEGER NOT NULL',
				'changedBy' => 'INTEGER NULL',
				'name' => 'string NOT NULL',
			), 'ENGINE InnoDB DEFAULT CHARSET=utf8'
		);

		$this->addForeignKey('archipelago_map_fk', 'Archipelago', 'mapSectionId', 'MapSection', 'id');

		$this->addForeignKey('island_archipelago_fk', 'Island', 'archipelagoId', 'Archipelago', 'id');
		$this->addForeignKey('island_owner_fk', 'Island', 'ownerId', 'User', 'id');
		$this->addForeignKey('island_storage_fk', 'Island', 'storageId', 'Storage', 'id');

		$this->addForeignKey('mapsection_left_fk', 'MapSection', 'leftSectionId', 'MapSection', 'id');
		$this->addForeignKey('mapsection_right_fk', 'MapSection', 'rightSectionId', 'MapSection', 'id');
		$this->addForeignKey('mapsection_world_fk', 'MapSection', 'worldId', 'World', 'id');

		$this->addForeignKey('stock_storage_fk', 'Stock', 'storageId', 'Storage', 'id');
		$this->addForeignKey('stock_resource_fk', 'Stock', 'resourceId', 'Resource', 'id');

		$this->addForeignKey('resourceproduction_island_fk', 'ResourceProduction', 'islandId', 'Island', 'id');
		$this->addForeignKey('resourceproduction_resource_fk', 'ResourceProduction', 'resourceId', 'Resource', 'id');
		$this->createIndex('resourceproduction_unique', 'ResourceProduction', 'islandId, resourceId', true);

		$this->addForeignKey('techtreeentry_category_fk', 'TechTreeEntry', 'categoryId', 'TechTreeCategory', 'id');
		$this->addForeignKey('techtreeentry_type_fk', 'TechTreeEntry', 'typeId', 'TechTreeType', 'id');

		$this->addForeignKey('techtreeentrydependency_entry_fk', 'TechTreeEntryDependency', 'techId', 'TechTreeEntry', 'id');
		$this->addForeignKey('techtreeentrydependency_dependency_fk', 'TechTreeEntryDependency', 'dependencyId', 'TechTreeEntry', 'id');

		$this->addForeignKey('techtreeentryresearch_user_fk', 'TechTreeEntryResearch', 'userId', 'User', 'id');
		$this->addForeignKey('techtreeentryresearch_entry_fk', 'TechTreeEntryResearch', 'techId', 'TechTreeEntry', 'id');

		$tables = array(
			'Archipelago', 'Island', 'MapSection', 'Storage', 'Stock', 'Resource', 'ResourceProduction', 'World',
			'TechTreeCategory', 'TechTreeType', 'TechTreeEntry', 'TechTreeEntryDependency', 'TechTreeEntryResearch'
		);
		foreach ($tables as $table_name)
		{
			$this->createIndex(strtolower($table_name) . '_createuser_idx', $table_name, 'createdBy');
			$this->createIndex(strtolower($table_name) . '_changeuser_idx', $table_name, 'changedBy');
			$this->addForeignKey(strtolower($table_name) . '_createuser_fk', $table_name, 'createdBy', 'User', 'id');
			$this->addForeignKey(strtolower($table_name) . '_changeuser_idx', $table_name, 'changedBy', 'User', 'id');
		}
		
		$this->insert('TechTreeCategory',
			array(
				'name' => 'Common',
				'createdAt' => date('Y-m-d H:i:s'),
			)
		);
		
		$this->insert('TechTreeType',
			array(
				'name' => 'Base technology',
				'createdAt' => date('Y-m-d H:i:s'),
			)
		);

		$this->insert('TechTreeEntry',
			array(
				'name' => 'Root technology',
				'description' => '',
				'costs' => 0,
				'categoryId' => 1,
				'typeId' => 1,
				'createdAt' => date('Y-m-d H:i:s'),
			)
		);

	}

	public function safeDown()
	{
		$tables = array(
			'Archipelago', 'Island', 'MapSection', 'Storage', 'Stock', 'Resource', 'ResourceProduction', 'World',
			'TechTreeCategory', 'TechTreeType', 'TechTreeEntry', 'TechTreeEntryDependency', 'TechTreeEntryResearch'
		);

		foreach ($tables as $table_name)
		{
			$this->dropTable($table_name);
		}
	}

}
