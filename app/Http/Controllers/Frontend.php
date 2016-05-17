<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\SingleContract;
use App\Models\Provider;
use App\Models\ContractData;

class Frontend extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data                = [];
    $data['title']       = 'Contrataciones Abiertas de la CDMX';
    $data['description'] = 'Contrataciones Abiertas de la Ciudad de México';
		$og_image			       = "img/og/contrataciones-abiertas-cdmx.png";
    $data['body_class']  = 'home';
    return view("frontend.home")->with($data);
	}


	//
	//
	//HOME
	//
	public function indexv2(){
		$contracts_amount	 = ContractData::sum("contracts");
		$contracts_number	 = SingleContract::whereHas("release", function($q){
			$q->where("is_latest", 1);
		})->count(); //Provider::sum('award_num');

		$data                = [];
		$data['title']       = 'Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Contrataciones Abiertas de la Ciudad de México';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'home2';
		
		$data['contracts_amount']  = $contracts_amount;
		$data['contracts_number']  = $contracts_number;

		return view("frontend.homev2")->with($data);
	}
	
	//
	//
	//whatis
	//
	public function whatis(){
		$data                = [];
		$data['title']       = 'Qué son las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Qué son las Contrataciones Abiertas de la Ciudad de México';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'queson';
		return view("frontend.what")->with($data);
	}
	
	//
	//
	//opendata
	//
	public function opendata(){
		$data                = [];
		$data['title']       = 'Cómo usar los datos de las Contrataciones Abiertas de la Ciudad de México';
		$data['description'] = 'Información para usar el estándar de datos para las contrataciones públicas de la CDMX';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos';
		return view("frontend.opendata")->with($data);
	}
	
	//
	//
	//api contratos
	//
	public function apicontratos(){
		$data                = [];
		$data['title']       = 'Documentación de API de Contratos de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Contratos de la CDMX';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_contracts")->with($data);
	}
	
	//
	//
	//api proveedores
	//
	public function apisuppliers(){
		$data                = [];
		$data['title']       = 'Documentación de API de Proveedores de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Proveedores de la CDMX';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_suppliers")->with($data);
	}
	
	//
	//
	//api dependencias
	//
	public function apioffices(){
		$data                = [];
		$data['title']       = 'Documentación de API de Dependencias de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Dependencias de la CDMX';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_offices")->with($data);
	}
	
	//
	//
	//api licitaciones
	//
	public function apitenders(){
		$data                = [];
		$data['title']       = 'Documentación de API de Licitaciones de las Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Información sobre el API de Licitaciones de la CDMX';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'datos api';
		return view("frontend.documentation.api_tenders")->with($data);
	}
	
	//
	//
	//Contacto
	//
	public function contact(){
		$data                = [];
		$data['title']       = 'Contacto | Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Contacto | Contrataciones Abiertas de la Ciudad de México';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'contact';
		return view("frontend.contact")->with($data);
	}
	
	//
	//
	//terms
	//
	public function terms(){
		$data                = [];
		$data['title']       = 'Privacidad y Términos | Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Privacidad y Términos | Contrataciones Abiertas de la Ciudad de México';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'terms';
		return view("frontend.terms")->with($data);
	}
	
	//
	//
	//Glosario
	//
	public function glossary(){
		$data                = [];
		$data['title']       = 'Glosario de Contrataciones Abiertas de la CDMX';
		$data['description'] = 'Glosario de Contrataciones Abiertas de la Ciudad de México';
		$og_image			 = "img/og/contrataciones-abiertas-cdmx.png";
		$data['body_class']  = 'glosario';
		return view("frontend.glossary")->with($data);
	}

}
