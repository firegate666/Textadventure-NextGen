<?php
$this->breadcrumbs=array(
	'Tech Tree Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TechTreeCategory', 'url'=>array('index')),
	array('label'=>'Create TechTreeCategory', 'url'=>array('create')),
	array('label'=>'View TechTreeCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TechTreeCategory', 'url'=>array('admin')),
);
?>

<h1>Update TechTreeCategory <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
