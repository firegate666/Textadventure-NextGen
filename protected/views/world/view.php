<?php
$this->breadcrumbs=array(
	'Worlds'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List World', 'url'=>array('index')),
	array('label'=>'Create World', 'url'=>array('create')),
	array('label'=>'Update World', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete World', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage World', 'url'=>array('admin')),
);
?>

<h1>View World #<?= $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'name',
	),
)); ?>
