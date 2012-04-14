var Adventure = {

		graph: {

			draw: function(g, id, width, height) {
				"use strict";

				width = width || 800;
				height = height || 600;
				(new Graph.Layout.Spring(g)).layout();
				(new Graph.Renderer.Raphael(id, g, width, height)).draw();
			}

		},

		renderFunc: function(r, node) {
			"use strict";

			/* the default node drawing */
			var color = node.color || Raphael.getColor();
			var ellipse = r.ellipse(0, 0, 30, 20).attr({fill: color, stroke: color, "stroke-width": 2});
			/* set DOM node ID */
			ellipse.node.id = node.id;
			var shape = r.set().
				push(ellipse).
				push(r.text(0, 30, node.label || node.id));
			return shape;
		}
};
