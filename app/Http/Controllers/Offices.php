<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Award;
use App\Models\Buyer;
use App\Models\Contract;
use App\Models\ContractData;
use App\Models\Planning;
use App\Models\Provider;
use App\Models\Publisher;
use App\Models\SingleContract;
use App\Models\Supplier;

/*
 * El controller de dependencias
 * Muestra la lista de dependencias y cada dependencia por separado
 *
 * funciones disponibles en el primer release:
 * - index
 * - show
 */
class Offices extends Controller {
	//
	// Offices list
	//
	// Regresa la lista de dependencias. 
	// Se accede a esta función mediante:
	// dependencias
	//
	public function index(){
		$buyers              = Buyer::all();
		$data                = [];
		$data['title']       = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['description'] = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['og_image']    = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'dependencia';
		$data['buyers']   	 = $buyers;
		//$data['_buyers'] = Publisher::with("office")->get();
		
		return view("frontend.offices.offices_list")->with($data);
	}

	//
	// Office 
	//
	// Muestra la información de una dependencia mediate su id del sistema, no del id de la CDMX
	// Se accede mendiante:
	// dependencias/{id}
	//
	public function show($id){
		//$publisher        = Publisher::find($id);
		$buyer				    = Buyer::find($id);
		$contracts 			  = $buyer->contracts()->with("data")->get();
		$implementation_num = $buyer->contracts()->whereHas("data", function($query){
			                      $query->whereHas("release", function($p){
			                      	$p->whereHas("singlecontracts", function($q){
				                        $q->has("implementation");
			                        });
			                      });
		                      })->count();

		$contracting_num = $buyer->contracts()->whereHas("data", function($query){
			                      $query->whereHas("release", function($p){
			                      	$p->whereHas("singlecontracts", function($q){
				                        $q->has("implementation");
			                        });
			                      });
		                      }, "<", 1)->whereHas("data", function($query){

		                      	$query->whereHas("release", function($p){
			                      	$p->has("singlecontracts");
			                      });

		                      })->count();


		$award_num = $buyer->contracts()->whereHas("data", function($query){
			                      $query->whereHas("release", function($p){
			                      	$p->has("singlecontracts");
			                      });
		                      }, "<", 1)->whereHas("data", function($query){

		                      	$query->whereHas("release", function($p){
			                      	$p->has("awards");
			                      });

		                      })->count();


		$tender_num = $buyer->contracts()->whereHas("data", function($query){
			                      $query->whereHas("release", function($p){
			                      	$p->has("awards");
			                      });
		                      }, "<", 1)->whereHas("data", function($query){

		                      	$query->whereHas("release", function($p){
			                      	$p->has("tender");
			                      });

		                      })->count();


		$planning_num = $buyer->contracts()->whereHas("data", function($query){
			                      $query->whereHas("release", function($p){
			                      	$p->has("tender");
			                      });
		                      }, "<", 1)->whereHas("data", function($query){

		                      	$query->whereHas("release", function($p){
			                      	$p->has("planning");
			                      });

		                      })->count();


		$awards 			    = $buyer->awards;
		$singlecont_count = $buyer->singlecontracts->count();
		$providers			  = Provider::whereHas("buyers", function($q) use($buyer){
			                    $q->where("buyer_id", $buyer->id);
		                    })->orderBy("budget", "desc")->take(5)->get();

		$providers_count 	= $buyer->providers->where("award_num", ">", 0)->count();
		
		
		$contract_data_c	= ContractData::whereHas("release", function($q) use($buyer){
			                    $q->where("buyer_id", $buyer->id);
		                    })->orderby('contracts', 'desc')->get();
		                    
		$contract_data		= ContractData::whereHas("release", function($q) use($buyer){
			                    $q->where("buyer_id", $buyer->id);
		                    })->orderby('contracts', 'desc')->take(5)->get();
		//total
		$total_planning		= $buyer->plannings->sum("amount");
		$total_award		  = $buyer->awards->sum("value");
		
		//contratado mx
		$total_contract	 	= $contract_data_c->sum("contracts");
		
		//contratado usd
		$buyer_usd				    = $buyer->singlecontracts->where('currency','USD');
		$total_contract_usd		= $buyer_usd->sum("amount");
		$total_contract_usd		= $total_contract_usd + $buyer_usd->sum("amount_year");
		
		///percentage
		$max = max(array($total_planning, $total_award, $total_contract));
		if($max > 0) {
			$per_planning = ($total_planning *100)/$max;	
			$per_award		= ($total_award *100)/$max;		
			$per_contract = ($total_contract *100)/$max;
		}
		else {
			$per_planning = 0; 
			$per_award		= 0; 
			$per_contract = 0;
		}
		
		$data                = [];
		$data['title']       = $buyer->name . ' de la CDMX con Contrataciones Abiertas';
		$data['description'] = $buyer->name . ' de la CDMX con Contrataciones Abiertas';
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'dependencia';
		
		$data['buyer']   	 		    = $buyer;
		$data['contracts']   		  = $contracts;
		$data['awards']   	 		  = $awards;
		$data['singlecont_count'] = $singlecont_count;
		$data['providers']   	 	  = $providers;
		$data['providers_count']  = $providers_count;
		$data['total_planning']   = $total_planning;
		$data['total_award']   	 	= $total_award;
		$data['total_contract']   	= $total_contract;
		$data['total_contract_usd'] = $total_contract_usd;
		$data['per_planning']   	= $per_planning;
		$data['per_award']   	 	  = $per_award;
		$data['per_contract']   	= $per_contract;	
		$data['contract_data']   	= $contract_data;	

		$data['implementation_num'] = $implementation_num;
		$data['contracting_num']    = $contracting_num;
		$data['award_num']          = $award_num;
		$data['tender_num']         = $tender_num;
		$data['planning_num']       = $planning_num;
		
		return view("frontend.offices.office")->with($data);
	}
}
