@extends('frontend.layouts.master')

@section('content')
<!--lead home-->
<section class="lead homev2">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-10 col-sm-offset-0 col-xs-offset-1">
				<h1><strong>¿Cómo compra <span class="mx">tu</span> gobierno?</strong></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
				<p class="info center">La <strong>CD<span class="mx">MX</span></strong> 
							es la primera ciudad en el mundo en publicar información sobre todo su proceso de contrataciones.*</p>
			
				<div class="bill">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-2">
							<h3><span id="contracts">0</span></h3>
							<p>Contrataciones</p>
						</div>
						<div class="col-sm-4">
							<h3>$<strong><span id="amount">0</span></strong></h3>
							<p>Millones (MXN)</p>
						</div>
						
					</div>
				</div>
				<p class="footnote center">*Información disponible a partir de diciembre de 2015 en la Secretaría de Finanzas</p>
				<div class="row">
					<div class="col-sm-6">
						<a href="{{ url('contratos') }}" class="btn cta">Explora las compras de la <strong>CDMX &#x2794;</strong> </a>
					</div>
					<div class="col-sm-6">
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
			<div class="col-sm-10 col-sm-offset-1">
				<iframe width="854px" height="480px" src="https://www.youtube.com/embed/pvI4QfhpEAo" frameborder="0" allowfullscreen></iframe>
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