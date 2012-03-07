<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../yii/framework/yiit.php';
require_once($yiit);

$config=include dirname(__FILE__).'/../config/test.php';
if (file_exists(dirname(__FILE__).'/../config/test_local.php'))
{
	$config_local = include dirname(__FILE__).'/../config/test_local.php';
	$config = CMap::mergeArray($config, $config_local);
}

require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
