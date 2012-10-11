<?php
$this->breadcrumbs=array(
	'Map Sections'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MapSection', 'url'=>array('index')),
	array('label'=>'Create MapSection', 'url'=>array('create')),
	array('label'=>'View MapSection', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MapSection', 'url'=>array('admin')),
);
?>

<h1>Update MapSection <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>