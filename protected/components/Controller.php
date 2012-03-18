<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

	/**
	 * test if logged in user is admin
	 *
	 * @return boolean
	 */
	protected function userIsAdmin()
	{
		$id = Yii::app()->user->id;
		$user = User::model()->findByPk($id);
		return $user->isAdmin();
	}

	/**
	 * get actual date, used as dynamic callback for site page view
	 *
	 * @return string
	 */
	public function nowDate($format = 'd.m.Y, H:i:s')
	{
		return date($format);
	}

	/**
	 * Declares class-based actions.
	 *
	 * @return void
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
					'class' => 'CCaptchaAction',
					'backColor' => 0xFFFFFF,
			),
		);
	}

}
