<?php
return array(

	// application components
	'components' => array(

		'db' => array(
			'connectionString' => '{{DB_SYSTEM}}:host={{DB_HOST}};dbname={{DB_NAME}}',
			'username' => '{{DB_USER}}',
			'password' => '{{DB_PASS}}',
			'charset' => 'utf8',
			'class' => 'CDbConnection'
		),

	),
);
