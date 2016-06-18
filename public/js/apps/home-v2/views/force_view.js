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
    height : 620,
    margin : {
      top    : 10,
      right  : 10,
      bottom : 10,
      left   : 10
    },
  };

  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " V I E W "
  // --------------------------------------------------------------------------------
  //
  var content = Backbone.View.extend({
    
    //
    // [ DEFINE THE EVENTS ]
    //
    events :{
      "change #bubble-fun" : "update_bubbles"
    },

    //
    // [ THE INITIALIZE FUNCTION ]
    //
    //
    initialize : function(settings){
      this.collection  = new Backbone.Collection(settings.data);
      this.collectionb = new Backbone.Collection(settings.datab);
      this.data        = settings.data;
      this.datab       = settings.datab;
      this.controller  = settings.controller;
      this._url        = settings._url;
      this._url_b      = settings._url_b;

      this.default_pointer = "contracts";
      this.render();
    },

    //
    // R E N D E R   F U N C T I O N S
    // ------------------------------------------------------------------------------
    //
    
    /***/

    charge : function(d) {
      return -Math.pow(d.radius, 2) / 8;
    },

    moveToCenter : function(alpha, center, damper) {
      return function (d) {
        d.x = d.x + (center.x - d.x) * damper * alpha;
        d.y = d.y + (center.y - d.y) * damper * alpha;
      };
    },

    createNodes : function(rawData, scale, index, skip_xy) {
      var myNodes = rawData.map(function (d) {
        if(skip_xy){
          return {
          id     : d.ocdsid || d.rfc,
          ocdsid : d.ocdsid,
          rfc    : d.rfc,
          radius : scale(+d[index]),
          value  : d[index],
          name   : d.name,
          type   : d.type
          };
        }
        else{
          return {
          id     : d.ocdsid || d.rfc,
          ocdsid : d.ocdsid,
          rfc    : d.rfc,
          radius : scale(+d[index]),
          value  : d[index],
          name   : d.name,
          type   : d.type,
          x      : Math.random() * 900,
          y      : Math.random() * 800
          };
        }
      });

      myNodes.sort(function (a, b) { return b.value - a.value; });
      return myNodes;
    },
    /***/
    //
    // 
    //
    render : function(e){
      var radiusScale = d3.scale.pow()
                          .exponent(0.5)
                          .range([0, 115]),
          that        = this,
          index       = "contracts",
          format      = d3.format('.3s'),
          maxAmount   = d3.max(this.data, function (d) { return +d[index]; }),
          center      = { x: SVG.width / 2, y: SVG.height / 2 },
          damper      = 0.102,
          sss         = d3.select(this.el),
          svg         = sss.append("svg:svg")
                    .attr("width", SVG.width)
                    .attr("height", SVG.height),
          bubbles     = null,
          nodes       = [],
          force       = d3.layout.force()
                          .size([SVG.width, SVG.height])
                          .charge(this.charge)
                          .gravity(-0.015)
                          .friction(.9);

      this.svg = svg;
      radiusScale.domain([0, maxAmount]);
      nodes = this.createNodes(this.data, radiusScale, index);
      force.nodes(nodes);

      bubbles = svg.selectAll('.bubble')
      .data(nodes);

      bubbles.enter().append('circle')
      .classed('bubble', true)
      .attr('r', 0)
      .attr('fill', function (d) { return "#f9bbe4"; })
      .attr('stroke', function (d) { return "#eb008b" })
      .attr('stroke-width', 2)
      .on("mouseover", function(d){
	    d3.select(this).style("fill", "#eb008b")
	    			   .style("stroke", "#B8006D");
        that.controller.create_tooltip_b({name:d.name, total:format(d.value)});
        force.start();
      })
      .on("mouseout", function(d){
	    d3.select(this).style("fill", "#f9bbe4")
	    				.style("stroke", "#eb008b");
        that.controller.remove_tooltip();
        force.start();
      })
      .on("click", function(d){
        var url = d.type == "contract" ? that._url + d.id : that._url_b + d.rfc;
        //console.log(d, url, that._url, that._url_b, d.id, d.rfc);
        window.open(url,"_self");
      });


      bubbles.transition()
      .duration(2000)
      .attr('r', function (d) { return d.radius; });

      
      force.on('tick', function (e) {
        bubbles.each(that.moveToCenter(e.alpha, center, damper))
          .attr('cx', function (d) { return d.x; })
          .attr('cy', function (d) { return d.y; });
      });

      this.force = force;
      force.start();
      return this;
    },

    update_bubbles : function(e){
      var index  = e.currentTarget.value,
       	  typeN;
      
      switch(index) {
	   	case 'tender':
	   		var typeN = 'TOTAL DE LICITACIONES';
	   		break;
	   	case 'awards':
	   		var typeN = 'TOTAL DE ADJUDICACIONES';
	   		break;
	   	case 'contracts':
	   		var typeN = 'TOTAL DE CONTRATOS FIRMADOS';
	   		break;
      };
      
      $('#type').html(typeN);
      this.update_render(index);
    },

    render_contracts : function(){
      $('#type').html('CONTRATOS');
      this.update_render(this.default_pointer);
    },

    render_providers : function(){
      $('#type').html('PROVEEDORES');
      this.update_render(this.default_pointer, "providers");
    },

    update_render : function(index, opt){
      var data        = opt ? this.datab : this.data,
          radiusScale = d3.scale.pow()
                          .exponent(0.5)
                          .range([0, 125]),
          that        = this,
          format      = d3.format('.3s'),
          maxAmount   = d3.max(data, function (d) { return +d[index]; }),

          //// cuenta los que tienen $
          data_count  = _.countBy(data, function(num) { return num[index] > 0}),
          //// imprime total de contratos, proveedores, licitaciones, etc.
          totprov	  = data_count.true,
          //// imprime cantidad total
          totAmount   = d3.sum(data, function (d) { return +d[index]; }),

          center      = { x: SVG.width / 2, y: SVG.height / 2 },
          damper      = 0.102,
         
          bubbles     = null,
          nodes       = [];
         
	  /// actualiza cantidades en los títulos 
	  $('#type_total').html(totprov);
	  $('#total_amount').html((totAmount/1000000).toFixed(2));
        
      radiusScale.domain([0, maxAmount]);
      
      nodes = this.createNodes(data, radiusScale, index, 1);
      this.force.nodes(nodes);

      bubbles = this.svg.selectAll('.bubble')
      .data(nodes);

      bubbles.enter().append('circle')
      .classed('bubble', true)
      .attr('r', 0)
      .attr('fill', function (d) { return "#f9bbe4"; })
      .attr('stroke', function (d) { return "#eb008b" })
      .attr('stroke-width', 2)
      .on("mouseover", function(d){
	    d3.select(this).style("fill", "#eb008b")
	    			   .style("stroke", "#B8006D");
        that.controller.create_tooltip_b({name:d.name, total:format(d.value)});
        force.start();
      })
      .on("mouseout", function(d){
	    d3.select(this).style("fill", "#f9bbe4")
	    				.style("stroke", "#eb008b");
        that.controller.remove_tooltip();
        force.start();
      })
      .on("click", function(d){
        var url = d.type == "contract" ? that._url + d.id : that._url_b + d.rfc;
        window.open(url,"_self");
      });

      bubbles.exit().remove();

      bubbles.transition()
      .duration(2000)
      .attr('r', function (d) { return d.radius; });

      this.force.on('tick', function (e) {
        bubbles.each(that.moveToCenter(e.alpha, center, damper))
          .attr('cx', function (d) { return d.x; })
          .attr('cy', function (d) { return d.y; });
      });

      this.force.start();
      return this;
    }

  });
    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return content;
});