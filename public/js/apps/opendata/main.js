// CDMX - OPENDATA
// date     : 13/04/2016
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : BASE_PATH  + "/js/apps/opendata",
  paths : {
    d3          : BASE_PATH  + "/js/libraries/d3",
    jquery      : BASE_PATH  + "/js/libraries/jquery.min",
    backbone    : BASE_PATH  + "/js/libraries/backbone",
    underscore  : BASE_PATH  + "/js/libraries/underscore-min",
    text        : BASE_PATH  + "/js/libraries/text",
    ScrollMagic : BASE_PATH  + "/js/libraries/ScrollMagic",
    "ScrollMagic.animation.gsap" : BASE_PATH  + "/js/libraries/animation.gsap",
    TimelineMax : BASE_PATH  + "/js/libraries/TimelineMax.min",
    TweenLite   : BASE_PATH  + "/js/libraries/TweenLite.min",
    TweenMax    : BASE_PATH  + "/js/libraries/TweenMax.min",
    splitText   : BASE_PATH  + "/js/libraries/SplitText.min",
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