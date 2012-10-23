<?php

class IslandController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'ownIslands'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'expression' => '$user->getState("isAdmin")',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression' => '$user->getState("isAdmin")',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Island;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Island']))
		{
			$model->attributes=$_POST['Island'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Island']))
		{
			$model->attributes=$_POST['Island'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Island');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Island('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Island']))
			$model->attributes=$_GET['Island'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * transform island collection to array
	 *
	 * @todo move to island or meta info
	 * @param array $islands
	 * @return array
	 */
	protected function transformIslands(array $islands) {
		$simple_list = array();
		foreach ($islands as $island) {
			if ($island instanceof Island) {
				$temp = $island->getAttributes();

				$temp['storage'] = $island->storage->getAttributes();
				$temp['archipelago'] = $island->archipelago->getAttributes();
				$temp['mapSection'] = $island->archipelago->mapSection->getAttributes();
				$temp['world'] = $island->archipelago->mapSection->world->getAttributes();
				$temp['owner'] = array(
					'id' => $island->owner->id,
					'name' => $island->owner->username,
				);

				$temp['storage']['stocks'] = array();
				foreach ($island->storage->stocks as $stock) {
					$temp['storage']['stocks'][] = $stock->getAttributes();
				}

				$temp['productions'] = array();
				foreach ($island->resourceProductions as $production) {
					$temp['productions'][] = $production->getAttributes();
				}

				$simple_list[$island->id] = $temp;
			}
		}
		return $simple_list;
	}

	/**
	 * render json list of own islands
	 *
	 * @param integer $world_id
	 * @param integer $user_id
	 * @return void
	 */
	public function actionOwnIslands($world_id, $user_id) {
		$islands = Island::model()->getPlayerIslands($world_id, $user_id);
		print json_encode($this->transformIslands($islands), JSON_FORCE_OBJECT);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Island::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='island-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
