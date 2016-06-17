@extends('frontend.layouts.master')

@section('content')

<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
				<h1 id="publisher-name">Lista de Dependencias con Contrataciones Abiertas</h1>
				<div class="divider"></div>
			</div>
		</div>
		<div class="col-sm-12">
			<ul class="list">
				<li>
					<div class="col-sm-4">
						<p>Dependencia</p>
					</div>
					<div class="col-sm-4">
						<p>Dirección</p>
					</div>
					<div class="col-sm-2">
						<p>Contacto</p>
					</div>
				</li>
			@foreach ($buyers as $buyer)
			<li>
				<div class="col-sm-4">
					<h3><a href="{{ url('dependencia/' . $buyer->id) }}">{{$buyer->name}}</a></h3>
					<p>{{$buyer->address}} </p>
				</div>
				<div class="col-sm-4">
					<p>Dr. Lavista 144, <br>Delegación Cuauhtémoc</p>
					<p>Ciudad de México C.P.06720</p>
				</div>
				<div class="col-sm-2">
					<p>Tel.: 5588 3388</p>
					<p><a href="http://www.finanzas.df.gob.mx">web</a></p>
				</div>
				<div class="col-sm-2">
					<a href="{{ url('dependencia/' . $buyer->id) }}" class="btn">Contrataciones</a>
				</div>
				<div class="clearfix"></div>
			</li>
			@endforeach
			<li></li>
			</ul>
		</div>
		
		
	</div>
</div>
@endsection