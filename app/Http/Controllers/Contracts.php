<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractData;
use App\Models\SingleContract;
use App\Models\Provider;

class Contracts extends Controller {

  const PAGE_SIZE = 10;
  //
  // CONSTRUCTOR
  //
  //
  public function __construct()
  {
    //parent::__construct();

      $endpoints = env('ENDPOINTS', 'production');

      if($endpoints == 'production'){
      // SERVER ENDPOINTS
      $this->apiContratos   = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/listarcontratos';
      //'http://10.1.129.11:9009/ocpcdmx/listarcontratos';
      $this->apiContrato    = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/contratos';
      //'http://10.1.129.11:9009/ocpcdmx/contratos';
      $this->apiProveedores = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/cproveedores';
      //'http://10.1.129.11:9009/ocpcdmx/cproveedores';
    }
    // PUBLIC ENDPOINTS
    else{
      $this->apiContratos   = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/listarcontratos';
      //'http://187.141.34.209:9009/ocpcdmx/listarcontratos';
      $this->apiContrato    = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/contratos';
      //'http://187.141.34.209:9009/ocpcdmx/contratos';
      $this->apiProveedores = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/cproveedores';
      //'http://187.141.34.209:9009/ocpcdmx/cproveedores';
    }
  }

	//
	// Contracts list
	//	
	public function index($page = 1, $type = "todos"){ // licitación, adjudicación, contratación
    $page = (int)$page - 1 >= 0 ?  (int)$page - 1 : 0;
		$contracts_amount	   = SingleContract::where("currency", "MXN")->sum('amount');
		$contracts_amount	   = $contracts_amount + SingleContract::where("currency_year", "MXN")->sum('amount_year');
		
		$contracts_number	   = SingleContract::all()->count();
		$contracts 			     = Contract::orderBy("published_date",'desc')->skip($page * self::PAGE_SIZE)->take(self::PAGE_SIZE)->get();
		$json                = ContractData::with("release.tender")->get();
		$_providers          = Provider::select("id", "rfc", "name","budget")->where("budget", ">", 0)->get();
		$data                = [];
		$data['title']       = 'Lista de Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Lista de contratos abiertos de la Ciudad de México';
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'contract';
		
    $data['page']      = $page + 1;
    $data['pages']     = ceil($contracts_number / self::PAGE_SIZE);
    $data['page_size'] = self::PAGE_SIZE;

		$data['contracts']  = $contracts;
		$data['json']       = $json;
		$data['_providers'] = $_providers;
		
		$data['contracts_amount']  = $contracts_amount;
		$data['contracts_number']  = $contracts_number;
		
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

  //
  // [ SHOW RAW CONTRACT ]
  //
  //
  public function showRaw($ocid){
    // [1] Validate ocid & redirect if not valid
    $r = preg_match('/^[\w-]+$/', $ocid);
    if(!$r) return redirect("contratos");

    // [2] make the call to the API
    $url  = $this->apiContrato;
    $base_contract = Contract::where("ocdsid", $ocid)->get()->first(); // id, cvedependencia, ocdsid 
    if(!$base_contract) die("O_______O");

    $data = ['dependencia' => $base_contract->cvedependencia, 'contrato' => $base_contract->ocdsid];

    // [2.1] the CURL stuff
    $conn = $this->apiCall($data, $url);
// OCDS-87SD3T-SEFIN-DRM-AD-002-2016
    // [3] if the ocid is invalid, redirect
    echo "<pre>";
    var_dump($base_contract->toArray());
    echo "</pre>";

    echo "<pre>";
    var_dump($conn);
    echo "</pre>";
    die();
  }

  //
  // [ SHOW RAW CONTRACT ]
  //
  //
  public function showFullRaw($ocid){
    // [1] Validate ocid & redirect if not valid
    $r = preg_match('/^[\w-]+$/', $ocid);
    if(!$r) return redirect("contratos");

    // [2] make the call to the API
    $url  = $this->apiContrato;
    $base_contract = Contract::where("ocdsid", $ocid)->get()->first(); // id, cvedependencia, ocdsid 
    if(!$base_contract) die("O_______O");

    $data = ['dependencia' => $base_contract->cvedependencia, 'contrato' => $base_contract->ocdsid];

    // [2.1] the CURL stuff
    $conn = $this->apiCall($data, $url, 0);
// OCDS-87SD3T-SEFIN-DRM-AD-002-2016
    // [3] if the ocid is invalid, redirect
    echo "<pre>";
    var_dump($base_contract->toArray());
    echo "</pre>";

    echo "<pre>";
    var_dump($conn);
    echo "</pre>";
    die();
  }

  public function showListRaw(){
    $data      = ['dependencia' => '0901', "ejercicio" => 2016]; // harcoded stuff
    $excercise = $this->apiCall($data, $this->apiContratos);
    echo "<pre>";
    var_dump($excercise);
    echo "</pre>";
  }

  private function apiCall($data, $endpoint, $decode = 1){
      $ch = curl_init();
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $endpoint );
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      $result   = curl_exec($ch);
      $response = $decode ? json_decode($result) : $result;

      return $response;
  }
}
