<?php

/**
 * This is the model class for table "AdventureStep".
 * It holds the name and description of the single steps
 * and relations to the step options
 *
 */
class AdventureStep extends CActiveRecord
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
	 * Returns the static model of the specified AR class.
	 *
	 * @static
	 * @param string $className active record class name.
	 * @return AdventureStep the static model class
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
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
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria();

		$criteria->compare('id', $this->id);
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
	 * get a list of adventure steps as associative array (id => name)
	 *
	 * @static
	 * @return array
	 */
	public static function items()
	{
		$result = array();
		foreach (self::model()->findAll() as $adventureStep)
		{
			$result[$adventureStep->id] = $adventureStep->name;
		}
		return $result;
	}
}
