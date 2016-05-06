@extends('frontend.layouts.master')

@section('content')
<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
				<p>Dependencia</p>
				<h1 id="publisher-name"><a href="http://www.finanzas.df.gob.mx/">{{$buyer->name}}</a></h1>
				<div class="divider"></div>
				<p id="releases-buyer-name"></p>
				<p>
				  <span id="address-streetAddress">Dr. Lavista 144,</span>
				  <span id="address-locality">Delegación Cuauhtémoc,</span>
				  <span id="address-region">Ciudad de México</span>
				  C.P.<span id="address-postalCode">06720</span>
				</p>
				
				

				<div class="divider"></div>
				@foreach($contracts as $contract)
					@if($contract->releases->count())
					<?php $r = $contract->releases->last();?>
					@endif
				@endforeach
				
				<?php 
					$total_procesos 	= $r->tender->count();
					$etapa_adjudicacion = ($awards->count() - $singlecont_count);
					$etapa_contratacion = $singlecont_count;
					$etapa_licitacion 	= $total_procesos - $awards->count() ;
				?>
				
				<div class="row">
					<div class="col-sm-3">
						<p>PROCESOS DE CONTRATACIÓN</p>
						<h2 id="licitaciones-total">{{$total_procesos}}</h2>
					</div>
					<div class="col-sm-3">
						<p>EN ETAPA DE LICITACIÓN</p>
						<h2 id="licitaciones-total-num">{{$etapa_licitacion}}</h2>
					</div>
					<div class="col-sm-3">
						<p>EN ETAPA DE  ADJUDICACIÓN</p>
						<h2 id="adjudicaciones-total-num">{{ $etapa_adjudicacion }}</h2>
					</div>
					<div class="col-sm-3">
						<p>EN ETAPA DE CONTRATACIÓN</p>
						<h2 id="contratos-total-num">{{$etapa_contratacion}}</h2>
					</div>
				</div>
				
				<!-- visualiza-->
				<div class="divider"></div>
				
				<!--planning-->
				<div class="row visualiza">
					<div class="row">
						<div class="col-sm-3">
							<p>TOTAL PLANEADO (MXN)</p>
						</div>
					</div>
					
					<div class="col-sm-3">
						<h2><span>$</span>{{ number_format($total_planning,2,'.',',') }}</h2>
					</div>
					<div class="col-sm-9">
						<span class="bar_office" style="width: {{$per_planning}}%; "></span>
					</div>
					
				</div>
				<!--award-->
				<div class="row visualiza">
					<div class="row">
						<div class="col-sm-3">
							<p>TOTAL ADJUDICADO (MXN)</p>
						</div>
					</div>
					<div class="col-sm-3">	
						<h2><span>$</span>{{ number_format($total_award,2,'.',',') }}</h2>
					</div>

					<div class="col-sm-9">
						<span class="bar_office adjudicados" style="width: {{$per_award}}%; "></span>
					</div>
					
				</div>
				<!--contract-->
				<div class="row visualiza">
					<div class="row">
						<div class="col-sm-3">
						<p>TOTAL CONTRATADO (MXN)</p>
						</div>
					</div>
					
					<div class="col-sm-3">
						<h2><span>$</span> {{ number_format($total_contract,2,'.',',') }}</h2>
					</div>
					<div class="col-sm-9">
						<span class="bar_office contratados" style="width: {{$per_contract}}%; "></span>
					</div>
					
				</div>
				

				
				
				<div class="divider"></div>
				<div id="linemap">
				 <!-- <h3>Total por contrato</h3>-->
				  <p>información recopilada desde <span id="tremmap-data-from">diciembre de 2015</span></p>
				</div>		

			</div>

		</div>
		
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8">
						<h3>Proveedores <span>(5 de {{$providers_count}})</span></h3>
					</div>
					<div class="col-sm-4">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="lucky-providers">
					@foreach($providers as $sp)
						@if ($sp->awards->count())
						<li class="row">
							<span class="col-sm-8">
								<a href="{{ url('proveedor/' . $sp->rfc) }}">{{$sp->name}}</a>
							</span>
							<span class="col-sm-4 right">
								${{number_format($sp->awards->sum('value'),2,'.',',')}}
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
					<div class="col-sm-8">
						<h3>Contrataciones <span>(5 de {{$singlecont_count}})</span></h3>
					</div>
					<div class="col-sm-4">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="licitaciones-costosas">
					@foreach ($contract_data as $c)
						<li class="row">
								<span class="col-sm-8">
									<a href="{{ url('contrato/'. $c->ocdsid) }}">{{$c->release->singlecontracts[0]->description}}</a>
								</span>
								<span class="col-sm-4 right">
								${{ number_format($c->contracts,2,'.',',') }}
								</span>
							</li>
						
					
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

@endsection