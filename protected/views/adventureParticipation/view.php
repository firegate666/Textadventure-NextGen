<?php
$this->breadcrumbs = array(
	'Adventure Participations' => array('index'),
	$model->id,
);

$this->menu = array(
	array('label' => 'List AdventureParticipation', 'url' => array('index')),
);
?>

<h1>View AdventureParticipation #<?php echo $model->id; ?></h1>

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
		'started',
		'ended',
	),
));
