<?php
/**
 * @package controller
 */
class UserGroupController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';

	/**
	 * (non-PHPdoc)
	 * @see CController::init()
	 */
	public function init()
	{
		$this->defaultAction = 'admin';
	}

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
				'actions' => array('index', 'view'),
				'expression' => '$user->getState("isAdmin")',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update'),
				'expression' => '$user->getState("isAdmin")',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete'),
				'expression' => '$user->getState("isAdmin")',
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 *
	 * @param integer $id the ID of the model to be displayed
	 * @return void
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id),
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
		$model = new UserGroup();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['UserGroup']))
		{
			$model->attributes = $_POST['UserGroup'];
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

		if (isset($_POST['UserGroup']))
		{
			$model->attributes = $_POST['UserGroup'];
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
	 * Lists all models.
	 *
	 * @return void
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('UserGroup');
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
		$model = new UserGroup('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['UserGroup']))
		{
			$model->attributes=$_GET['UserGroup'];
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
	 * @throws CHttpException
	 * @return UserGroup
	 */
	public function loadModel($id)
	{
		$model = UserGroup::model()->findByPk($id);
		if ($model === null)
		{
			throw new CHttpException(404, 'The requested page does not exist.');
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
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-group-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

