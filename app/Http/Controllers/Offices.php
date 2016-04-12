<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Contract;
use App\Models\Award;
use App\Models\SingleContract;
use App\Models\Supplier;

class Offices extends Controller {
	//
	//[ Offices list ]
	//	
	//
	public function index(){
		$contracts 			     = Contract::all();
		$data                = [];
		$data['title']       = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['description'] = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'dependencia';
		
		$data['contracts']   = $contracts;
		
		return view("frontend.offices")->with($data);
	}
	
	public function show($id){
		$contracts 			 = Contract::all();
		$awards 			 = Award::all();
		$singlecontracts 	 = SingleContract::all();
		$topcontracts 	 	 = SingleContract::orderby('amount', 'desc')->take(5)->get();;
		$suppliers 			 = Supplier::all();

		$data                = [];
		$data['title']       = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['description'] = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'dependencia';
		
		$data['contracts']   = $contracts;
		$data['awards']   	 = $awards;
		$data['suppliers']   	 = $suppliers;
		$data['singlecontracts']   	 = $singlecontracts;
		$data['topcontracts']   	 = $topcontracts;
		
		
		
		return view("frontend.office")->with($data);
	}
}
