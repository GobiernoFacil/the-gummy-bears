<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\Award;
use App\Models\Buyer;
use App\Models\Contract;
use App\Models\ContractData;
use App\Models\ContractHistory;
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
use App\Models\BuyerProvider;

class OptimizeQueries extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'contracts:optimize';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$contracts = Contract::all();
    Release::has("contract")->update(["is_latest" => 0]);

    foreach($contracts as $contract){
      // [1] Genera un historial de presupuesto
      if(!$contract->releases->count()){
        $this->error('el contrato' . $contract->ocdsid . ' no tiene ningún release');
        continue;
      }
      else{
        foreach($contract->releases as $release){
          $history = ContractHistory::firstOrCreate([
            "contract_id" => $contract->id,
            "release_id"  => $release->id
          ]);

          if($release->planning){
            $history->ocdsid    = $contract->ocdsid;
            $history->local_id  = $release->local_id;
            $history->planning  = $release->planning->amount + $release->planning->amount_year;
            $history->tender    = $release->tender->amount;
            $history->awards    = $release->awards->sum('value') + $release->awards->sum('amount_year');
            $history->contracts = $release->singlecontracts->sum('amount') + $release->awards->sum('amount_year');
            $history->date      = $release->date;
            $history->update();
            $this->info('se ha optimizado el historial del contrato: ' . $contract->ocdsid);
          } // if $release->planning
          else{
          	$history->ocdsid    = $contract->ocdsid;
            $history->local_id  = $release->local_id;
            $history->date      = $release->date;
            $history->update();
          	$this->error("este relase no tiene datos");
          } // else
        } // foreach($contract->releases as $release){
      } // else

      // [2] genera un agregado de presupuestos para el último release del contrato
      $release = ContractHistory::where("contract_id", $contract->id)->orderBy("local_id", "desc")->first();
      $release->release()->update(['is_latest' => 1]);
      $this->info("release {$release->id}: " . $release->is_latest);
    	$data = ContractData::firstOrCreate(["contract_id" => $contract->id]);
    	if($release->planning){
    	  $data->ocdsid     = $contract->ocdsid;
    	  $data->local_id   = $release->local_id;
        $data->planning   = $release->planning;
        $data->tender     = $release->tender;
        $data->awards     = $release->awards;
        $data->contracts  = $release->contracts;
        $data->date       = $release->date;
        $data->release_id = $release->id;

        $data->update();
        $this->info('se ha optimizado la información más reciente del contrato: ' . $contract->ocdsid);
      }
      else{
      	$this->error("este relase no tiene datos");
      } 
    } // foreach contracts  

    $providers = Provider::all();
    foreach($providers as $provider){

      // get data by buyer
      $buyers = $provider->tenders()->lists("buyer_id");
      foreach ($buyers as $buyer){
        $b = BuyerProvider::firstOrCreate([
          "buyer_id"    => $buyer,
          "provider_id" => $provider->id
        ]);

        $b->tender_num = $provider->tenders()->where("buyer_id", $buyer)->where(function($q){
          $q->WhereHas("release", function($query){
            $query->where("is_latest", 1);
          });
        })->count();

        $b->award_num = $provider->awards()->where("buyer_id", $buyer)->where(function($q){
          $q->WhereHas("release", function($query){
            $query->where("is_latest", 1);
          });
        })->count();

        $b->budget = $provider->awards()->where("buyer_id", $buyer)->where(function($q){
          $q->WhereHas("release", function($query){
            $query->where("is_latest", 1);
          });
        })->sum("value") + $provider->awards()->where("buyer_id", $buyer)->where(function($q){
          $q->WhereHas("release", function($query){
            $query->where("is_latest", 1);
          });
        })->sum("amount_year");
        /***********************************/
        // calculate the actual single contracts budget by buyer
        $counter = 0;
        $aw = $provider->awards()->where("buyer_id", $buyer)->where(function($q){
          $q->WhereHas("release", function($query){
            $query->where("is_latest", 1);
          });
        })->get();

        foreach($aw as $award){
          $_aw = $award->release->singlecontracts->where("buyer_id", $buyer)->where("award_id", $award->local_id)->first();
          $counter+= $_aw ? $_aw->amount : 0;
        }

        $b->contract_budget = $counter;
        /***********************************/

        $b->update();
      }

    	$provider->tender_num = $provider->tenders()->where(function($q){
    		$q->WhereHas("release", function($query){
    			$query->where("is_latest", 1);
    		});
    	})->count();

    	$provider->award_num = $provider->awards()->where(function($q){
    		$q->WhereHas("release", function($query){
    			$query->where("is_latest", 1);
    		});
    	})->count();

    	$provider->budget = $provider->awards()->where(function($q){
    		$q->WhereHas("release", function($query){
    			$query->where("is_latest", 1);
    		});
    	})->sum("value") + $provider->awards()->where(function($q){
        $q->WhereHas("release", function($query){
          $query->where("is_latest", 1);
        });
      })->sum("amount_year");

      // calculate the actual single contracts budget
      $counter = 0;
      $aw = $provider->awards()->where(function($q){
        $q->WhereHas("release", function($query){
          $query->where("is_latest", 1);
        });
      })->get();

      foreach($aw as $award){
        $_aw = $award->release->singlecontracts->where("award_id", $award->local_id)->first();
        $counter+= $_aw ? $_aw->amount : 0;
      }

      $provider->contract_budget = $counter;

    	$provider->update();
    }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['example', InputArgument::OPTIONAL, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

}
