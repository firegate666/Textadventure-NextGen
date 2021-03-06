<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Textadventure NextGEN',

	// application components
	'components' => array(
		'cache' => array( // override in local conf if a different caching class is desired
			'class' => 'system.caching.CFileCache',
		),
	),
	'import' => array(
		'application.commands.*',
		'application.models.*',
		'application.models.game.*',
		'application.components.*',
	),
);
