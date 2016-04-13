<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Supplier;

class ApiCDMX extends Controller {

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


}
