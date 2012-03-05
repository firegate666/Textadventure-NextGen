<?php
$this->breadcrumbs=array(
	'Adventures'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Adventure', 'url'=>array('index')),
	array('label'=>'Manage Adventure', 'url'=>array('admin')),
);
?>

<h1>Create Adventure</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>