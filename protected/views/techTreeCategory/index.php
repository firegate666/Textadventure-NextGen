<?php
$this->breadcrumbs=array(
	'Tech Tree Categories',
);

$this->menu=array(
	array('label'=>'Create TechTreeCategory', 'url'=>array('create')),
	array('label'=>'Manage TechTreeCategory', 'url'=>array('admin')),
);
?>

<h1>Tech Tree Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
