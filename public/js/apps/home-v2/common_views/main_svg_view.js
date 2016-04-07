// PROMÉXICO - STATISTICS
// @package  : promexico
// @location : /js/apps/statistics/common_views
// @file     : main_svg_view.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var d3  = require("d3"),
      SVG = function(div, layout){
      var svg = d3.select(div).append("svg")
                .attr("width", layout.width)
                .attr("height", layout.height)
                .attr("class", "main_graph");
      svg.append('g')
                .attr("class", "main_container");
      return svg;
      };

  //
  // R E T U R N   T H E   E L E M E N T
  // --------------------------------------------------------------------------------
  //
  return SVG;
});