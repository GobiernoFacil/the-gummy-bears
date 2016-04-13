<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
		$data                = [];
    $data['title']       = 'Contrataciones Abiertas de la CDMX';
    $data['description'] = 'Contrataciones Abiertas de la Ciudad de México';
		$og_image			       = "img/og/contrataciones-abiertas-cdmx.png";
    $data['body_class']  = 'home2';
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
