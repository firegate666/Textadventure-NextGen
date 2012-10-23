var game = {

	ownIslands: function (url, data, callback) {
		$.getJSON(url, data, function(ret_data) {
			callback(ret_data);
		});
	}
};
