<?php
$this->breadcrumbs=array(
	'Tech Tree Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TechTreeType', 'url'=>array('index')),
	array('label'=>'Create TechTreeType', 'url'=>array('create')),
	array('label'=>'View TechTreeType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TechTreeType', 'url'=>array('admin')),
);
?>

<h1>Update TechTreeType <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
