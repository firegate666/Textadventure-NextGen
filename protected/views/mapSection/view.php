<?php
$this->breadcrumbs=array(
	'Map Sections'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MapSection', 'url'=>array('index')),
	array('label'=>'Create MapSection', 'url'=>array('create')),
	array('label'=>'Update MapSection', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MapSection', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MapSection', 'url'=>array('admin')),
);
?>

<h1>View MapSection #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createdAt',
		'changedAt',
		'createdBy',
		'changedBy',
		'leftSectionId',
		'rightSectionId',
		'worldId',
	),
)); ?>
