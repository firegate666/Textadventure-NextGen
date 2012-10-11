<?php
$this->breadcrumbs=array(
	'Storages',
);

$this->menu=array(
	array('label'=>'Create Storage', 'url'=>array('create')),
	array('label'=>'Manage Storage', 'url'=>array('admin')),
);
?>

<h1>Storages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
