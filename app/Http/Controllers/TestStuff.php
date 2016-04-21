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
use App\Models\TenderTenderer;

class TestStuff extends Controller {

	public function index()
	{
    $suppliers = Supplier::all();
    $contracts = Contract::with("releases")->get();
    $tenders = Tender::all();


		return view('test')->with([
      "suppliers" => $suppliers,
      "contracts" => $contracts,
      "tenders" => $tenders
      ]);
	}

  public function supplier($rfc){
    $supplier = Supplier::where("rfc", $rfc)->get()->first();
    
    $tenders = Tender::whereHas("tenderers", function($query) use($supplier){
      $query->where("rfc", $supplier->rfc);
    })->get();
    
    $awards = Award::whereHas("suppliers", function($query) use($supplier){
       $query->where("rfc", $supplier->rfc);
    })->get();

    return view('test2')->with([
      "supplier" => $supplier,
      "tenders"  => $tenders,
      "awards"   => $awards
    ]);
  }

}
