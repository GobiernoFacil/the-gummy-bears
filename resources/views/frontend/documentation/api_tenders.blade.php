@extends('frontend.layouts.master')

@section('content')
<div class="breadcrumb">
	<div class="col-sm-12">
    <a href="{{ url('datos-abiertos')}}" class="back"><strong>&lt;</strong> Lista de APIs</a>
	</div>
</div>
	<!--usa los datos-->
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="codigo">
						<h1 class="title_section">API de Licitaciones</h1>
						<!--listar proveedores-->
						<div class="divider">
							<h2>Obtén la lista de licitaciones</h2>
							<p>Esta es la lista de licitaciones (<em>tenders</em>) para la última versión de cada proceso de contratación.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/licitaciones/1">{{url('')}}/api/licitaciones/{page?}</a></li>
								<li><strong>Método:</strong> GET</li>
								
							</ul>
						</div>
						
						
						
					</div>
				</div>
			</div>
		</div>
@endsection