<?php
$this->breadcrumbs=array(
	'Tech Tree Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TechTreeType', 'url'=>array('index')),
	array('label'=>'Manage TechTreeType', 'url'=>array('admin')),
);
?>

<h1>Create TechTreeType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>