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
	 * check if player already plays on that world
	 *
	 * @param integer $user_id
	 * @return boolean
	 */
	public function playerIsOnWorld($user_id) {
		$list = Island::model()->getPlayerIslands($this->id, $user_id);
		return count($list) > 0;
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
		if ($this->playerIsOnWorld($user_id)) {
			throw new CException('Player already plays on that world');
		}

		return Island::model()->getPlayerStartIsland($this->id, $user_id);
	}

	/**
	 * update all islands of this world
	 *
	 * @return int number of updated islands
	 */
	public function updateIslands()
	{
		$updated = 0;
		foreach (Island::model()->getWorldIslands($this->id) as $island) {
			if ($island instanceof Island && $island->ownerId !== null)
			{
				$island->updateResources();
				$updated++;
			}
		}
		return $updated;
	}
}
