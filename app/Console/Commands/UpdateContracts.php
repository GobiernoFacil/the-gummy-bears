<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Models\Address;
use App\Models\Award;
use App\Models\AwardProvider;
use App\Models\Buyer;
use App\Models\ContactPoint;
use App\Models\Contract;
use App\Models\ContractHistory;
use App\Models\Implementation;
use App\Models\Item;
use App\Models\Milestone;
use App\Models\Office;
use App\Models\Planning;
use App\Models\ProcuringEntity;
use App\Models\Provider;
use App\Models\Publisher;
use App\Models\Release;
use App\Models\SingleContract;
use App\Models\Supplier;
use App\Models\Tender;
use App\Models\Tenderer;
use App\Models\TenderProvider;
use App\Models\TenderTenderer;
use App\Models\Transaction;

use DB;


class UpdateContracts extends Command {
  /*
  * 
  * T H E   E N D P O I N T S  
  *
  */
  public $apiContratos;
  public $apiContrato;
  public $apiProveedores;
  const MAX_YEARS = 5;


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
      //$this->apiContratos = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/listarcontratos';
      $this->apiContratos   = 'http://10.1.129.11:9009/ocpcdmx/listarcontratos';
      //$this->apiContrato  = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/contratos';
      $this->apiContratos   = 'http://10.1.129.11:9009/ocpcdmx/contratos';
      //$this->apiProveedores = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/cproveedores';
      $this->apiContratos   = 'http://10.1.129.11:9009/ocpcdmx/cproveedores';
      //$this->dependencias = "http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/cdependencias";
      $this->dependencias   = "http://10.1.129.11:9009/ocpcdmx/cdependencias";
    }
    // PUBLIC ENDPOINTS
    else{
      //$this->apiContratos = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/listarcontratos';
      $this->apiContratos   = 'http://187.141.34.209:9009/ocpcdmx/listarcontratos';
      //$this->apiContrato  = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/contratos';
      $this->apiContratos   = 'http://187.141.34.209:9009/ocpcdmx/contratos';
      //$this->apiProveedores = 'http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/cproveedores';
      $this->apiContratos   = 'http://187.141.34.209:9009/ocpcdmx/cproveedores';
      //$this->dependencias = "http://grpap01.sap.finanzas.df.gob.mx:8000/sap(bD1lcyZjPTMwMA==)/bc/bsp/sap/zocpcdmx/cdependencias";
      $this->dependencias   = "http://10.1.129.11:9009/ocpcdmx/cdependencias";
    }
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
    // [0] DELETE ALL THE DATA!!!!!!
    $this->deleteAll();

    // [0.5] obtiene la info de todas las dependencias
    $this->info('obteniendo lista de dependencias');
    $dependencies = $this->getOffices();
    $this->info('listo');

    // [1] obtiene la lista de contractos
    $this->info('obteniendo la lista de contratos:');
    $contracts = $this->getList($dependencies);
    $this->info('Listo!');

    // [2] obtiene la información completea de cada contracto
    foreach($contracts as $contract){
      $this->info('obteniendo la información de: ' . $contract->ocdsid);
      $data     = ['dependencia' => $contract->cvedependencia, 'contrato' => $contract->ocdsid];
        $response = $this->apiCall($data, $this->apiContrato);

        if(!empty($response) && ! property_exists($response, 'error')){
          // [2.1] se actualizan los metadatos del contrato
          //       de hecho, solo se actualiza la fecha de publicación en formato Y-m-d
          $contract = $this->updateContract($contract, $response);
          $this->info('se actualizó la información de: ' . $contract->ocdsid);
          
          // [2.2] se crea/edita el autor del documento
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
          //     - saveImplementation
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
        $this->info("se creó el release #{$release->local_id} de: {$contract->ocdsid}");

        $buyer = $this->saveBuyer($rel);
        $this->info("se registró el comprador para el release #{$release->local_id} de: {$contract->ocdsid}");
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
        $buyer = Buyer::where('local_id', $data->buyer->identifier->id)->first();

        if(!$buyer){
          $buyer = Buyer::firstOrCreate([
            "local_id" => $data->buyer->identifier->id,
            "name"     => $data->buyer->name
          ]);

          $buyer->uri = $data->buyer->identifier->uri;
          $buyer->update();

          $buyer->contact()->create([
            "name"       => $data->buyer->contactPoint->name,
            "email"      => $data->buyer->contactPoint->email,
            "telephone"  => $data->buyer->contactPoint->telephone,
            "fax_number" => $data->buyer->contactPoint->faxNumber,
            "url"        => $data->buyer->contactPoint->url
          ]);

          $buyer->address()->create([
            "street_address" => $data->buyer->address->streetAddress,
            "locality"       => $data->buyer->address->locality,
            "region"         => $data->buyer->address->region,
            "postal_code"    => $data->buyer->address->postalCode,
            "country_name"   => $data->buyer->address->countryName,
          ]);

          $this->info("se registró a {$buyer->name} como comprador");
        }
        return $buyer;
      }
      else{
        $this->error('no hay información del comprador!');
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
        $tender->procurement_method_rationale = $tn->procurementMethodRationale;
        $tender->award_criteria       = $tn->awardCriteria;
        $tender->award_criteria_details = $tn->awardCriteriaDetails;
        $tender->tender_start         = $tn->tenderPeriod ? date("Y-m-d", strtotime($tn->tenderPeriod->startDate)) : null;
        $tender->tender_end           = $tn->tenderPeriod ? date("Y-m-d", strtotime($tn->tenderPeriod->endDate)) : null;
        $tender->enquiry_start        = $tn->enquiryPeriod ? date("Y-m-d", strtotime($tn->enquiryPeriod->startDate)) : null;
        $tender->enquiry_end          = $tn->enquiryPeriod ? date("Y-m-d", strtotime($tn->enquiryPeriod->endDate)) : null;
        $tender->award_start          = $tn->awardPeriod ? date("Y-m-d", strtotime($tn->awardPeriod->startDate)) : null;
        $tender->award_end            = $tn->awardPeriod ? date("Y-m-d", strtotime($tn->awardPeriod->endDate)) : null;
        $tender->has_enquiries        = $tn->hasEnquiries;
        $tender->eligibility_criteria = $tn->eligibilityCriteria;
        $tender->submission_method    = count($tn->submissionMethod) ? implode(',',$tn->submissionMethod) : null; 
        $tender->submission_method_details = $tn->submissionmethoddetails;
        $tender->number_of_tenderers  = $tn->numberOfTenderers;
        $tender->buyer_id             = $release->buyer_id;

        $tender->update();
        
        $this->saveItems($tender, $tn);
        $this->saveTenderers($tender, $tn);
        $this->saveProviers($tender, $tn, "tender");
        $this->saveDocuments($tender, $tn);
        $this->saveProcuringEntity($tender, $tn);
      }
    }

    //
    // [ U P D A T E   T E N D E R E R S ]
    //
    //
    private function saveTenderers($tender, $data){
      if(count($data->tenderers)){
        foreach($data->tenderers as $tn){

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


          $tenderer->contact()->firstOrCreate([
            "name"       => $tn->contactPoint->name,
            "email"      => $tn->contactPoint->email,
            "telephone"  => $tn->contactPoint->telephone,
            "fax_number" => $tn->contactPoint->faxNumber,
            "url"        => $tn->contactPoint->url
          ]);

          $tenderer->address()->firstOrCreate([
            "street_address" => $tn->address->streetAddress,
            "locality"       => $tn->address->locality,
            "region"         => $tn->address->region,
            "postal_code"    => $tn->address->postalCode,
            "country_name"   => $tn->address->countryName
          ]);




          $tenderer->update();
        }
      }
    }

    //
    // [ U P D A T E   P R O C U R I N G   E N T I T Y ]
    //
    //
    private function saveProcuringEntity($tender, $data){
      if($data->procuringEntity){
        $procuringEntity = ProcuringEntity::where("_id", $data->procuringEntity->identifier->id)->first();
        if(!$procuringEntity){
          $procuringEntity = ProcuringEntity::firstOrCreate([
            "_id"  => $data->procuringEntity->identifier->id,
            "name" => $data->procuringEntity->name
          ]);

          // TenderTenderer

          //$procuringEntity->name = $data->procuringEntity->name;
          $procuringEntity->uri  = $data->procuringEntity->identifier->uri;


          $procuringEntity->contact()->create([
            "name"       => $data->procuringEntity->contactPoint->name,
            "email"      => $data->procuringEntity->contactPoint->email,
            "telephone"  => $data->procuringEntity->contactPoint->telephone,
            "fax_number" => $data->procuringEntity->contactPoint->faxNumber,
            "url"        => $data->procuringEntity->contactPoint->url
          ]);

          $procuringEntity->address()->create([
            "street_address" => $data->procuringEntity->address->streetAddress,
            "locality"       => $data->procuringEntity->address->locality,
            "region"         => $data->procuringEntity->address->region,
            "postal_code"    => $data->procuringEntity->address->postalCode,
            "country_name"   => $data->procuringEntity->address->countryName
          ]);
        }



        $tender->procuring_entity_id = $procuringEntity->id;
        $tender->update();
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

        $planning->amount      = $data->planning->budget->amount->amount;
        $planning->currency    = $data->planning->budget->amount->currency;
        $planning->project     = $data->planning->budget->project;
        $planning->description = $data->planning->budget->description;

        $planning->multi_year    = empty($data->planning->budget->multiYear) ? 0 : 1;
        $planning->amount_year   = empty($data->planning->budget->amountyear) ? null : $data->planning->budget->amountyear->amount;
        $planning->currency_year = empty($data->planning->budget->amountyear) ? null : $data->planning->budget->amountyear->currency;

        $planning->update();

        $this->saveDocuments($planning, $data->planning);
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
          //$contract->documents      = count($s->documents);
          $contract->buyer_id       = $release->buyer_id;

          $contract->multi_year    = empty($s->multiYear) ? 0 : 1;
          $contract->amount_year   = empty($s->valueyear) ? null : $s->valueyear->amount;
          $contract->currency_year = empty($s->valueyear) ? null : $s->valueyear->currency;

          $contract->update();
          
          $this->saveItems($contract, $s);
          $this->saveDocuments($contract, $s);
          if(isset($s->implementation)){
            $this->saveImplementation($release, $contract, $s->implementation);
          }
        }
      }
    }

    //
    // [ S A V E   I M P L E M E N T A T I O N ]
    //
    //
    private function saveImplementation($release, $contract, $data){
      $implementation = Implementation::firstOrCreate([
        "contract_id" => $contract->id,
        "release_id"  => $release->id
      ]);

      //$implementation->release_id = $release->id;
      $implementation->update();

      $this->saveMilestones($implementation, $data);
      $this->saveTransactions($implementation, $data);
      $this->saveDocuments($implementation, $data);
    }

    //
    // [ S A V E   M I L E S T O N E S ]
    //
    //
    private function saveMilestones($implementation, $data){
      if(count($data->milestones)){
        foreach($data->milestones as $ml){
          $milestone = Milestone::firstOrCreate([
            "implementation_id" => $implementation->id,
            "local_id"          => $ml->id
          ]);

          $milestone->title       = $ml->title;
          $milestone->description = $ml->description;
          $milestone->status      = $ml->status;
          $milestone->date        = date("Y-m-d", strtotime($ml->dueDate));
          
          $milestone->update();
        }
      }
    }

    //
    // [ S A V E   T R A N S A C T I O N S ]
    //
    //
    private function saveTransactions($implementation, $data){
      if(count($data->transactions)){
        foreach($data->transactions as $tr){
          $transaction = Transaction::firstOrCreate([
            "implementation_id" => $implementation->id,
            "local_id"          => $tr->id
          ]);

          $transaction->date          = date("Y-m-d", strtotime($tr->date));
          $transaction->amount        = $tr->amount->amount;
          $transaction->currency      = $tr->amount->currency;
          $transaction->provider_id   = $tr->providerOrganization->id;
          $transaction->provider_name = $tr->providerOrganization->legalName;
          $transaction->provider_uri  = $tr->providerOrganization->uri;
          $transaction->receiver_id   = $tr->receiverOrganization->id;
          $transaction->receiver_name = $tr->receiverOrganization->legalName;
          $transaction->receiver_uri  = $tr->receiverOrganization->uri;

          $transaction->update();
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
          $award->title              = $aw->title;
          $award->description        = $aw->description;
          $award->status             = $aw->status;
          $award->date               = date("Y-m-d", strtotime($aw->date));
          $award->value              = $aw->value->amount;
          $award->currency           = $aw->value->currency;
          $award->exchange_rate      = empty($aw->value->exchangeRate) ? null : $aw->value->exchangeRate;
          $award->date_exchange_rate = empty($aw->value->dateexchangeRate) ? null : date("Y-m-d", strtotime($aw->value->dateexchangeRate));
          $award->buyer_id           = $release->buyer_id;

          
          $award->multi_year     = empty($aw->multiYear) ? 0 : $aw->multiYear;
          $award->amount_year    = empty($aw->valueyear) ? null : $aw->valueyear->amount;
          $award->currency_year  = empty($aw->valueyear) ? null : $aw->valueyear->currency;
          

          $award->update();

          $this->saveItems($award, $aw);
          $this->saveDocuments($award, $aw);
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


          $supplier->contact()->firstOrCreate([
            "name"       => $sup->contactPoint->name,
            "email"      => $sup->contactPoint->email,
            "telephone"  => $sup->contactPoint->telephone,
            "fax_number" => $sup->contactPoint->faxNumber,
            "url"        => $sup->contactPoint->url
          ]);

          $supplier->address()->firstOrCreate([
            "street_address" => $sup->address->streetAddress,
            "locality"       => $sup->address->locality,
            "region"         => $sup->address->region,
            "postal_code"    => $sup->address->postalCode,
            "country_name"   => $sup->address->countryName
          ]);



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

          if(empty($it->id)){
            // ignore the items that doesnt have id
            continue;
          }

          $item = $parent->items()->firstOrCreate([
            'local_id'  => $it->id
          ]);

          $item->quantity    = $it->quantity;
          $item->description = $it->description;
          $item->unit        = $it->unit->name;

          if(!empty($item->deliveryLocation)){
            $item->lat = $it->deliveryLocation->geometry->coordinates[0][0];
            $item->lng = $it->deliveryLocation->geometry->coordinates[0][1];
            $item->point = "({$item->lat} {$item->lng})";
          }

          $item->update();

        }
      }
    }

    //
    // [ U P D A T E   D O C U M E N T S ]
    //
    //
    private function saveDocuments($parent, $data){
      if(count($data->documents)){
        foreach($data->documents as $doc){
          $document = $parent->documents()->firstOrCreate([
            'local_id' => $doc->id
          ]);

          $document->date_published = $doc->datePublished;
          $document->date           = date("Y-m-d", strtotime($doc->datePublished));
          $document->format         = $doc->format;
          $document->local_id       = $doc->id;
          $document->language       = $doc->language;
          $document->title          = $doc->title;
          $document->url            = $doc->url;

          $document->update();
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
      $contract->published_date = empty($data->publishedDate) ? date("Y-m-d") : date("Y-m-d", strtotime($data->publishedDate));
      $contract->uri = $data->uri;
      $contract->update();

      return $contract;
    }

    //
    // [ G E T   A L L   O F F I C E S ]
    //
    //
    private function getOffices(){
      $offices = [];
      $data    = $this->apiCall([], $this->dependencias);

      if(!is_array($data)){
        $x = var_export($data, true);
        $this->error($x);
        $this->error("no está conectando con el api de contratos"); 
        die(":D");
      }

      forEach($data as $_office){

        $office = Office::firstOrCreate([
          "_id"  => $_office->id,
          "name" => $_office->name
        ]);

        $office->contact()->create([
          "name"       => $_office->contactPoint->name,
          "email"      => $_office->contactPoint->email,
          "telephone"  => $_office->contactPoint->telephone,
          "fax_number" => $_office->contactPoint->faxNumber,
          "url"        => $_office->contactPoint->url
        ]);

        $office->address()->create([
          "street_address" => $_office->address->streetAddress,
          "locality"       => $_office->address->locality,
          "region"         => $_office->address->region,
          "postal_code"    => $_office->address->postalCode,
          "country_name"   => $_office->address->countryName,
        ]);

        $offices[] = $office;
      }

      return $offices;
    }

    //
    // [ G E T   L A S T   T H R E E   Y E A R S   O F   D A T A ]
    //
    //
    private function getList($offices = []){
      $contracts = [];
      
      // GET THE LIST FROM THE API
      for($i = 0; $i < self::MAX_YEARS; $i ++){
        forEach($offices as $office){
          $year      = date("Y") - $i;
          $this->info("Se están descargando contratos para: " . $office->_id . " en el ejercicio " . $year);
          $data      = ['dependencia' => $office->_id, "ejercicio" => $year]; // harcoded stuff
          $excercise = $this->apiCall($data, $this->apiContratos);
          if(!is_array($excercise)){
            $x = var_export($excercise, true);
            $this->info($x);
            $this->error($x);
            $this->error("no está conectando con el api de contratos"); 
            die(":D");
          }
          $contracts = array_merge($contracts, $excercise);
        }
      }

      // SAVE THEM TO THE DB
      $response = [];
      forEach($contracts as $c){
        $contract = Contract::firstOrCreate([
          'ocdsid' => $c->ocdsID
        ]);
        $contract->ejercicio      = (int)$c->ejercicio;
        $contract->cvedependencia = $c->cveDependencia;
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
      //curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
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

  protected function deleteAll(){
    $this->info("se van a eliminar los datos de la DB");
    DB::table('addresses')->truncate();       
    DB::table('amounts')->truncate();           
    DB::table('awards')->truncate();            
    DB::table('buyer_providers')->truncate();   
    DB::table('buyers')->truncate();            
    DB::table('classifications')->truncate();   
    DB::table('contact_points')->truncate();    
    DB::table('contracts')->truncate();         
    DB::table('contracts_data')->truncate();    
    DB::table('contracts_history')->truncate(); 
    DB::table('documents')->truncate();         
    DB::table('identifiers')->truncate();       
    DB::table('implementations')->truncate();   
    DB::table('items')->truncate();                    
    DB::table('milestones')->truncate();
    DB::table('offices')->truncate();           
    DB::table('organizations')->truncate();     
    DB::table('password_resets')->truncate();
    DB::table('procuring_entities')->truncate();
    DB::table('periods')->truncate();           
    DB::table('plannings')->truncate();         
    DB::table('provider_award')->truncate();    
    DB::table('provider_tender')->truncate();   
    DB::table('providers')->truncate();         
    DB::table('publishers')->truncate();        
    DB::table('releases')->truncate();          
    DB::table('single_contracts')->truncate();  
    DB::table('suppliers')->truncate();         
    DB::table('tags')->truncate();              
    DB::table('tender_tenderer')->truncate();   
    DB::table('tender_tenderers')->truncate();  
    DB::table('tenderers')->truncate();         
    DB::table('tenders')->truncate();           
    DB::table('transactions')->truncate();      
    DB::table('users')->truncate(); 

    $this->info("se han borrado todos los datos de la DB");
  }

}
