// CDMX - PROVIDER
// @package  : cdmx
// @location : /js/apps/provider/views
// @file     : contract_nav_view.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone = require('backbone'),
      d3       = require("d3"),
      //data     = require("json!../../data/OCDS-87SD3T-SEFIN-30001105-006-2015.json");
  //
  // D E F I N E   T H E   S E T U P   V A R I A B L E S
  // --------------------------------------------------------------------------------
  //



  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //
  ContractLinkLI  = require("text!templates/nav-li-contract.html");

 

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
      "click a" : "show_contract" 
    },

    //
    // [ THE CONTAINER ]
    //
    //
    tagName : "li",

    //
    // [ THE TEMPLATES ]
    //
    //
    contractLinkLI  : _.template(ContractLinkLI),

    //
    // [ INITIALIZE THE APP ]
    // 
    //
    initialize : function(settings){
      this.label_date = settings.label_date;
      this.controller = settings.controller;
      this.num        = settings.num;
    },

    //
    // [ RENDER THE APP ]
    //
    //
    render : function(){
      var d = {
        date : this.label_date, 
        i    : this.num
      };

      this.$el.append(this.contractLinkLI(d));
      return this;
    },

    //
    // [ CALL THE SHOW CONTRACT FROM THE CONTRACT ]
    //
    //
    show_contract : function(e){
      e.preventDefault();
      console.log("meh");
    }
  });

    

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});