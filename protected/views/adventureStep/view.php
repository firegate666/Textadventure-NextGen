<?php
$this->breadcrumbs=array(
	'Adventure Steps'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List AdventureStep', 'url'=>array('index')),
	array('label'=>'Create AdventureStep', 'url'=>array('create')),
	array('label'=>'Update AdventureStep', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AdventureStep', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdventureStep', 'url'=>array('admin')),
);
?>

<h1>View AdventureStep #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'adventure',
		'name',
		'description',
	),
));
?>
