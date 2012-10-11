<?php
$this->breadcrumbs=array(
	'Resource Productions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResourceProduction', 'url'=>array('index')),
	array('label'=>'Create ResourceProduction', 'url'=>array('create')),
	array('label'=>'View ResourceProduction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ResourceProduction', 'url'=>array('admin')),
);
?>

<h1>Update ResourceProduction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>