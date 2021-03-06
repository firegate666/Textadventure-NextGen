<?php
$this->breadcrumbs=array(
	'Islands'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Island', 'url'=>array('index')),
	array('label'=>'Create Island', 'url'=>array('create')),
	array('label'=>'Update Island', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Island', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Island', 'url'=>array('admin')),
);
?>

<h1>View Island #<?= $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'name',
		'size',
		'xPos',
		'yPos',
		'archipelagoId',
		'ownerId',
		'storageId',
	),
)); ?>
