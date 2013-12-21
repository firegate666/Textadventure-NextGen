<?php
$this->breadcrumbs=array(
	'Tech Tree Entries'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TechTreeEntry', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntry', 'url'=>array('create')),
	array('label'=>'Update TechTreeEntry', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TechTreeEntry', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TechTreeEntry', 'url'=>array('admin')),
);
?>

<h1>View TechTreeEntry #<?= $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'name',
		'description',
		'costs',
		'categoryId',
		'typeId',
	),
)); ?>
