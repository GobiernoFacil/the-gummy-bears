<div id="tender" class="container_info {{$elcontrato->awards->count() ? 'hide' : ''}}">
    <!--encabezado-->
	<div class="row divider">
		<div class="col-sm-4">
			<p class="title_section">Etapa <span class="i_tender"><b></b> Licitación</span></p>
		</div>
		<div class="col-sm-4">
        	<p class="title_section center">Identificador de Contratación Abierta</p>
        	<p class="ago center">{{$ocid}}</p>
    	</div>
	</div>
	<!-- title-->
    <div class="row divider">
    	<div class="col-sm-9">
			<p class="title_section">título</p>
			<h1>{{ $elcontrato->tender->title }}</h1>
    	</div>
		<div class="col-sm-3">
			<p class="title_section">Estatus de la licitación</p>
			<p><span class="label {{ $elcontrato->tender->status}}">
				{{ $elcontrato->tender->status == "complete" ? 'COMPLETA' : '' }}</span></p>
    	</div>
    </div>
    
    <div class="row divider">
	    <!--description-->
    	<div class="col-sm-6">
    		<p class="title_section">Descripción</p>
			<p>{{ $elcontrato->tender->description }}</p>
    	</div>
        <!--items-->
        <div class="col-sm-6">
            <p class="title_section">ARTÍCULOS</p>
            <ul>
                @foreach ($elcontrato->tender->items as $item)
                <li class="row">
                  <span class="col-sm-9">{{ $item->description }} </span>
                  <span class="col-sm-3">{{ $item->quantity }} {{ $item->unit}} </span>
                </li>
                @endforeach  
        	</ul>
        </div>
    </div>
    
    <div class="row divider">
        <!--monto licitado-->
        <div class="col-sm-4">
			<p class="title_section">MONTO ESTIMADO ({{$elcontrato->tender->currency}})</p>
              <?php $budget_amount = $elcontrato->tender->amount;?>
              <h2 class="amount"><span>$</span>{{ number_format($budget_amount,2, '.', ',') }}</h2>
        </div>
        
        <!--método de licitación-->
        <div class="col-sm-4">
        	<p class="title_section">método de licitación</p>
        	<?php switch ($elcontrato->tender->procurement_method){
        	  case "selective":
        	    $procurementMethod = "Selectiva";
        	    break;
        	  case "open":
        	    $procurementMethod = "Abierta";
        	    break;
        	  case "limited":
        	    $procurementMethod = "Limitada";
        	    break;
        	}?>
        	<p>{{ $procurementMethod }}</p>
        </div>
       
        <!--CRITERIOS DE ADJUDICACIÓN-->
        <div class="col-sm-4">
            <?php switch ($elcontrato->tender->award_criteria){
              case "lowestCost":
                $awardCriteria = "Costo más bajo";
                break;
              case "bestProposal":
                $awardCriteria = "Mejor Propuesta";
                break;
              case "bestValueToGovernment":
                $awardCriteria = "Mejor Retorno para Gobierno";
                break;
              case "singleBidOnly":
                $singleBidOnly = "Sólo una oferta";
                break;
            }?>
            <p class="title_section">CRITERIOS DE ADJUDICACIÓN</p>
            <p>{{ $awardCriteria }}</p>
        </div>
    </div>
    
    <div class="row divider">
		<!--Método de Presentación-->
		<div class="col-sm-4">
		<?php switch ($elcontrato->tender->submission_method){
    	  case "electronicAuction":
    	    $submission_method = "Licitación Electrónica";
    	    break;
    	  case "electronicSubmission":
    	    $submission_method = "Entrega de propuesta Electrónica";
    	    break;
    	  case "written":
    	    $submission_method = "Escrita";
    	    break;
    	  case "inPerson":
    	    $submission_method = "En Persona";
    	    break;
    	}?>
    	  <p class="title_section">Método de Presentación</p>
    	  <p>{{$submission_method}}
		</div>
		
		<!--hasEnquiries-->
		<div class="col-sm-4">
    		<p class="title_section">Solicitudes de información</p>
    		<p>{{ $elcontrato->tender->submission_method == true ? 'Sí' : 'No'}}</p>
		</div>
		<!-- eligibilityCriteria-->
		<div class="col-sm-4">
    		<p class="title_section">Criterios de elegibilidad</p>
    		<p>{{ $elcontrato->tender->eligibility_criteria }}</p>
		</div>
    </div>
          
    <div class="row divider">
		<!--numberOfTenderers-->
    	<div class="col-sm-8">
    		<p class="title_section"> {{ $elcontrato->tender->number_of_tenderers }} Licitantes  aplicaron</p>
			@if ($elcontrato->tender->tenderers->count())
			<ol>
		 		@foreach ($elcontrato->tender->tenderers as $tendererers)
		 		<li class="row">
		 			<div class="col-sm-7">
		 				<a href="{{ url('proveedor/'. $tendererers->rfc) }}">{{ $tendererers->name }}</a>
		 			</div>
		 			<div class="col-sm-5">
		 				{{$tendererers->locality }}, {{ $tendererers->region }}
		 			</div>
		 		</li>
		 		@endforeach
			</ol>
			@endif
    	</div>
    	
		<!--COMPRADOR-->
        <div class="col-sm-4">
        	<p class="title_section">COMPRADOR</p>
			<p><a href="{{ url('dependencia/'. $elcontrato->buyer->id) }}">{{ $elcontrato->buyer->name }}</a></p>
        </div>
    </div>
    <div class="row">
	    <!--DOCUMENTOS-->
        <div class="col-sm-8">
          <p class="title_section">DOCUMENTOS</p>
          <ol>
          @foreach ($elcontrato->tender->documents as $doc)
          	<li class="row">
          		<div class="col-sm-6">
          			<a href="{{$doc->url}}">{{$doc->title}}</a> 
          		</div>
          		<div class="col-sm-3">
          		{{date('d/m/Y', strtotime($doc->date))}}
          		</div>
		  		<div class="col-sm-3">
		  		  	{{$doc->format}}
		  		</div>
          	</li>
          @endforeach
          </ol>
        </div>
    </div>
    
    <?php /*
    <div class="row divider">
        <!--monto licitado-->
        <div class="col-sm-4">
              <p class="title_section">MONTO LICITADO ({{$elcontrato->tender->currency}})</p>
              <?php $budget_amount = $elcontrato->tender->amount;?>
              <h2 class="amount"><b class="budget"></b><span>$</span>{{ number_format($budget_amount,2, '.', ',') }}</h2>
            </div>
            <?php  $amount_gastado =  0;?>
              @foreach ($elcontrato->singlecontracts as $s)
              	@if($s->amount)
              		<?php  $amount_gastado 			  =  $amount_gastado + $s->amount;
	              		   $single_contract_currency = $s->currency;?>
              	@endif
              @endforeach
              
            <!--monto contratado-->
            <div class="col-sm-4">
              <p class="title_section">MONTO CONTRATADO ({{ !empty($single_contract_currency) ? $single_contract_currency  : '' }})</p>
              <h2 class="amount"><b class="spent"></b><span>$</span>{{ number_format($amount_gastado,2, '.', ',') }}</h2>
            </div>
            @if (!empty($single_contract_currency))
            @if($single_contract_currency == "MXN")
            <div class="col-sm-4">
              <?php 
                $percent_tender = ($amount_gastado * 100)/$budget_amount;
                
                if ($percent_tender > 100) {
                  $percent_budget = ($budget_amount * 100)/$amount_gastado . '%' ;
                  $percent_spent  = '100%';
                }
                else {
                  $percent_budget = '100%';
                  $percent_spent = $percent_tender .'%';
                }
              ?>
              
              <p class="title_section">% LICITADO / CONTRATADO</p>
              <div class="percent">
                <div class="budget" style="width: <?php echo $percent_budget;?>"></div>
                <div class="spent"  style="width: <?php echo $percent_spent;?>"></div>
              </div>
              <p class="title_section"><span>0</span> <span class="right"><?php echo $percent_tender > 100 ? number_format($percent_tender) : '100';?>%</span></p>
            </div>
            @endif
            @endif
          </div>
          
          */?>
          <!--
          <div class="row divider">
            <div class="col-sm-12">
              <p class="title_section">Línea de tiempo</p>
            </div>
          </div>-->
          
          

</div>