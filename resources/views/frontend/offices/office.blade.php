@extends('frontend.layouts.master')

@section('content')
<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
				<div class="row">
					<div class="col-sm-9">
						<p>DEPENDENCIA</p>

						<?php $publisher = $buyer->publisher; ?>

						<h1 id="publisher-name">
						  <a href="{{$publisher->office->contact->url}}">
						    {{$buyer->name}}
						  </a>
						</h1>
						<p class="address">
						  <span id="address-streetAddress">{{$publisher->office->address->street_address}},</span>
						  <span id="address-locality">{{$publisher->office->address->locality}},</span>
						  <span id="address-region">Ciudad de México</span>
						  C.P.<span id="address-postalCode">{{$publisher->office->address->postal_code}}</span>
						</p>
					</div>
					<div class="col-sm-3">
						<?php $etapa_implementacion = 0;?>
						@foreach($buyer->singlecontracts as $c)
							@if($c->implementation->transactions->count())
								<?php $etapa_implementacion = $etapa_implementacion+1;?>
							@endif
						@endforeach
						<?php
						/*
						 * ESE COMPA, AQUÍ DEBERÍAN ESTAR BIEN/MÁS O MENOS  CALCULADOS LOS VALORES 
						 * EN LAS VARIABLES QUE AQUÍ AGREGO (1 feb 2017)
						 * 
						 * 
						 * $implementation_num;
						 * $contracting_num;
						 * $award_num;
						 * $tender_num;
						 * $planning_num;
						 *
						 *
						*/
							$total_procesos 	= $buyer->contracts()->count();//$total_procesos->count();
							$etapa_adjudicacion = ($total_procesos - $singlecont_count);
							$etapa_contratacion = $total_procesos - $etapa_implementacion;
							$etapa_licitacion 	= $total_procesos - $total_procesos;
						?>
						<p>TOTAL DE PROCESOS DE CONTRATACIÓN ABIERTOS</p>
						<h2 id="licitaciones-total" class="subtitle">{{$total_procesos}}</h2>
					</div>
				

				</div>
				<div class="divider"></div>
				<!--- proceso por etapa-->
				<div class="row">
					<div class="col-sm-8">
						<h2>Procesos de contratación por etapa activa</h2>
						<div class="row">
							<div class="col-sm-6">
								<div id="donut"></div>
							</div>
							<div class="col-sm-6">
								<ul class="stage_list">
									<li class="planning zero"><b><?php echo file_get_contents("img/nav_planeacion.svg"); ?></b> <strong>0</strong> en Planeación</li>
									<li class="tender {{ $etapa_licitacion == 0 ? 'zero' : ''}}">
									<b><?php echo file_get_contents("img/nav_licitacion.svg"); ?></b> 
									<strong>{{$etapa_licitacion < 0 ? '0' : $etapa_licitacion}}</strong> en Licitación</li>
									<li class="awards {{ $etapa_adjudicacion == 0 ? 'zero' : ''}}">
									<b><?php echo file_get_contents("img/nav_adjudicacion.svg"); ?></b>
									<strong>{{$etapa_adjudicacion < 0 ? '0' : $etapa_adjudicacion}}</strong> en Adjudicación</li>
									<li class="contracts {{ $etapa_contratacion == 0 ? 'zero' : ''}}">
									<b><?php echo file_get_contents("img/nav_contratacion.svg"); ?></b> 
									<strong>{{$etapa_contratacion}}</strong> en Contratación</li>
									<li class="implementation {{ $etapa_implementacion == 0 ? 'zero' : ''}}">
									<b><?php echo file_get_contents("img/nav_implementacion.svg"); ?></b> 
									<strong>{{$etapa_implementacion}}</strong> en Implementación</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-4 right">
						<div class="row divider">
							<div class="col-sm-11">
								<p class="title_section">Monto total contratado en MXN</p>
								<h2>${{ number_format($total_contract,2,'.',',') }} <span>MXN</span></h2>
							</div>
						</div>
						<div class="row divider">
							<div class="col-sm-11">
								<p class="title_section">Monto total contratado en USD</p>
								<h2>${{ number_format($total_contract_usd,2,'.',',') }} <span>USD</span></h2>
							</div>
						</div>
					</div>
				</div>
				
				<?php /*
				<div class="divider"></div>
				<!-- montos-->
				<div class="row amount">
					<div class="col-sm-4 planning">
							<p>MONTO TOTAL PLANEADO (MXN)</p>
							<h2><b><?php echo file_get_contents("img/nav_planeacion.svg"); ?></b><span>$</span>{{ number_format($total_planning,2,'.',',') }}</h2>
					</div>
					<div class="col-sm-4 awards">
							<p>MONTO TOTAL ADJUDICADO (MXN)</p>
							<h2><b><?php echo file_get_contents("img/nav_adjudicacion.svg"); ?></b><span>$</span>{{ number_format($total_award,2,'.',',') }}</h2>
					</div>
					<div class="col-sm-4 contracts">
							<p>MONTO TOTAL CONTRATADO (MXN)</p>
							<h2><b><?php echo file_get_contents("img/nav_contratacion.svg"); ?></b><span>$</span>{{ number_format($total_contract,2,'.',',') }}</h2>
					</div>
				</div>
				
				<!--planning-->
				<div class="row">
					
					<div class="col-sm-10 col-sm-offset-1 visualiza">
						<span class="bar_office" style="width: {{$per_planning}}%; ">${{ number_format(($total_planning/1000000),2,'.',',') }}M &nbsp;</span>
						<span class="bar_office adjudicados" style="width: {{$per_award}}%; ">${{ number_format(($total_award/1000000),2,'.',',') }}M &nbsp;</span>
						<span class="bar_office contratados" style="width: {{$per_contract}}%; ">${{ number_format(($total_contract/1000000),2,'.',',') }}M &nbsp;</span>
					</div>
					<div class="col-sm-10 col-sm-offset-1">
						<h3>¿Qué estoy viendo?</h3>
						<p>El monto total planeado es aquél que se autorizó como suficiencia presupuestal para comenzar el proceso. El monto total adjudicado nos muestra el total que se pagará por el bien o servicio. El monto total contratado nos indica que la cantidad que ya fue formalizada y firmada en un documento llamado contrato. La gráfica de barras muestra una comparación entre los presupuestos dentro de cada fase del proceso</p>
					</div>
				</div>
				*/?>
				
				<div class="divider"></div>
				<div id="linemap">
				 <!-- <h3>Total por contrato</h3>-->
				  <p>Información disponible a partir de la implementación del estándar en 2015.</p>
				</div>		

			</div>

		</div>
		
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8 col-xs-7">
						<h3>Proveedores <span>(5 de {{$providers_count}})</span></h3>
					</div>
					<div class="col-sm-4 col-xs-5">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="lucky-providers">
					@foreach($providers as $sp)
						@if ($sp->awards->count())
						<li class="row">
							<span class="col-sm-8 col-xs-7">
								<a href="{{ url('proveedor/' . $sp->rfc) }}">{{$sp->name}}</a>
							</span>
							<span class="col-sm-4 col-xs-5 right">
								${{number_format($sp->budget,2,'.',',')}}
							</span>
						</li>
						@endif
					@endforeach
				</ul>
				<div class="divider"></div>
				<a href="{{ url('proveedores') }}">Ver lista completa de proveedores</a>

			</div>
		</div>
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8 col-xs-7">
						<h3>Contratos <span>(5 de {{$singlecont_count}})</span></h3>
					</div>
					<div class="col-sm-4 col-xs-5">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="licitaciones-costosas">
					@foreach ($contract_data as $c)
					  @if($c->release->singlecontracts->count())
						<li class="row">
								<span class="col-sm-8 col-xs-7">
									<a href="{{ url('contrato/'. $c->ocdsid) }}">{{$c->release->singlecontracts[0]->description}}</a>
								</span>
								<span class="col-sm-4 col-xs-5 right">
								${{ number_format($c->contracts,2,'.',',') }}
								</span>
							</li>	
							@endif				
					@endforeach
				</ul>
				<div class="divider"></div>
				<a href="{{ url('proveedores') }}">Ver lista completa de contrataciones </a>
			</div>
		</div>
		
		<div class="col-sm-12">
			<!--
			<div class="box">
				<div class="row">
					<div class="col-sm-6">
						<h3>Todas las licitaciones: <strong id="award-counter-filter">1</strong></h3>
					</div>
					<div class="col-sm-6">
						<form>
				  <p>
				    <select name="filter" id="award-filter-select">
				      <option>Todas</option>
				      <option>A</option>
				      <option>B</option>
				    </select>
				  </p>
				</form>
					</div>
				</div>
				<ul id="awards-by-filter">
					<li class="row">
						<span class="col-sm-6">
							<a href="#">PAPELERIA PARA EL ALMACÉN CENTRAL</a>
						</span>
						<span class="col-sm-3">
							01-01-2015
						</span>
						<span class="col-sm-3 right">
							$4,123,084
						</span>
					</li>
				</ul>
			</div>
			-->
		</div>
		
	</div>
</div>

<script>
	var DATA = [{"stage":"planning", "total":0},
    			{"stage":"tender", "total":{{$etapa_licitacion}} },
    			{"stage":"awards", "total":{{$etapa_adjudicacion}} },
    			{"stage":"contracting", "total":{{$etapa_contratacion}} },
    			{"stage":"implmentation", "total":{{$etapa_implementacion}} },
    			];
</script>

@endsection