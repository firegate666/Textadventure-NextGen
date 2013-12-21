<?php
$this->breadcrumbs=array(
	'Resources'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Resource', 'url'=>array('index')),
	array('label'=>'Create Resource', 'url'=>array('create')),
	array('label'=>'View Resource', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Resource', 'url'=>array('admin')),
);
?>

<h1>Update Resource <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
