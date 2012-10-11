<?php
$this->breadcrumbs=array(
	'Tech Tree Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TechTreeCategory', 'url'=>array('index')),
	array('label'=>'Create TechTreeCategory', 'url'=>array('create')),
	array('label'=>'Update TechTreeCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TechTreeCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TechTreeCategory', 'url'=>array('admin')),
);
?>

<h1>View TechTreeCategory #<?php echo $model->id; ?></h1>

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
