<?php
$this->breadcrumbs=array(
	'Game', 'World Map'
);?>
<h1>World Map</h1>

<table id="world-islands">

	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Größe</th>
		<th>Archipel</th>
		<th>Produktion</th>
	</tr>

</table>

<script type="text/javascript">

	function renderResults(k, v) {
		var island_link = '<?=$this->createUrl('game/island', array('island_id' => 'ID'))?>',
			tr = $('<tr class="island-row"></tr>').appendTo('#world-islands');

		tr.append('<td><a href="' + island_link.replace(/ID/, v.id) + '">' + v.id + '</a></td>');
		tr.append('<td>' + v.name + '</td>');
		tr.append('<td>' + v.size + '</td>');
		tr.append('<td>' + v.archipelago.name + '</td>');

		if (v.storage) {
			var production = '';
			$.each(v.storage.stocks, function (k, v) {
				production += '<li>' + v.resourceId + ': ' + v.amount + '</li>';
			});
			production = '<ul>' + production + '</ul>';

			tr.append('<td>'+production+'</td>');
		}
	}

	game.ownIslands('<?=$this->createUrl('island/all', array('world_id' => $world_id, 'limit' => $limit, 'offset' => $offset))?>', {}, function (ret_data) {
		$.each(ret_data.list, renderResults);

		var pager = $('<div class="pager" data-limit="<?=$limit?>" data-offset="<?=$offset?>"></div>').insertAfter('#world-islands');
		var prev = $('<a href="" class="prev">&lt;&lt;</a>');
		var next = $('<a href="" class="next">&gt;&gt;</a>');

		pager.append(prev).append('&nbsp;').append(next);

		$(pager).on('click', 'a', {count: ret_data.count, baseurl: '<?=$this->createUrl('island/all', array('world_id' => $world_id, 'limit' => 'LIMIT', 'offset' => 'OFFSET'))?>'}, function(e) {
			var limit = parseInt($(this).parents('.pager').first().attr('data-limit'), 10);
			var offset = parseInt($(this).parents('.pager').first().attr('data-offset'), 10);

			var query_result = true;

			if ($(this).hasClass('prev')) {
				query_result = offset !== 0;
				offset = Math.max(0, offset - limit);
			} else {
				offset = Math.min(e.data.count, offset + limit);
			}

			if (query_result) {
				$('#world-islands tr.island-row').remove();
				$(this).parents('.pager').first().attr('data-offset', offset).attr('data-limit', limit);
				game.ownIslands(e.data.baseurl.replace(/LIMIT/, limit).replace(/OFFSET/, offset), {}, function (ret_data) {
					$.each(ret_data.list, renderResults);
				});
			}

			e.preventDefault();
			e.stopPropagation();
		});

	});

</script>
