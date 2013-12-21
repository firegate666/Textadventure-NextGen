<?php

/**
 * This is the model class for table "Storage".
 *
 * The followings are the available columns in table 'Storage':
 * @property integer $capacity
 *
 * The followings are the available model relations:
 * @property Island[] $islands
 * @property Stock[] $stocks
 *
 * @static Storage model
 */
class Storage extends MetaInfo
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Storage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('capacity', 'required'),
			array('capacity', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, capacity', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'islands' => array(self::HAS_MANY, 'Island', 'storageId'),
			'stocks' => array(self::HAS_MANY, 'Stock', 'storageId'),
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
			'capacity' => 'Capacity',
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
		$criteria->compare('capacity',$this->capacity);
		return $criteria;
	}

	/**
	 * create a stock for each known resource in this storage
	 *
	 * @param Storage $storage
	 * @param Resource[] $resources
	 * @return void
	 */
	public function createStocksForStorage($resources) {
		foreach ($resources as $resource) {
			$stock = new Stock();
			$stock->storageId = $this->id;
			$stock->resourceId = $resource->id;
			$stock->save();
		}
	}

}
