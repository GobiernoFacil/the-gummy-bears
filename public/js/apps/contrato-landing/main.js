// CDMX - CONTRATO-LANDING
// date     : 29/12/2015
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : BASE_PATH  + "/js/apps/contrato-landing",
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
    jquery         : BASE_PATH  + "/js/libraries/jquery.min",
    backbone       : BASE_PATH  + "/js/libraries/backbone",
    underscore     : BASE_PATH  + "/js/libraries/underscore-min",
    text           : BASE_PATH  + "/js/libraries/text",
    d3             : BASE_PATH  + "/js/libraries/d3",
    ScrollMagic    : BASE_PATH  + "/js/libraries/ScrollMagic",
    TimelineMax    : BASE_PATH  + "/js/libraries/TimelineMax.min",
    TweenLite      : BASE_PATH  + "/js/libraries/TweenLite.min",
    TweenMax       : BASE_PATH  + "/js/libraries/TweenMax.min",
    splitText      : BASE_PATH  + "/js/libraries/SplitText.min",
    ScrollToPlugin : BASE_PATH  + "/js/libraries/ScrollToPlugin.min",
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
