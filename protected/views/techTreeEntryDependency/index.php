<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Dependencies',
);

$this->menu=array(
	array('label'=>'Create TechTreeEntryDependency', 'url'=>array('create')),
	array('label'=>'Manage TechTreeEntryDependency', 'url'=>array('admin')),
);
?>

<h1>Tech Tree Entry Dependencies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
