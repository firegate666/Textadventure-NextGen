<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/protected/vendors/yii/framework/yii.php';
$config = include dirname(__FILE__) . '/protected/config/main.php';

require_once ($yii);
if (file_exists(dirname(__FILE__) . '/protected/config/main_local.php'))
{
	$config_local = include dirname(__FILE__) . '/protected/config/main_local.php';
	$config = CMap::mergeArray($config, $config_local);
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

Yii::createWebApplication($config)->run();
