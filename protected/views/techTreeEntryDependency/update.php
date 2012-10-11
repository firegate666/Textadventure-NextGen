<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Dependencies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TechTreeEntryDependency', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntryDependency', 'url'=>array('create')),
	array('label'=>'View TechTreeEntryDependency', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TechTreeEntryDependency', 'url'=>array('admin')),
);
?>

<h1>Update TechTreeEntryDependency <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>