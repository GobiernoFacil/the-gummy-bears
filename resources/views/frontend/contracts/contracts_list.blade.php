@extends('frontend.layouts.master')

@section('content')
<?php
  $total_contracts = 0;
  $contract_data = [];
  foreach ($contracts as $elcontract) {
	if ($elcontract->releases->count()) {
		$total_contracts++;
		$r = $elcontract->releases->last();
		$contract_data[] = [
		  "id"        =>  $elcontract->ocdsid,
		  "title"     => $r->planning->project,
		  "budget"    => $r->planning->amount,
		  "buyer"     => $r->buyer,
		  "awards"    => $r->awards,
		  "contracts" => $r->singlecontracts
		  ];
	}
  }

  $total_money = array_reduce($contract_data,function($v1, $v2){
  	return $v1 + (float)$v2["budget"];
  },0);?>
  
<div class="instructions">
	<div class="container">
	<h1>Contrataciones Abiertas de la CD<span class="mx">MX</span></h1>
	<p>Explora cómo compra tu Gobierno filtrando por etapa de proceso de compra, dependencias o proveedores.</p>
	</div>
</div>  
<!-- viz-->
<div id="force" class="viz_home">
	<!-- filtros-->
	<div class="breadcrumb">
		<div class="container">
			<nav class="row">
				<div class="col-sm-4">
					<p>Filtrar por etapa:
						<select id="bubble-fun">
							<option value="tender">Licitaciones</option>
							<option value="awards">Adjudicaciones</option>
							<option value="contracts" selected>Contratos</option>
						</select>
					</p>
				<!--Contratos-->
				</div>
				<div class="col-sm-4 right">
					<p>Ver por: 
					<!--<a href="#" class="advanced_search">Advanced Search</a>-->
					<a href="#" id="dependencia-a" class="ladependencia live">Contratos</a>
					<a href="#" id="dependencia-b" class="ladependencia empresa"> Proveedores</a>
					</p>
				</div>
				<div class="col-sm-4 right">
					<form method="get" action="{{url('contratos/busqueda')}}" class="form-search">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="query" value="{{old('query')}}" placeholder="Buscar contrato">
						<input type="submit" value="&nbsp;"></p>
  					</form>
				</div>
				
			</nav>
		</div>
	</div>
	<header>
		<div class="col-sm-4">
			<p><span>DEPENDENCIAS</span> <strong>01</strong></p>
		</div>
		<div class="col-sm-4 center">
			<p><span id="type">CONTRATOS</span> <strong id="type_total">{{ $contracts_number }}</strong></p>
		</div>
		<div class="col-sm-4">
			<p><span>TOTAL (MXN)</span>$<strong id="total_amount">{{ (int)($contracts_amount/1000000) }}</strong> millones </p>
		</div>
	</header>
	<p id="publisher-name"></p>
	<p id="contratos-total-num"></p>
	<p id="contratos-total-money"></p>
</div>
<div class="viz_instructions">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-6">
				<p class="wit"><strong>¿Qué estoy viendo?</strong> Esta gráfica te permite comparar cantidades por cada elemento. Entre más área tenga el círculo más elevado es el total recibido.</p>
			</div>
		</div>
	</div>
</div>

<!-- container-->
<div id="all-list-contracts" class="container">
	<div class="row">
		<div class="col-sm-9">
			<h2 id="title_select_type" class="title_section select">Lista de <strong>Contrataciones Abiertas</strong></h2>
		</div>
		<div class="col-sm-3">
			<form class="select_type">
				<p>Mostrar por etapa: 
				  <select id="contracts-selector">
				    <option value="all">Todos</option>
					 <!-- <option value="planning">Planeación</option>-->
					  <option value="tender">Licitación</option>
					  <option value="award">Adjudicación</option>
					  <option value="contract">Contratación</option>
				  </select>
				</p>
			</form>
		</div>
		<div class="col-sm-12 col-xs-10 col-xs-offset-1 col-sm-offset-0">			
			<ul class="list">
			@foreach($contracts as $contract)
				<?php $contract_ocdsid = $contract->ocdsid;?>
				@if($contract->releases->count())
					<?php $r = $contract->releases->last(); 
						// aquí se capturan los datos para la lista  
						$title_project  	= $r->planning->project;
						$budget 			= number_format($r->planning->amount);
						//tender
						$tender_title  		= $r->tender->title;
						$tender_id  		= $r->tender->id;
						$tender_description = $r->tender->description;
						$tender_amount 		= $r->tender->amount;
						$tender_start		= $r->tender->tender_start;
						//buyer
						$buyer_name  		= $r->buyer ? $r->buyer->name : '';
						$buyer_id 			= $r->buyer ? $r->buyer->id : '';
						//awards
						$awards 			= $r->awards;
						//single contracts 
						$single_contracts 	= $r->singlecontracts;
					?>
					@if ($awards->count())
						@if ($single_contracts->count())
							<?php $class = "contract";?>
						@else
							<?php $class = "award";?>
						@endif
					@else 
						<?php $class = "tender";?>
					@endif
					<li class="row {{$class}}">
					<!--amount-->
						<div class="col-sm-3 amount top">
							<p><span>$</span> {{$budget}} <span>MXN</span></p>
							<?php switch($r->tender->procurement_method){
								case "limited":
									$procurement_method = "limitado";
									break;
								case "selective":
									$procurement_method = "selectivo";
									break;
								case "open":
									$procurement_method = "abierto";
									break;
								
							}?>
							<p class="procurement_method">Método de adquisición <strong>{{$procurement_method}}</strong></p>
						</div>
						<!--top-->
						<div class="col-sm-7 top">
							<h2><a href="{{ url('contrato/' . $contract_ocdsid) }}">{{ $tender_title }} 
								<span class="ocid">{{$contract_ocdsid}} </span></a></h2>
							<p class="description"><span>Descripción:</span> {{ $tender_description ? $tender_description : ""}}</p>
						</div>
						<div class="col-sm-2 top">
							<p class="list_t right">Etapa de
							@if($single_contracts->count())
									<strong>contratación</strong> <span><?php echo file_get_contents("img/nav_planeacion.svg"); ?>
									<?php echo file_get_contents("img/nav_licitacion.svg"); ?>
									<?php echo file_get_contents("img/nav_adjudicacion.svg"); ?>
									<?php echo file_get_contents("img/nav_contratacion.svg"); ?></span>
									@else 
										@if($awards->count())
										 <strong>adjudicación</strong> 
										 <span><?php echo file_get_contents("img/nav_planeacion.svg"); ?>
										 <?php echo file_get_contents("img/nav_licitacion.svg"); ?>
										 <?php echo file_get_contents("img/nav_adjudicacion.svg"); ?></span>
										@else
											@if($tender_id)
											<strong>licitación </strong>
											 <span><?php echo file_get_contents("img/nav_planeacion.svg"); ?>
											 <?php echo file_get_contents("img/nav_licitacion.svg"); ?></span>
											@else
											No ha comenzado
											@endif
										@endif
									@endif
							</p>
						</div>
						<div class="clearfix"></div>
						<!--icons-->
					<div class="icons">
						<div class="col-sm-3">
							<p class="list_t">Comprador: <br>
								<a href="{{ $buyer_name ? url('dependencia/'.$buyer_id)  : '#'}}">{{ $buyer_name ? $buyer_name : "No está definido" }}</a></p>
						</div>
						<div class="col-sm-4">
							@if($awards->count())
							<p class="list_t">{{$awards->count() == 1 ? 'Proveedor: ' : 'Proveedores'}} 
							<br>
								@foreach ($awards as $award)
									@foreach($award->suppliers as $supplier)
									<a href="{{ url('proveedor/'. $supplier->rfc) }}">{{$supplier->name}}</a>
									@endforeach
								@endforeach
							</p>
							@endif
						</div>
						<div class="col-sm-3">
							<p class="list_t">Criterio:<br>
									<?php switch($r->tender->award_criteria){
										case "bestValueToGovernment":
											$award_criteria = "Mejor oferta para el Gobierno";
											break;
										case "bestProposal":
											$award_criteria = "Mejor propuesta";
											break;
									}?>
									 {{$award_criteria}}
									
								</p>
						</div>
						<div class="col-sm-2">
							<ul class="right">
								<li class="contrato_num">{{$r->tender->items->count()}}</li>
								<li class="time_num">
								  <?php
								  if(empty($tender_start)){
								   	echo "0 meses";
								  }
								  else{
								  	$from = new DateTime();
								  	$from->setTimestamp(strtotime($tender_start));
								  	$to = new DateTime();
								  	$to->setTimestamp(time());

								  	$diff=date_diff($from,$to);
								  	if(!$diff->y && !$diff->m) {
								  		echo "0 meses"; // acaba de iniciar
								  	}
								  	elseif (!$diff->y && $diff->m == 1) {
								  		echo "1 mes";
								  	}
								  	elseif (!$diff->y && $diff->m > 1) {
								  		echo $diff->m . " meses";
								  	}
								  	else{
								  		echo "+1 año";
								  	}
								  }
								  ?>
								</li>
							</ul>
						</div>
						
						<div class="clearfix"></div>
					</div>

				</li>
					
				@endif
			@endforeach
			</ul>
		</div>
	</div>
</div>

<script>
	var DATA = <?php echo json_encode($contract_data); ?>;
	var JSON = <?php echo json_encode($json); ?>;
	var PROVIDERS = <?php echo json_encode($_providers); ?>;
</script>

@endsection