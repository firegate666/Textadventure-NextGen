<?php
$this->breadcrumbs=array(
	'Storages'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Storage', 'url'=>array('index')),
	array('label'=>'Create Storage', 'url'=>array('create')),
	array('label'=>'Update Storage', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Storage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Storage', 'url'=>array('admin')),
);
?>

<h1>View Storage #<?= $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'capacity',
	),
)); ?>
