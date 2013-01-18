<?php
$this->breadcrumbs=array(
	'Game', 'Own Islands'
);?>
<h1>Own Islands</h1>

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

	var baseurl = '<?=$this->createUrl('island/ownIslands', array('world_id' => $world_id, 'limit' => 'LIMIT', 'offset' => 'OFFSET'))?>';

</script>

<?= $this->renderPartial('_islandScript', array('limit' => $limit, 'offset' => $offset)) ?>
