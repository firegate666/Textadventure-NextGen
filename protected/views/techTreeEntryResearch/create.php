<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Researches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TechTreeEntryResearch', 'url'=>array('index')),
	array('label'=>'Manage TechTreeEntryResearch', 'url'=>array('admin')),
);
?>

<h1>Create TechTreeEntryResearch</h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
