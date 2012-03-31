<?php
$this->breadcrumbs=array(
	'Adventure Step Options',
);

$this->menu = array(
	array('label'=>'Create AdventureStepOption', 'url'=>array('create')),
	array('label'=>'Manage AdventureStepOption', 'url'=>array('admin')),
);
?>

<h1>Adventure Step Options</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
