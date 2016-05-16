@extends('frontend.layouts.master')

@section('content')

<!-- container-->
<div id="all-list-contracts" class="container">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title_section select">Resultados de búsqueda para: "<strong>{{$keyword}}</strong>"</h2>
			<p>{{$contracts->count()}} resultado encontrado.</p>
		</div>
		<div class="col-sm-3 right">
			<form method="get" action="{{url('contratos/busqueda')}}" class="form-search search_view">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="text" name="query" value="{{old('query')}}" placeholder="Realizar otra búsqueda">
				<input type="submit" value="&nbsp;">
			</form>
		</div>
		<div class="col-sm-12">			
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
								<a href="{{ $buyer_name ? url('dependencia/1')  : '#'}}">{{ $buyer_name ? $buyer_name : "No está definido" }}</a></p>
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

@endsection