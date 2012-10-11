<?php
$this->breadcrumbs=array(
	'Tech Tree Types',
);

$this->menu=array(
	array('label'=>'Create TechTreeType', 'url'=>array('create')),
	array('label'=>'Manage TechTreeType', 'url'=>array('admin')),
);
?>

<h1>Tech Tree Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
