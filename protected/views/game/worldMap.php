<?php
$this->breadcrumbs = array(
	'Game', 'World Map'
);?>

<h1>World Map</h1>

<table id="islands">

	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Größe</th>
		<th>Archipel</th>
		<th>Produktion</th>
		<th>Eigentümer</th>
	</tr>

</table>

<script type="text/javascript">

	var baseurl = '<?=$this->createUrl('island/all', array('world_id' => $world_id, 'limit' => 'LIMIT', 'offset' => 'OFFSET'))?>';

</script>

<?= $this->renderPartial('_islandScript', array('limit' => $limit, 'offset' => $offset)) ?>
