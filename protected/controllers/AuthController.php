<?php
/**
 * responsible for everything concerning authorization
 */
class AuthController extends Controller
{
	/**
	 * Displays the login page; redirects to returnUrl after login
	 *
	 * @return void
	 */
	public function actionLogin()
	{
		$model = new Auth();

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['Auth']))
		{
			$model->attributes = $_POST['Auth'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
			{
				Yii::app()->session->regenerateID(true);
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 *
	 * @return void
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->session->regenerateID(true);
		$this->redirect(Yii::app()->homeUrl);
	}
}
