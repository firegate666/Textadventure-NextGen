(function($, window) {
	'use strict';

	window.game = {

		islands: function (url, data, callback) {
			$.getJSON(url, data, function(ret_data) {
				callback(ret_data);
			});
		},

		pager: function (target, limit, offset, count, baseurl, row_callback) {
			var pager = $('<div class="pager" data-limit="' + limit + '" data-offset="' + offset + '"></div>').insertAfter(target),
				prev = $('<a href="" class="prev">&lt;&lt;</a>'),
				next = $('<a href="" class="next">&gt;&gt;</a>');

			pager.append(prev)
				.append('&nbsp;')
				.append(next);

			$(pager).on('click', 'a', {count: count, baseurl: baseurl}, function(e) {
				var limit = parseInt($(this).parents('.pager').first().attr('data-limit'), 10),
					offset = parseInt($(this).parents('.pager').first().attr('data-offset'), 10),
					query_result = true;

				if ($(this).hasClass('prev')) {
					query_result = offset !== 0;
					offset = Math.max(0, offset - limit);
				} else {
					offset = Math.min(e.data.count - limit, offset + limit);
				}

				if (query_result) {
					$('tr.island-row', target).css('visibility', 'hidden');
					$(this).parents('.pager').first().attr('data-offset', offset).attr('data-limit', limit);
					window.game.islands(e.data.baseurl.replace(/LIMIT/, limit).replace(/OFFSET/, offset), {}, function (ret_data) {
						$('tr.island-row', target).remove();
						$.each(ret_data.list, row_callback);
					});
				}

				e.preventDefault();
				e.stopPropagation();
			});
		}
	};

}(jQuery, window));
