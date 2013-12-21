<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Dependencies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TechTreeEntryDependency', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntryDependency', 'url'=>array('create')),
	array('label'=>'Update TechTreeEntryDependency', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TechTreeEntryDependency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TechTreeEntryDependency', 'url'=>array('admin')),
);
?>

<h1>View TechTreeEntryDependency #<?= $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'techId',
		'dependencyId',
	),
)); ?>
