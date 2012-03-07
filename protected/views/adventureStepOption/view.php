<?php
$this->breadcrumbs=array(
	'Adventure Step Options'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AdventureStepOption', 'url'=>array('index')),
	array('label'=>'Create AdventureStepOption', 'url'=>array('create')),
	array('label'=>'Update AdventureStepOption', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdventureStepOption', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdventureStepOption', 'url'=>array('admin')),
);
?>

<h1>View AdventureStepOption #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent',
		'target',
		'name',
	),
));
?>
