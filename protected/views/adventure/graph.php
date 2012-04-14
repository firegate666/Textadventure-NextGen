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
var g = new Graph();
var edges = <?=  json_encode($steps_to_draw) ?>;
$.each(edges, function(k, v)
{
	g.addEdge(v.from, v.to, { directed : true });
});
Adventure.graph.draw(g, 'canvas', $('#canvas').width(), 600);
</script>

