<?php
$this->breadcrumbs = array(
	'Adventures' => array('index'),
	'Manage' => array('admin'),
	'Graph'
);

$baseurl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerCoreScript('jquery');

$raphael_js = Yii::app()->assetManager->publish(__DIR__ . '/../../../htdocs/public/js/libs/dracula/vendor/raphael.js');
Yii::app()->clientScript->registerScriptFile($raphael_js);

$dracula_graffle_js = Yii::app()->assetManager->publish(__DIR__ . '/../../../htdocs/public/js/libs/dracula/lib/dracula_graffle.js');
Yii::app()->clientScript->registerScriptFile($dracula_graffle_js);

$dracula_graph_js = Yii::app()->assetManager->publish(__DIR__ . '/../../../htdocs/public/js/libs/dracula/lib/dracula_graph.js');
Yii::app()->clientScript->registerScriptFile($dracula_graph_js);

$main_js = Yii::app()->assetManager->publish(__DIR__ . '/../../../htdocs/public/js/main.js');
Yii::app()->clientScript->registerScriptFile($main_js);

Yii::app()->clientScript->registerScript('adventure_graph_init', "
Adventure.graph.init(" . json_encode($steps) . ", " . json_encode($edges_to_draw) . ").draw('canvas', $('#canvas').width(), 600);
", CClientScript::POS_END);
?>

<div id="canvas"></div>

