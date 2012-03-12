<?php
$this->breadcrumbs=array(
	'Adventures'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Adventure', 'url'=>array('index')),
	array('label'=>'Create Adventure', 'url'=>array('create')),
	array('label'=>'Update Adventure', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Adventure', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Adventure', 'url'=>array('admin')),
);
?>

<h1>View Adventure #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'adventureId',
	),
));
