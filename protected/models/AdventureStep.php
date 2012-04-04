<?php

/**
 * This is the model class for table "AdventureStep".
 * It holds the name and description of the single steps
 * and relations to the step options
 *
 */
class AdventureStep extends MetaInfo
{
	// The following are the available columns in table 'AdventureStep':

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var integer
	 */
	public $adventure;

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
	public $stepId;

	/**
	 *
	 * @var boolean
	 */
	public $startingPoint;

	/**
	 *
	 * @var boolean
	 */
	public $endingPoint;

	// The following are the available model relations:

	/**
	 *
	 * @var Adventure
	 */
	public $adventureParent;

	/**
	 *
	 * @var AdventureStepOption[]
	 */
	public $stepOptions;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'AdventureStep';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adventure, name, description, stepId', 'required'),
			array('adventure', 'numerical', 'integerOnly' => true),
			array('startingPoint, endingPoint', 'boolean'),
			array('startingPoint, endingPoint', 'default', 'setOnEmpty' => true, 'value' => false),
			array('name', 'length', 'max' => 256),
			array('stepId', 'length', 'max' => 32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, adventure, name, description, stepId, startingPoint', 'safe', 'on' => 'search'),
		);
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
		if ($this->isNewRecord && empty($this->stepId) && !empty($this->name))
		{
			$key = substr($this->name, 0, 10);
			$id = substr(uniqid(), 0, 5);
			$this->setAttribute('stepId', str_replace(' ', '-', mb_strtoupper($key) . '_' . $id));
			$this->addError('stepId', 'An empty stepId was submitted, please validate auto-created id');
		}

		if ($this->startingPoint && $this->endingPoint)
		{
			$this->addError('startingPoint', 'can not be starting point if is ending point');
			$this->addError('endingPoint', 'can not be ending point if is starting point');
		}
		return $ret;
	}

	/**
	 * this step has options?
	 *
	 * @return boolean
	 */
	public function hasOptions()
	{
		return count($this->getRelated('stepOptions')) != 0;
	}

	/**
	 * test if given id is a valid parent of this step by checking the options
	 *
	 * @param integer $step_id
	 * @return boolean
	 */
	public function isParent($step_id)
	{
		$options = AdventureStepOption::model()->findByAttributes(array(
			'parent' => $step_id,
			'target' => $this->id,
		));
		return $options !== null;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'adventureParent' => array(self::BELONGS_TO, 'Adventure', 'adventure'),
			'stepOptions' => array(self::HAS_MANY, 'AdventureStepOption', 'parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'adventure' => 'Adventure',
			'name' => 'Name',
			'description' => 'Description',
			'stepId' => 'Adventure Step Id',
			'startingPoint' => 'Is starting point?',
			'endingPoint' => 'Is ending point?',
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
		$criteria->compare('adventure', $this->adventure);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('stepId', $this->stepId, true);
		$criteria->compare('startingPoint', $this->startingPoint, true);
		$criteria->compare('endingPoint', $this->endingPoint, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * get a list of adventure steps as associative array (id => name) grouped by adventure
	 *
	 * @param Adventure $adventure=null limit items to one adventure
	 * @static
	 * @return array
	 */
	public static function items(Adventure $adventure = null)
	{
		$result = array();
		$list = array();
		if ($adventure !== null) // get steps from one adventure
		{
			$list = self::model()->findAllByAttributes(array('adventure' => $adventure->id));
		}
		else
		{
			$model = self::model();
			$list = $model->search()->getData();
		}
		foreach ($list as $adventure_step)
		{
			$adventure_key = sprintf('[%s] %s', $adventure_step->getRelated('adventureParent')->adventureId, $adventure_step->getRelated('adventureParent')->name);
			if (!isset($result[$adventure_key]))
			{
				$result[$adventure_key] = array();
			}
			$result[$adventure_key][$adventure_step->id] =
				sprintf('[%s] %s', $adventure_step->stepId, $adventure_step->name);
		}
		ksort($result);
		return $result;
	}

	/**
	 * log this step and user
	 *
	 * @param integer $user_id
	 * @return void;
	 */
	public function log($user_id)
	{
		$log = new AdventureLog();
		$log->userId = $user_id;
		$log->adventureId = $this->adventure;
		$log->adventureStepId = $this->id;
		$log->save();
	}

	/**
	 * test if user is admin or if user can create adventures and this is created by him
	 *
	 * @todo refactor to reduce copy & paste (Adventure, AdventureStep, AdventureStepOption)
	 * @param user_id $user_id
	 * @return boolean
	 */
	public function isAdminOrOwner($user_id)
	{
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
