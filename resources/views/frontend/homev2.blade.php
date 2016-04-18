@extends('frontend.layouts.master')

@section('content')
<!--lead home-->
<section class="lead homev2">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-xs-10 col-sm-offset-1 col-xs-offset-1">
				<h1><strong>Contrataciones Abiertas</strong> de la 
				CD<span class="mx">MX</span>
				</h1>
				<p class="center">Consulta la información de contrataciones realizadas por la CDMX desde diciembre de 2015.</p>
				<div class="bill">
					<div class="row">
						<div class="col-sm-4">
							<h3>$<strong><span id="amount">0</span></strong></h3>
							<p>Millones (MXN)</p>
						</div>
						<div class="col-sm-4">
							<h3><span id="tender">0</span></h3>
							<p>licitaciones</p>
						</div>
						<div class="col-sm-4">
							<h3><span id="contracts">0</span></h3>
							<p>Contrataciones</p>
						</div>
					</div>
				</div>
				<a href="{{ url('contratos') }}" class="btn cta">Explora las contrataciones de la CDMX</a>
			</div>
		</div>
	</div>
</section>

	<!--etapas-->
<section class="etapas">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h1>La <span>CD</span><strong>MX</strong> es la <span>primer ciudad del mundo</span> en implementar el 
					<a href="http://standard.open-contracting.org/?lang=es">Estándar de Contrataciones Abiertas</a></h1>
				
				<div id="mini-description-a">Con el <strong>Estándar de Contrataciones Abiertas</strong>, ahora los contratos públicos se liberarán desde la etapa de planeación hasta su ejecución, permitiéndote dar seguimiento al gasto de fondos públicos y mejorar la prestación de servicios.</div>

				<!-- stage nav-->
				@include ("frontend/home_slider/stages_nav")
					<a href="{{ url('que-son') }}" class="btn">¿Qué son las Contrataciones Abiertas?</a>
					<a href="{{ url('glosario') }}" class="btn">Consulta el Glosario para conocer más sobre Contrataciones Abiertas</a>

			</div>
			<div class="col-sm-6 pasos">
				<!-- planeación -->
				<div class="slide planeacion" data-step="planeacion">
					@include ("frontend/home_slider/stages-planeacion")
				</div>
				<!--licitación-->
				<div class="slide licitacion hide" data-step="licitacion">
					@include ("frontend/home_slider/stages-licitacion")
				</div>
				<!--adjudicacion-->
				<div class="slide adjudicacion hide">
					@include ("frontend/home_slider/stages-adjudicacion")
				</div>
				<!--contrato-->
				<div class="slide contrato hide">
					@include ("frontend/home_slider/stages-contrato")
				</div>
				<!--implementación-->
				<div class="slide implementacion hide">
					@include ("frontend/home_slider/stages-implementacion")
				</div>
			</div>
		</div>
	</div>
</section>
@endsection