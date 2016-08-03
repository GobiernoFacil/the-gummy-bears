<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\BuyerProvider;
use App\Models\Contract;
use App\Models\ContractHistory;
use App\Models\ContractData;
use App\Models\Provider;
use App\Models\Supplier;
use App\Models\Tender;

/*
 * El controller del API de datos
 * La función de esta api es proveer métodos para agregar distintos datos del estándar
 * y facilitar la creación de aplicaciones complementarias o mejoras al sistema mismo
 *
 * funciones disponibles en el primer release:
 * - listAll
 * - getByYear
 * - listAllProviders
 * - getJSON
 * - search
 * - showProvider
 * - showContractData
 * - showContractHistory
 * - showBuyers
 * - showBuyerProviderRelation
 * - tenders
 * - _full_search
 */
class ApiCDMX extends Controller {
  // el tamaño de la paginaciónd el API
  // se define como constante y como variable debido a un bug que se arregló cambiando la
  // constante por una variable
  const PAGE_SIZE   = 50;
  public $page_size = 50;

  //
  // Constructor
  // Dependiendo el tipo de entorno, se definen los endpoints para los distintos servicios del api
  // tal vez sea posible eliminar este proceso, pues es un vestigio de la versión inicial del api,
  // en el que eran distintos los endpoints para producción y desarrollo
  //
	public function __construct()
	{
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
  // Obtén todos los contratos
  // Este método regresa la clave única para todos los contratos disponibles. 
  // La clave se puede usar para obtener el contrato completo. Más información abajo
  //
  // se puede acceder a esta función mediante:
  // api/contratos/todos
  //
	public function listAll()
	{
		$contracts = Contract::all();
    return response()->json($contracts)->header('Access-Control-Allow-Origin', '*');
	}

  //
  // Obtén todos los contratos por año
  // Similar al endpoint anterior, este sirve para obtener todos los contratos 
  // en un año determinado. El array contiene la clave única del contrato y el 
  // nombre de quien publica la información
  //
  // se puede acceder a esta función mediante:
  // api/contratos/ejercicio/{year}
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
  // Obtén todos los proveedores
  // obtén la información de contacto de todos los proveedores que han participado 
  // en una licitación o han obtenido un contrato con la CDMX. Esta lista solo cuenta 
  // con los proveedores que aparecen en los contratos publicados en el sitio.
  //
  // se puede acceder a esta función mediante:
  // api/proveedores/todos
  //
	public function listAllProviders($page = 1)
	{
		$providers = Provider::take($this->page_size)->skip(($page-1) * $this->page_size)->get();
    return response()->json($providers)->header('Access-Control-Allow-Origin', '*');
	}

  //
  // Obtén la información completa por contrato
  // Con este endpoint, se obtiene la información completa del contrato, como lo 
  // indica el Open Contracting Partnership
  // (http://standard.open-contracting.org/latest/en/schema/reference/).
  //
  // se puede acceder a esta función mediante:
  // api/contrato/{ocds}
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
    curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);
    $json   = json_decode($result);

    return response()->json($json)->header('Access-Control-Allow-Origin', '*');
  }

  //
  // Busca un contrato por palabra clave
  // Es posible buscar por palabra clave dentro del contrato. El campo de 
  // búsqueda se llama “query”, y es opcional seleccionar la página de resultados 
  // de la búsqueda. La respuesta incluye el número de resultados, página que se 
  // está regresando y los resultados por página.
  //
  // se puede acceder a esta función mediante:
  // api/contratos/buscar/{page?}?query
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
    ])->header('Access-Control-Allow-Origin', '*');
    //
  }

  //
  // Obtén la información de un solo proveedor
  // Obtén la información de contacto de un proveedor mediante el RFC. 
  // El objeto por proveedor es idéntico al que regresa el array de todos 
  // los proveedores (el endpoint anterior).
  //
  // se puede acceder a esta función mediante:
  // api/proveedor/{rfc}
  //
  public function showProvider($rfc){
    if(!ctype_alnum($rfc)) abort(404);

    $provider = Provider::where("rfc", $rfc)->first();
    return response()->json($provider)->header('Access-Control-Allow-Origin', '*');
  }

  //
  // Obtén los valores oportunos del contrato
  // Si solo se quiere la información (agregada) más reciente del contrato, 
  // se puede usar esta api, que regresa la información del dinero presupuestado, 
  // autorizado y gastado por contrato, para el último release (versión del contrato). 
  // El formato en el que se obtiene la información del contrato, difiere del estándar, 
  // en cuanto a que solo es un resumen del mismo, y no el contrato completo
  //
  // se puede acceder a esta función mediante:
  // api/contrato/actual/{ocds}
  //
  public function showContractData($ocdsid){
    $contract = ContractData::with([
      "release.tender", "release.planning","release.singlecontracts", "release.awards"
    ])->where("ocdsid", $ocdsid)->first();
    return response()->json($contract)->header('Access-Control-Allow-Origin', '*');
  }

  //
  // Obtén la información agregada histórica de un contrato
  //
  // se puede acceder a esta función mediante:
  // api/contrato/historico/{key}
  //
  public function showContractHistory($ocdsid){
    $contracts = ContractHistory::where("ocdsid", $ocdsid)->get();
    return response()->json($contracts)->header('Access-Control-Allow-Origin', '*');
  }

  //
  // Obtén la lista de dependencias
  // Esta es la lista de dependencias (o compradores)
  // 
  // se puede acceder a esta función mediante:
  // api/dependencias/todas
  //
  public function showBuyers(){
    $response = Buyer::all();
    return response()->json($response)->header('Access-Control-Allow-Origin', '*');
  }

  //
  // obtén la relación entre dependecias y proveedores
  // Este endpoint contiene un resumen de la relación de las dependencias con cada proveedor.
  //
  // se puede acceder a esta función mediante:
  // api/dependencia-proveedor/{page?}
  //
  public function showBuyerProviderRelation($page = 1){
    $response = BuyerProvider::with(["buyer", "provider"])->orderBy("budget", "desc")->get();
    return response()->json($response)->header('Access-Control-Allow-Origin', '*');
  }

  //
  // obtén la lista de licitaciones
  // Esta es la lista de licitaciones (tenders) para la última versión de cada proceso de contratación.
  // 
  // se puede acceder a esta función mediante:
  // api/licitaciones/{page?}
  //
  public function tenders($page = 1){
    $response = Tender::whereHas("release", function($q){
      $q->where("is_latest", 1);
    })->with(["items", "providers", "documents", "release.singlecontracts"])->orderBy("amount", "desc")->get();
    return response()->json($response)->header('Access-Control-Allow-Origin', '*');
  }

  //
  // La función de búsqueda
  // Esta función es privada
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
