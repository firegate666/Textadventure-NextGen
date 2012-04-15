<?php

/**
 * This is the model class for table "AdventureLog".
 */
class AdventureLog extends MetaInfo
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
	 * @var integer
	 */
	public $adventureStepId;

	/**
	 *
	 * @var boolean
	 */
	public $finalized;

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
	 *
	 * @var AdventureStep
	 */
	public $adventureStep;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'AdventureLog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, adventureId, adventureStepId', 'required'),
			array('userId, adventureId, adventureStepId', 'numerical', 'integerOnly' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, userId, adventureId, adventureStepId', 'safe', 'on' => 'search'),
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
			'adventureStep' => array(self::BELONGS_TO, 'AdventureStep', 'adventureStepId'),
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
			'adventureStepId' => 'Adventure Step',
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see MetaInfo::getSearchCriteria()
	 */
	protected function getSearchCriteria()
	{
		$criteria = parent::getSearchCriteria();
		$criteria->compare('userId', $this->userId);
		$criteria->compare('adventureId', $this->adventureId);
		$criteria->compare('adventureStepId', $this->adventureStepId);
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

	/**
	 * set all log entries for this adventure and user to finalized
	 * this happens if an adventure is restarted
	 *
	 * @param integer $user_id
	 * @param integer $adventure_id
	 * @return void
	 */
	public static function finalize($user_id, $adventure_id)
	{
		$logs = AdventureLog::model()->findAllByAttributes(array(
			'userId'=>$user_id,
			'adventureId'=>$adventure_id,
		));
		foreach ($logs as $log)
		{
			$log->finalized = true;
			$log->save();
		}
	}

	/**
	 * get last visited step for user and adventure
	 *
	 * @param integer $user_id
	 * @param integer $adventure_id
	 * @return integer
	 */
	public static function getLastStep($user_id, $adventure_id)
	{
		$log = AdventureLog::model()->findBySql('
			SELECT
				*
			FROM
				AdventureLog
			WHERE
				userId = :userId AND
				adventureId = :adventureId AND
				finalized = 0
			ORDER BY
				createdAt DESC
			LIMIT
				1
		', array(
			':userId' => $user_id,
			':adventureId' => $adventure_id,
		));

		if ($log === null)
		{
			return null;
		}
		return $log->adventureStepId;
	}
}
