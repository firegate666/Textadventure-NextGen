<?php
$main_config = include dirname(__FILE__).'/main.php';

return CMap::mergeArray(
	$main_config,
	array(
		'components' => array(
			'fixture' => array(
				'class' => 'system.test.CDbFixtureManager',
			),
		),
	)
);
