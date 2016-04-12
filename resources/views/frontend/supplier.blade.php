@extends('frontend.layouts.master')

@section('content')

<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
				<p>Proveedor</p>
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
							<h3>RFC: <strong>{{$tenderer->rfc}}</strong></h3>
						</div>
						<div class="col-sm-6">
							<p>Contacto: <strong>{{$tenderer->contact_name}}</strong></p>
						</div>
					</div>
				<div class="divider"></div>
				<div class="row">
					<div class="col-sm-6">
						<p>Dirección: <br>
						  <span id="address-streetAddress">{!! $tenderer->street ? $tenderer->street . '. <br>' : '' !!}</span>
						  <span id="address-locality">{!! $tenderer->locality ? $tenderer->locality . '. <br>' : '' !!}</span>
						  <span id="address-region">{{ $tenderer->region ? $tenderer->region . '. ' : '' }}</span>
						  CP. <span id="address-postalCode">{{ $tenderer->zip ? $tenderer->zip . '. ': '' }}</span>
						  {{ $tenderer->country ? $tenderer->country : '' }}
						</p>
					</div>
					<div class="col-sm-3">
						<p>Correo:<br> {{ $tenderer->email ? $tenderer->email . '. ' : '' }}</p>
					</div>
					<div class="col-sm-3">
						<p>Tel.: {!! $tenderer->phone ? '<strong>' . $tenderer->phone . '</strong><br>': '' !!}
							Fax: {!! $tenderer->fax ? $tenderer->fax : '' !!}
						</p>
					</div>
				</div>
				<div class="divider"></div>
				
				<div class="row">
					<?php $total = 0;
						  $total_awards = 0;
					?>
						@foreach ($awards as $award)
						@foreach ($suppliers as $supplier)
							@if($supplier->award_id == $award->id)
							<?php $total = $total + $award->value;
								$total_awards++;
							?>
							@endif
						@endforeach
						@endforeach
					<div class="col-sm-3">
						<p>ADJUDICACIONES TOTAL(MXN)</p>
						<h2 id="contrataciones-total-money"><span>$</span>{{ number_format($total,2,'.',',') }}</h2>
					</div>
					<div class="col-sm-3">
						<p>LICITACIONES</p>
						<h2 id="licitaciones-total-num">{{$tender_tenderer->count()}}</h2>
					</div>
					<div class="col-sm-3">
						<p>ADJUDICACIONES</p>
						<h2 id="adjudicaciones-total-num">{{ $total_awards }}</h2>
					</div>
					<div class="col-sm-3">
						<p>PROMEDIO POR ADJUDICACIÓN (MXN)</p>
						
						<h2 id="gasto-promedio-money"><span>$</span> {{ $total_awards > 0 ? number_format($total / $total_awards,2,'.',',') : '0' }} </h2>
					</div>
					
				</div>
					

			</div>

		</div>
		@if($total_awards > 0)
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8">
						<h3>Adjudicaciones con dependencias</h3>
					</div>
					<div class="col-sm-4">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="lucky-providers">
					<li class="row">
						<span class="col-sm-8">
							<a href="{{ url('dependencias') }}">SEFIN</a>
						</span>
						<span class="col-sm-4 right">
							${{ number_format($total,2,'.',',') }}
						</span>
					</li>
					
				</ul>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="box">
				<div class="row">
					<div class="col-sm-8">
						<h3>Adjudicaciones más costosas</h3>
					</div>
					<div class="col-sm-4">
						<p class="right">TOTAL (MXN)</p>
					</div>
				</div>
				<ul id="licitaciones-costosas">
					@foreach($contracts as $contract)
					<?php $contract_ocdsid = $contract->ocdsid;
						  $r = $contract->releases->last();?>
						@if($contract->releases->count())
							@foreach($awards as $award)
							    @if ($r->id == $award->release_id)
							    @foreach ($suppliers as $supplier)
									@if($supplier->award_id == $award->id)
									<li class="row">
									  <span class="col-sm-8">
									  	<a href="{{ url('contrato/'. $contract_ocdsid)}}">{{ $award->title }}</a>
									  </span>
									  <span class="col-sm-4 right">
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
								<span class="col-sm-6">
									<a href="{{ url('contrato/' . $contract_ocdsid ) }}">{{$t->title}}</a><br>
									{{$t->description}}
								</span>
								<span class="col-sm-3">
									{{$t->tender_start}}
								</span>
								<span class="col-sm-3 right">
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
<script data-main="/js/apps/dependencia/main" src="/js/bower_components/requirejs/require.js"></script>

@endsection