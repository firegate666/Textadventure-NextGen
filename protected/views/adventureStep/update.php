<?php
$this->breadcrumbs=array(
	'Adventure Steps'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdventureStep', 'url'=>array('index')),
	array('label'=>'Create AdventureStep', 'url'=>array('create')),
	array('label'=>'View AdventureStep', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdventureStep', 'url'=>array('admin')),
);
?>

<h1>Update AdventureStep <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model, 'adventureList'=>$adventureList)); ?>
