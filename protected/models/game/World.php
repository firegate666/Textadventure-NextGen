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
 *
 * @method World model
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
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
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

	/**
	 * Add player to world by giving him his first island
	 *
	 * @param integer $user_id
	 * @throws CException
	 * @return Island
	 */
	public function enterWorld($user_id)
	{
		// check for map sections
		$map_sections = MapSection::model()->findAllByAttributes(array('worldId' => $this->id));
		if (empty($map_sections)) {
			throw new CException('There are no map sections for this world');
		}
		$map_section_ids = array();
		foreach ($map_sections as $map_section) {
			$map_section_ids[] = $map_section->id;
		}

		// check for archipelagos
		$archipelagos = Archipelago::model()->findAllByAttributes(array('mapSectionId' => $map_section_ids, 'magnitude' => 1));
		if (empty($archipelagos)) {
			throw new CException('There are no archipelagos with start islands for this world');
		}
		$archipelago_ids = array();
		foreach ($archipelagos as $archipelago) {
			$archipelago_ids[] = $archipelago->id;
		}

		// get start island
		$island = Island::model()->findByAttributes(array('archipelagoId' => $archipelago_ids, 'ownerId' => null));
		if (empty($island)) {
			throw new CException('There are no start islands for this world');
		}

		$island->ownerId = $user_id;
		$island->save();

		return $island;
	}
}
