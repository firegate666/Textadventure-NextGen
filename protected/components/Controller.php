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
	 * @param string $format
	 * @return string
	 */
	public function nowDate($format = 'd.m.Y, H:i:s')
	{
		return date($format);
	}

	/**
	 * read version date from VERSION file in runtime path
	 *
	 * @return string
	 */
	public function getVersionInfo() {
		$version_info_file = Yii::app()->getRuntimePath().'/VERSION';
		$version_string = 'no version found';
		if (file_exists($version_info_file))
		{
			$version_string = file_get_contents($version_info_file);
		}
		return $version_string;
	}

	/**
	 * Declares class-based actions.
	 *
	 * @return array
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

	/**
	 * Define default filter for theming and lang switch
	 *
	 * @see CController::filters()
	 * @return array
	 */
	public function filters()
	{
		return array(
			'theming',
			'lang',
		);
	}

	/**
	 * switch theme with request get parameter 'theme'
	 *
	 * @param CFilterChain $filterchain
	 * @return void
	 */
	function filterTheming(CFilterChain $filterchain)
	{
		$theme = Yii::app()->request->getParam('theme', false);

		if ($theme !== false && !empty($theme))
		{
			Yii::app()->theme = $theme;
		}

		$filterchain->run();
	}

	/**
	 * handle application langue by get parameter "lang" or session stored lang
	 *
	 * @param CFilterChain $filterchain
	 * @return void
	 */
	function filterLang(CFilterChain $filterchain)
	{
		$session_lang = $this->getSessionValue('session_lang', false, true, '');
		$lang_from_get = Yii::app()->request->getParam('lang', false);

		$lang = $lang_from_get ? $lang_from_get : $session_lang;
		if ($lang)
		{
			Yii::app()->setLanguage($lang);
			$this->addSessionValue('session_lang', $lang, true, '');
		}

		$filterchain->run();
	}

	/**
	 * get value from session
	 *
	 * @see CHttpSession::get(mixed, mixed)
	 * @param mixed $key
	 * @param mixed $defaultValue
	 * @param boolean $allowGetEmpty
	 * @param string $prefix prefix for session stored values, defaults to calling class
	 * @throws SessionKeyNotExistsException
	 * @return mixed
	 */
	public static function getSessionValue($key, $defaultValue, $allowGetEmpty = true, $prefix = null)
	{
		if ($prefix === null)
		{
			$prefix = get_called_class();
		}

		if (!$allowGetEmpty && !Yii::app()->session->contains($prefix.'_'.$key))
		{
			throw new SessionKeyNotExistsException();
		}

		return Yii::app()->session->get($prefix.'_'.$key, $defaultValue);
	}

	/**
	 * add value to session
	 *
	 * @see CHttpSession::add(mixed, mixed)
	 * @param mixed $key
	 * @param mixed $value
	 * @param boolean $allowOverride override if value exists
	 * @param string $prefix prefix for session stored values, defaults to calling class
	 * @throws SessionKeyExistsException
	 * @return void
	 */
	public static function addSessionValue($key, $value, $allowOverride = true, $prefix = null)
	{
		if ($prefix === null)
		{
			$prefix = get_called_class();
		}

		if (!$allowOverride && Yii::app()->session->contains($prefix.'_'.$key))
		{
			throw new SessionKeyExistsException();
		}

		Yii::app()->session->add($prefix.'_'.$key, $value);
	}

}
