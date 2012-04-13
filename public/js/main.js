var Adventure = {

		'graph': {

			'draw': function(g, id, width, height) {
				"use strict";

				width = width || 800;
				height = height || 600;
				var layouter = new Graph.Layout.Spring(g);
				layouter.layout();
				var renderer = new Graph.Renderer.Raphael(id, g, width, height);
				renderer.draw();
			},

			'redraw': function() {
				"use strict";

			    layouter.layout();
			    renderer.draw();
			}

		}
};
