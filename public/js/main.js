var Adventure = {

		tooltip: {

			/**
			 * pointer to tooltip
			 *
			 * @type {jQuery}
			 */
			i_tooltip: null,

			/**
			 * show tooltip
			 *
			 * @param {event} event
			 * @param {string} headline
			 * @param {string} text
			 * @return {void}
			 */
			show: function(event, headline, text) {
				"use strict";
				this.i_tooltip = $('#tooltip');
				if (!this.i_tooltip.size()) {
					$('body').append('<div id="tooltip"><div class="headline"></div><div class="text"></div></div>');
					this.i_tooltip = $('#tooltip');
				}
				$('#tooltip .headline').text(headline);
				$('#tooltip .text').text(text);
				$('#tooltip').css({left: event.pageX, top: event.pageY}).show();
			},

			/**
			 * hide tooltip
			 *
			 * @return {void}
			 */
			hide: function() {
				"use strict";
				this.i_tooltip.hide();
			}
		},

		graph: {

			/**
			 * pointer to graph
			 *
			 * @type {jQuery}
			 */
			i_graph: null,

			/**
			 * nodes of this graph
			 *
			 * @type {JSON}
			 */
			i_nodes: null,

			/**
			 * edges of this graph
			 *
			 * @type {JSON}
			 */
			i_edges: null,

			/**
			 * set up graph, load nodes and edges
			 *
			 * @param {JSON} nodes
			 * @param {JSON} edges
			 * @return Adventure.graph
			 */
			init: function(nodes, edges) {
				"use strict";
				this.i_graph = new Graph();
				if (nodes) {
					this.addNodes(nodes);
				}
				if (edges) {
					this.addEdges(edges);
				}
				this.initEvents();
				return this;
			},

			/**
			 * set up events
			 *
			 * @return void
			 */
			initEvents: function() {
				"use strict";
				$('#canvas svg .adventure-step').live('mouseenter', function(e) {
					Adventure.tooltip.show(e, Adventure.graph.i_nodes[this.id].name, Adventure.graph.i_nodes[this.id].description);
				}).live('mouseleave', function() {
					Adventure.tooltip.hide();
				});
			},

			/**
			 * create nodes for this graph
			 *
			 * @param {JSON} nodes
			 * @return Adventure.graph
			 */
			addNodes: function(nodes) {
				"use strict";
				Adventure.graph.i_nodes = nodes;
				var g = this.i_graph;
				$.each(nodes, function(k, v)
				{
					var color = '#6699FF';
					if (v.startingPoint === "1")
					{
						color = '#14FF14';
					}
					else if (v.endingPoint === "1")
					{
						color = '#FF0033';
					}
					Adventure.graph.i_graph.addNode(v.stepId, {
						label: v.name.trimIf(10),
						color: color,
						render: Adventure.renderFunc,
						className: 'adventure-step'
					});
				});
				return this;
			},

			/**
			 * create edges for this graph
			 *
			 * @param {JSON} edges
			 * @return Adventure.graph
			 */
			addEdges: function(edges) {
				"use strict";
				Adventure.graph.i_edges = edges;
				$.each(edges, function(k, v)
				{
					Adventure.graph.i_graph.addEdge(v.from, v.to, {
						directed : true,
						label: v.name.trimIf(10),
						'label-style' : {
							'font-size': 10
						}
					});
				});
				return this;
			},

			/**
			 * draw graph
			 *
			 * @param {string} id
			 * @param {integer} width
			 * @param {integer} height
			 * @return Adventure.graph
			 */
			draw: function(id, width, height) {
				"use strict";
				width = width || 800;
				height = height || 600;
				(new Graph.Layout.Spring(this.i_graph)).layout();
				(new Graph.Renderer.Raphael(id, this.i_graph, width, height)).draw();
				return this;
			}

		},

		renderFunc: function(r, node) {
			"use strict";
			/* the default node drawing */
			var color = node.color || Raphael.getColor();
			var ellipse = r.ellipse(0, 0, 30, 20).attr({fill: color, stroke: color, "stroke-width": 2});
			/* set DOM node ID */
			ellipse.node.id = node.id;

			var className = node.className || false;
			if (className) {
				ellipse.node.setAttribute('class', className);
			}
			var shape = r.set().
				push(ellipse).
				push(r.text(0, 30, node.label || node.id));
			return shape;
		}

};

/**
 * trim string if it is longer, append custom string
 *
 * @param {integer} length
 * @param {string} append
 * @return {string}
 */
String.prototype.trimIf = function(length, append) {
	"use strict";
	var string = this;
	length = length || 100;
	append = append || '...';
	if (string.length > length) {
		string = string.substr(0, length-append.length);
		string = string + append;
	}
	return string;
};
