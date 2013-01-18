<script type="text/javascript">

	function renderResults(k, v) {
		var island_link = '<?=$this->createUrl('game/island', array('island_id' => 'ID'))?>',
			tr = $('<tr class="island-row"></tr>').appendTo('#islands');

		tr.append('<td><a href="' + island_link.replace(/ID/, v.id) + '">' + v.id + '</a></td>');
		tr.append('<td>' + v.name + '</td>');
		tr.append('<td>' + v.size + '</td>');
		tr.append('<td>' + v.archipelago.name + '</td>');

		var production = '';
		if (v.storage) {
			$.each(v.storage.stocks, function (k, v) {
				production += '<li>' + v.resourceId + ': ' + v.amount + '</li>';
			});
			production = '<ul>' + production + '</ul>';
		}
		tr.append('<td>' + production + '</td>');

		var owner = '';
		if (v.owner) {
			owner = v.owner.name;
		}
		tr.append('<td>' + owner + '</td>');
	}

	game.islands(baseurl.replace(/LIMIT/, <?=$limit?>).replace(/OFFSET/, <?=$offset?>), {}, function (ret_data) {
		$.each(ret_data.list, renderResults);
		game.pager('#islands', <?=$limit?>, <?=$offset?>, ret_data.count, baseurl, renderResults);
	});
</script>
