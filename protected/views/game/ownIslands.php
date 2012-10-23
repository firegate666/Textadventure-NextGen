<?php
$this->breadcrumbs=array(
	'Game', 'Own Islands'
);?>
<h1>Own Islands</h1>

<table id="own-islands">

	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Größe</th>
		<th>Archipel</th>
		<th>Produktion</th>
	</tr>

</table>

<script type="text/javascript">

	game.ownIslands('<?=$this->createUrl('island/ownIslands', array('world_id' => $world_id, 'user_id' => $user_id))?>', {}, function (ret_data) {
		var tr = $('#own-islands').append('<tr></tr>');
		$.each(ret_data, function (k, v) {
			var island_link = '<?=$this->createUrl('game/island', array('island_id' => 'ID'))?>';

			tr.append('<td><a href="' + island_link.replace(/ID/, v.id) + '">' + v.id + '</a></td>');
			tr.append('<td>' + v.name + '</td>');
			tr.append('<td>' + v.size + '</td>');
			tr.append('<td>' + v.archipelago.name + '</td>');

			var production = '';
			$.each(v.storage.stocks, function (k, v) {
				production += '<li>' + v.resourceId + ': ' + v.amount + '</li>';
			});
			production = '<ul>' + production + '</ul>';

			tr.append('<td>'+production+'</td>');
		})
	});

</script>
