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
	
	
	//
	// Show Contract
	//
  public function show($ocid){
    // [1] Validate ocid & redirect if not valid
    $r = preg_match('/^[\w-]+$/', $ocid);
    if(!$r) return redirect("contratos");
	
	$contract = Contract::where("ocdsid", $ocid)->get()->first();
    if(!$contract) return redirect("contratos");
	$ocid	= $ocid;
	$con 	= $contract->releases->last(); 
    // [2] show the view
    	$data                = [];
		$data['title']       = $con->tender->title . " | Contrataciones Abiertas de la CDMX";
		$data['description'] = "Contrato: " . $con->tender->description;
		$data['og_image']	 = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'contract single';
		$data['elcontrato']	 = $con;
		$data['ocid']	 	 = $ocid;
    
    return view("frontend.contracts.contract")->with($data);

  }
}
