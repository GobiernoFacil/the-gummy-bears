<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Tenderer;
use App\Models\Tender;

class Suppliers extends Controller {
	//
	// Suppliers list
	//	
	public function index(){
		
	}

	//
	// Supplier 
	//
	public function show($id){
		$supplier 			     = Tenderer::where("id", $id)->get()->first();
		$contracts 			     = Contract::all();
		$data                = [];
		$data['title']       = $supplier->name;
		$data['description'] = 'Proveedor';
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'proveedor';
		
		$data['contracts']  = $contracts;
		$data['supplier']   = $supplier;
		
		return view("frontend.supplier")->with($data);
	}
}
