<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\Award;
use App\Models\AwardProvider;
use App\Models\Buyer;
use App\Models\Contract;
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
use App\Models\TenderProvider;
use App\Models\TenderTenderer;


class UpdateContracts extends Command {
  /*
  * 
  * T H E   E N D P O I N T S  
  *
  */
  public $apiContratos;
  public $apiContrato;
  public $apiProveedores;


	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'contracts:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update contracts from CDMX API.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

    $endpoints = env('ENDPOINTS', 'production');

    if($endpoints == 'production'){
      // SERVER ENDPOINTS
      $this->apiContratos   = 'http://10.1.129.11:9009/ocpcdmx/listarcontratos';
      $this->apiContrato    = 'http://10.1.129.11:9009/ocpcdmx/contratos';
      $this->apiProveedores = 'http://10.1.129.11:9009/ocpcdmx/cproveedores';
    }
    // PUBLIC ENDPOINTS
    else{
      $this->apiContratos   = 'http://187.141.34.209:9009/ocpcdmx/listarcontratos';
      $this->apiContrato    = 'http://187.141.34.209:9009/ocpcdmx/contratos';
      $this->apiProveedores = 'http://187.141.34.209:9009/ocpcdmx/cproveedores';
    }
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
    // [1] obtiene la lista de contractos
      $this->info('obteniendo la lista de contratos:');
      $contracts = $this->getList();
      $this->info('Listo!');

      // [2] obtiene la información completea de cada contracto
      foreach($contracts as $contract){
        $this->info('obteniendo la información de: ' . $contract->ocdsid);
        $data     = ['dependencia' => $contract->cvedependencia, 'contrato' => $contract->ocdsid];
        $response = $this->apiCall($data, $this->apiContrato);

        if(!empty($response) && ! property_exists($response, 'error')){
          // [2.1] se actualizan los metadatos del contracto
          $contract = $this->updateContract($contract, $response);
          $this->info('se actualizó la información de: ' . $contract->ocdsid);
          
          // [2.2] se crea/edita el creador del documento
          $contract = $this->savePublisher($contract, $response);
          $this->info('se agregó el autor de: ' . $contract->ocdsid);

          // [2.3] se crean las versiones de la publicación
          // dentro se llaman las siguientes functiones:
          // 0. saveBuyer
          // 1. saveAwards
          //     - saveItems
          //     - saveSuppliers
          // 2. saveContracts
          //     - saveItems
          // 3. savePlanning
          // 4. saveTender
          //     - saveTenderers
          //     - saveItems
          $releases = $this->saveReleases($contract, $response);
          $this->info('se guardó la información completa de: ' . $contract->ocdsid);
        }
        else{
          $this->error('la información de ' . $contract->ocdsid . ' no está disponible');
        }
      }
	}

  //
    // [ U P D A T E   R E L E A S E S ]
    //
    //
    private function saveReleases($contract, $data){
      $releases = [];
      foreach($data->releases as $rel){
        $release = Release::firstOrCreate([
          "local_id"        => $rel->id,
          "contract_id"     => $contract->id,
          "ocid"            => $contract->ocdsid,
          "date"            => date("Y-m-d", strtotime($rel->date)),
          "initiation_type" => $rel->initiationType,
          "language"        => $rel->language
        ]);
        $this->info("se creó el release v{$release->local_id} de: {$contract->ocdsid}");

        $buyer = $this->saveBuyer($rel);
        $this->info("se creó el comprador para el release v{$release->local_id} de: {$contract->ocdsid}");
        $release->buyer_id = $buyer ? $buyer->id : null;
        $release->update();
        
        $releases[] = $release;
        $this->saveAwards($release, $rel);
        $this->info("se crearon los awards para el release v{$release->local_id} de: {$contract->ocdsid}");
        $this->saveContracts($release, $rel);
        $this->info("se crearon los contratos para el release v{$release->local_id} de: {$contract->ocdsid}");
        $this->savePlanning($release, $rel);
        $this->info("se creó la planeación para el release v{$release->local_id} de: {$contract->ocdsid}");
        $this->saveTender($release, $rel);
        $this->info("se creó la licitación para el release v{$release->local_id} de: {$contract->ocdsid}");
      }

      return $releases;
    }

    //
    // [ U P D A T E   B U Y E R ]
    //
    //
    private function saveBuyer($data){
      if($data->buyer){
        $buyer = Buyer::firstOrCreate([
          "local_id" => $data->buyer->identifier->id,
          "name"     => $data->buyer->name
        ]);

        $buyer->uri = $data->buyer->identifier->uri;
        $buyer->update();
        $this->info("buyer: {$buyer->id}");
        return $buyer;
      }
      else{
        $this->error('no hay buyer!');
        return null;
      }
    }

    //
    // [ U P D A T E   T E N D E R ]
    //
    //
    private function saveTender($release, $data){
      $tn = $data->tender;
      if($tn){
        $tender = Tender::firstOrCreate([
          "release_id" => $release->id
        ]);

        $tender->local_id             = $tn->id;
        $tender->title                = $tn->title;
        $tender->description          = $tn->description;
        $tender->status               = $tn->status;
        $tender->amount               = $tn->value ? $tn->value->amount : null;
        $tender->currency             = $tn->value ? $tn->value->currency : null;
        $tender->procurement_method   = $tn->procurementMethod;
        $tender->award_criteria       = $tn->awardCriteria;
        $tender->tender_start         = $tn->tenderPeriod ? date("Y-m-d", strtotime($tn->tenderPeriod->startDate)) : null;
        $tender->tender_end           = $tn->tenderPeriod ? date("Y-m-d", strtotime($tn->tenderPeriod->endDate)) : null;
        $tender->enquiry_start        = $tn->enquiryPeriod ? date("Y-m-d", strtotime($tn->enquiryPeriod->startDate)) : null;
        $tender->enquiry_end          = $tn->enquiryPeriod ? date("Y-m-d", strtotime($tn->enquiryPeriod->endDate)) : null;
        $tender->award_start          = $tn->awardPeriod ? date("Y-m-d", strtotime($tn->awardPeriod->startDate)) : null;
        $tender->award_end            = $tn->awardPeriod ? date("Y-m-d", strtotime($tn->awardPeriod->endDate)) : null;
        $tender->has_enquiries        = $tn->hasEnquiries;
        $tender->eligibility_criteria = $tn->eligibilityCriteria;
        $tender->submission_method    = count($tn->submissionMethod) ? implode(',',$tn->submissionMethod) : null; 
        $tender->number_of_tenderers  = $tn->numberOfTenderers;

        $tender->update();
        $this->saveItems($tender, $tn);
        $this->saveTenderers($tender, $tn);
         $this->saveProviers($tender, $tn, "tender");
      }
    }

    //
    // [ U P D A T E   T E N D E R E R S ]
    //
    //
    private function saveTenderers($tender, $data){
      if(count($data->tenderers)){
        foreach($data->tenderers as $tn){

          /*
          $tenderer = $tender->tenderers()->firstOrCreate([
            "rfc" => $tn->identifier->id
          ]);
          */

          $tenderer = Tenderer::firstOrCreate([
            "rfc" => $tn->identifier->id
          ]);

          $relation = TenderTenderer::firstOrCreate([
            'tender_id'   => $tender->id,
            'tenderer_id' => $tenderer->id
          ]);

          // TenderTenderer

          $tenderer->name         = $tn->name;
          $tenderer->street       = $tn->address->streetAddress;
          $tenderer->locality     = $tn->address->locality;
          $tenderer->region       = $tn->address->region;
          $tenderer->zip          = $tn->address->postalCode;
          $tenderer->country      = $tn->address->countryName;
          $tenderer->contact_name = $tn->contactPoint->name;
          $tenderer->email        = $tn->contactPoint->email;
          $tenderer->phone        = $tn->contactPoint->telephone;
          $tenderer->fax          = $tn->contactPoint->faxNumber;
          $tenderer->url          = $tn->contactPoint->url;

          $tenderer->update();
        }
      }
    }

    //
    // [ U P D A T E   P L A N N I N G ]
    //
    //
    private function savePlanning($release, $data){
      if($data->planning){
        $planning = Planning::firstOrCreate([
          "release_id" => $release->id
        ]);

        $planning->amount   = $data->planning->budget->amount->amount;
        $planning->currency = $data->planning->budget->amount->currency;
        $planning->project  = $data->planning->budget->project;

        $planning->update();
      }
    }

    //
    // [ U P D A T E   C O N T R A C T S  ]
    //
    //
    private function saveContracts($release, $data){
      $this->info("contratos: " . count($data->contracts));
      if(count($data->contracts)){
        foreach($data->contracts as $s){
          $contract = SingleContract::firstOrCreate([
            "local_id"   => $s->id,
            "release_id" => $release->id
          ]);

          $contract->award_id       = $s->awardID;
          $contract->title          = $s->title;
          $contract->description    = $s->description;
          $contract->status         = $s->status;
          $contract->contract_start = $s->period ? date("Y-m-d", strtotime($s->period->startDate)) : null;
          $contract->contract_end   = $s->period ? date("Y-m-d", strtotime($s->period->endDate)) : null;
          $contract->amount         = $s->value->amount;
          $contract->currency       = $s->value->currency;
          $contract->date_signed    = $s->dateSigned ? date("Y-m-d", strtotime($s->dateSigned)) : null;
          $contract->documents      = count($s->documents);
          // ? implode(',',$r->tender->submissionMethod) : null;

          $contract->update();
          $this->saveItems($contract, $s);
        }
      }
    }

    //
    // [ U P D A T E   A W A R D S ]
    //
    //
    private function saveAwards($release, $data){
      if(count($data->awards)){
        foreach($data->awards as $aw){
          $award = Award::firstOrCreate([
            "release_id" => $release->id,
            "local_id"   => $aw->id
          ]);

          $award->title       = $aw->title;
          $award->description = $aw->description;
          $award->status      = $aw->status;
          $award->date        = date("Y-m-d", strtotime($aw->date));
          $award->value       = $aw->value->amount;
          $award->currency    = $aw->value->currency;

          $award->update();
          $this->saveItems($award, $aw);
          $this->saveSuppliers($award, $aw);
          $this->saveProviers($award, $aw, "award");
        }
      }
      else{
        //
      }
    }

    //
    // [ U P D A T E   S U P P L I E R S ]
    //
    //
    private function saveSuppliers($award, $data){
      if(count($data->suppliers)){
        foreach($data->suppliers as $sup){
          $supplier = Supplier::firstOrCreate([
            "award_id" => $award->id,//$data->id,
            "rfc"      => $sup->identifier->id
          ]);

          $supplier->name         = $sup->name;
          $supplier->street       = $sup->address->streetAddress;
          $supplier->locality     = $sup->address->locality;
          $supplier->region       = $sup->address->region;
          $supplier->zip          = $sup->address->postalCode;
          $supplier->country      = $sup->address->countryName;
          $supplier->contact_name = $sup->contactPoint->name;
          $supplier->email        = $sup->contactPoint->email;
          $supplier->phone        = $sup->contactPoint->telephone;
          $supplier->fax          = $sup->contactPoint->faxNumber;
          $supplier->url          = $sup->contactPoint->url;

          $supplier->update();
        }
      }
    }

    //
    // [ UPDATE PROVIDERS ]
    //
    //
    private function saveProviers($event, $data, $type){
      if($type == "award"){
        $providers = $data->suppliers;
      }
      elseif($type == "tender"){
        $providers = $data->tenderers;
      }
      else{
        $providers = [];
      }

      foreach($providers as $sup){
        $provider = Provider::firstOrCreate([
            "rfc"      => $sup->identifier->id
        ]);

        $provider->name         = $sup->name;
        $provider->street       = $sup->address->streetAddress;
        $provider->locality     = $sup->address->locality;
        $provider->region       = $sup->address->region;
        $provider->zip          = $sup->address->postalCode;
        $provider->country      = $sup->address->countryName;
        $provider->contact_name = $sup->contactPoint->name;
        $provider->email        = $sup->contactPoint->email;
        $provider->phone        = $sup->contactPoint->telephone;
        $provider->fax          = $sup->contactPoint->faxNumber;
        $provider->url          = $sup->contactPoint->url;

        $provider->update();

        if($type == "tender"){
          $rel = TenderProvider::firstOrCreate([
            "provider_id" => $provider->id,
            "tender_id"   => $event->id
          ]);
        }
        elseif($type == "award"){
          $rel = AwardProvider::firstOrCreate([
            "provider_id" => $provider->id,
            "award_id"   => $event->id
          ]);
        }
        else{
          // O_____O
        }
      }
    }

    //
    // [ U P D A T E   I T E M S ]
    //
    //
    private function saveItems($parent, $data){
      if(count($data->items)){
        foreach($data->items as $it){
          $item = $parent->items()->firstOrCreate([
            'local_id'  => $it->id
          ]);

          $item->quantity    = $it->quantity;
          $item->description = $it->description;
          $item->unit        = $it->unit->name;

          $item->update();
        }
      }
    }

    //
    // [ U P D A T E   P U B L I S H E R ]
    //
    //
    private function savePublisher($contract, $data){
      // create the publisher
      $publisher = Publisher::firstOrCreate([
        "scheme" => $data->publisher->scheme,
        "name"   => $data->publisher->name,
        "uri"    => $data->publisher->uri,
        "uid"    => $data->publisher->uid
      ]);

      $contract->publisher_id = $publisher->id;
      $contract->update();
      return $contract;
    }

    //
    // [ U P D A T E   C O N T R A C T ]
    //
    //
    private function updateContract($contract, $data){
      // add extra data to contracts
      //$contract->uri = $data->uri;
      $contract->published_date = date("Y-m-d", strtotime($data->publishedDate));
      $contract->update();

      return $contract;
    }
    //
    // [ G E T   L A S T   T H R E E   Y E A R S   O F   D A T A ]
    //
    //
    private function getList(){
      $contracts = [];
      
      // GET THE LIST FROM THE API
      for($i = 0; $i < 3; $i ++){
        $year      = date("Y") - $i;
        $data      = ['dependencia' => '901', "ejercicio" => $year]; // harcoded stuff
        $excercise = $this->apiCall($data, $this->apiContratos);
        if(!is_array($excercise)){
          $x = var_export($excercise, true);
          $this->info($x);
          $this->error($x); 
          die(":D");
        }
        $contracts = array_merge($contracts, $excercise);
      }

      // SAVE THEM TO THE DB
      $response = [];
      forEach($contracts as $c){
        $contract = Contract::firstOrCreate([
          'ocdsid'         => $c->ocdsID
        ]);
        $contract->ejercicio      = (int)$c->ejercicio;
        $contract->cvedependencia = (int)$c->cveDependencia;
        $contract->nomDependencia = $c->nomDependencia;
        $contract->update();

        $response[] = $contract;
      }

      // RETURN THE ARRAY OF CONTRACTS
      return $response;
    }

    //
    // [ C A L L   T H E   C D M X   A P I ]
    //
    //
    private function apiCall($data, $endpoint){
      $ch = curl_init();
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $endpoint );
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));
      
      $result   = curl_exec($ch);
      $response = json_decode($result);

      return $response;
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
