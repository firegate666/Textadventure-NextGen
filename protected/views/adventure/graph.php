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
var k, v;
var g = new Graph();
var nodes = <?=  json_encode($steps)?>;
var edges = <?=json_encode($edges_to_draw) ?>;

$.each(nodes, function(k, v)
{
	"use strict";
	var color = '#6699FF';
	if (v.startingPoint === "1")
	{
		color = '#14FF14';
	}
	else if (v.endingPoint === "1")
	{
		color = '#FF0033';
	}
	g.addNode(v.stepId, {
		label: Adventure.trimIf(v.name, 25),
		color: color,
		render: Adventure.renderFunc
	});
});

$.each(edges, function(k, v)
{
	"use strict";
	g.addEdge(v.from, v.to, {
		directed : true,
		label: Adventure.trimIf(v.name, 25),
		'label-style' : {
			'font-size': 10
		}
	});
});
Adventure.graph.draw(g, 'canvas', $('#canvas').width(), 600);
</script>

