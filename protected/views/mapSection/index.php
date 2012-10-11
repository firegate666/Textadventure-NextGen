<?php
$this->breadcrumbs=array(
	'Map Sections',
);

$this->menu=array(
	array('label'=>'Create MapSection', 'url'=>array('create')),
	array('label'=>'Manage MapSection', 'url'=>array('admin')),
);
?>

<h1>Map Sections</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
