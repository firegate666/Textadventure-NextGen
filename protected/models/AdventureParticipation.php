<?php

/**
 * This is the model class for table "AdventureParticipation".
 */
class AdventureParticipation extends MetaInfo
{
	/**
	 *
	 * @var integer
	 */
	public $userId;

	/**
	 *
	 * @var integer
	 */
	public $adventureId;

	/**
	 *
	 * @var datetime
	 */
	public $started;

	/**
	 *
	 * @var datetime
	 */
	public $ended;

	// RELATIONS

	/**
	 *
	 * @var User
	 */
	public $player;

	/**
	 *
	 * @var Adventure
	 */
	public $adventure;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'AdventureParticipation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, adventureId, started', 'required'),
			array('userId, adventureId', 'numerical', 'integerOnly' => true),
			array('ended', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, userId, adventureId, started, ended', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return parent::relations() + array(
			'player' => array(self::BELONGS_TO, 'User', 'userId'),
			'adventure' => array(self::BELONGS_TO, 'Adventure', 'adventureId'),
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
			'userId' => 'User',
			'adventureId' => 'Adventure',
			'started' => 'Started',
			'ended' => 'Ended',
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see MetaInfo::getSearchCriteria()
	 */
	protected function getSearchCriteria() {
		$criteria = parent::getSearchCriteria();
		$criteria->compare('userId', $this->userId);
		$criteria->compare('adventureId', $this->adventureId);
		$criteria->compare('started', $this->started,true);
		$criteria->compare('ended', $this->ended,true);
		return $criteria;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = $this->getSearchCriteria();

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}