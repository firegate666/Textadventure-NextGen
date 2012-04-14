<?php
$this->breadcrumbs = array(
	'Adventures' => array('index'),
	'Manage' => array('admin'),
	'Graph'
);
?>

<script type="text/javascript" src="public/js/main.js"></script>
<script type="text/javascript" src="public/vendors/dracula/js/raphael-min.js"></script>
<script type="text/javascript" src="public/vendors/dracula/js/dracula_graffle.js"></script>
<script type="text/javascript" src="public/vendors/dracula/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="public/vendors/dracula/js/dracula_graph.js"></script>
<?php


?>

<div id="canvas"></div>

<script type="text/javascript">
var k, v;
var g = new Graph();
var nodes = <?=  json_encode($steps)?>;
var edges = <?=  json_encode($steps_to_draw) ?>;

$.each(nodes, function(k, v)
{
	"use strict";
	g.addNode(v.stepId, {
		label: Adventure.trimIf(v.name, 25),
		render: Adventure.renderFunc
	});
});

$.each(edges, function(k, v)
{
	"use strict";
	g.addEdge(v.from, v.to, {
		directed : true,
		label: Adventure.trimIf(v.name, 25)
	});
});
Adventure.graph.draw(g, 'canvas', $('#canvas').width(), 600);
</script>

