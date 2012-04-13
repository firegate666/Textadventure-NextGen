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
<pre>
<?php


?>
<div id="canvas"></div>

<button id="redraw" onclick="Adventure.graph.redraw();">redraw</button>

<script type="text/javascript">
var g = new Graph();
var count = 0;
<?php foreach ($steps_to_draw as $step_to_draw): ?>
g.addEdge("<?=key($step_to_draw)?>", "<?=current($step_to_draw)?>", { directed : true });
count++;
<?php endforeach; ?>
Adventure.graph.draw(g, 'canvas', $(canvas).width(), 600, Graph);
</script>
</pre>
