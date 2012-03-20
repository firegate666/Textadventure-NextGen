<?php

/**
 * This is the model class for table "Adventure".
 *
 * It represents the adventure as is, its name and description, and
 * holds relations to the single adventure steps
 *
 */
class Adventure extends CActiveRecord
{

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
	 * Returns the static model of the specified AR class.
	 *
	 * @static
	 * @param string $className active record class name.
	 * @return Adventure the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
		return array_merge_recursive(
			self::runningStates(),
			self::stopStates()
		);
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
		return array(
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
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria();

		$criteria->compare('id', $this->id);
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
}
