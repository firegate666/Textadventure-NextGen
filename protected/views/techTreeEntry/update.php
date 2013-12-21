<?php
$this->breadcrumbs=array(
	'Tech Tree Entries'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TechTreeEntry', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntry', 'url'=>array('create')),
	array('label'=>'View TechTreeEntry', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TechTreeEntry', 'url'=>array('admin')),
);
?>

<h1>Update TechTreeEntry <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
