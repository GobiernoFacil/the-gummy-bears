// CDMX - STATISTICS
// @package  : cdmx
// @location : /js/apps/dependencia
// @file     : controller.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){
	
  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone  = require('backbone'),
      d3        = require("d3")
      Donut     = require("views/donut_view");
      
  
  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  var controller = Backbone.View.extend({
	// -----------------
	// SET THE CONTAINER
	// -----------------
	//
	el : "body",  
	
	
	// ------------------------
	// THE INITIALIZE FUNCTION
	// ------------------------
	//
	initialize : function(){
		
		// render slope
		this.donut 	= new Donut({controller : this});
        this.donut.render();

	 
	},
	
  });
  
	  
  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});