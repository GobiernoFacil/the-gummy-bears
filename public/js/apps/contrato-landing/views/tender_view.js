// CDMX - PROVIDER
// @package  : cdmx
// @location : /js/apps/provider/views
// @file     : tender_view.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone = require('backbone'),
      d3       = require("d3"),
  //
  // D E F I N E   T H E   S E T U P   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //



  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //
  Container  = require("text!templates/full-tender.html");

 

  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //

  var controller =  Backbone.View.extend({
    //
    // [ THE EVENTS ]
    //
    //
    events : {
    },

    //
    // [ THE CONTAINER ]
    //
    //
    tagName   : "div",
    className : "col-sm-9 info",

    //
    // [ THE TEMPLATES ]
    //
    //
    template  : _.template(Container),

    //
    // [ INITIALIZE THE APP ]
    // 
    //
    initialize : function(settings){
      this.controller = settings.controller;
      this.data       = settings.data;
      this.time_list  = settings.time_list;
    },

    //
    // [ RENDER THE APP ]
    //
    //
    render : function(){
      var d = {
        ocid : this.data.releases[0].ocid
      }
      this.$el.append(this.template(d));
      return this;
    }
  });

    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});