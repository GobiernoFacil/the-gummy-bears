// CDMX - CONTRATO-LICITACIÓN
// date     : 30/12/2015
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : "js/apps/contrato-licitacion",
  paths : {
    d3          : "../../bower_components/d3/d3",
    jquery      : "../../bower_components/jquery/dist/jquery.min",
    backbone    : "../../bower_components/backbone/backbone",
    underscore  : "../../bower_components/underscore/underscore-min",
    text        : "../../bower_components/requirejs-text/text",
    TimelineMax : "../../bower_components/gsap/src/minified/TimelineMax.min",
    TweenLite   : "../../bower_components/gsap/src/minified/TweenLite.min",
    TweenMax    : "../../bower_components/gsap/src/minified/TweenMax.min",
    ScrollToPlugin : "../../bower_components/gsap/src/minified/plugins/ScrollToPlugin.min",
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
