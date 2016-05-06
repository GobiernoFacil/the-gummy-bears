<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Contract;
use App\Models\ContractData;
use App\Models\Planning;
use App\Models\Award;
use App\Models\SingleContract;
use App\Models\Supplier;
use App\Models\Provider;
use App\Models\Buyer;

class Offices extends Controller {
	//
	//[ Offices list ]
	//	
	//
	public function index(){
		$contracts 			 = Contract::all();
		$data                = [];
		$data['title']       = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['description'] = 'Dependencias de la CDMX con Contrataciones Abiertas';
		$data['og_image']	   = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'dependencia';
		
		$data['contracts']   = $contracts;
		
		return view("frontend.offices")->with($data);
	}
	
	public function show($id){
		$buyer				 = Buyer::where('id',$id)->get()->first();
		$contracts 			 = Contract::where('cvedependencia',$buyer->local_id)->get();
		$awards 			 = Award::all();
		$singlecont_count 	 = SingleContract::all()->count();
		$providers			 = Provider::orderby('budget', 'desc')->take(5)->get();
		$providers_count 	 = Provider::all()->count();
		
		$contract_data		= ContractData::orderby('contracts', 'desc')->take(5)->get();;
		
		//total
		$total_planning		= Planning::sum('amount');
		$total_award		= Award::sum('value');
		$total_contract		= SingleContract::sum('amount');
		
		///percentage
		$max				= max(array($total_planning, $total_award, $total_contract));
		$per_planning		= ($total_planning *100)/$max;	
		$per_award			= ($total_award *100)/$max;		
		$per_contract		= ($total_contract *100)/$max;
		
		$data                = [];
		$data['title']       = $buyer->name . ' de la CDMX con Contrataciones Abiertas';
		$data['description'] = $buyer->name . ' de la CDMX con Contrataciones Abiertas';
		$data['og_image']	 = "img/og/contrato-cdmx.png";
		$data['body_class']  = 'dependencia';
		
		$data['buyer']   	 		 = $buyer;
		$data['contracts']   		 = $contracts;
		$data['awards']   	 		 = $awards;
		$data['singlecont_count']    = $singlecont_count;
		$data['providers']   	 	 = $providers;
		$data['providers_count']   	 = $providers_count;
		$data['total_planning']   	 = $total_planning;
		$data['total_award']   	 	 = $total_award;
		$data['total_contract']   	 = $total_contract;
		$data['per_planning']   	 = $per_planning;
		$data['per_award']   	 	 = $per_award;
		$data['per_contract']   	 = $per_contract;	
		$data['contract_data']   	 = $contract_data;	
		
		return view("frontend.office")->with($data);
	}
}
