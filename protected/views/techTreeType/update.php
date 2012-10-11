<?php
$this->breadcrumbs=array(
	'Tech Tree Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TechTreeType', 'url'=>array('index')),
	array('label'=>'Create TechTreeType', 'url'=>array('create')),
	array('label'=>'View TechTreeType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TechTreeType', 'url'=>array('admin')),
);
?>

<h1>Update TechTreeType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>