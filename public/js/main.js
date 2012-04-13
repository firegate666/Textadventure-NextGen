var Adventure = {

		'graph': {

			'draw': function(g, id, width, height) {
				"use strict";

				width = width || 800;
				height = height || 600;
				(new Graph.Layout.Spring(g)).layout();
				(new Graph.Renderer.Raphael(id, g, width, height)).draw();
			}

		}
};
