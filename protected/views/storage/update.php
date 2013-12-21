<?php
$this->breadcrumbs=array(
	'Storages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Storage', 'url'=>array('index')),
	array('label'=>'Create Storage', 'url'=>array('create')),
	array('label'=>'View Storage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Storage', 'url'=>array('admin')),
);
?>

<h1>Update Storage <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
