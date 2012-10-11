<?php

/**
 * This is the model class for table "Stock".
 *
 * The followings are the available columns in table 'Stock':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
 * @property integer $storageId
 * @property integer $resourceId
 *
 * The followings are the available model relations:
 * @property Resource $resource
 * @property Storage $storage
 */
class Stock extends MetaInfo
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Stock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('storageId, resourceId', 'required'),
			array('storageId, resourceId', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, storageId, resourceId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'resource' => array(self::BELONGS_TO, 'Resource', 'resourceId'),
			'storage' => array(self::BELONGS_TO, 'Storage', 'storageId'),
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
			'storageId' => 'Storage',
			'resourceId' => 'Resource',
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
		$criteria->compare('storageId',$this->storageId);
		$criteria->compare('resourceId',$this->resourceId);
		return $criteria;
	}

}
