<?php
$this->breadcrumbs=array(
	'Adventure Step Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdventureStepOption', 'url'=>array('index')),
	array('label'=>'Manage AdventureStepOption', 'url'=>array('admin')),
);
?>

<h1>Create AdventureStepOption</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
