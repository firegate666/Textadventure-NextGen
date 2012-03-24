<?php
$this->breadcrumbs=array(
	'Adventure Participations',
);

$this->menu=array();
?>

<h1>Adventure Participations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
