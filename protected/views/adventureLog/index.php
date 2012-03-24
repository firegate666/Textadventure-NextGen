<?php
$this->breadcrumbs = array(
	'Adventure Logs',
);

$this->menu = array();
?>

<h1>Adventure Logs</h1>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
));
