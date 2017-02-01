// CDMX - STATISTICS
// @package  : cdmx
// @location : /js/apps/dependencia/views
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
      d3       = require('d3');





  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " V I E W "
  // --------------------------------------------------------------------------------
  //
  var content = Backbone.View.extend({
    
    //
    // [ DEFINE THE EVENTS ]
    //
    events :{
    },

    

    //
    // R E N D E R   F U N C T I O N 
    // ------------------------------------------------------------------------------
    //
    


    /***/
    //
    // 
    //
    render : function(){
		var width = 200,
			height = 200,
			radius = Math.min(width, height) / 2;
    
		var data = DATA;

		var color = d3.scale.ordinal()
			    .range(["#00BFB3", "#eb008b", "#702082", "#28c3f9", "#1D1D1B"]);
		
		var arc = d3.svg.arc()
		    .outerRadius(radius - 10)
		    .innerRadius(radius - 70);
		
		var pie = d3.layout.pie()
		    .sort(null)
		    .value(function(d) { 
			    return d.total; });
		
		var svg = d3.select("#donut").append("svg")
		    .attr("width", width)
		    .attr("height", height)
			.append("g")
		    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
	  
	
		var g = svg.selectAll(".arc")
		  .data(pie(data))
		  .enter().append("g")
		  .attr("class", "arc");

		g.append("path")
		    .attr("d", arc)
		    .style("fill", function(d,i) { return color(i); });
		
		g.append("text")
		    .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
		    .attr("dy", ".35em")
		    .text(function(d) { 
		        if (d.data.total > 0) {
					return d.data.total;   
		        }
		     })
		     .attr("fill",function(d) { 
		        if (d.data.stage != "planning") {
					return "white";   
		        }
		        else { return "black";}
		     });

      return this;
    },





  });
    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return content;
});