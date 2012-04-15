<?php
$this->breadcrumbs = array(
	'Adventures' => array('index'),
	'Manage' => array('admin'),
	'Graph'
);

$baseurl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile($baseurl . 'public/vendors/dracula/js/raphael-min.js');
Yii::app()->clientScript->registerScriptFile($baseurl . 'public/vendors/dracula/js/dracula_graffle.js');
Yii::app()->clientScript->registerScriptFile($baseurl . 'public/vendors/dracula/js/dracula_graph.js');
Yii::app()->clientScript->registerScriptFile($baseurl . 'public/js/main.js');
?>

<div id="canvas"></div>

<script type="text/javascript">
Adventure.graph.init(<?=json_encode($steps)?>, <?=json_encode($edges_to_draw) ?>).draw('canvas', $('#canvas').width(), 600);
</script>
