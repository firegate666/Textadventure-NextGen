<?php
$this->breadcrumbs=array(
	'Adventures',
);

$this->menu=array(
	array('label'=>'Create Adventure', 'url'=>array('create')),
	array('label'=>'Manage Adventure', 'url'=>array('admin')),
);
?>

<h1>Adventures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
