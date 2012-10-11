<?php
$this->breadcrumbs=array(
	'Archipelagos',
);

$this->menu=array(
	array('label'=>'Create Archipelago', 'url'=>array('create')),
	array('label'=>'Manage Archipelago', 'url'=>array('admin')),
);
?>

<h1>Archipelagos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
