<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Supplier;

class ApiCDMX extends Controller {

	public function __construct()
	{
		//parent::__construct();

      $endpoints = env('ENDPOINTS', 'production');

      if($endpoints == 'production'){
      // SERVER ENDPOINTS
        $this->apiContratos   = 'http://10.1.129.11:9009/ocpcdmx/listarcontratos';
        $this->apiContrato    = 'http://10.1.129.11:9009/ocpcdmx/contratos';
        $this->apiProveedores = 'http://10.1.129.11:9009/ocpcdmx/cproveedores';
      }
    // PUBLIC ENDPOINTS
      else{
        $this->apiContratos   = 'http://187.141.34.209:9009/ocpcdmx/listarcontratos';
        $this->apiContrato    = 'http://187.141.34.209:9009/ocpcdmx/contratos';
        $this->apiProveedores = 'http://187.141.34.209:9009/ocpcdmx/cproveedores';
      }
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function listAll()
	{
		$contracts = Contract::all();
    return response()->json($contracts)->header('Access-Control-Allow-Origin', '*');
	}

	public function getByYear($year){
		$year = (int)$year;
		if(!$year){
			header("HTTP/1.0 400 invalid year");
			die();
		}

		$contracts = Contract::where("ejercicio", $year)->get();
		return response()->json($contracts)->header('Access-Control-Allow-Origin', '*');
		// 400 Bad Request
	}

	public function listAllProviders()
	{
		$providers = Supplier::all();
    return response()->json($providers)->header('Access-Control-Allow-Origin', '*');
	}

	public function getJSON($ocid){
    // [1] Validate ocid & redirect if not valid
    $r = preg_match('/^[\w-]+$/', $ocid);
    if(!$r) abort(404);

    // [2] make the call to the API
    $url  = $this->apiContrato;
    $contract = Contract::where("ocdsid", $ocid)->get()->first(); // id, cvedependencia, ocdsid 
    if(!$contract) abort(404);

    $data = ['dependencia' => $contract->cvedependencia, 'contrato' => $contract->ocdsid];

    // [2.1] the CURL stuff
    $ch   = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));
    $result = curl_exec($ch);
    $json   = json_decode($result);

    return response()->json($json);
  }


}
