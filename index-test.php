<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii=dirname(__FILE__).'/protected/vendors/yii/framework/yii.php';
$config=include dirname(__FILE__).'/protected/config/test.php';

if (file_exists(dirname(__FILE__).'/protected/config/test_local.php'))
{
	$config_local = include dirname(__FILE__).'/protected/config/test_local.php';
	$config = array_merge_recursive($config, $config_local);
}

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
