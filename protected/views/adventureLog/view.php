<?php
$this->breadcrumbs = array(
	'Adventure Logs' => array('index'),
	$model->id,
);

$this->menu = array(
	array('label' => 'List AdventureLog', 'url' => array('index')),
);
?>

<h1>View AdventureLog #<?= $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'userId',
		'adventureId',
		'adventureStepId',
	),
));
