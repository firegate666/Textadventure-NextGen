<?php
$this->breadcrumbs=array(
	'Tech Tree Entry Researches',
);

$this->menu=array(
	array('label'=>'Create TechTreeEntryResearch', 'url'=>array('create')),
	array('label'=>'Manage TechTreeEntryResearch', 'url'=>array('admin')),
);
?>

<h1>Tech Tree Entry Researches</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
