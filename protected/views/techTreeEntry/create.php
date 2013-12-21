<?php
$this->breadcrumbs=array(
	'Tech Tree Entries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TechTreeEntry', 'url'=>array('index')),
	array('label'=>'Manage TechTreeEntry', 'url'=>array('admin')),
);
?>

<h1>Create TechTreeEntry</h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
