<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractHistory;
use App\Models\ContractData;
use App\Models\Provider;
use App\Models\Supplier;

class ApiCDMX extends Controller {

  const PAGE_SIZE = 50;

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

  //
  //
  //
  //
	public function listAll()
	{
		$contracts = Contract::all();
    return response()->json($contracts)->header('Access-Control-Allow-Origin', '*');
	}

  //
  //
  //
  //
	public function getByYear($year){
		$year = (int)$year;
		if(!$year){
			header("HTTP/1.0 400 invalid year");
			die();
		}

		$contracts = Contract::where("ejercicio", $year)->get();
		return response()->json($contracts)->header('Access-Control-Allow-Origin', '*');
	}

  //
  //
  //
  //
	public function listAllProviders($page = 1)
	{
		$providers = Provider::take(SELF::PAGE_SIZE)->skip(($page-1) * SELF::PAGE_SIZE)->get();
    return response()->json($providers)->header('Access-Control-Allow-Origin', '*');
	}

  //
  //
  //
  //
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

  //
  //
  //
  //
  public function search(Request $request, $page = 1){
    $query = $request->input('query', false);

    if($query){
      $contracts = $this->_full_search($query)->get();
      $total     = $this->_full_search($query)->count();
     
    }
    else{
      $contracts = [];
      $total     = 0;
    }

    return response()->json([
      "contracts" => $contracts,
      "page"      => $page,
      "total"     => $total
    ]);
    //
  }

  //
  //
  //
  //
  public function showProvider($rfc){
    if(!ctype_alnum($rfc)) abort(404);

    $provider = Provider::where("rfc", $rfc)->first();
    return response()->json($provider);
  }

  public function showContractData($ocdsid){
    $contract = ContractData::with([
      "release.tender", "release.planning","release.singlecontracts", "release.awards"
    ])->where("ocdsid", $ocdsid)->first();
    return response()->json($contract);
  }

  public function showContractHistory($ocdsid){
    $contracts = ContractHistory::where("ocdsid", $ocdsid)->get();
    return response()->json($contracts);
  }

  //
  //
  //
  //
  private function _full_search($query){
    $contracts = Contract::where('nomdependencia', 'like', '%' . $query.'%')
      ->orWhere('ejercicio', 'like', '%' . $query . '%')
      ->orWhere('ocdsid', 'like', '%' . $query . '%')
      // SEARCH ON PUBLISHER
      ->orWhere(function($q) use($query){
        $q->whereHas('publisher', function($q) use($query){
          $q->where('name', 'like', '%' . $query . '%');
        });
      })

      // SEARCH ON PLANNINGS
      ->orWhere(function($q) use($query){
        $q->whereHas('plannings', function($q) use($query){
          $q->where('project', 'like', '%' . $query . '%');
        });
      })

      // SEARCH BUYER
      ->orWhere(function($q) use($query){
        $q->whereHas('releases', function($q) use($query){
          $q->whereHas('buyer', function($q) use($query){
            $q->where('name', 'like', '%' . $query . '%');
          });
        });
      })

      // SEARCH ON TENDERS
      ->orWhere(function($q) use($query){
        $q->whereHas('tenders', function($q) use($query){
          $q->where('description', 'like', '%' . $query . '%');
        })
        ->orWhereHas('tenders', function($q) use($query){
          $q->where('title', 'like', '%' . $query . '%');
        })
        ->orWhereHas('tenders', function($q) use($query){
          $q->where('status', 'like', '%' . $query . '%');
        });
      })


      // SEARCH ON AWARDS
      ->orWhere(function($q) use($query){
        $q->whereHas('awards', function($q) use($query){
          $q->where('description', 'like', '%' . $query . '%');
        })
        ->orWhereHas('awards', function($q) use($query){
          $q->where('title', 'like', '%' . $query . '%');
        })
        ->orWhereHas('awards', function($q) use($query){
          //$q->where('title', 'like', '%' . $query . '%');
          $q->whereHas('suppliers', function($q) use($query){
            $q->where("name", 'like', '%' . $query . '%');
          });
        });
      });

    return $contracts;
  }


}
