<?php
$this->breadcrumbs=array(
	'Resource Productions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResourceProduction', 'url'=>array('index')),
	array('label'=>'Manage ResourceProduction', 'url'=>array('admin')),
);
?>

<h1>Create ResourceProduction</h1>

<?= $this->renderPartial('_form', array('model'=>$model)); ?>
