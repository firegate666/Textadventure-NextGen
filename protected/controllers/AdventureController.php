<?php
/**
 * control list and playing of adventures
 *
 * @package controller
 * @subpackage game
 */
class AdventureController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array_merge(
			parent::filters(),
			array(
				'accessControl', // perform access control for CRUD operations
			)
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view', 'start', 'reset'),
				'users' => array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update', 'graph'),
				'expression' => '$user->getState("isAdmin") || $user->getState("canCreateAdventure")',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete'),
				'expression' => '$user->getState("isAdmin") || $user->getState("canCreateAdventure")',
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * remove played info about this adventure and restart it
	 *
	 * @param type $id
	 * @throws CHttpException if $id is invalid
	 * @return void
	 */
	public function actionReset($id)
	{
		if (empty($id))
		{
			throw new CHttpException(404, 'Adventure not found');
		}

		AdventureLog::finalize(Yii::app()->user->id, $id);
		$this->redirect(array('view', 'id' => $id));
	}

	public function actionGraph($id)
	{
		$this->layout = '//layouts/column1_admin';
		if (empty($id))
		{
			throw new CHttpException(404, 'Adventure not found');
		}

		$model = $this->loadModel($id);

		if ($model === null)
		{
			throw new CHttpException(404, 'Adventure not found');
		}

		$startStep = AdventureStep::model()->findByAttributes(array('startingPoint'=>1, 'adventure'=>$model->id));
		$remainingSteps = AdventureStep::model()->findAllByAttributes(array('startingPoint'=>0, 'adventure'=>$model->id));

		$edges_to_draw = array();
		$steps = array();

		foreach ($remainingSteps as $adventureStep)
		{
			$steps[$adventureStep->stepId] = $adventureStep->getAttributes();
			foreach($adventureStep->getRelated('stepOptions') as $stepOption)
			{
				$edges_to_draw[] = array(
					'from' => $adventureStep->stepId,
					'to' => $stepOption->getRelated('targetStep')->stepId,
					'name' => $stepOption->name,
				);
			}
		}

		if ($startStep !== null)
		{
			$steps[$startStep->stepId] = $startStep->getAttributes();
			foreach($startStep->getRelated('stepOptions') as $stepOption)
			{
				$edges_to_draw[] = array(
					'from' => $startStep->stepId,
					'to' => $stepOption->getRelated('targetStep')->stepId,
					'name' => $stepOption->name,
				);
			}
		}

		$this->render('graph', array(
			'model' => $model,
			'steps' => $steps,
			'edges_to_draw' => $edges_to_draw,
		));
	}

	/**
	 * Displays a particular model.
	 *
	 * @param integer $id the ID of the model to be displayed
	 * @param integer $step
	 * @throws CHttpException
	 * @return void
	 */
	public function actionView($id, $step = null)
	{
		$this->layout = '//layouts/column1';
		if (empty($id))
		{
			throw new CHttpException(404, 'Adventure not found');
		}

		$stepModel = null;
		$log = AdventureLog::model();
		$lastStep = $log->getLastStep(Yii::app()->user->id, $id);
		if (empty($step) && !empty($lastStep))
		{
			$step = $lastStep;
		}

		// always access the startingPoint if last step is empty
		if (empty($step) || empty($lastStep))
		{
			$stepModel = AdventureStep::model()->findByAttributes(array('startingPoint' => true, 'adventure' => $id));
		}
		else
		{
			$stepModel = AdventureStep::model()->findByPk($step);
		}

		if ($stepModel === null)
		{
			throw new CHttpException(404, 'Adventure Step Not Found');
		}

		if (!empty($lastStep) && !empty($step) && $step != $lastStep)
		{
			if (!$stepModel->isParent($lastStep))
			{
				throw new CHttpException(403, 'Adventure Step is not allowed');
			}
		}

		$model = $this->loadModel($id, false);
		if (!$model->isRunning() || !$model->hasStartingPoint() || !$model->hasEndingPoint())
		{
			throw new CHttpException(423, 'The requested adventure is temporarily not available');
		}

		if ($stepModel->startingPoint)
		{
			$model->start(Yii::app()->user->id);
		}
		else if ($stepModel->endingPoint)
		{
			$model->stop(Yii::app()->user->id);
		}
		$stepModel->log(Yii::app()->user->id);

		$this->render('view', array(
			'model' => $model,
			'stepModel' => $stepModel,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return void
	 */
	public function actionCreate()
	{
		$save_and_return = Yii::app()->request->getParam('save_and_return', '') != '';
		$model = new Adventure();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Adventure']))
		{
			$model->attributes = $_POST['Adventure'];
			if ($model->save())
			{
				if ($save_and_return) {
					$this->redirect($this->createUrl('update', array('id' => $model->id)), true);
				}
				$this->redirect(array('admin'));
			}
		}

		$this->render('create', array(
			'model' => $model,
			'adventureSteps' => array()
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id the ID of the model to be updated
	 * @return void
	 */
	public function actionUpdate($id)
	{
		$save_and_return = Yii::app()->request->getParam('save_and_return', '') != '';
		/** @var Adventure $model */
		$model = $this->loadModel($id);

		$adventureSteps = array();
		$stepOptions = array();

		if (isset($_POST['Adventure']))
		{
			$ta = Yii::app()->db->beginTransaction();
			$model->attributes = $_POST['Adventure'];

			$stepsValidated = true;
			if (isset($_POST['AdventureStep'])) {
				foreach ($_POST['AdventureStep'] as $stepData) {
					if (empty($stepData['name']))
					{
						continue;
					}

					$step_model = new AdventureStep();
					$key = 'NEW_' . mt_rand(0, 9999999);
					if (!empty($stepData['id']))
					{
						$step_model = $step_model->findByPk($stepData['id']);
						$key = $step_model->id;
					}

					$step_model->attributes = $stepData;
					$stepsValidated = $stepsValidated && $step_model->validate();

					if ($step_model->isNewRecord)
					{
						// this is a new model, give him empty options
						$step_model->stepOptions = array(new AdventureStepOption());
					}

					$adventureSteps[$key] = $step_model;
				}
			}

			$optionsValidated = true;
			if (isset($_POST['AdventureStepOption']))
			{
				$stepOptions = array();

				foreach ($_POST['AdventureStepOption'] as $optionsData) {
					if (empty($optionsData['name']))
					{
						continue;
					}

					$options_model = new AdventureStepOption();
					if (!empty($optionsData['id']))
					{
						$options_model = $options_model->findByPk($optionsData['id']);
					}

					$options_model->attributes = $optionsData;
					$optionsValidated = $optionsValidated && $options_model->validate();
					$stepOptions[$optionsData['parent']][] = $options_model;
				}

				foreach ($stepOptions as $step_id => $stepOption)
				{
					if (empty($adventureSteps[$step_id]->stepOptions))
					{
						$adventureSteps[$step_id]->stepOptions = array();
					}
					$adventureSteps[$step_id]->stepOptions = array_merge($stepOption, array(new AdventureStepOption()));
				}
			}

			if ($model->validate() && $stepsValidated && $optionsValidated) {
				foreach ($adventureSteps as $step)
				{
					$step->save();
				}

				foreach ($stepOptions as $parents)
				{
					foreach ($parents as $option)
					{
						$option->save();
					}
				}

				$model->save();
				$ta->commit();
				if (!$save_and_return)
				{
					$this->redirect(array('admin'));
				}
			}
			else
			{
				$ta->rollback();
			}
		}
		else
		{
			$adventureSteps = $model->adventureSteps;
			foreach ($adventureSteps as $step)
			{
				if (empty($step->stepOptions))
				{
					$step->stepOptions = array();
				}
				$step->stepOptions = array_merge($step->stepOptions, array(new AdventureStepOption()));
			}
		}

		$adventureSteps[] = new AdventureStep();
		$this->render('update', array(
			'model' => $model,
			'adventureSteps' => array_values($adventureSteps)
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id the ID of the model to be deleted
	 * @throws CHttpException if request is not post
	 * @return void
	 */
	public function actionDelete($id)
	{
		if (Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (!isset($_GET['ajax']))
			{
				$this->redirect(array('admin'));
			}
		}
		else
		{
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
		}
	}

	/**
	 * Show all adventures to select one to start with
	 *
	 * @return void
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/column1';
		$dataProvider = new CActiveDataProvider('Adventure');
		$sort = new CSort('Adventure');
		$sort->defaultOrder = array('id' => CSort::SORT_DESC);
		$dataProvider->setSort($sort);

		$nowDate = new DateTime();

		$criteria_is_running = new CDbCriteria();
		$criteria_is_running_start = new CDbCriteria();
		$criteria_is_running_stop = new CDbCriteria();

		$adventure_model = Adventure::model();

		$criteria_is_running_start->addInCondition($adventure_model->quotedCol('startDate'), array(null));
		$criteria_is_running_start->addBetweenCondition($adventure_model->quotedCol('startDate'), '1970-01-01', $nowDate->format('Y-m-d'), 'OR');

		$criteria_is_running_stop->addInCondition($adventure_model->quotedCol('stopDate'), array(null));
		$criteria_is_running_stop->addBetweenCondition($adventure_model->quotedCol('stopDate'), $nowDate->format('Y-m-d'), '2037-01-01', 'OR');

		$criteria_is_running->mergeWith($criteria_is_running_start);
		$criteria_is_running->mergeWith($criteria_is_running_stop);

		$criteria_is_running->addInCondition($adventure_model->quotedCol('state'), array_keys(Adventure::runningStates()), 'AND');
		$dataProvider->setCriteria($criteria_is_running);

		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	/**
	 * Manages all models.
	 *
	 * @return void
	 */
	public function actionAdmin()
	{
		$model = new Adventure('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Adventure']))
		{
			$model->attributes=$_GET['Adventure'];
		}

		if (!Yii::app()->user->isAdmin)
		{
			$model->createdBy = Yii::app()->user->id;
		}

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer $id the ID of the model to be loaded
	 * @param boolean $with_acl check acl upon model load
	 * @throws CHttpException
	 * @return void
	 */
	public function loadModel($id, $with_acl = true)
	{
		$model = Adventure::model()->findByPk($id);
		if ($model === null)
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}
		else if ($with_acl && !$model->isAdminOrOwner(Yii::app()->user->id))
		{
			throw new CHttpException(403, 'Not authorized');
		}
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 *
	 * @param CModel $model the model to be validated
	 * @return void
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'adventure-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
