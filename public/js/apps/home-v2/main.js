// CDMX - CONTRATO-HOME
// date     : 25/01/2016
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : "js/apps/home-v2",
  paths : {
    jquery     : "../../bower_components/jquery/dist/jquery.min",
    backbone   : "../../bower_components/backbone/backbone",
    underscore : "../../bower_components/underscore/underscore-min",
    text       : "../../bower_components/text/text",
    d3         : "../../bower_components/d3/d3"
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