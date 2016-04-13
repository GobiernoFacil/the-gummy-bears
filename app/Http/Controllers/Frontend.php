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
