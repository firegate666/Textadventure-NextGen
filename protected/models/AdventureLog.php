<?php

/**
 * This is the model class for table "AdventureLog".
 *
 * @property integer $userId
 * @property integer $adventureId
 * @property integer $adventureStepId
 * @property boolean $finalized
 *
 * @property User $player
 * @property Adventure $adventure
 * @property AdventureStep $adventureStep
 *
 * @static AdventureLog model
 */
class AdventureLog extends MetaInfo
{

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
	 * @param integer $limit
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($limit = 5)
	{
		$criteria = $this->getSearchCriteria();

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>array(
				'pageSize' => $limit,
			),
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
	public function getLastStep($user_id, $adventure_id)
	{
		$criteria = new CDbCriteria();
		$criteria->limit = 1;
		$criteria->order = $this->quotedCol('createdAt') . ' DESC';
		$criteria->compare($this->quotedCol('userId'), $user_id);
		$criteria->compare($this->quotedCol('adventureId'), $adventure_id);
		$criteria->compare($this->quotedCol('finalized'), false);
		$log = $this->findByAttributes(array('finalized' => false), $criteria);

		if ($log === null)
		{
			return null;
		}
		return $log->adventureStepId;
	}
}
