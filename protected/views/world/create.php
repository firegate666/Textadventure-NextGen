<?php
$this->breadcrumbs=array(
	'Worlds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List World', 'url'=>array('index')),
	array('label'=>'Manage World', 'url'=>array('admin')),
);
?>

<h1>Create World</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>