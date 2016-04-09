<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Contract;

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
		
		//// lista de contratos aún sin implementar en el view
		$data['contracts']   = $contracts;
		
		return view("frontend.office")->with($data);
	}
}
