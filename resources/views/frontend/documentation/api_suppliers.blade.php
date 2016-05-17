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
						<h1 class="title_section">API de Proveedores</h1>
						<!--listar proveedores-->
						<div class="divider">
							<h2>Obtén todos los proveedores</h2>
							<p>Obtén la información de contacto de todos los proveedores que han participado en una licitación o han obtenido un contrato con la CDMX. Esta lista solo cuenta con los proveedores que aparecen en los contratos publicados en el sitio.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/proveedores/todos">{{url('')}}/api/proveedores/todos</a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
											{
												<div class="box">
													<span class="string">"id"</span>:<span class="int">1</span>,										 <br>
									<span class="string">"rfc"</span>:<span class="string">"CUMB306206M8"</span>,						 <br>
									<span class="string">"name"</span>:<span class="string">"SERVICIOS INTEGRALES CONTRA INCENDI"</span>,<br>
									<span class="string">"total"</span>:<span class="int">null</span>,									 <br>
									<span class="string">"street"</span>:<span class="string">"CHIPITLÁN"</span>,						 <br>
									<span class="string">"locality"</span>:<span class="string">"SAN MATEO; TEXAS"</span>,				 <br>
									<span class="string">"region"</span>:<span class="string">"PUE"</span>,								 <br>
									<span class="string">"zip"</span>:<span class="string">"74000"</span>,								 <br>
									<span class="string">"country"</span>:<span class="string">"MX"</span>,								 <br>
									<span class="string">"contact_name"</span>:<span class="string">"ARTURO C."</span>,					 <br>
									<span class="string">"email"</span>:<span class="string">"No Capturado"</span>,						 <br>
									<span class="string">"phone"</span>:<span class="string">"555-55-55"</span>,						 <br>
									<span class="string">"fax"</span>:<span class="string">"555-55-55"</span>,							 <br>
									<span class="string">"url"</span>:<span class="string">"No Capturado"</span>,						 <br>
									<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:33"</span>,			 <br>
									<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:52:16"</span>,			 <br>
									<span class="string">"tender_num"</span>:<span class="int">3</span>,								 <br>
									<span class="string">"award_num"</span>:<span class="int">3</span>,									 <br>
									<span class="string">"budget"</span>:<span class="int">2278067.39</span>							 <br>
												</div>
											},..
										</div>
									]
									</code>
									

								</li>
							</ul>
						</div>
						
						
						<div class="divider">
							<h2>Obtén la información de un solo proveedor</h2>
							<p>Obtén la información de contacto de un proveedor mediante el RFC. El objeto por proveedor es idéntico al que regresa el <em>array</em> de todos los proveedores (el <em>endpoint</em> anterior).</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/proveedor/CCF121101KQ4">{{url('')}}/api/proveedor/{rfc} </a></li>
								<li><strong>Método:</strong> GET</li>
								
							</ul>
						</div>
						
					</div>
				</div>
			</div>
		</div>
@endsection