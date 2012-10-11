<?php
$this->breadcrumbs=array(
	'Archipelagos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Archipelago', 'url'=>array('index')),
	array('label'=>'Manage Archipelago', 'url'=>array('admin')),
);
?>

<h1>Create Archipelago</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>