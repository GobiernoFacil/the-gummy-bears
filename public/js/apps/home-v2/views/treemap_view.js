// CDMX - STATISTICS
// @package  : CDMX
// @location : /js/apps/statistics/views
// @file     : treemap_view.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone = require('backbone'),
      d3       = require("d3"),
      SVG      = require("common_views/main_svg_view"),

  //
  // D E F I N E   T H E   S E T U P   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //
      Treemap_layout = {
        width  : 800,
        height : 500,
        top    : 0,
        right  : 0,
        bottom : 0,
        left   : 0
      };

  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //

  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  var treeMap = Backbone.View.extend({
    
    //
    // [ DEFINE THE EVENTS ]
    //
    events :{
    },

    //
    // [ THE INITIALIZE FUNCTION ]
    //
    //
    initialize : function(settings){

      console.log(settings.data);
      this.controller = settings.controller;
      this._url       = settings._url;
      this._selector  = settings._selector;
      this.data       = settings.data;
      this.layout     = Treemap_layout;
      this.svg        = new SVG(this.el, Treemap_layout);  
      this.treemap    = d3.layout.treemap().round(false).size([Treemap_layout.width, Treemap_layout.height]);
      this.treemap.value(function(d){
        return d[settings._selector];
      });
      this.tree       = this.treemap({name: "", children : this.data});
	    var max = d3.max(this.data, function(d){
        return d.value;
      });
      var Blues  = ["#eb008b", "#eb008b", "#eb008b"],
          Colors = d3.scale.linear().domain([max,(max/2),1]).range(Blues); 

      this.colors = Colors;
      this.render_treemap(); 

      console.log("meh");
    },

    render_treemap : function(){
      var that   = this,
          rects  = this.svg.selectAll(".rect"),
          labels = this.svg.selectAll(".label"),
          paths  = this.svg.selectAll(".clip"),
          maxval = d3.max(this.data, function(d){
		  			  return d.value;}),
		  minval = d3.min(this.data, function(d){
		  			  return d.value;}),
          format = d3.format('.3s'),
          formatn = d3.format(','); 
          console.log(minval);
          
      rects.data(this.tree).enter()
        .append("rect")
          .attr("class", "rect")
          .attr("fill", function(d){
            return that.colors(d.value);
          })
          .attr("stroke", "#c1057e")
          .attr("x", function(d){
            return d.x;
          })
          .attr("y", function(d){
            return d.y;
          })
          .attr("width", function(d){
            return d.dx;
          })
          .attr("height", function(d){
            return d.dy;
          })
          .on("mouseover", function(d){
	        if (d.value <= 500000) {
            	that.controller.create_tooltip_b({name:d.title, total:format(d.value)});
            }
          })
          .on("mouseout", function(d){
	        if (d.value <= 500000) {
            	that.controller.remove_tooltip();
            }
          })
          .on("click", function(d){
            console.log(d);
            window.open(that._url + d.id,"_self");
          });

      labels.data(this.tree).enter()
        .append("text")
          .attr("class", "label")
          .attr("x", function (d) {return d.x+10;})
          .attr("y", function (d) {return d.y+20;})
          .attr("dy", ".35em")
          .text(function(d){
	          /// por ahora
	          if (d.value >= 500000 && (d.value == maxval || d.value < maxval )) {
		          return d.title;
	          }
          });
          
       labels.data(this.tree).enter()
        .append("text")
          .attr("class", "label_amount")
          .attr("x", function (d) {return d.x+10;})
          .attr("y", function (d) {return d.y+40;})
          .attr("dy", ".35em")
          .text(function(d){
	          /// por ahora
	          if (d.value >= 500000 && (d.value == maxval || d.value < maxval )) {
		          return "$" + format(d.value);
	          }
            
          });

      paths.data(this.tree).enter()
        .append("clipPath")
          .attr("id", function(d, i){
            return that.cid + "_" + i;
          })
          .append("rect")
          .attr("x", function(d){
            return d.x;
          })
          .attr("y", function(d){
            return d.y;
          })
          .attr("width", function(d){
            return d.dx;
          })
          .attr("height", function(d){
            return d.dy;
          });

      this.svg.selectAll("text").attr("clip-path", function(d,i){
        return "url(#" + that.cid + "_" + i +")";
      });

    }

  });

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return treeMap;
});