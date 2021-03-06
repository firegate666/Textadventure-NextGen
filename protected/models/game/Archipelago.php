<?php

/**
 * This is the model class for table "Archipelago".
 *
 * The followings are the available columns in table 'Archipelago':
 * @property string $name
 * @property integer $xPos
 * @property integer $yPos
 * @property integer $magnitude
 * @property integer $mapSectionId
 *
 * The followings are the available model relations:
 * @property Mapsection $mapSection
 * @property Island[] $islands
 *
 * @static Archipelago model
 */
class Archipelago extends MetaInfo
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Archipelago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, xPos, yPos, magnitude, mapSectionId', 'required'),
			array('xPos, yPos, magnitude, mapSectionId', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, name, xPos, yPos, magnitude, mapSectionId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'mapSection' => array(self::BELONGS_TO, 'MapSection', 'mapSectionId'),
			'islands' => array(self::HAS_MANY, 'Island', 'archipelagoId'),
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
			'xPos' => 'X Pos',
			'yPos' => 'Y Pos',
			'magnitude' => 'Magnitude',
			'mapSectionId' => 'Map Section',
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
		$criteria->compare('xPos',$this->xPos);
		$criteria->compare('yPos',$this->yPos);
		$criteria->compare('magnitude',$this->magnitude);
		$criteria->compare('mapSectionId',$this->mapSectionId);
		return $criteria;
	}

	/**
	 * get all archipelagos for given map sections
	 *
	 * @param integer[] $map_section_ids
	 * @param integer $magnitude
	 * @return integer[]
	 */
	public function getByMapSectionsAndMagnitude(array $map_section_ids, $magnitude = 1) {
		$archipelagos = $this->findAllByAttributes(array('mapSectionId' => $map_section_ids, 'magnitude' => $magnitude));
		if (empty($archipelagos)) {
			throw new CException('There are no archipelagos with islands for this world matching the given magnitude');
		}
		$archipelago_ids = array();
		foreach ($archipelagos as $archipelago) {
			$archipelago_ids[] = $archipelago->id;
		}
		return $archipelago_ids;
	}

}
