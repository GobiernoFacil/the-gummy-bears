// CDMX - CONTRATO-HOME
// date     : 01/04/2016
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : "/js/apps/home",
  paths : {
    /*
    jquery     : "../../bower_components/jquery/dist/jquery.min",
    backbone   : "../../bower_components/backbone/backbone",
    underscore : "../../bower_components/underscore/underscore-min",
    text       : "../../bower_components/text/text",
    d3         : "../../bower_components/d3/d3",
    ScrollMagic : "../../bower_components/scrollmagic/scrollmagic/uncompressed/ScrollMagic",
    "ScrollMagic.animation.gsap" : "../../bower_components/scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap",
    TimelineMax : "../../bower_components/gsap/src/minified/TimelineMax.min",
    TweenLite   : "../../bower_components/gsap/src/minified/TweenLite.min",
    TweenMax    : "../../bower_components/gsap/src/minified/TweenMax.min",
    splitText   : "../../bower_components/gsap/src/minified/utils/SplitText.min",
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
    "ScrollMagic.animation.gsap" : "../../libraries/animation.gsap",
  },
  shim : {
    backbone : {
      deps    : ["jquery", "underscore"],
      exports : "Backbone"
    }
  }
});

 var app;


require(['controller'], function(controller){ 
  app = new controller;
});