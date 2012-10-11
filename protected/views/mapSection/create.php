<?php
$this->breadcrumbs=array(
	'Map Sections'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MapSection', 'url'=>array('index')),
	array('label'=>'Manage MapSection', 'url'=>array('admin')),
);
?>

<h1>Create MapSection</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>