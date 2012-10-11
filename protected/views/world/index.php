<?php
$this->breadcrumbs=array(
	'Worlds',
);

$this->menu=array(
	array('label'=>'Create World', 'url'=>array('create')),
	array('label'=>'Manage World', 'url'=>array('admin')),
);
?>

<h1>Worlds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
