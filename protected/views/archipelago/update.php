<?php
$this->breadcrumbs=array(
	'Archipelagos'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Archipelago', 'url'=>array('index')),
	array('label'=>'Create Archipelago', 'url'=>array('create')),
	array('label'=>'View Archipelago', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Archipelago', 'url'=>array('admin')),
);
?>

<h1>Update Archipelago <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
