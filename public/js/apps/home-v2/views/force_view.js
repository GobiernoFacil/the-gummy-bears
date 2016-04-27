// CDMX - STATISTICS
// @package  : cdmx
// @location : /js/apps/homev2/views
// @file     : pack.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  //  [ libraries ]
  var Backbone = require('backbone'),
      d3       = require('d3'),

  //
  // D E F I N E   T H E   S E T U P   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //
     Colors     = d3.scale.category20(),

  //
  // D E F I N E   T H E   D 3   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //
  SVG = {
    width  : 800,
    height : 500,
    margin : {
      top    : 10,
      right  : 10,
      bottom : 10,
      left   : 10
    },
  };

  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //
 

  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " V I E W "
  // --------------------------------------------------------------------------------
  //
  var content = Backbone.View.extend({
    
    //
    // [ DEFINE THE EVENTS ]
    //
    events :{
      // "change #pack-chart-controls input" : "set_categories"
    },

    //
    // [ DEFINE THE ELEMENT ]
    //
    //el : "#bubbles",

    //
    // [ DEFINE THE TEMPLATES ]
    //


    //
    // [ THE INITIALIZE FUNCTION ]
    //
    //
    initialize : function(settings){
      this.collection = new Backbone.Collection(settings.data);
      this.data       = settings.data;
      this.controller = settings.controller;
      // this.render_pack();
      this.render();
      //this.definitions = new Backbone.Collection(Definitions);
    },

    //
    // R E N D E R   F U N C T I O N S
    // ------------------------------------------------------------------------------
    //
    
    // [ submit / ESC / call from controller ]
    // Genera el HTML del elemento seleccionado
    //
    render : function(e){
      console.log(this.data);

      function charge(d) {
        return -Math.pow(d.radius, 2) / 8;
      }

      function moveToCenter(alpha) {
        return function (d) {
          d.x = d.x + (center.x - d.x) * damper * alpha;
          d.y = d.y + (center.y - d.y) * damper * alpha;
        };
      }

       var radiusScale = d3.scale.pow()
            .exponent(0.5)
            .range([2, 125]);
      var maxAmount = d3.max(this.data, function (d) { return +d.planning; });
      radiusScale.domain([0, maxAmount]);

      function createNodes(rawData) {
        
        // Use map() to convert raw data into node data.
        // Checkout http://learnjsdata.com/ for more on
        // working with data.
        var myNodes = rawData.map(function (d) {
        return {
            //id: d.id,
            radius: radiusScale(+d.planning),
            value: d.planning,
            name: d.name,
            x: Math.random() * 900,
            y: Math.random() * 800
          };
        });

        // sort them to prevent occlusion of smaller nodes.
        myNodes.sort(function (a, b) { return b.value - a.value; });

        return myNodes;
      }

       var sss   = d3.select(this.el),
          svg = sss.append("svg:svg")
                  .attr("width", SVG.width)
                  .attr("height", SVG.height);


      var center  = { x: SVG.width / 2, y: SVG.height / 2 },
          damper  = 0.102,
          //svg     = this.svg,
          bubbles = null,
          nodes   = [],
          force   = d3.layout.force()
                      .size([SVG.width, SVG.height])
                      .charge(charge)
                      .gravity(-0.015)
                      .friction(.9);

      nodes = createNodes(this.data);
      force.nodes(nodes);

      console.log(svg);
      bubbles = svg.selectAll('.bubble')
      .data(nodes);
      var that = this,
        format = d3.format('.3s');

      bubbles.enter().append('circle')
      .classed('bubble', true)
      .attr('r', 0)
      .attr('fill', function (d) { return "#f9bbe4"; })
      .attr('stroke', function (d) { return "#eb008b" })
      .attr('stroke-width', 2)
      .on("mouseover", function(d){
        console.log(d);
              that.controller.create_tooltip_b({name:d.name, total:format(d.value)});
              force.start();
          })
          .on("mouseout", function(d){
              that.controller.remove_tooltip();
              force.start();
          })
          .on("click", function(d){
            console.log(d);
            //window.open(that._url + d.id,"_self");
          });


      bubbles.transition()
      .duration(2000)
      .attr('r', function (d) { return d.radius; });

      
      force.on('tick', function (e) {
        bubbles.each(moveToCenter(e.alpha))
          .attr('cx', function (d) { return d.x; })
          .attr('cy', function (d) { return d.y; });
      });

      force.start();
      return this;
    }
  });
    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return content;
});