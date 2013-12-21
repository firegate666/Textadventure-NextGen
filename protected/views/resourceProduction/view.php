<?php
$this->breadcrumbs=array(
	'Resource Productions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ResourceProduction', 'url'=>array('index')),
	array('label'=>'Create ResourceProduction', 'url'=>array('create')),
	array('label'=>'Update ResourceProduction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ResourceProduction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResourceProduction', 'url'=>array('admin')),
);
?>

<h1>View ResourceProduction #<?= $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'islandId',
		'resourceId',
		'growthFactor',
		'productionValue',
	),
)); ?>
