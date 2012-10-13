<?php
return array(
	'name' => '{{NAME}}',
	'modules' => array(
	),

	// application components
	'components' => array(

		'db' => array(
			'connectionString' => '{{DB_SYSTEM}}:host={{DB_HOST}};dbname={{DB_NAME}}',
			'username' => '{{DB_USER}}',
			'password' => '{{DB_PASS}}',
			'charset' => 'utf8',
			'class' => 'CDbConnection'
		),

		'cache' => array(
			'class' => 'system.caching.CFileCache',
		),

	),

	'theme' => '{{THEME))',

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => array(
		// this is used in contact page
		'adminEmail' => '{{EMAIL}}',
	),
);
