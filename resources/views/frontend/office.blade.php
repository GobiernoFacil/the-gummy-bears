@extends('frontend.layouts.master')

@section('content')
<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
		
				<p>Dependencia</p>
				<h1 id="publisher-name"><a href="http://www.finanzas.df.gob.mx/">Secretaría de Finanzas</a></h1>
				<div class="divider"></div>
				<p id="releases-buyer-name"></p>
				<p>
				  <span id="address-streetAddress">Dr. Lavista 144</span>
				  <span id="address-locality">Cuauhtémoc</span>
				  <span id="address-region">DF</span>
				  CP.<span id="address-postalCode">06720</span>
				</p>
				
				<div class="divider"></div>
				<?php $amount_contract		= 0;?>
				@foreach($contracts as $contract)
					@if($contract->releases->count())
					<?php $r = $contract->releases->last(); 
					 	  $single_contracts 	= $r->singlecontracts;
					 	  $total_contracts		= $single_contracts->count();
					 	  ?>
					 	  @foreach($single_contracts as $s)
					 	  	<?php $amount_contract+= $s->amount;?>
					 	  @endforeach
					@endif
				@endforeach
				
				<div class="row">
					<div class="col-sm-3">
						<p>CONTRATACIONES TOTAL(MXN)</p>
						<h2 id="contrataciones-total-money"><span>$</span>{{ number_format($amount_contract,2,'.',',') }}</h2>
					</div>
					<div class="col-sm-3">
						<p>LICITACIONES</p>
						<h2 id="licitaciones-total-num">{{$r->tender->count()}}</h2>
					</div>
					<div class="col-sm-3">
						<p>ADJUDICACIONES</p>
						<h2 id="adjudicaciones-total-num">{{ $awards->count() }}</h2>
					</div>
					<div class="col-sm-3">
						<p>PROMEDIO POR CONTRATACIÓN (MXN)</p>
						<h2 id="gasto-promedio-money"><span>$</span> {{ number_format($amount_contract / $singlecontracts->count(),2,'.',',') }}</h2>
					</div>
					
				</div>
				<div class="divider"></div>
				<div id="linemap">
				  <h3>Total por contrato</h3>
				  <p>información recopilada desde <span id="tremmap-data-from">diciembre de 2015</span></p>
				</div>		

			</div>

		</div>
		
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8">
						<h3>Proveedores más beneficiados</h3>
					</div>
					<div class="col-sm-4">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="lucky-providers">
					@foreach($suppliers as $sp)
					@foreach($awards as $aw)
						@if($sp->award_id == $aw->id)
					<li class="row">
						<span class="col-sm-8">
							<a href="{{ url('proveedor/' . $sp->rfc) }}">{{$sp->name}}</a>
						</span>
						<span class="col-sm-4 right">
							${{$aw->value}}
						</span>
					</li>
						@endif
					@endforeach
					@endforeach
				</ul>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8">
						<h3>Contrataciones más costosas</h3>
					</div>
					<div class="col-sm-4">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="licitaciones-costosas">
					@foreach($topcontracts as $tp)
					<li class="row">
						<span class="col-sm-8">
							<a href="#">{{$tp->description}}</a>
						</span>
						<span class="col-sm-4 right">
						{{ number_format($tp->amount,2,'.',',') }}
						</span>
					</li>
					@endforeach
				</ul>
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