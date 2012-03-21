<?php

/**
 * model parent class that adds create and change data informations
 */
abstract class MetaInfo extends CActiveRecord {

	/**
	 * creation date
	 *
	 * @var datetime
	 */
	public $createdAt;

	/**
	 * date of last change
	 *
	 * @var datetime
	 */
	public $changedAt;

	/**
	 * who created
	 *
	 * @var integer
	 */
	public $createdBy;

	/**
	 * who changed
	 * 
	 * @var integer
	 */
	public $changedBy;

	/**
	 * write dates and user ids to model
	 *
	 * @return boolean
	 */
	protected function beforeSave()
	{
		$before_safe = parent::beforeSave();
		if ($before_safe)
		{
			if ($this->isNewRecord)
			{
				$this->createdAt = date('Y-m-d H:i:s');
				if (Yii::app()->user->id)
				{
					$this->createdBy = Yii::app()->user->id;
				}
			}
			else
			{
				$this->changedAt = date('Y-m-d H:i:s');
				if (Yii::app()->user->id)
				{
					$this->changedBy = Yii::app()->user->id;
				}
			}
		}
		return $before_safe;
	}

}
