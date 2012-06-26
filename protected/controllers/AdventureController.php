<?php
/**
 * control list and playing of adventures
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
	 * @throws CHttpException if $id is invalid
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
		$lastStep = AdventureLog::getLastStep(Yii::app()->user->id, $id);
		if (empty($step) && !empty($lastStep))
		{
			$step = $lastStep;
		}

		// always access the startingPoint if last step is empty
		if (empty($step) || empty($lastStep))
		{
			$stepModel = AdventureStep::model()->findBySql('SELECT * FROM "AdventureStep"
					WHERE "startingPoint" = true AND "adventure" = :adventure', array(':adventure' => $id));
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
		$model = new Adventure();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Adventure']))
		{
			$model->attributes = $_POST['Adventure'];
			if ($model->save())
			{
				$this->redirect(array('admin'));
			}
		}

		$this->render('create', array(
			'model' => $model,
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
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Adventure']))
		{
			$model->attributes = $_POST['Adventure'];
			if ($model->save())
			{
				$this->redirect(array('admin'));
			}
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id the ID of the model to be deleted
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
		$criteria_is_running->condition = sprintf(
			'
				("startDate" IS NULL OR "startDate" <= \'%s\')
				AND
				("stopDate" IS NULL OR "stopDate" >= \'%s\')
				AND
				"state" IN (%s)
			',
			$nowDate->format('Y-m-d'),
			$nowDate->format('Y-m-d'),
			implode(',', array_keys(Adventure::runningStates()))
		);

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
	 * @param CModel the model to be validated
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
