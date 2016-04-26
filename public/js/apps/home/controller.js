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
		
		// NAVIGATION
		"click .cta.scroll"   : "move_to_second",
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
      this.set_animation_controller();
    },
  
	set_animation_controller : function(){
      this.animation = new ScrollMagic.Controller();
      this.set_first_scene();
      this.set_second_scene();
    },
    
    set_first_scene : function(){
      var that = this;
      this.scene1 = new ScrollMagic.Scene({
        triggerElement : ".lead.homev2",
        duration : 400,
      })
      .addTo(this.animation)
    },
	
	set_second_scene : function(){
      var that = this;
      this.scene2 = new ScrollMagic.Scene({
        triggerElement : ".etapas .container",
        duration : 300,
        offset : -100
      })
      .addTo(this.animation)
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
	    	contractDisplay	= document.getElementById("contracts");
	    	amountDisplay	= document.getElementById("amount"),
	    //	tenderDisplay	= document.getElementById("tender"),
	    	r 				 = new TimelineMax();
	    
	    r.add(TweenMax.to(numbers, 1, {
		    		contracts:"+="+NUMBER_CON, 
		    		roundProps:"contracts", 
		    		onUpdate: function () {  
			    		contractDisplay.innerHTML = Math.ceil(numbers.contracts);
			    	}, 
			    	ease:Circ.easeOut
			    })
		);
		
	    r.add(TweenMax.to(bought, 1, {
		    		amount:"+="+(AMOUNT/1000000), 
		    		roundProps:"amount", 
		    		onUpdate: function () {  
			    		amountDisplay.innerHTML = Math.ceil(bought.amount);
			    	}, 
			    	ease:Circ.easeOut
			    })
		);
	/*	r.add(TweenMax.to(number, 1, {
		    		tender:"+=18", 
		    		roundProps:"tender", 
		    		onUpdate: function () {  
			    		tenderDisplay.innerHTML = Math.ceil(number.tender);
			    	}, 
			    	ease:Circ.easeOut
			    })
		);*/
		
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
    
    move_to_second : function(e){
      if(e) e.preventDefault(); 
      var y = this.scene2.triggerPosition();
      TweenMax.to(window, 1, {scrollTo:{y: y}, ease:Power2.easeOut});
    },

  });

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});