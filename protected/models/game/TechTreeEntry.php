<?php

/**
 * This is the model class for table "TechTreeEntry".
 *
 * The followings are the available columns in table 'TechTreeEntry':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
 * @property string $name
 * @property string $description
 * @property integer $costs
 * @property integer $categoryId
 * @property integer $typeId
 *
 * The followings are the available model relations:
 * @property Techtreecategory $category
 * @property Techtreetype $type
 */
class TechTreeEntry extends MetaInfo
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TechTreeEntry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, costs, categoryId, typeId', 'required'),
			array('costs, categoryId, typeId', 'numerical', 'integerOnly'=>true),
			array('name, description', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, name, description, costs, categoryId, typeId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'category' => array(self::BELONGS_TO, 'Techtreecategory', 'categoryId'),
			'type' => array(self::BELONGS_TO, 'Techtreetype', 'typeId'),
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
			'description' => 'Description',
			'costs' => 'Costs',
			'categoryId' => 'Category',
			'typeId' => 'Type',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('costs',$this->costs);
		$criteria->compare('categoryId',$this->categoryId);
		$criteria->compare('typeId',$this->typeId);
		return $criteria;
	}
}
