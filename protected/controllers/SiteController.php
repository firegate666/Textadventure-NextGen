<?php
/**
 * display static pages
 */
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 *
	 * @return void
	 */
	public function actions()
	{
		$actions = parent::actions();
		return array_merge($actions, array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 *
	 * @return void
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * show admin interface
	 *
	 * @return void
	 */
	public function actionAdmin()
	{
		$this->layout = '//layouts/column1_admin';
		$this->render('admin');
	}

	/**
	 * This is the action to handle external exceptions.
	 *
	 * @return void
	 */
	public function actionError()
	{
		if (($error=Yii::app()->errorHandler->error) !== null)
		{
			if(Yii::app()->request->isAjaxRequest)
			{
				echo $error['message'];
			}
			else
			{
				$this->render('error', $error);
			}
		}
	}

	/**
	 * Displays the contact page
	 *
	 * @return void
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if (isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate())
			{
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array('model' => $model));
	}

	public function filters()
	{
		return array(
			array(
				'COutputCache + page, index',
				'duration' => 100,
				'varyByParam' => array('view'),
				'varyBySession' => true,
			),
		);
	}

}
