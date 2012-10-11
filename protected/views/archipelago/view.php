<?php
$this->breadcrumbs=array(
	'Archipelagos'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Archipelago', 'url'=>array('index')),
	array('label'=>'Create Archipelago', 'url'=>array('create')),
	array('label'=>'Update Archipelago', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Archipelago', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Archipelago', 'url'=>array('admin')),
);
?>

<h1>View Archipelago #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'name',
		'xPos',
		'yPos',
		'magnitude',
		'mapSectionId',
	),
)); ?>
