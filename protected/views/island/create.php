<?php
$this->breadcrumbs=array(
	'Islands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Island', 'url'=>array('index')),
	array('label'=>'Manage Island', 'url'=>array('admin')),
);
?>

<h1>Create Island</h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
