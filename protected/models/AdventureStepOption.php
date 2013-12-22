<?php

/**
 * This is the model class for table "AdventureStepOption".
 * It holds the name for the single step options
 * and the target step of this option
 *
 * @property integer $parent
 * @property integer $target
 * @property string $name
 *
 * @property AdventureStep $sourceStep
 * @property AdventureStep $targetStep
 *
 * @static AdventureStepOption model
 */
class AdventureStepOption extends MetaInfo
{

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
		$relations = parent::relations();
		return $relations + array(
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
	 * (non-PHPdoc)
	 * @see CModel::beforeValidate()
	 * @return boolean
	 */
	public function beforeValidate()
	{
		$ret = parent::beforeValidate();
		if (!empty($this->parent))
		{
			$adventureStep = AdventureStep::model()->findByPk($this->parent);
			if ($adventureStep->endingPoint)
			{
				$this->addError('parent', 'adventure step ending point can not be chosen as parent');
			}
		}
		return $ret;
	}

	/**
	 * (non-PHPdoc)
	 * @see MetaInfo::getSearchCriteria()
	 */
	protected function getSearchCriteria()
	{
		$criteria = parent::getSearchCriteria();
		$criteria->compare('parent', $this->parent);
		$criteria->compare('target', $this->target);
		$criteria->compare('name', $this->name, true);
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
