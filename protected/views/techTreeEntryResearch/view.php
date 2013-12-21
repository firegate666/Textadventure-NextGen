<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Researches'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TechTreeEntryResearch', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntryResearch', 'url'=>array('create')),
	array('label'=>'Update TechTreeEntryResearch', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TechTreeEntryResearch', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TechTreeEntryResearch', 'url'=>array('admin')),
);
?>

<h1>View TechTreeEntryResearch #<?= $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'userId',
		'techId',
		'start',
		'end',
		'finished',
	),
)); ?>
