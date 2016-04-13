// CDMX - PROVIDER
// date     : 29/12/2015
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : BASE_PATH  + "/js/apps/provider",
  paths : {
    d3          : BASE_PATH  + "/js/libraries/d3/d3",
    jquery      : BASE_PATH  + "/js/libraries/jquery/dist/jquery.min",
    backbone    : BASE_PATH  + "/js/libraries/backbone/backbone",
    underscore  : BASE_PATH  + "/js/libraries/underscore/underscore-min",
    text        : BASE_PATH  + "/js/libraries/requirejs-text/text",
    TimelineMax : BASE_PATH  + "/js/libraries/gsap/src/minified/TimelineMax.min",
    TweenLite   : BASE_PATH  + "/js/libraries/gsap/src/minified/TweenLite.min",
    TweenMax    : BASE_PATH  + "/js/libraries/gsap/src/minified/TweenMax.min",
    ScrollToPlugin : BASE_PATH  + "/js/libraries/gsap/src/minified/plugins/ScrollToPlugin.min",
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
