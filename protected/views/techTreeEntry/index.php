<?php
$this->breadcrumbs=array(
	'Tech Tree Entries',
);

$this->menu=array(
	array('label'=>'Create TechTreeEntry', 'url'=>array('create')),
	array('label'=>'Manage TechTreeEntry', 'url'=>array('admin')),
);
?>

<h1>Tech Tree Entries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
