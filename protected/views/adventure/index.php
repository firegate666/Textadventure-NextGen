<?php
$this->breadcrumbs = array(
	'Starte das Abenteuer',
);
?>

<h1>Starte das Abenteuer</h1>

<div id="adventure-index">
	<?php
		$this->widget('zii.widgets.CListView', array(
			'dataProvider' => $dataProvider,
			'itemView' => '_view',
		));
	?>
</div>
