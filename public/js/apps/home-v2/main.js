// CDMX - CONTRATO-HOME
// date     : 25/01/2016
// @package : cdmx
// @file    : main.js
// @version : 1.0.0
// @author  : Gobierno fácil <howdy@gobiernofacil.com>
// @url     : http://gobiernofacil.com

require.config({
  baseUrl : BASE_PATH  + "/js/apps/home-v2",
  paths : {
    jquery     : BASE_PATH  + "/js/bower_components/jquery/dist/jquery.min",
    backbone   : BASE_PATH  + "/js/bower_components/backbone/backbone",
    underscore : BASE_PATH  + "/js/bower_components/underscore/underscore-min",
    text       : BASE_PATH  + "/js/bower_components/text/text",
    d3         : BASE_PATH  + "/js/bower_components/d3/d3"
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