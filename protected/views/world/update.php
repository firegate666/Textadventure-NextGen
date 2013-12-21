<?php
$this->breadcrumbs=array(
	'Worlds'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List World', 'url'=>array('index')),
	array('label'=>'Create World', 'url'=>array('create')),
	array('label'=>'View World', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage World', 'url'=>array('admin')),
);
?>

<h1>Update World <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
