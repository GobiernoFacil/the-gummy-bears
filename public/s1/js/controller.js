// CDMX - HOME
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
  
  // STEPS
  Planning = document.querySelector(".slide.e-1.planeacion"),
  Bidding  = document.querySelector(".slide.e-2.licitacion"),
  Award    = document.querySelector(".slide.e-2.adjudicacion"),
  Contract = document.querySelector(".slide.e-2.contrato"),
  Implementation = document.querySelector(".slide.e-2.implementacion"),

  // POSIBILITIES
  Viz    = document.querySelector("#tools-visualize"),
  Api    = document.querySelector("#tools-api"),
  Social = document.querySelector("#tools-social");

  //
  // S E T   T H E   R O U T E R
  // --------------------------------------------------------------------------------
  //

  var Router = Backbone.Router.extend({
    routes : {
      ""              : "first",
      "estandar"      : "second",
      "todos-ganamos" : "third",
      "que-hacer"     : "fourth"
    },

    initialize : function(settings){
      this.controller = settings.controller;
    },

    first : function(){
    },
    second : function(){
      this.controller.move_to_second();
    },
    third : function(){
      this.controller.move_to_third();
    },
    fourth : function(){
      this.controller.move_to_fourth();
    }
  });

 

  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //

  var controller =  Backbone.View.extend({
    events : {
      // MOBILE
      "click .bento_menu" : "show_mobile_menu",
      "click .close" 	  : "hide_mobile_menu",
      
      // NAVIGATION
      "click .cta" : "move_to_second",
      "click #goto-step1" : "move_to_first",
      "click #goto-step2" : "move_to_second",
      "click #goto-step3" : "move_to_third",
      "click #goto-step4" : "move_to_fourth",

      // STANDAR
      "click #link_nav_planeacion"     : "show_planning",
      "click #link_nav_licitacion"     : "show_bidding",
      "click #link_nav_adjudicacion"   : "show_award",
      "click #link_nav_contratacion"   : "show_contract",
      "click #link_nav_implementacion" : "show_implementation",

      // POSIBILITIES
      "click #tools-visualize-btn" : "show_viz",
      "click #tools-api-btn"       : "show_api",
      "click #tools-social-btn"    : "show_social"
    },

    el : "body",

    //
    // S E T U P   S C E N E S
    // --------------------------------------------------------------------------------
    //

    initialize : function(){
      this.hide_stuff();
      this.set_animation_controller();
      this.router = new Router({controller : this});
      Backbone.history.start({pushState: true});
      this.head_animation();
    },

    set_animation_controller : function(){
      this.animation = new ScrollMagic.Controller();
      this.set_first_scene();
      this.set_second_scene();
      this.set_third_scene();
      this.set_fourth_scene();
    },

    hide_stuff : function(){
      Bidding.style.display = "none";
      Award.style.display = "none";
      Contract.style.display = "none";
      Implementation.style.display = "none";
      Api.style.display = "none";
      Social.style.display = "none";
    },

    set_first_scene : function(){
      var that = this;
      this.scene1 = new ScrollMagic.Scene({
        triggerElement : ".participacion .container",
        duration : 400,
        //offset : -160
      })
      //.setTween(tl)
      //.setPin(".participacion")
      .addTo(this.animation)
      .on("enter", function(e){
        that.enter_first();
      });
    },

    set_second_scene : function(){
      var that = this;
      this.scene2 = new ScrollMagic.Scene({
        triggerElement : ".etapas .container",
        duration : 300,
        offset : -100
      })
      .setTween(this.text_animation())
      //.setPin(".etapas")
      .addTo(this.animation)
      .on("enter", function(e){
        that.enter_second();
      });;
    },

    set_third_scene : function(){
      var that = this;
      this.scene3 = new ScrollMagic.Scene({
        triggerElement : ".win",
        duration : 400,
        offset : 30
      })
      //.setTween()
      //.setPin(".win")
      .addTo(this.animation)
      .on("enter", function(e){
        that.enter_third();
      });;
    },

    set_fourth_scene : function(){
      var that = this;
      this.scene4 = new ScrollMagic.Scene({
        triggerElement : ".tools",
        duration : 400,
        offset : 20
      })
      //.setTween(tl)
      //.setPin(".tools")
      .addTo(this.animation)
      .on("enter", function(e){
        that.enter_fourth();
      });;
    },

    //
    // G E N E R A L   T R A N S I T I O N S
    // --------------------------------------------------------------------------------
    //

    move_to_first : function(e){
      if(e) e.preventDefault(); 
      var y = this.scene1.triggerPosition();
      TweenMax.to(window, 1, {scrollTo:{y: y}, ease:Power2.easeOut});
      this.enter_first();
    },

    move_to_second : function(e){
      if(e) e.preventDefault(); 
      var y = this.scene2.triggerPosition();
      TweenMax.to(window, 1, {scrollTo:{y: y}, ease:Power2.easeOut});
      this.enter_second();
    },

    move_to_third : function(e){
      if(e) e.preventDefault(); 
      var y = this.scene3.triggerPosition();
      TweenMax.to(window, 1, {scrollTo:{y: y}, ease:Power2.easeOut});
      this.enter_third();
    },

    move_to_fourth : function(e){
      if(e) e.preventDefault(); 
      var y = this.scene4.triggerPosition();
      TweenMax.to(window, 1, {scrollTo:{y: y}, ease:Power2.easeOut});
      this.enter_fourth();
    },

    enter_first : function(){
      $("#menu_scroll a").removeClass("current");
      $("#goto-step1").addClass("current");
      //this.router.navigate("");
    },

    enter_second : function(){
      $("#menu_scroll a").removeClass("current");
      $("#goto-step2").addClass("current");
      //this.router.navigate("estandar");
    },

    enter_third : function(){
      $("#menu_scroll a").removeClass("current");
      $("#goto-step3").addClass("current");
      //this.router.navigate("todos-ganamos");
    },

    enter_fourth : function(){
      $("#menu_scroll a").removeClass("current");
      $("#goto-step4").addClass("current");
      //this.router.navigate("que-hacer");
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
	
    show_planning : function(e){
      e.preventDefault();
      Planning.style.display       = "block";
      Bidding.style.display        = "none";
      Award.style.display          = "none";
      Contract.style.display       = "none";
      Implementation.style.display = "none";
      $("a.nav_stage").removeClass("current");
      $("#link_nav_planeacion").addClass("current");
      this.animate_planning();
    },

    show_bidding : function(e){
      e.preventDefault();
      Planning.style.display       = "none";
      Bidding.style.display        = "block";
      Award.style.display          = "none";
      Contract.style.display       = "none";
      Implementation.style.display = "none";
      $("a.nav_stage").removeClass("current");
      $("#link_nav_licitacion").addClass("current");
      this.animate_bidding();
    },

    show_award : function(e){
      e.preventDefault();
      Planning.style.display       = "none";
      Bidding.style.display        = "none";
      Award.style.display          = "block";
      Contract.style.display       = "none";
      Implementation.style.display = "none";
      $("a.nav_stage").removeClass("current");
      $("#link_nav_adjudicacion").addClass("current");
      this.animate_award();
    },

    show_contract : function(e){
      e.preventDefault();
      Planning.style.display       = "none";
      Bidding.style.display        = "none";
      Award.style.display          = "none";
      Contract.style.display       = "block";
      Implementation.style.display = "none";
      $("a.nav_stage").removeClass("current");
      $("#link_nav_contratacion").addClass("current");
      this.animate_contract();
    },

    show_implementation : function(e){
      e.preventDefault();
      Planning.style.display       = "none";
      Bidding.style.display        = "none";
      Award.style.display          = "none";
      Contract.style.display       = "none";
      Implementation.style.display = "block";
      $("a.nav_stage").removeClass("current");
      $("#link_nav_implementacion").addClass("current");
      this.animate_implementation();
    },

    show_viz : function(e){
      e.preventDefault();
      Viz.style.display    = "block";
      Api.style.display    = "none";
      Social.style.display = "none";
      $(".tools li a").removeClass("current");
      $("#tools-visualize-btn").addClass("current");
    },

    show_api : function(e){
      e.preventDefault();
      Viz.style.display    = "none";
      Api.style.display    = "block";
      Social.style.display = "none";
      $(".tools li a").removeClass("current");
      $("#tools-api-btn").addClass("current");
    },

    show_social : function(e){
      e.preventDefault();
      Viz.style.display    = "none";
      Api.style.display    = "none";
      Social.style.display = "block";
      $(".tools li a").removeClass("current");
      $("#tools-social-btn").addClass("current");
    },

    //
    // A N I M A T I O N S
    // --------------------------------------------------------------------------------
    //
    head_animation : function(){
      var servidor = new TimelineMax({repeat:-1, yoyo: true});
      servidor.add(TweenMax.from(document.querySelectorAll(".cabeza"), .7, {rotation: 5, x:2, y:2, transformOrigin:"50% 50%"}));
      servidor.add(TweenMax.to(document.querySelectorAll(".cabeza"), .7, {rotation: -5, x:-2, y:2, transformOrigin:"50% 50%"}));

      return servidor;
    },

    text_animation : function(){
      var mySplit = new SplitText("#mini-description-a", {type: "chars, lines, words"}),
          chars   = mySplit.chars,
          tl      = new TimelineMax();
          tl.staggerFrom(chars, 0.8, {opacity:0, scale:0, y:80, rotationX:180, transformOrigin:"0% 50% -50",  ease:Back.easeOut}, 0.005, "+=0");

      $("#mini-description-a").css({
        perspective:400,
        opacity : 1
      });

      return tl;
    },

    animate_planning : function(){
      var m         = new TimelineMax();
      m.add(TweenMax.from(".slide.e-1.planeacion", .6, {opacity : 0}));
      m.staggerFrom(".slide.e-1.planeacion .description", .5, {opacity:0}, .1, "+=0");
    },

    animate_bidding : function(){
      var m = new TimelineMax();
      m.add(TweenMax.from(document.querySelectorAll(".slide.e-2.licitacion"), .6, {opacity : 0}));
      m.staggerFrom(".slide.e-2.licitacion .description", .5, {opacity:0, scale:0}, .1, "+=0");
    },

    animate_award : function(){
      var m       = new TimelineMax();
      m.add(TweenMax.from(".slide.e-2.adjudicacion", .6, {opacity : 0}));
      m.staggerFrom(".slide.e-2.adjudicacion .description", .5, {opacity:0}, .1, "+=0");
    },

    animate_contract : function(){
      var m = new TimelineMax();
      m.add(TweenMax.from(document.querySelectorAll(".slide.e-2.contrato"), .6, {opacity : 0}));
      m.staggerFrom(".slide.e-2.contrato .description", .5, {opacity:0}, .1, "+=0");
    },

    animate_implementation : function(){
      var m = new TimelineMax();
      m.add(TweenMax.from(document.querySelectorAll(".slide.e-2.implementacion"), .6, {opacity : 0}));
      m.staggerFrom(".slide.e-2.implementacion .description", .5, {opacity:0}, .1, "+=0");
    }
  });

    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});