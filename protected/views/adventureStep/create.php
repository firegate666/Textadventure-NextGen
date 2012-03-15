<?php
$this->breadcrumbs=array(
	'Adventure Steps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdventureStep', 'url'=>array('index')),
	array('label'=>'Manage AdventureStep', 'url'=>array('admin')),
);
?>

<h1>Create AdventureStep</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'adventureList'=>$adventureList)); ?>
