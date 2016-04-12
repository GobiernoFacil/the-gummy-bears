// CDMX - CONTRATO-LANDING
// date     : 29/12/2015
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : "js/apps/contrato-landing",
  paths : {
    /*
    d3          : "../../bower_components/d3/d3",
    jquery      : "../../bower_components/jquery/dist/jquery.min",
    backbone    : "../../bower_components/backbone/backbone",
    underscore  : "../../bower_components/underscore/underscore-min",
    text        : "../../bower_components/text/text",
    TimelineMax : "../../bower_components/gsap/src/minified/TimelineMax.min",
    TweenLite   : "../../bower_components/gsap/src/minified/TweenLite.min",
    TweenMax    : "../../bower_components/gsap/src/minified/TweenMax.min",
    ScrollToPlugin : "../../bower_components/gsap/src/minified/plugins/ScrollToPlugin.min",
    */
    jquery         : "../../libraries/jquery.min",
    backbone       : "../../libraries/backbone",
    underscore     : "../../libraries/underscore-min",
    text           : "../../libraries/text",
    d3             : "../../libraries/d3",
    ScrollMagic    : "../../libraries/ScrollMagic",
    TimelineMax    : "../../libraries/TimelineMax.min",
    TweenLite      : "../../libraries/TweenLite.min",
    TweenMax       : "../../libraries/TweenMax.min",
    splitText      : "../../libraries/SplitText.min",
    ScrollToPlugin : "../../libraries/ScrollToPlugin.min",
  },
  shim : {
    backbone : {
      deps    : ["jquery", "underscore"],
      exports : "Backbone"
    },
    "ScrollMagic.animation.gsap" : ["ScrollMagic"]
  }
});

 var app;


require(['controller'], function(controller){ 
  app = new controller;
});
