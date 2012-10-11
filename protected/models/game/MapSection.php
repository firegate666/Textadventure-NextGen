<?php

/**
 * This is the model class for table "MapSection".
 *
 * The followings are the available columns in table 'MapSection':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
 * @property integer $leftSectionId
 * @property integer $rightSectionId
 * @property integer $worldId
 *
 * The followings are the available model relations:
 * @property Mapsection $leftSection
 * @property Mapsection $rightSection
 * @property World $world
 */
class MapSection extends MetaInfo
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'MapSection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createdAt, createdBy, leftSectionId, rightSectionId, worldId', 'required'),
			array('createdBy, changedBy, leftSectionId, rightSectionId, worldId', 'numerical', 'integerOnly'=>true),
			array('changedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, leftSectionId, rightSectionId, worldId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'leftSection' => array(self::BELONGS_TO, 'Mapsection', 'leftSectionId'),
			'rightSection' => array(self::BELONGS_TO, 'Mapsection', 'rightSectionId'),
			'world' => array(self::BELONGS_TO, 'World', 'worldId'),
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
			'leftSectionId' => 'Left Section',
			'rightSectionId' => 'Right Section',
			'worldId' => 'World',
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
		$criteria->compare('leftSectionId',$this->leftSectionId);
		$criteria->compare('rightSectionId',$this->rightSectionId);
		$criteria->compare('worldId',$this->worldId);
		return $criteria;
	}

}
