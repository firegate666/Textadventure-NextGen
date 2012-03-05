<?php
$this->breadcrumbs=array(
	'Adventure Step Options'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdventureStepOption', 'url'=>array('index')),
	array('label'=>'Create AdventureStepOption', 'url'=>array('create')),
	array('label'=>'View AdventureStepOption', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AdventureStepOption', 'url'=>array('admin')),
);
?>

<h1>Update AdventureStepOption <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>