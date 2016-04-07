// CDMX - STATISTICS
// @package  : cdmx
// @location : /js/apps/home
// @file     : controller.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone 	 	 = require('backbone'),
      d3        	 = require("d3"),
      ScrollMagic    = require("ScrollMagic"),
      TweenLite      = require("TweenLite"),
      SplitText      = require("splitText"),
      TweenMax       = require("TweenMax"),
      xxx            = require("ScrollMagic.animation.gsap"),
      ScrollToPlugin = require("ScrollToPlugin"),
      TimelineMax    = require("TimelineMax");    

  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //
    

    
  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  var controller = Backbone.View.extend({
    
    //
    // [ DEFINE THE EVENTS ]
    //
    events :{
	    // STANDAR
		"click .stages a"     : "show_step",
    },

    //
    // [ DEFINE THE TEMPLATES ]
    //

    // 
    // [ SET THE CONTAINER ]
    //
    //
    el : 'body',

    //
    // [ THE INITIALIZE FUNCTION ]
    //
    //
    initialize : function(){
      this.count_amount();
    },
  



   
    //
    // L O C A L   T R A N S I T I O N S
    // --------------------------------------------------------------------------------
    //
    
    
    /*****
	    COUNTER
	*****/
    count_amount : function() {
	    var bought 			= {amount:0},
	    	number 			= {tender:0},
	    	numbers 			= {contracts:0},
	    	amountDisplay	= document.getElementById("amount"),
	    	tenderDisplay	= document.getElementById("tender"),
	    	contractDisplay	= document.getElementById("contracts");
	    	r 				 = new TimelineMax();
	    
	    r.add(TweenMax.to(bought, 1, {
		    		amount:"+=17", 
		    		roundProps:"amount", 
		    		onUpdate: function () {  
			    		amountDisplay.innerHTML = Math.ceil(bought.amount);
			    	}, 
			    	ease:Circ.easeOut
			    })
		);
		r.add(TweenMax.to(number, 1, {
		    		tender:"+=16", 
		    		roundProps:"tender", 
		    		onUpdate: function () {  
			    		tenderDisplay.innerHTML = Math.ceil(number.tender);
			    	}, 
			    	ease:Circ.easeOut
			    })
		);
		r.add(TweenMax.to(numbers, 1, {
		    		contracts:"+=4", 
		    		roundProps:"contracts", 
		    		onUpdate: function () {  
			    		contractDisplay.innerHTML = Math.ceil(numbers.contracts);
			    	}, 
			    	ease:Circ.easeOut
			    })
		);
    },
    
    
	show_step : function(e){
    	e.preventDefault();
    	var   div 	= $( e.currentTarget ).attr("data-step");    	  		
		$(".pasos .slide").addClass("hide");
		$(".slide." + div).removeClass("hide");   
		$("a.nav_stage").removeClass("current");
		$(e.currentTarget).addClass("current");
		this.animate_step(div);
    },

    animate_step : function(div){
      var m         = new TimelineMax();
      m.add(TweenMax.from(".slide."+div, .6, {opacity : 0}));
      m.staggerFrom(".slide."+ div +" .description", .5, {opacity:0, scale:0}, .1, "+=0");
    },

  });

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});