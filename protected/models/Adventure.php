<?php

/**
 * This is the model class for table "Adventure".
 *
 * It represents the adventure as is, its name and description, and
 * holds relations to the single adventure steps
 *
 */
class Adventure extends MetaInfo
{

	const STATE_DISABLED = 0;

	const STATE_DRAFT = 1;

	const STATE_PUBLISHED = 2;

	// The followings are the available columns in table 'Adventure':

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var string
	 */
	public $name;

	/**
	 *
	 * @var string
	 */
	public $description;

	/**
	 *
	 * @var string
	 */
	public $adventureId;

	/**
	 *
	 * @var integer
	 */
	public $startDate;

	/**
	 *
	 * @var Date
	 */
	public $stopDate;

	/**
	 *
	 * @var Date
	 */
	public $state;

	// The following are the available model relations:

	/**
	 *
	 * @var AdventureStep[]
	 */
	public $adventureSteps;

	/**
	 * this adventure has steps?
	 *
	 * @return boolean
	 */
	public function hasSteps()
	{
		return count($this->getRelated('adventureSteps')) != 0;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Adventure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description, adventureId, state', 'required'),
			array('name', 'length', 'max' => 256),
			array('adventureId', 'length', 'max' => 32),
			array('startDate, stopDate', 'date', 'format' => 'yyyy-MM-dd', 'allowEmpty' => true),
			array('state', 'isAdventureState', 'default' => self::STATE_DRAFT),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, adventureId, state, startDate, stopDate', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * get list of valid states
	 *
	 * @uses Adventure::stopStates()
	 * @uses Adventure::runningStates()
	 * @static
	 * @return array
	 */
	public static function validStates()
	{
		// using array_merge instead of + would result in losing our numeric array keys
		return self::runningStates()
			+ self::stopStates()
		;
	}

	/**
	 * get the human readable state name
	 *
	 * @param integer $state_id
	 * @return string
	 */
	public static function getStateName($state_id)
	{
		$states = self::validStates();
		if (!isset($states[$state_id]))
		{
			throw new CException('Invalid state requested');
		}
		return $states[$state_id];
	}

	/**
	 * get a list of valid stop states
	 *
	 * @static
	 * @return array
	 */
	public static function stopStates()
	{
		return array(
			self::STATE_DISABLED => 'Disabled',
			self::STATE_DRAFT => 'Draft',
		);
	}

	/**
	 * get a list of valid running states
	 *
	 * @static
	 * @return array
	 */
	public static function runningStates()
	{
		return array(
			self::STATE_PUBLISHED => 'Published',
		);
	}

	/**
	 * tests if state is public and start stop matches
	 *
	 * @return boolean
	 */
	public function isRunning()
	{
		if (array_key_exists((int)$this->state, self::stopStates()))
		{
			return false;
		}

		// use DateTime to honor timezones
		$startDate = new DateTime($this->startDate);
		$stopDate = new DateTime($this->stopDate);
		$nowDate = new DateTime();

		return
			(empty($this->startDate) || $startDate->getTimestamp() <=
					$nowDate->getTimestamp())
			&&
			(empty($this->stopDate) || $stopDate->getTimestamp() >
					$nowDate->getTimestamp())
		;
	}

	/**
	 * state validator
	 *
	 * @param string $attribute
	 * @param array $params
	 * @return void
	 */
	public function isAdventureState($attribute, $params)
	{
		if (!array_key_exists($this->$attribute, self::validStates()))
		{
			$this->addError($attribute, 'invalid state selected');
		}
	}

	/**
	 * Set an artificial adventureId if none was submitted
	 *
	 * (non-PHPdoc)
	 * @see CModel::beforeValidate()
	 * @return boolean
	 */
	public function beforeValidate()
	{
		$ret = parent::beforeValidate();
		if ($this->isNewRecord && empty($this->adventureId) && !empty($this->name))
		{
			$key = substr($this->name, 0, 10);
			$id = substr(uniqid(), 0, 5);
			$this->setAttribute('adventureId', str_replace(' ', '-', mb_strtoupper($key) . '_' . $id));
			$this->addError('adventureId', 'An empty adventureId was submitted, please validate auto-created id');
		}

		// empty string results to invalid date, so make sure this is null if it's empty
		if (empty($this->startDate))
		{
			$this->startDate = null;
		}

		// empty string results to invalid date, so make sure this is null if it's empty
		if (empty($this->stopDate))
		{
			$this->stopDate = null;
		}

		if (!empty($this->startDate) && !empty($this->stopDate))
		{
			if ($this->startDate == $this->stopDate)
			{
				$this->addError('startDate', 'must not equal stopDate');
				$this->addError('stopDate', 'must not equal startDate');
			}
			else if ($this->startDate > $this->stopDate)
			{
				$this->addError('startDate', 'must be lower than stopDate');
				$this->addError('stopDate', 'must be greater than startDate');
			}
		}

		return $ret;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'adventureSteps' => array(self::HAS_MANY, 'AdventureStep', 'adventure'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'adventureId' => 'Adventure ID',
			'state' => 'State',
			'startDate' => 'Start date',
			'stopDate' => 'Stop date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = $this->getSearchCriteria();
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('adventureId', $this->adventureId, true);
		$criteria->compare('state', $this->adventureId, true);
		$criteria->compare('startDate', $this->adventureId, true);
		$criteria->compare('stopDate', $this->adventureId, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * get a list of adventures as associative array (id => name)
	 *
	 * @static
	 * @return array
	 */
	public static function items()
	{
		$result = array();
		foreach (self::model()->findAll() as $adventure)
		{
			$result[$adventure->id] = sprintf('[%s] %s', $adventure->adventureId, $adventure->name);
		}
		natcasesort($result);
		return $result;
	}

	/**
	 * find an started and not ended participation entry
	 *
	 * @param integer $user_id
	 * @return AdventureParticipation
	 */
	public function findOpenEntryForUser($user_id)
	{
		return AdventureParticipation::model()->findBySql('
			SELECT
				*
			FROM
				AdventureParticipation
			WHERE
				userId = :userId AND
				adventureId = :adventureId AND
				started IS NOT NULL AND
				ended IS NULL
		', array(
			':userId' => $user_id,
			':adventureId' => $this->id,
		));
	}

	/**
	 * test if logged in user is running this adventure
	 *
	 * @param integer $user_id
	 * @return boolean
	 */
	public function userInAdventure($user_id)
	{
		$log = $this->findOpenEntryForUser($user_id);
		return $log !== null;
	}

	/**
	 * write starting log entry for adventure and logged in user
	 *
	 * @param integer $user_id
	 * @return void
	 */
	public function start($user_id)
	{
		$log = $this->findOpenEntryForUser($user_id);

		if ($log === null)
		{
			$log = new AdventureParticipation();
			$log->userId = $user_id;
			$log->adventureId = $this->id;
			$log->started = date('Y-m-d H:i:s');
			$log->save();
		}
		// else adventure already started and not ended, this is a returning user
	}

	/**
	 * write ending log entry for adventure and logged in user
	 *
	 * @param integer $user_id
	 * @throws CHttpException if starting log entry could not be found
	 * @return void
	 */
	public function stop($user_id)
	{
		$log = $this->findOpenEntryForUser($user_id);

		if ($log !== null)
		{
			$log->ended = date('Y-m-d H:i:s');
			$log->save();
		}
		// else adventure already started and ended; this is a returning user
	}

	/**
	 * test if user is admin or if user can create adventures and this is created by him
	 *
	 * @todo refactor to reduce copy & paste (Adventure, AdventureStep, AdventureStepOption)
	 * @param user_id $user_id
	 * @return boolean
	 */
	public function isAdminOrOwner($user_id) {
		$user = User::model()->findByPk($user_id);
		if ($user !== null)
		{
			return $user->isAdmin() ||
				($user->canCreateAdventure() && $user_id == $this->createdBy)
			;
		}
		return false;
	}

}
