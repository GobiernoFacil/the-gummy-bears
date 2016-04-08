<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;

class Contracts extends Controller {
	//
	// Contracts list
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

}
