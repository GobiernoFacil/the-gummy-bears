@extends('frontend.layouts.master')

@section('content')

<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
				<p>PROVEEDOR</p>
				<h1 id="publisher-name">
					@if($tenderer->url && $tenderer->url != "No Capturado")
					<a href="{{$tenderer->url}}">{{$tenderer->name}}</a>
					@else
					{{$tenderer->name}}
					@endif
					</h1>
				<div class="divider"></div>
					<div class="row">
						<div class="col-sm-6">
							<p class="title_section">RFC</p>
							<h3> <strong>{{$tenderer->rfc}}</strong></h3>
						</div>
						<div class="col-sm-6">
							<p class="title_section">Persona de Contacto</p>
							<p>{{$tenderer->contact_name}}</p>
						</div>
					</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-sm-6">
						<p class="title_section">Dirección</p>
						<p>
						  <span id="address-streetAddress">{!! $tenderer->street ? $tenderer->street . '. <br>' : '' !!}</span>
						  <span id="address-locality">{!! $tenderer->locality ? $tenderer->locality . '. <br>' : '' !!}</span>
						  <span id="address-region">{{ $tenderer->region ? $tenderer->region . '. ' : '' }}</span>
						  CP. <span id="address-postalCode">{{ $tenderer->zip ? $tenderer->zip . '. ': '' }}</span>
						  {{ $tenderer->country ? $tenderer->country : '' }}
						</p>
					</div>
					<div class="col-sm-3">
						<p class="title_section">Correo</p>
						<p>{{ $tenderer->email ? $tenderer->email . '. ' : '' }}</p>
					</div>
					<div class="col-sm-3">
						<p class="title_section">Contacto</p>
						<p>Tel.: {!! $tenderer->phone ? '<strong>' . $tenderer->phone . '</strong><br>': '' !!}
							Fax: {!! $tenderer->fax ? $tenderer->fax : '' !!}
						</p>
					</div>
				</div>
				<div class="divider"></div>
				
				<div class="row">
					
					<div class="col-sm-4">
						<p>MONTO TOTAL CONTRATADO</p>
						<h2 id="contrataciones-total-money">
							<span>$</span>{{ number_format($supplier->contract_budget,2,'.',',') }} <!--<span>MXN</span>-->
						</h2>
					</div>
					<div class="col-sm-2 mobile-no">
						<p>LICITACIONES</p>
						<h2 id="licitaciones-total-num">{{$tender_tenderer->count()}}</h2>
					</div>
					<div class="col-sm-2 mobile-no">
						<p>ADJUDICACIONES</p>
						<h2 id="adjudicaciones-total-num">{{ $supplier->award_num }}</h2>
					</div>
					<div class="col-sm-3 mobile-no">
						<p>PROMEDIO POR CONTRATACIÓN</p>
						<h2 id="gasto-promedio-money"><span>$</span>{{ $supplier->awards->count() ? number_format($supplier->contract_budget / $supplier->awards->count(),2,'.',',') : '0' }}<!--<span>MXN</span>--> </h2>
					</div>
					
				</div>
					

			</div>

		</div>
		@if($supplier->awards->count() > 0)
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8 col-xs-6">
						<h3>Adjudicaciones con dependencias</h3>
					</div>
					<div class="col-sm-4  col-xs-6">
						<p class="right">TOTAL</p>
					</div>
				</div>
				<ul id="lucky-providers">
					@foreach ($buyers as $buyer)
					<li class="row">
						<span class="col-sm-8 col-xs-6">
						<a href="{{ url('dependencia/'. $buyer->buyer->id) }}">{{($buyer->buyer->name)}}</a>
						</span>
						<span class="col-sm-4  col-xs-6 right">
							${{ number_format($buyer->budget,2,'.',',') }} 
						</span>
					</li>
					
					@endforeach
				</ul>
				<div class="divider"></div>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8 col-xs-6">
						<h3>Adjudicaciones</h3>
					</div>
					<div class="col-sm-4 col-xs-6">
						<p class="right">TOTAL</p>
					</div>
				</div>
				<ul id="licitaciones-costosas">
					@foreach($contracts as $contract)
					<?php $contract_ocdsid = $contract->ocdsid;
						  $r = $contract->releases->last();?>
						@if($contract->releases->count())
							@foreach($awards as $award)
							    @if ($r->id == $award->release_id)
								@foreach ($supplier->awards as $ar)
									@if($ar->id == $award->id)
									<li class="row">
									  <span class="col-sm-8 col-xs-6">
									  	<a href="{{ url('contrato/'. $contract_ocdsid)}}">{{ $award->title }}</a>
									  </span>
									  <span class="col-sm-4 col-xs-6 right">
									  	${{ number_format($award->value,2,'.',',') }}
									  </span>
									</li>
									@endif
								@endforeach
							    @endif
							@endforeach
						@endif
					@endforeach
				</ul>
			</div>
		</div>
		@endif
		
		<div class="col-sm-12">
			<div class="box">
				<div class="row">
					<div class="col-sm-6">
						<h3>Todas las licitaciones: <strong id="award-counter-filter">{{$tender_tenderer->count()}}</strong></h3>
					</div>
					<!---
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
					</div>-->
				</div>
				<ul id="awards-by-filter">
					@foreach($contracts as $contract)
					<?php $contract_ocdsid = $contract->ocdsid;
						  $r = $contract->releases->last();?>
						@if($contract->releases->count())
						@foreach($tenders as $t)
						 @if ($r->id == $t->release_id)
							@foreach($tender_tenderer as $tt)
							    @if ($t->id == $tt->tender_id)
							<li class="row">
								<span class="col-sm-6  col-xs-6">
									<a href="{{ url('contrato/' . $contract_ocdsid ) }}">{{$t->title}}</a><br>
									{{$t->description}}
								</span>
								<span class="col-sm-3  mobile-no">
									{{$t->tender_start}}
								</span>
								<span class="col-sm-6  col-xs-3 right">
									${{ number_format($t->amount,2,'.',',') }}
								</span>
							</li>
							@endif
							@endforeach
							@endif
						@endforeach
						@endif
					@endforeach
				</ul>
			</div>
		</div>
		
	</div>
</div>
@endsection