@extends('frontend.layouts.master')

@section('content')

<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
				<h1 id="publisher-name">Lista de proveedores con Contrataciones Abiertas</h1>
				<div class="divider"></div>
			</div>
		</div>
		
		<div class="col-sm-12">
			<ul class="list">
			@foreach ($providers as $provider)
			@if($provider->award_num > 0)
			<li>
				<div class="col-sm-5">
					<h3><a href="{{ url('proveedor/' . $provider->rfc) }}">{{$provider->name}}</a></h3>
					<p>{{$provider->locality}},{{$provider->region}} </p>
				</div>
				<div class="col-sm-3">
					<p>Licitaciones: <strong>{{$provider->tender_num}}</strong><br>
					Adjudicaciones: <strong>{{$provider->award_num}}</strong></p>
				</div>
				<div class="col-sm-4">
					<p>Cantidad adjudicada (MXN):<br> <strong>${{ number_format($provider->budget,2,'.',',') }}</strong></p>
				</div>
				<div class="clearfix"></div>
			</li>
			@endif
			@endforeach
			</ul>
		</div>
		
		
	</div>
</div>
@endsection