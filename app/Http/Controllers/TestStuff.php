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

  public function providers(){
    $providers = Provider::all();
    echo "<pre>";
    foreach($providers as $provider){
      $counter = 0;
      foreach($provider->awards as $award){
        $aw = $award->release->singlecontracts->where("award_id", $award->local_id)->first();
        $counter+= $aw ? $aw->amount : 0;

      }
      echo "<p>" . $provider->name . ": " . $counter . "</p>";
    }
    echo "</pre>";
  }

  public function get_latest_release($rfc){
    $contracts = Contract::with(["releases" => function($query){
      $query->orderBy("local_id", "desc")->take(1);
    }])->get();
  }

}
