// CDMX - DATA
// @package  : cdmx
// @location : /js
// @file     : controller.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone       = require('backbone'),
      d3             = require("d3"),
      ScrollMagic    = require("ScrollMagic"),
      TweenLite      = require("TweenLite"),
      SplitText      = require("splitText"),
      TweenMax       = require("TweenMax"),
      xxx            = require("ScrollMagic.animation.gsap"),
      ScrollToPlugin = require("ScrollToPlugin"),
      TimelineMax    = require("TimelineMax"),
  //
  // D E F I N E   T H E   S E T U P   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //



  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //

  // MOBILE
  MenuMobile = document.querySelector("#menu-mobile"),
  
  ///DATA
  ListContract    	 = document.querySelector("#listar-contratos"),
  AgenciesCatalog    = document.querySelector("#catalogo-dependecias"),
  SuppliersCatalog   = document.querySelector("#catalogo-proveedores"),
  WebService    	 = document.querySelector("#web-contratos");
  
  
 

 

  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //

  var controller =  Backbone.View.extend({
    events : {
      
      // MOBILE
      "click .bento_menu" : "show_mobile_menu",
      "click .close" 	  : "hide_mobile_menu",

      // DATA
      "click #btn-listar-contratos" : "show_list",
      "click #btn-dependencias"     : "show_agencies",
      "click #btn-proveedores"      : "show_suppliers",
      "click #btn-web-service"      : "show_webservice",
      
      // NAVIGATION
      "click .cta" : "move_to_second",
    },

    el : "body",

    //
    // S E T U P   S C E N E S
    // --------------------------------------------------------------------------------
    //

    initialize : function(){
      this.hide_stuff();
      this.set_animation_controller();
    },

	set_animation_controller : function(){
      this.animation = new ScrollMagic.Controller();
      this.set_first_scene();
      this.set_second_scene();
    },
    
    
    hide_stuff : function(){
      AgenciesCatalog.style.display = "none";
      SuppliersCatalog.style.display = "none";
      WebService.style.display = "none";
    },
	
	set_first_scene : function(){
      var that = this;
      this.scene1 = new ScrollMagic.Scene({
        triggerElement : ".lead.datos .container",
        duration : 400,
        //offset : -160
      })
      //.setTween(tl)
      //.setPin(".participacion")
      .addTo(this.animation)
    },
	
	set_second_scene : function(){
      var that = this;
      this.scene2 = new ScrollMagic.Scene({
        triggerElement : ".datos_pa_labanda .container",
        duration : 300,
        offset : -100
      })
      .addTo(this.animation)
    },
	

    //
    // L O C A L   T R A N S I T I O N S
    // --------------------------------------------------------------------------------
    //
	
	show_mobile_menu : function(e) {
		e.preventDefault();
		MenuMobile.style.display = "block";
	},
	
	hide_mobile_menu : function(e) {
		e.preventDefault();
		MenuMobile.style.display = "none";
	},
	
    show_list : function(e){
      e.preventDefault();
      ListContract.style.display       = "block";
      AgenciesCatalog.style.display      = "none";
      SuppliersCatalog.style.display     = "none";
      WebService.style.display      	 = "none";
      $(".usa_datos a").removeClass("current");
      $('#btn-listar-contratos').addClass("current");
    },

    show_agencies : function(e){
      e.preventDefault();
      ListContract.style.display      	 = "none";
      AgenciesCatalog.style.display      = "block";
      SuppliersCatalog.style.display     = "none";
      WebService.style.display      	 = "none";
      $(".usa_datos a").removeClass("current");
      $('#btn-dependencias').addClass("current");
    },

    show_suppliers : function(e){
      e.preventDefault();
      ListContract.style.display      	 = "none";
      AgenciesCatalog.style.display      = "none";
      SuppliersCatalog.style.display     = "block";
      WebService.style.display      	 = "none";
      $(".usa_datos a").removeClass("current");
      $('#btn-proveedores').addClass("current");
    },	

	show_webservice : function(e){
      e.preventDefault();
      ListContract.style.display      	 = "none";
      AgenciesCatalog.style.display      = "none";
      SuppliersCatalog.style.display     = "none";
      WebService.style.display      	 = "block";
      $(".usa_datos a").removeClass("current");
      $('#btn-web-service').addClass("current");
    },
	
	 move_to_first : function(e){
      if(e) e.preventDefault(); 
      var y = this.scene1.triggerPosition();
      TweenMax.to(window, 1, {scrollTo:{y: y}, ease:Power2.easeOut});
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