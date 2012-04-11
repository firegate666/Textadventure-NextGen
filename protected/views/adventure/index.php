<?php
$this->breadcrumbs = array(
	'Start adventuring',
);

$this->menu = array(
	array('label' => 'Create Adventure', 'url' => array('create')),
	array('label' => 'Manage Adventure', 'url' => array('admin')),
);
?>

<h1>Start adventuring</h1>

<div id="adventure-index">
	<?php
		$this->widget('zii.widgets.CListView', array(
			'dataProvider' => $dataProvider,
			'itemView' => '_view',
		));
	?>
</div>
