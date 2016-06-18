@extends('frontend.layouts.master')

@section('content')
<!--lead home-->
<section class="lead homev2">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<h1><strong>¿Cómo compra <span class="mx">tu gobierno</span>?</strong></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 col-xs-12 col-sm-offset-2">
				<p class="info center">La <strong>CD<span class="mx">MX</span></strong> es la primera ciudad en el mundo en publicar información sobre todo su proceso de contrataciones.<sup>1</sup></p>
			
				<div class="bill">
					<div class="row">
						<div class="col-sm-5 col-xs-6 col-sm-offset-1">
							<p>Total de Contratos Firmados</p>
							<h3><span id="contracts">0</span></h3>
						</div>
						<div class="col-sm-5 col-xs-6 ">
							<p>Monto Total Contratado (MXN)<sup>2</sup></p>
							<h3>$<strong><span id="amount">0</span></strong><span class="mxn"> millones</span></h3>
						</div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-9 col-sm-offset-2">
					<p class="footnote"><strong>1</strong> Información disponible a partir de la implementación del estándar en 2015.<br><strong>2</strong> El monto contratado corresponde a las contrataciones abiertas realizadas en pesos mexicanos, por lo que el total no contiene las compras  realizadas en otras monedas.</p>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<a href="{{ url('contratos') }}" class="btn cta">Explora las compras de la <strong>CDMX &#x2794;</strong> </a>
					</div>
					<div class="col-md-6 col-sm-12">
						<a href="#" class="btn cta scroll">Conoce el proceso de una compra <strong><b>&#x2794;</b></strong></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

	<!--etapas-->
<section class="etapas">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<h2 class="center">Proceso de Compra de la <strong>CD<span class="mx">MX</span></strong>.</h2>
				<p class="info">Cada vez que <strong>tu gobierno realiza una compra</strong>, completa un proceso para elegir lo que más le convenga.</p>
			</div>
			<div class="col-sm-10 col-sm-offset-1">
				<iframe src="https://www.youtube.com/embed/xQvKHiERIJI" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="col-sm-4 col-sm-offset-2">
				<a href="{{ url('por-que') }}" class="btn">¿Por qué las Contrataciones Abiertas?</a>
			</div>
			<div class="col-sm-4">
			<a href="{{ url('glosario') }}" class="btn">Consulta los términos claves de las Contrataciones Abiertas</a>
			</div>
		</div>
	</div>
</section>
@endsection