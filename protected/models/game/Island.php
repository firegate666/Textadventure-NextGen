<?php

/**
 * This is the model class for table "Island".
 *
 * The followings are the available columns in table 'Island':
 * @property string $name
 * @property integer $size
 * @property integer $xPos
 * @property integer $yPos
 * @property integer $archipelagoId
 * @property integer $ownerId
 * @property integer $storageId
 *
 * The followings are the available model relations:
 * @property Archipelago $archipelago
 * @property User $owner
 * @property Storage $storage
 * @property ResourceProduction[] $resourceProductions
 *
 * @static Island model
 */
class Island extends MetaInfo
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Island';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, size, xPos, yPos, archipelagoId, storageId', 'required'),
			array('size, xPos, yPos, archipelagoId, ownerId, storageId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, name, size, xPos, yPos, archipelagoId, ownerId, storageId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'archipelago' => array(self::BELONGS_TO, 'Archipelago', 'archipelagoId'),
			'owner' => array(self::BELONGS_TO, 'User', 'ownerId'),
			'storage' => array(self::BELONGS_TO, 'Storage', 'storageId'),
			'resourceProductions' => array(self::HAS_MANY, 'ResourceProduction', 'islandId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'createdAt' => 'Created At',
			'changedAt' => 'Changed At',
			'createdBy' => 'Created By',
			'changedBy' => 'Changed By',
			'name' => 'Name',
			'size' => 'Size',
			'xPos' => 'X Pos',
			'yPos' => 'Y Pos',
			'archipelagoId' => 'Archipelago',
			'ownerId' => 'Owner',
			'storageId' => 'Storage',
		);
	}

	/**
	 * get search criterias for this model
	 *
	 * @return CDbCriteria
	 */
	protected function getSearchCriteria()
	{
		$criteria = parent::getSearchCriteria();
		$criteria->compare('name',$this->name,true);
		$criteria->compare('size',$this->size);
		$criteria->compare('xPos',$this->xPos);
		$criteria->compare('yPos',$this->yPos);
		$criteria->compare('archipelagoId',$this->archipelagoId);
		$criteria->compare('ownerId',$this->ownerId);
		$criteria->compare('storageId',$this->storageId);
		return $criteria;
	}

	/**
	 * give player start island
	 *
	 * @param integer $world_id
	 * @param integer $user_id
	 * @return Island
	 */
	public function getPlayerStartIsland($world_id, $user_id) {
		$transaction = $this->getDbConnection()->beginTransaction();
		{
			$map_section_ids = MapSection::model()->getByWorldId($world_id);
			$archipelago_ids = Archipelago::model()->getByMapSectionsAndMagnitude($map_section_ids, 1);

			$island = $this->findByAttributes(array('archipelagoId' => $archipelago_ids, 'ownerId' => null));
			if (empty($island)) {
				throw new CException('There are no start islands for this world');
			}

			$island->ownerId = $user_id;
			$island->save();
		}
		$transaction->commit();

		return $island;
	}

	/**
	 * if this island is being assigned to a player,
	 * create island dependencies like stocks and resource production
	 *
	 * @return boolean
	 */
	protected function beforeSave() {
		$beforeSave = parent::beforeSave();
		if ($beforeSave
			&& !$this->isNewRecord
			&& array_key_exists('ownerId', $this->_changedAttributes)
			&& $this->_changedAttributes['ownerId'] === null
			&& $this->ownerId !== null
		) {
			// for the first time, this island is assigned to a player
			$this->storage->createStocksForStorage(Resource::model()->findAll());
			$this->initializeResourceProduction(Resource::model()->findAll());

		}
		return $beforeSave;
	}

	/**
	 * create initial resource production values
	 *
	 * @param Resource[] $resources
	 * @return void
	 */
	protected function initializeResourceProduction($resources) {
		foreach ($resources as $resource) {
			$production = new ResourceProduction();
			$production->islandId = $this->id;
			$production->resourceId = $resource->id;
			$production->growthFactor = mt_rand(50, 150) / 100.0;
			$production->productionValue = mt_rand(1, 5);
			$production->save();
		}
	}

	/**
	 * build up criteria to get all islands from one world
	 *
	 * @param integer $world_id
	 * @return CDbCriteria
	 */
	protected function getWorldQuery($world_id) {
		$this->with(array(
			'archipelago' => array(
				'joinType'=>'INNER JOIN',
				'together' => true
			)
			))->with(array(
				'archipelago.mapSection' => array(
					'joinType'=>'INNER JOIN',
					'together' => true
				)
			))->with(
						array(
							'archipelago.mapSection.world' => array(
								'condition' => MapSection::model()->quotedCol('worldId') . '=' . intval($world_id),
								'joinType'=>'INNER JOIN',
								'together' => true
							)
						)
					);

		return $this->getDbCriteria();
	}

	public function getInhabitedIslands($world_id) {
		$query = $this->getWorldQuery($world_id);

		$criteria = new CDbCriteria();
		$criteria->addNotInCondition('ownerId', array(null));
		$query->mergeWith($criteria);

		$this->setDbCriteria($query);

		return $this->findAll();
	}

	/**
	 * get all islands for world
	 *
	 * @param integer $world_id
	 * @return Island
	 */
	public function getWorldIslands($world_id, $limit = null, $offset = null)
	{
		$query = $this->getWorldQuery($world_id);

		$this->setDbCriteria($query);

		$island_list = new stdClass();
		$island_list->count = $this->count();

		if ($limit !== null || $offset !== null) {
			$paging = new CDbCriteria();
			$paging->limit = $limit;
			$paging->offset = $offset;
			$query->mergeWith($paging);
			$this->setDbCriteria($query);
		}

		$island_list->result = $this->findAll();

		return $island_list;
	}

	/**
	 * get islands for player and world
	 *
	 * @param integer $world_id
	 * @param integer $user_id
	 * @param integer $limit
	 * @param integer $offset
	 * @return array
	 */
	public function getPlayerIslands($world_id, $user_id, $limit = null, $offset = null)
	{
		$query = $this->getWorldQuery($world_id);
		$query->addCondition('t.ownerId = ' . $user_id);

		$this->setDbCriteria($query);

		$island_list = new stdClass();
		$island_list->count = $this->count();

		if ($limit !== null || $offset !== null) {
			$paging = new CDbCriteria();
			$paging->limit = $limit;
			$paging->offset = $offset;
			$query->mergeWith($paging);
		}

		$this->setDbCriteria($query);

		$island_list->result = $this->findAll();

		return $island_list;
	}

	/**
	 * get island dependend resource production bonus depending on existing buildings, researches or other effects
	 *
	 * @todo implement
	 * @param integer $resource_id
	 * @return integer
	 */
	protected function resourceProductionValueBonus($resource_id) {
		return 0;
	}

	/**
	 * update resource productions for this island
	 *
	 * @return integer last update timestamp for this updates
	 */
	public function updateResources() {
		// read ressource production and index by resource id
		$production_values = array();
		foreach ($this->resourceProductions as $res_prod) {
			$production_values[$res_prod->resourceId] = $res_prod;
		}

		// save the now timestamp, so every values have the same update
		$now = time();

		// go through all stock values and add generated resources
		foreach ($this->storage->stocks as $stock) {
			if ($stock instanceof Stock) {
				if (!empty($stock->lastResourceUpdate)) {
					$production_value = $production_values[$stock->resourceId]->productionValue + $this->resourceProductionValueBonus($stock->resourceId);
					$ress_increment = ($production_value / 3600)
						* $production_values[$stock->resourceId]->growthFactor
						* ($now - $stock->lastResourceUpdate);
					$stock->amount += $ress_increment;
				}
				$stock->lastResourceUpdate = $now;
				$stock->save();
			}
		}

		return $now;
	}
}
