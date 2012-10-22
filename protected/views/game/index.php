<?php
$this->breadcrumbs=array(
	'Game',
);?>
<h1>Select your world</h1>

<p>Choose the world you would like to play on from the list below</p>

<ul>
	<?php foreach ($world_list as $world):
		$this->renderPartial('_world', array('model' => $world));
	endforeach; ?>
</ul>
