<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SingleContract;
use App\Models\Contract;
use App\Models\Provider;
use App\Models\ContractData;

/*
 * El controller del frontend
 * Contiene los views estáticos del sitio
 *
 * funciones disponibles en el primer release:
 * - index
 * - indexv2
 * - whatis
 * - opendata
 * - apicontratos
 * - apisuppliers
 * - apioffices
 * - apitenders
 * - contact
 * - terms
 * - glossary
 *
 */
class Frontend extends Controller {

	//
	// La primera versión del inicio
	// No tiene acceso mediante el url
	//
	public function index()
	{
		$data                = [];
    $data['title']       = 'Contrataciones Abiertas de la CDMX';
    $data['description'] = 'Contrataciones Abiertas de la Ciudad de México';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
    $data['body_class']  = 'home';
    return view("frontend.home")->with($data);
	}


	//
	// La página de inicio
	// el landing page del portal
	// Se accede a esta función mediante:
	// /
	//
	public function indexv2(){
		$contracts_amount	 = ContractData::sum("contracts");
		$contracts_number	 = Contract::all()->count();
		/*
		$contracts_number	 = SingleContract::whereHas("release", function($q){
			$q->where("is_latest", 1);
		})->count(); //Provider::sum('award_num');
		*/

		$data                     = [];
		$data['title']            = 'Contrataciones Abiertas de la CDMX';
		$data['description']      = 'Contrataciones Abiertas de la Ciudad de México';
		$data['og_image']         = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']       = 'home2';
		$data['contracts_amount'] = $contracts_amount;
		$data['contracts_number'] = $contracts_number;

		return view("frontend.homev2")->with($data);
	}
	
	//
	// Qué son las contrataciones abiertas
	// Se accede a esta función mediante:
	// por-que
	//
	public function whatis(){
		$data                = [];
		$data['title']       = 'Qué son las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Qué son las Contrataciones Abiertas de la Ciudad de México';
		$data['og_image']	   = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'queson';
		return view("frontend.what")->with($data);
	}
	
	//
	// El directorio de datos abiertos
	// Se accede a esta función mediante:
	// datos-abiertos
	//
	public function opendata(){
		$data                = [];
		$data['title']       = 'Cómo usar los datos de las Contrataciones Abiertas de la Ciudad de México';
		$data['description'] = 'Información para usar el estándar de datos para las contrataciones públicas de la CDMX';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos';
		return view("frontend.opendata")->with($data);
	}
	
	//
	// El api contratos
	// Se accede a esta función mediante:
	// datos-abiertos/documentacion-api-contratos
	//
	public function apicontratos(){
		$data                = [];
		$data['title']       = 'Documentación de API de Contratos de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Contratos de la CDMX';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_contracts")->with($data);
	}
	
	//
	//
	// El api de proveedores
	// Se accede a esta función mediante:
	// datos-abiertos/documentacion-api-proveedores
	//
	public function apisuppliers(){
		$data                = [];
		$data['title']       = 'Documentación de API de Proveedores de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Proveedores de la CDMX';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_suppliers")->with($data);
	}
	
	//
	// El api dependencias
	// Se accede a esta función mediante:
	// datos-abiertos/documentacion-api-dependencias
	//
	public function apioffices(){
		$data                = [];
		$data['title']       = 'Documentación de API de Dependencias de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Dependencias de la CDMX';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_offices")->with($data);
	}
	
	//
	// El api licitaciones
	// Se accede a esta función mediante:
	// datos-abiertos/documentacion-api-licitaciones
	//
	public function apitenders(){
		$data                = [];
		$data['title']       = 'Documentación de API de Licitaciones de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Licitaciones de la CDMX';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_tenders")->with($data);
	}
	
	//
	// Contacto
	// Se accede a esta función mediante:
	// contacto
	//
	public function contact(){
		$data                = [];
		$data['title']       = 'Contacto | Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Contacto | Contrataciones Abiertas de la Ciudad de México';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'contact';
		return view("frontend.contact")->with($data);
	}
	
	//
	// Términos de uso
	// Se accede a esta función mediante:
	// privacidad
	//
	public function terms(){
		$data                = [];
		$data['title']       = 'Privacidad y Términos | Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Privacidad y Términos | Contrataciones Abiertas de la Ciudad de México';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'terms';
		return view("frontend.terms")->with($data);
	}
	
	//
	// Glosario
	// Se accede a esta función mediante:
	// glosario
	//
	public function glossary(){
		$data                = [];
		$data['title']       = 'Glosario de Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Glosario de Contrataciones Abiertas de la Ciudad de México';
		$data['og_image']    = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'glosario';
		return view("frontend.glossary")->with($data);
	}

}
