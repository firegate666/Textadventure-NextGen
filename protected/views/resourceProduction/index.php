<?php
$this->breadcrumbs=array(
	'Resource Productions',
);

$this->menu=array(
	array('label'=>'Create ResourceProduction', 'url'=>array('create')),
	array('label'=>'Manage ResourceProduction', 'url'=>array('admin')),
);
?>

<h1>Resource Productions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
