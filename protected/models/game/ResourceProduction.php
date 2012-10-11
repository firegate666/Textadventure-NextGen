<?php

/**
 * This is the model class for table "ResourceProduction".
 *
 * The followings are the available columns in table 'ResourceProduction':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
 * @property integer $islandId
 * @property integer $resourceId
 * @property double $growthFactor
 * @property integer $productionValue
 *
 * The followings are the available model relations:
 * @property Island $island
 * @property Resource $resource
 */
class ResourceProduction extends MetaInfo
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ResourceProduction';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('islandId, resourceId, growthFactor, productionValue', 'required'),
			array('islandId, resourceId, productionValue', 'numerical', 'integerOnly'=>true),
			array('growthFactor', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, islandId, resourceId, growthFactor, productionValue', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'island' => array(self::BELONGS_TO, 'Island', 'islandId'),
			'resource' => array(self::BELONGS_TO, 'Resource', 'resourceId'),
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
			'islandId' => 'Island',
			'resourceId' => 'Resource',
			'growthFactor' => 'Growth Factor',
			'productionValue' => 'Production Value',
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
		$criteria->compare('islandId',$this->islandId);
		$criteria->compare('resourceId',$this->resourceId);
		$criteria->compare('growthFactor',$this->growthFactor);
		$criteria->compare('productionValue',$this->productionValue);
		return $criteria;
	}

}
