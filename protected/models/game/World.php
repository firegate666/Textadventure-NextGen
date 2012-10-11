<?php

/**
 * This is the model class for table "World".
 *
 * The followings are the available columns in table 'World':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
 * @property string $name
 *
 * The followings are the available model relations:
 * @property MapSection[] $mapSections
 */
class World extends MetaInfo
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'World';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createdAt, createdBy, name', 'required'),
			array('createdBy, changedBy', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('changedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'mapSections' => array(self::HAS_MANY, 'MapSection', 'worldId'),
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
		return $criteria;
	}
}
