@extends('frontend.layouts.master')

@section('content')

<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="row box">
				<h1 class="mega_title">Lista de Dependencias con Contrataciones Abiertas</h1>
				<div class="col-sm-10 col-sm-offset-1">
					<div class="row guia">
						<div class="col-sm-4"><p>Dependencia</p></div>
						<div class="col-sm-3"><p>Dirección</p></div>
						<div class="col-sm-2"><p>Contacto</p></div>
					</div>
					<ul class="list">
					@foreach ($buyers as $_buyer)
					 <?php 
					   // del controller llega el comprador, pero la info que se despliega es de la oficina,
					   // por eso este mini-ugly-hack
					   $buyer = $_buyer->publisher; 
					 ?>
						<li class="row">
							<div class="col-sm-4">
								<h3><a href="{{ url('dependencia/' . $_buyer->id) }}">{{$buyer->office->name}}</a></h3>
							</div>
							<div class="col-sm-3">
								<p>{{$buyer->office->address->street_address}}, <br>{{$buyer->office->address->locality}}</p>
								<p>
								Ciudad de México C.P.{{$buyer->office->address->postal_code}}
								</p>
							</div>
							<div class="col-sm-2">
								<p>Tel.: {{$buyer->office->contact->telephone}}</p>
								<p><a href="{{$buyer->office->contact->url}}">web</a></p>
							</div>
							<div class="col-sm-3">
								<a href="{{ url('dependencia/' . $_buyer->id) }}" class="btn">Ver Dependencia</a>
							</div>
						</li>
					@endforeach

					<?php /*
					@foreach ($buyers as $buyer)
						<li class="row">
							<div class="col-sm-4">
								<h3><a href="{{ url('dependencia/' . $buyer->id) }}">{{$buyer->name}}</a></h3>
								<!--<p>{{$buyer->address}} </p>-->
							</div>
							<div class="col-sm-3">
								<p>{{$buyer->address->street_address}}, <br>{{$buyer->address->locality}}</p>
								<p>
								<!--{{$buyer->address->region}}-->
								Ciudad de México C.P.{{$buyer->address->postal_code}}
								</p>
							</div>
							<div class="col-sm-2">
								<p>Tel.: {{$buyer->contact->telephone}}</p>
								<p><a href="{{$buyer->contact->url}}">web</a></p>
							</div>
							<div class="col-sm-3">
								<a href="{{ url('dependencia/' . $buyer->id) }}" class="btn">Ver Dependencia</a>
							</div>
						</li>
					@endforeach
					*/?>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection