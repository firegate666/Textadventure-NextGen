<?php
$this->breadcrumbs=array(
	'Tech Tree Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TechTreeCategory', 'url'=>array('index')),
	array('label'=>'Manage TechTreeCategory', 'url'=>array('admin')),
);
?>

<h1>Create TechTreeCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>