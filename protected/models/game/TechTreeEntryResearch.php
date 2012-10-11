<?php

/**
 * This is the model class for table "TechTreeEntryResearch".
 *
 * The followings are the available columns in table 'TechTreeEntryResearch':
 * @property integer $id
 * @property string $createdAt
 * @property string $changedAt
 * @property integer $createdBy
 * @property integer $changedBy
 * @property integer $userId
 * @property integer $techId
 * @property string $start
 * @property string $end
 * @property integer $finished
 *
 * The followings are the available model relations:
 * @property Techtreeentry $tech
 * @property User $user
 */
class TechTreeEntryResearch extends MetaInfo
{
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'TechTreeEntryResearch';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, techId', 'required'),
			array('userId, techId, finished', 'numerical', 'integerOnly'=>true),
			array('start, end', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdAt, changedAt, createdBy, changedBy, userId, techId, start, end, finished', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = parent::relations();
		return $relations + array(
			'tech' => array(self::BELONGS_TO, 'Techtreeentry', 'techId'),
			'user' => array(self::BELONGS_TO, 'User', 'userId'),
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
			'techId' => 'Tech',
			'start' => 'Start',
			'end' => 'End',
			'finished' => 'Finished',
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
		$criteria->compare('userId',$this->userId);
		$criteria->compare('techId',$this->techId);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('finished',$this->finished);
		return $criteria;
	}
}
