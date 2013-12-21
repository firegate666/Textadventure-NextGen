<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Dependencies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TechTreeEntryDependency', 'url'=>array('index')),
	array('label'=>'Manage TechTreeEntryDependency', 'url'=>array('admin')),
);
?>

<h1>Create TechTreeEntryDependency</h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
