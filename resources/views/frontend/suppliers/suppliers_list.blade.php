@extends('frontend.layouts.master')

@section('content')

<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="row box">
				<?php $supplier_num = 0;?>
				@foreach ($providers as $provider)
					@if($provider->award_num > 0)
					<?php $supplier_num =  $supplier_num + 1;?>
					@endif
				@endforeach
					<h1 class="mega_title">{{ $supplier_num}} proveedores con Contrataciones Abiertas</h1>
		

				<div class="col-sm-10 col-sm-offset-1">
					<div class="row guia">
						<div class="col-sm-5"><p>Proveedor</p></div>
						<div class="col-sm-2"><p>Adjudicaciones</p></div>
						<div class="col-sm-3"><p>Monto Total Contratado</p></div>
					</div>
					<ol class="list">
					@foreach ($providers as $provider)
						@if($provider->award_num > 0)
						<li class="row">
							<div class="col-sm-5">
								<h3><a href="{{ url('proveedor/' . $provider->rfc) }}">{{$provider->name}}</a></h3>
								<p>{{$provider->locality}},{{$provider->region}} </p>
							</div>
							<div class="col-sm-2">
								<p class="center"> <strong>{{$provider->award_num}}</strong></p>
							</div>
							<div class="col-sm-2">
								<p class="right">${{ number_format($provider->budget,2,'.',',') }}</p>
							</div>
							<div class="col-sm-2 col-sm-offset-1">
								<p><a href="{{ url('proveedor/' . $provider->rfc) }}" class="btn">Ver Proveedor</a>	</p>										</div>
						</li>
						@endif
					@endforeach
					</ol>
					<div class="row guia">
						<div class="col-sm-5"><p>Proveedor</p></div>
						<div class="col-sm-2"><p>Adjudicaciones</p></div>
						<div class="col-sm-3"><p>Monto Total Contratado</p></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>


@endsection