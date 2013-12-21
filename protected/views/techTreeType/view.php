<?php
$this->breadcrumbs=array(
	'Tech Tree Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TechTreeType', 'url'=>array('index')),
	array('label'=>'Create TechTreeType', 'url'=>array('create')),
	array('label'=>'Update TechTreeType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TechTreeType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TechTreeType', 'url'=>array('admin')),
);
?>

<h1>View TechTreeType #<?= $model->id; ?></h1>

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
