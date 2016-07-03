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
use App\Models\BuyerProvider;
use App\Models\Buyer;

/*
 * El controller de proveedores. Aquí se muestra la lista de proveedores
 * y cada proveedor por separado.
 *
 * funciones disponibles en el primer release: 
 * - index
 * - show
*/
class Suppliers extends Controller {
	//
	// Suppliers list
	//
	// Regresa la lista de proveedores, ordenados por nombre. 
	// Se accede a esta función mediante:
	// proveedores
  //
	// nota: necesita paginación, y pasar el filtro que existe en el view al controller
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
	// Muestra un proveedor mediante el rfc. 
	// se accede a esta función mediante: 
	// proveedor/{id}
	//
	// nota: es posible optimizar esta función utilizando ORM, sin la necesidad de 
	// cargar todos los elementos y filtrarlos. 
	//
	public function show($rfc){
		$tenderer        = Provider::where("rfc", $rfc)->get()->first();							 		
		$tender_tenderer = TenderTenderer::where("tenderer_id", $tenderer->id)->get();
		$tenders         = Tender::all();
		$supplier        = Provider::where("rfc", $rfc)->get()->first();
		$buyers          = BuyerProvider::where('provider_id',$supplier->id)->get();
				
		$contracts       = Contract::all();
		$awards          = Award::all();
		$singlecontracts = SingleContract::all();
		
		$data                		= [];
		$data['title']       		= $tenderer->name;
		$data['description'] 		= 'Proveedor';
		$data['og_image']	      = "img/og/contrato-cdmx.png";
		$data['body_class']  		= 'proveedor';
		
		$data['contracts']  		 = $contracts;
		$data['tenderer']   		 = $tenderer;
		$data['supplier']   		 = $supplier;
		$data['sicon']  			   = $singlecontracts;
		$data['awards']   			 = $awards;
		$data['tender_tenderer'] = $tender_tenderer;
		$data['tenders']   			 = $tenders;
		$data['buyers']   			 = $buyers;

		
		return view("frontend.suppliers.supplier")->with($data);
	}
}
