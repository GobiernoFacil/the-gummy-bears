// CDMX - STATISTICS
// @package  : CDMX
// @location : /js/apps/home-v2/views
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
      //"change #pack-chart-controls input" : "set_categories"
    },

    //
    // [ DEFINE THE ELEMENT ]
    //
    el : "#bubblefun",

    //
    // [ DEFINE THE TEMPLATES ]
    //


    //
    // [ THE INITIALIZE FUNCTION ]
    //
    //
    initialize : function(data){
      this.collection  = new Backbone.Collection();
      this.definitions = new Backbone.Collection(Definitions);
      this.get_data();
    },

    //
    // C O  N T R O L   F U N C T I O N S
    // ------------------------------------------------------------------------------
    //
    set_categories : function(e){
      if(e.currentTarget.checked){
        Selected.push(Categories[+e.currentTarget.value]);
      }
      else{
        Selected.splice(Selected.indexOf(Categories[+e.currentTarget.value]), 1);
      }

      this.update_pack();
    },
   

    //
    // R E N D E R   F U N C T I O N S
    // ------------------------------------------------------------------------------
    //
    
    // [ submit / ESC / call from controller ]
    // Genera el HTML del elemento seleccionado
    //
    render : function(e){
      return this;
    },

    //
    //
    //
    render_pack : function(){
      var root = {collection : this.collection, name : "trusts", _class : "root"},
          pack = d3.layout.pack()
                 .sort(null)
                 .size([SVG.width, SVG.height])
                 .value(function(d){
                  return d.collection ? d.collection.length : 1;
                 });

      root.children = this.generate_tree(root, 0);

      var svg   = d3.select("#circle-pack"),
          chart = svg.append("svg:svg")
                  .attr("width", SVG.width)
                  .attr("height", SVG.height),

          enter = chart.selectAll("g").data(pack(root)).enter()
          .append("svg:g");

      enter.append("svg:circle")
          .attr("r", function(d){ return d.r})
          .attr("cx", function(d){ return d.x})
          .attr("cy", function(d){ return d.y})
          .attr("class", function(d){ return d._class})
          //.attr("stroke", "black")
          //.attr("fill", "black")
          //.attr("stroke", "white")
          //.attr("stroke-width", 1);
          /*
          .attr("y", function(d){ return d.y})
          .attr("width", function(d){ return d.dx})
          .attr("height", function(d){ return d.dy})
          .attr("fill", function(d,i){ return Colors(i)});
          */
      /*
      enter.append("svg:text")
          .text(function(d){ return d.value})
          .attr("x", function (d) {return d.x+5;})
          .attr("y", function (d) {return d.y+20;})
          .attr("dy", ".35em")
          .attr("text-anchor", "middle");
      */
    },

    update_pack : function(){
      var root = {collection : this.collection, name : "trusts", _class : "root"},
          pack = d3.layout.pack()
                 .sort(null)
                 .size([SVG.width, SVG.height])
                 .value(function(d){
                  return d.collection ? d.collection.length : 1;
                 });

      root.children = this.generate_tree(root, 0);

      var svg     = d3.select("#circle-pack svg"),
          circles = svg.selectAll("g");

      circles.remove();
      circles = svg.selectAll("g").data(pack(root));
      circles.enter().append("svg:g")
                    .append("svg:circle")
                    .attr("r", function(d){ return d.r})
                    .attr("cx", function(d){ return d.x})
                    .attr("cy", function(d){ return d.y})
                    .attr("class", function(d){ return d._class});
    },

    //
    // nodes for any level
    //
    generate_tree : function(parent, deep){
      var category  = Selected[deep],
          list      = _.uniq(parent.collection.pluck(category)),
          search    = {},
          childrens = list.map(function(cat){
            search[category] = cat;
            var child = {
              name      : cat, 
              collection : new Backbone.Collection(parent.collection.where(search)),
              _class : "category"
            };
            child.value = child.collection.length;
            child.children = child.collection.map(function(ch){
              return {
                name : ch.get("designation"),
                trust : ch,
                _class : "trust"
              };
            });
            return child;
          }, this);

      if(deep + 1 < Selected.length){
        childrens.forEach(function(ch){
          ch._class = "category";
          ch.children = this.generate_tree(ch, deep+1);
        }, this);
      }

      return childrens;
    },

    //
    // H E L P E R S
    // ------------------------------------------------------------------------------
    //
    get_data : function(){
      var that = this;
      $.get(Url, {}, function(d){
        that.collection.reset(d);
        that.render_pack();
        document.querySelector("#treemap-category").disabled = false;
      }, "json");
    }

  });
    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return content;
});