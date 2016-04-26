<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Supplier;
use App\Models\Tenderer;
use App\Models\TenderTenderer;
use App\Models\Tender;
use App\Models\SingleContract;
use App\Models\Award;
use App\Models\Provider;

class Suppliers extends Controller {
	//
	// Suppliers list
	//	
	public function index(){
		$contracts 			     = Contract::all();
		$data                = [];
		$data['title']       = 'Lista de Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Lista de contratos abiertos de la Ciudad de México';
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'contract';
		
		$data['contracts']  = $contracts;
		
		return view("frontend.contracts.contracts_list")->with($data);
	}

	//
	// Supplier 
	//
	public function show($rfc){
		$tenderer 			 		= Tenderer::where("rfc", $rfc)->get()->first();							 		
		$tender_tenderer 	 		= TenderTenderer::where("tenderer_id", $tenderer->id)->get();
		$tenders			 		= Tender::all();
		$supplier 			 		= Provider::where("rfc", $rfc)->get()->first();
							 		
		$contracts 			 		= Contract::all();
		$awards 			 		= Award::all();
		$singlecontracts 	 		= SingleContract::all();
		$data                		= [];
		$data['title']       		= $tenderer->name;
		$data['description'] 		= 'Proveedor';
		$data['og_image']	 		= "img/og/contrato-cdmx.png";
		$data['body_class']  		= 'proveedor';
		
		$data['contracts']  		= $contracts;
		$data['tenderer']   		= $tenderer;
		$data['supplier']   		= $supplier;
		$data['sicon']  			= $singlecontracts;
		$data['awards']   			= $awards;
		$data['tender_tenderer']   	= $tender_tenderer;
		$data['tenders']   	= $tenders;
							

		
		return view("frontend.supplier")->with($data);
	}
}
