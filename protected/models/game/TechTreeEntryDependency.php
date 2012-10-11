<?php

/**
 * This is the model class for table "TechTreeEntryDependency".
 *
 * The followings are the available columns in table 'TechTreeEntryDependency':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
 * @property integer $techId
 * @property integer $dependencyId
 *
 * The followings are the available model relations:
 * @property Techtreeentry $dependency
 * @property Techtreeentry $tech
 */
class TechTreeEntryDependency extends MetaInfo
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TechTreeEntryDependency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createdAt, createdBy, techId, dependencyId', 'required'),
			array('createdBy, changedBy, techId, dependencyId', 'numerical', 'integerOnly'=>true),
			array('changedAt', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, techId, dependencyId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'dependency' => array(self::BELONGS_TO, 'Techtreeentry', 'dependencyId'),
			'tech' => array(self::BELONGS_TO, 'Techtreeentry', 'techId'),
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
			'techId' => 'Tech',
			'dependencyId' => 'Dependency',
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
		$criteria->compare('techId',$this->techId);
		$criteria->compare('dependencyId',$this->dependencyId);
		return $criteria;
	}
}
