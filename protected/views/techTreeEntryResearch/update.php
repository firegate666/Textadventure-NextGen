<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Researches'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TechTreeEntryResearch', 'url'=>array('index')),
	array('label'=>'Create TechTreeEntryResearch', 'url'=>array('create')),
	array('label'=>'View TechTreeEntryResearch', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TechTreeEntryResearch', 'url'=>array('admin')),
);
?>

<h1>Update TechTreeEntryResearch <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>