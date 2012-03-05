<?php
$this->breadcrumbs=array(
	'Adventure Steps',
);

$this->menu=array(
	array('label'=>'Create AdventureStep', 'url'=>array('create')),
	array('label'=>'Manage AdventureStep', 'url'=>array('admin')),
);
?>

<h1>Adventure Steps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
