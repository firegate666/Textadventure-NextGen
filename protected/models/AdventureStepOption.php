<?php

/**
 * This is the model class for table "AdventureStepOption".
 * It holds the name for the single step options
 * and the target step of this option
 *
 */
class AdventureStepOption extends CActiveRecord
{
	// The following are the available columns in table 'AdventureStepOption':

	/**
	 *
	 * @var integer
	 */
	public $id;

	/**
	 *
	 * @var integer
	 */
	public $parent;

	/**
	 *
	 * @var integer
	 */
	public $target;

	/**
	 *
	 * @var string
	 */
	public $name;

	// The following are the available model relations:

	/**
	 *
	 * @var AdventureStep
	 */
	public $targetStep;

	/**
	 *
	 * @var AdventureStep
	 */
	public $sourceStep;

	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @static
	 * @param string $className active record class name.
	 * @return AdventureStepOption the static model class
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
		return 'AdventureStepOption';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent, target, name', 'required'),
			array('parent, target', 'numerical', 'integerOnly' => true),
			array('name', 'length', 'max' => 256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent, target, name', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'targetStep' => array(self::BELONGS_TO, 'Adventurestep', 'target'),
			'sourceStep' => array(self::BELONGS_TO, 'Adventurestep', 'parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent' => 'Parent',
			'target' => 'Target',
			'name' => 'Name',
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
		$criteria->compare('parent', $this->parent);
		$criteria->compare('target', $this->target);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
