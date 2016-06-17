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
					@foreach ($buyers as $buyer)
						<li class="row">
							<div class="col-sm-4">
								<h3><a href="{{ url('dependencia/' . $buyer->id) }}">{{$buyer->name}}</a></h3>
								<p>{{$buyer->address}} </p>
							</div>
							<div class="col-sm-3">
								<p>Dr. Lavista 144, <br>Delegación Cuauhtémoc</p>
								<p>Ciudad de México C.P.06720</p>
							</div>
							<div class="col-sm-2">
								<p>Tel.: 5588 3388</p>
								<p><a href="http://www.finanzas.df.gob.mx">web</a></p>
							</div>
							<div class="col-sm-3">
								<a href="{{ url('dependencia/' . $buyer->id) }}" class="btn">Ver Dependencia</a>
							</div>
						</li>
					@endforeach
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection