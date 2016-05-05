// CDMX - STATISTICS
// @package  : cdmx
// @location : /js/apps/statistics
// @file     : companies_controller.js
// @author   : Gobierno fácil <howdy@gobiernofacil.com>
// @url      : http://gobiernofacil.com

define(function(require){

  //
  // L O A D   T H E   A S S E T S   A N D   L I B R A R I E S
  // --------------------------------------------------------------------------------
  //
  var Backbone  = require('backbone'),
      d3        = require("d3"),
      Force     = require("views/force_view"), 
    
      TooltipA  = require("text!templates/tooltip_a.html"),
      TooltipB  = require("text!templates/tooltip_b.html"),
     

  //
  // C A C H E   T H E   C O M M O N   E L E M E N T S
  // --------------------------------------------------------------------------------
  //
    
    // CONTAINERS
    StateMap     = document.querySelector("#providers-by-state-container");
    
  //
  // I N I T I A L I Z E   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  var controller = Backbone.View.extend({
    
    //
    // [ DEFINE THE EVENTS ]
    //
    events :{
      "change #contracts-selector" : "update_list"
    },

    //
    // [ DEFINE THE TEMPLATES ]
    //
    tooltip_a : _.template(TooltipA),
    tooltip_b : _.template(TooltipB),

    // 
    // [ SET THE CONTAINER ]
    //
    //
    el : 'body',

    //
    // [ THE INITIALIZE FUNCTION ]
    //
    //
    initialize : function(){

      console.log(DATA, "xxx");

      // FORCE
      this.force = new Force({
        controller : this,
        data       : JSON.map(function(d){
                       return {
                         "name"      : d.release.tender.title,
                         "planning"  : d.planning,
                         "ocdsid"    : d.ocdsid,
                         "contracts" : d.contracts,
                         "awards"    :d.awards,
                         "tender"    :d.tender
                       };
                     }),
        datab       : PROVIDERS.map(function(d){
                       return {
                         "name"      : d.name,
                         "id"        : d.rfc,
                         "contracts" : d.budget
                       };
                     }),
        el         : "#force",
        _url       : BASE_PATH + "/contrato/",
        _url_b     : BASE_PATH + "/proveedor/",
        _selector  : "budget"
      });
    },
  
    //
    // [ TOOLTIP FOR TIME LINES ]
    //
    //
    create_tooltip : function(data){
      var el = $(this.tooltip_a(data));
      el.css({
        left : d3.event.pageX + "px",
        top  : d3.event.pageY + "px"
      });

      this.$el.append(el);
    },

    //
    //
    //
    create_tooltip_b : function(data){
      var el = $(this.tooltip_b(data));
      el.css({
        left : d3.event.pageX + "px",
        top  : d3.event.pageY + "px",
        position: "absolute"
      });

      this.$el.append(el);
    },

    remove_tooltip : function(){
      $(".tooltip-container").remove();
    },

    update_list : function(e){
      var option = e.currentTarget.value;
      if(option == "all"){
        $("li.row").show();
        $("h2#title_select_type").html("Lista de <strong>Contrataciones Abiertas</strong>");
      }
      else{
	      switch(option) {
		      case "planning":
		      var name_option = "Lista de contrataciones en <strong>Planeación</strong>";
		      break;
		      case "tender":
		      var name_option = "Lista de contrataciones en <strong>Licitación</strong>";
		      break;
			  case "award":
		      var name_option = "Lista de contrataciones en <strong>Adjudicación</strong>";
		      break;
		      case "contract":
		      var name_option = "Lista de <strong>Contratos</strong>";
		      break;
		      default:
		      var name_option = "";
	      }
        $("li.row").hide();
        $("li." + option).show();
        $("h2#title_select_type").html(name_option);
      }
    }

  });

  //
  // R E T U R N   T H E   B A C K B O N E   " C O N T R O L L E R "
  // --------------------------------------------------------------------------------
  //
  return controller;
});