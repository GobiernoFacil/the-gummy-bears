// CDMX - PROVIDER
// @package  : cdmx
// @location : /js/apps/contrato-landing
// @file     : controller.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone 		  = require('backbone'),
      d3       		  = require("d3");
      

  //
  // D E F I N E   T H E   S E T U P   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //



  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //

  var   timeline  		= $(".timeline li"),
  		container_info  = $(".container_info"),
  		sub_container	= $(".sub_container"),
  		//subnav
		nav_contract 	= $("#nav_contract"),
		nav_award 	 	= $("#nav_award");
 

  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //

  var controller =  Backbone.View.extend({
    events : {
	    "click a.nav_stage" 	: "show_step",
	   // "click #nav_contract a" : "show_substep",
	    //"click #nav_award a" : "show_substep",
    },

    el : "body",


    //
    // I N I T I A L I Z E   T H E   A P P
    // --------------------------------------------------------------------------------
    //

    initialize : function(){
      
    },

	show_step : function(e){
    	e.preventDefault();
    	var   dataID 	= $( e.currentTarget ).attr("data-id");    	 
		
		this.change_class(e.currentTarget);
		///hide
    	container_info.addClass("hide");
    	nav_award.addClass("hide");
    	nav_contract.addClass("hide");
    	//hide
		sub_container.addClass("hide");
    	/// show
    	$("#" + dataID).removeClass("hide"); 
		$("#" + dataID + ' div').first().removeClass("hide");	
    	
    },
    
    show_substep : function(e) {
    	e.preventDefault();
    	var   dataID 	= $( e.currentTarget ).attr("data-id");    	 
		///update class
		timeline.children("li ul a").removeClass("current");
		$(e.currentTarget).addClass("current");
		//hide
		sub_container.addClass("hide");
		//show
		$("#" + dataID).removeClass("hide");
    },
    
    change_class : function(element){
      	timeline.removeClass("active");
		timeline.children("a").removeClass("current");
		$(element).parent("li").addClass("active");
		$(element).addClass("current");
    },

  });

    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});