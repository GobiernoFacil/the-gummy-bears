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
		$providers 			     = Provider::orderby('name','ASC')->get();
		$data                = [];
		$data['title']       = 'Lista de Proveedores con Contratos con la CDMX';
		$data['description'] = 'Lista de Proveedores con Contratos con la CDMX';
		$data['og_image']	 = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'proveedor';
		
		$data['providers']  = $providers;
		
		return view("frontend.suppliers.suppliers_list")->with($data);
	}

	//
	// Supplier 
	//
	public function show($rfc){
		$tenderer 			 		= Provider::where("rfc", $rfc)->get()->first();							 		
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
							

		
		return view("frontend.suppliers.supplier")->with($data);
	}
}
