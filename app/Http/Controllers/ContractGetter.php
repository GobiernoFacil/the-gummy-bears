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

class ContractGetter extends Controller {

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
	public function index()
	{
		//
	}

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
    curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));
    $result = curl_exec($ch);
    //$con    = json_decode($result);

    //echo "<pre>";
    //var_dump($con);
    //echo "</pre>";
    $file = $ocid . ".json";
    //file_put_contents($file, $result);
    //return response()->download($file);
    header('Content-Disposition: attachment; filename="' . $file . '"');
    header('Content-Type: application/json');
    header('Content-Length: ' . strlen($result));
    header('Connection: close');

    echo $result;
  }
}
