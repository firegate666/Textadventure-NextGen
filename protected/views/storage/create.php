<?php
$this->breadcrumbs=array(
	'Storages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Storage', 'url'=>array('index')),
	array('label'=>'Manage Storage', 'url'=>array('admin')),
);
?>

<h1>Create Storage</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>