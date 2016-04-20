<?php $body_class = "error";
	  $title	  = "Página no encontrada"
?>
@extends('frontend.layouts.master')

@section('content')
<section>
<div class="container">
	<div class="row">
		<div class="col-sm-2 col-sm-offset-2">
			<?php echo file_get_contents("img/svg/404.svg"); ?>
		</div>
		<div class="col-sm-6">
			<h1>Página no encontrada</h1>
			<p class="info">La página que buscas no está disponible en el sitio de <strong>Contrataciones Abiertas de la CDMX</strong>,
				tal vez fue eliminada, ha cambiado su dirección o nunca existió.</p>
			<a href="{{ url('home2') }}" class="btn">Ir a la página principal</a>
		</div>
	</div>
</div>
</section>
@endsection