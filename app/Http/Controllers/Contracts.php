<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractData;
use App\Models\SingleContract;
use App\Models\Provider;

/*
 * El controller de los contratos
 * Muestra la lista de contratos y la información de un contrato en particular.
 * Incluye también funciones de prueba que revisan la respuesta del API
 *
 * funciones disponibles en el primer release:
 * - __construct
 * - index
 * - show
 * - showRaw
 * - showFullRaw
 * - showListRaw
 * - apiCall
 */
class Contracts extends Controller {

  // El tamaño de la paginación
  const PAGE_SIZE = 10;
  
  //
  // Constructor
  // Dependiendo el tipo de entorno, se definen los endpoints para los distintos servicios del api
  // tal vez sea posible eliminar este proceso, pues es un vestigio de la versión inicial del api,
  // en el que eran distintos los endpoints para producción y desarrollo
  //
  public function __construct()
  {
    $endpoints = env('ENDPOINTS', 'production');
    
    // SERVER ENDPOINTS
    if($endpoints == 'production'){
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
	// Lista de contratos
	// Muestra la lista de contratos paginada, ordenados por fecha de publicación
  // Se accede mediante:
  // contratos/{página}
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
	// Contrato
  // Muestra el contrato seleccionado mendiante su clave ocid
  // se accede a esta función mediante:
  // contrato/{ocid}
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
    	$data              = [];
		$data['title']       = $con->tender->title . " | Contrataciones Abiertas de la CDMX";
		$data['description'] = "Contrato: " . $con->tender->description;
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'contract single';
		$data['elcontrato']	 = $con;
		$data['ocid']	 	     = $ocid;
    
    return view("frontend.contracts.contract")->with($data);

  }

  //
  // Contrato en PHP y JSON
  // Muestra la información básica del contrasto en modo Array y después el JSON 
  // del estándar para el contrato seleccionado
  // Se accede a esta función mediante:
  // contrato/json/{ocid}
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
  // Contrato en JSON
  // Muestra solo el JSON del proceso de contratación seleccionado,
  // siempre y cuando esté en el sistema
  // Se puede acceder mediante:
  // contrato/text/{ocid}
  //
  // Nota: durante el debug, posiblemente se haya afectado el método para mostrar
  // estos datos; hay que darle una revisada en el siguiente release.
  //
  public function showFullRaw($ocid){
    // [1] Validate ocid & redirect if not valid
    $r = preg_match('/^[\w-]+$/', $ocid);
    if(!$r) return redirect("contratos");

    // [2] make the call to the API
    $url  = $this->apiContrato;
    $base_contract = Contract::where("ocdsid", $ocid)->get()->first();
    if(!$base_contract) die("O_______O");

    $data = ['dependencia' => $base_contract->cvedependencia, 'contrato' => $base_contract->ocdsid];

    // [2.1] the CURL stuff
    $conn = $this->apiCall($data, $url, 0);

    echo "<pre>";
    var_dump($conn);
    echo "</pre>";
    die();
  }

  // 
  // La lista de contratos PHP
  // muestra la lista de contratos en formato PHP para el 2016.
  // No es posible cambiar el año, es solo una fución de prueba
  //
  // Se puede acceder mediante: 
  // lista/contratos/json
  //
  public function showListRaw(){
    $data      = ['dependencia' => '0901', "ejercicio" => 2016]; // harcoded stuff
    $excercise = $this->apiCall($data, $this->apiContratos);
    echo "<pre>";
    var_dump($excercise);
    echo "</pre>";
  }

  //
  // llamada CURL
  // Esta función generica se usa para conectarse al api. Es una función privada
  //
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
