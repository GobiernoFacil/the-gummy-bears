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

/*
 * El controller de búsqueda.
 * Recibe la información del campo de texto, y muestra los resultados, o el formulario
 * de búsqueda.
 *
 * funciones disponibles en el primer release:
 * - index
 *
 */
class Search extends Controller {

	// Lista de resultados / formulario de búsqueda
  //
  // Si se recibe la varible "query", la busca dentro de distintos campos. Si no, pasa
  // un array vacío, y en el view se toma como si no se hubiera buscado nada.
  // Se accede a la función mediante:
  // contratos/busqueda
  //
	public function index(Request $request){
    $query = $request->input('query', false);

    if(!empty($query)){
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
        });
      })

      ->get();
    }
    else{
      $contracts = [];
    }
	  $data                = [];
    $data['title']       = 'Resultados de búsqueda de Contrataciones Abiertas de la CDMX';
    $data['description'] = 'Resultados de búsqueda de Contrataciones Abiertas de la Ciudad de México';
	  $data['og_image']	   = "img/og/contrato-cdmx.png";
	  $data['body_class']  = 'contract single';
    $data['contracts']   = $contracts;
    $data['keyword']   	 = $query;

    return view('frontend.contracts.search')->with($data);
    //
  }

}
