<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Award;
use App\Models\Buyer;
use App\Models\Contract;
use App\Models\Item;
use App\Models\Planning;
use App\Models\Provider;
use App\Models\Publisher;
use App\Models\Release;
use App\Models\SingleContract;
use App\Models\Supplier;
use App\Models\Tender;
use App\Models\Tenderer;
use App\Models\TenderTenderer;

/*
 * El controller para descargar los archivos JSON del estándar
 * Estos archivos son los originales generados por el api de la CDMX
 * Solo se preparan para ser descargados en formato json y no en formato de texto
 *  
 * funciones disponibles en el primer release:
 * - index (definida, pero no hace nada, y no tiene acceso desde el front)
 * - getJSON
 *
 */
class ContractGetter extends Controller {
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

  //
  // Descarga el JSON del estándar
  // obtiene los datos del api, y los regresa como archivo de json
  // se puede acceder a esta función mediante:
  // descargar/contrato/{ocid}
  //
	public function getJSON($ocid){
    // [1] Validate ocid & redirect if not valid
    $r = preg_match('/^[\w-]+$/', $ocid);
    if(!$r) die("O_______O");

    // [2] make the call to the API
    $url  = $this->apiContrato;
    $contract = Contract::where("ocdsid", $ocid)->get()->first(); // id, cvedependencia, ocdsid 
    if(!$contract) die("O_______O");

    $data = ['dependencia' => $contract->cvedependencia, 'contrato' => $contract->ocdsid];

    // [2.1] the CURL stuff
    $ch   = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);
    
    $file = $ocid . ".json";

    header('Content-Disposition: attachment; filename="' . $file . '"');
    header('Content-Type: application/json');
    header('Content-Length: ' . strlen($result));
    header('Connection: close');

    echo $result;
  }
}
