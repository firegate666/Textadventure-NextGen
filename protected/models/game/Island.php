<?php

/**
 * This is the model class for table "Island".
 *
 * The followings are the available columns in table 'Island':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
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

}
