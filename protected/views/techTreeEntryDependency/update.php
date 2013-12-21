<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Dependencies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TechTreeEntryDependency', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntryDependency', 'url'=>array('create')),
	array('label'=>'View TechTreeEntryDependency', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TechTreeEntryDependency', 'url'=>array('admin')),
);
?>

<h1>Update TechTreeEntryDependency <?= $model->id; ?></h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
