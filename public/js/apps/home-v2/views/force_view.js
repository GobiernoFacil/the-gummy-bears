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
     Colors     = d3.scale.category20();

  //
  // D E F I N E   T H E   D 3   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //
  SVG = {
    width  : 700,
    height : 700,
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
      var chart = d3.select(this.el).append("svg:svg")
                  .attr("width", SVG.width)
                  .attr("height", SVG.height);

       var force = d3.layout.force()
    .nodes(this.data)
    //.links(links)
    .size([SVG.width, SVG.height])
    .linkStrength(0.1)
    .friction(0.9)
    .linkDistance(20)
    .charge(-30)
    .gravity(0.1)
    .theta(0.8)
    .alpha(0.1)
    .start();



      var stuff = chart.selectAll(".dots").data(this.data).enter()
      .append("circle")
      .attr("r", 10);

      force.on("tick", function(e,x){
        console.log(e,x);
      });

      return this;
    }

  });
    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return content;
});