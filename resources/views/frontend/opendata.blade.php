@extends('frontend.layouts.master')

@section('content')
	<!--datos-->
	<section class="lead datos">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-xs-10 col-sm-offset-0 col-xs-offset-1">
					<h1><span>Gobierno abierto + Datos abiertos</span> 
					</h1>
					<a href="#" class="btn cta">Utiliza los datos</a>
				</div>
			</div>
		</div>
	</section>
	
	<!--usa los datos-->
	<section class="datos_pa_labanda">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<!-- usar nav-->
					<h2>Lista de APIs disponibles</h2>
					<ul class="usa_datos">
						<li><a href="{{ url('datos-abiertos/documentacion-api-contratos') }}">API de Contratos</a>
							<ol>
								<li>Listar contratos</li>
								<li>Obtén todos los contratos por año</li>
								<li>Obtén la información completa por contrato</li>
								<li>Busca un contrato por palabra clave</li>
								<li>Obtén los valores oportunos del contrato</li>
							</ol>
						</li>
						<li><a href="{{ url('datos-abiertos/documentacion-api-proveedores') }}">API de Proveedores</a>
							<ol>
								<li>Obtén todos los proveedores</li>
								<li>Obtén la información de un solo proveedor</li>
							</ol>
						</li>
						<li><a href="{{ url('datos-abiertos/documentacion-api-dependencias') }}">API de Dependencias</a>
							<ol>
								<li>Obtén la lista de dependencias</li>
								<li>Obtén la relación entre dependencias y proveedores</li>
							</ol>
						</li>
						<li><a href="{{ url('datos-abiertos/documentacion-api-licitaciones') }}">API de Licitaciones</a>
							<ol>
								<li>Obtén la lista de licitaciones</li>
							</ol>
						</li>
					</ul>
					<a href="http://standard.open-contracting.org/latest/es/" class="btn default">Más información del Estándar de Contrataciones Abiertas</a>
				</div>
			</div>
		</div>
	</section>
@endsection