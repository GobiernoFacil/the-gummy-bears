@extends('frontend.layouts.master')

@section('content')

<?php
	date_default_timezone_set('America/Mexico_City');
	/* UGLY HACK */
	$d = array_diff(scandir("./js/newdata"), ['..', '.', '.DS_Store']);
  $loscontracts = [];
  foreach($d as $elcontract){
  	$f = file_get_contents("./js/newdata/" . $elcontract);
    $j = json_decode($f);

    if($j){
      $id = $j->releases[0]->ocid;
      $loscontracts[str_replace("/", "-", $id)] = $j;
    }
  }

  $contract_data = [];
  foreach ($loscontracts as $key => $value) {
  	$contract_data[] = [
  	"id"        => $key,
  	"title"     => $value->releases[0]->planning->budget->project,
	  "budget"    => $value->releases[0]->planning->budget->amount->amount,
		"buyer"     => $value->releases[0]->buyer,
	  "awards"    => $value->releases[0]->awards,
		"contracts" => $value->releases[0]->contracts
		];
  }

  $total_money = array_reduce($contract_data,function($v1, $v2){
  	return $v1 + (float)$v2["budget"];
  },0);
	?>
<div class="breadcrumb">
	<div class="container">
		<nav class="row">
			<div class="col-sm-5">
			<!--Contratos-->
			</div>
			<div class="col-sm-7 right">
			<!--	<a href="#" class="advanced_search">Advanced Search</a>
				<a href="#" id="dependencia-a" class="ladependencia empresa">Proveedores</a>-->
				<a href="#" id="dependencia-a" class="ladependencia live">Dependencia</a>
			</div>
		</nav>
	</div>
</div>
<!-- viz-->
<div class="viz_home">
	<header>
		<div class="col-sm-4">
			<p><span>DEPENDENCIA</span>SEFIN</p>
		</div>
		<div class="col-sm-4 center">
			<p><span>LICITACIONES POR DEPENDENCIA</span> <strong><?php echo count($contracts); ?></strong></p>
		</div>
		<div class="col-sm-4">
			<p><span>TOTAL (MXN)</span>$<strong><?php echo (int)($total_money/1000000); ?></strong> millones </p>
		</div>
	</header>
	<p id="publisher-name"></p>
	<p id="contratos-total-num"></p>
	<p id="contratos-total-money"></p>
	
	<div id="treemap"></div>
</div>

<!-- container-->
<div class="container">
	<div class="row">
		<div class="col-sm-9">
			<h2 id="title_select_type" class="title_section select">Lista de <strong>Contrataciones Abiertas</strong></h2>
		</div>
		<div class="col-sm-3">
			<form class="select_type">
				<p>Mostrar: 
				  <select>
				    <option value="all">Todos</option>
					  <option value="planning">Planeación</option>
					  <option value="tender">Licitación</option>
					  <option value="award">Adjudicación</option>
					  <option value="contract">Contratación</option>
				  </select>
				</p>
			</form>
		</div>
		<div class="col-sm-12">			
			<ul class="list">
			@foreach($contracts as $contract)
				<?php $contract_ocdsid = $contract->ocdsid?>
				@if($contract->releases->count())
					<?php $r = $contract->releases->last(); 
						// aquí se capturan los datos para la lista  
						$title  			= $r->planning->project;
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
					<li class="row tender planning {{ empty($awards) ? '' : 'award' }} {{ empty($contracts) ? '' : 'contract'}}">
						<!--top-->
						<div class="col-sm-9 top">
							<h2><a href="{{ url('contrato/' . $contract_ocdsid) }}">{{ $tender_title }} 
								<span>{{$contract_ocdsid}} </span></a></h2>
							<p class="description"><span>Descripción:</span> {{ $tender_description ? $tender_description : ""}}</p>
						</div>
						<!--amount-->
						<div class="col-sm-3 amount top">
							<p><span>$</span> {{$budget}} <span>MXN</span></p>
						</div>
						<div class="clearfix"></div>
						<!--icons-->
					<div class="icons">
						<div class="col-sm-4">
							<p>Comprador: 
								<a href="{{ $buyer_name ? url('dependencia/1')  : '#'}}">{{ $buyer_name ? $buyer_name : "No está definido" }}</a></p>
						</div>
						<div class="col-sm-4">
							@if($awards->count())
							<p>{{$awards->count() == 1 ? 'Proveedor: ' : 'Proveedores'}} 
								<a href="#"><?php // echo $first_supplier; ?></a>
							</p>
								@foreach ($awards as $award)
									@foreach($award->suppliers as $supplier)
									{{$supplier->name}}
									@endforeach
								@endforeach
							@endif
						</div>
						
						<div class="col-sm-4">
							<ul>
								<li>
									@if($single_contracts->count())
									En contratación
									@else 
										@if($awards->count())
										En adjudicación
										@else
											@if($tender_id)
											En Licitación
											@else
											No ha comenzado
											@endif
										@endif
									@endif
									
								</li>
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
</script>
<script data-main="/js/apps/home-v2/main" src="js/bower_components/requirejs/require.js"></script>

@endsection