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
						<h1 class="title_section">API de Dependencias</h1>
						<!--listar proveedores-->
						<div class="divider">
							<h2>Obtén la lista de dependencias</h2>
							<p>Esta es la lista de dependencias (o compradores).</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/dependencias/todas">{{url('')}}/api/dependencias/todas</a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
											{
												<div class="box">
													<span class="string">"id"</span>:<span class="int">1</span>,											   <br>
									<span class="string">"local_id"</span>:<span class="string">"0901"</span>,								   <br>
									<span class="string">"uri"</span>:<span class="string">"http:\/\/www.contratosabiertos.cdmx.gob.mx"</span>,<br>
									<span class="string">"name"</span>:<span class="string">"SECRETAR\u00cdA DE FINANZAS"</span>,			   <br>
									<span class="string">"address_id"</span>:<span class="int">null</span>,									   <br>
									<span class="string">"contact_point_id"</span>:<span class="int">null</span>,							   <br>
									<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:33"</span>,				   <br>
									<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:46:33"</span>				   <br>
												</div>
											},..
										</div>
									]
									</code>
								</li>
							</ul>
						</div>
						
						
						<div class="divider">
							<h2>Obtén la relación entre dependencias y proveedores</h2>
							<p>Este <em>endpoint</em> contiene un resumen de la relación de las dependencias con cada proveedor.
</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/dependencia-proveedor">{{url('')}}/api/dependencia-proveedor/{page?} </a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
									{
										<div class="box">
										<span class="string">"id"</span>:<span class="int">21</span>,							   <br>
										<span class="string">"provider_id"</span>:<span class="int">21</span>,					   <br>
										<span class="string">"buyer_id"</span>:<span class="int">1,</span>						   <br>
										<span class="string">"tender_num"</span>:<span class="int">1</span>,					   <br>
										<span class="string">"award_num"</span>:<span class="int">1</span>,						   <br>
										<span class="string">"budget"</span>:<span class="int">9742882</span>,					   <br>
										<span class="string">"contract_budget"</span>:<span class="int">974288</span>2,			   <br>
										<span class="string">"created_at"</span>:<span class="string">"2016-05-15 23:44:17"</span>,<br>
										<span class="string">"updated_at"</span>:<span class="string">"2016-05-15 23:44:17"</span>,<br>
										<span class="string">"buyer"</span>:
											<div class="box">
											{
												<div class="box">
												<span class="string">"id"</span>:<span class="int">1</span>,											   <br>
												<span class="string">"local_id"</span>:<span class="string">"0901"</span>,								   <br>
												<span class="string">"uri"</span>:<span class="string">"http:\/\/www.contratosabiertos.cdmx.gob.mx"</span>,<br>
												<span class="string">"name"</span>:<span class="string">"SECRETAR\u00cdA DE FINANZAS"</span>,			   <br>
												<span class="string">"address_id"</span>:<span class="int">null</span>,									   <br>
												<span class="string">"contact_point_id"</span>:<span class="int">null</span>,							   <br>
												<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:33"</span>,				   <br>
												<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:46:33"</span>				   <br>
												</div>
											},
											</div>
										<span class="string">"provider"</span>:
											<div class="box">
											{
												<div class="box">
												<span class="string">"id"</span>:<span class="int">21</span>,									   <br>
												<span class="string">"rfc"</span>:<span class="string">"SMI680112PG9"</span>,					   <br>
												<span class="string">"name"</span>:<span class="string">"SERVICIOS MEXICANOS DE INGENIERIA"</span>,<br>
												<span class="string">"total"</span>:<span class="int">null</span>,								   <br>
												<span class="string">"street"</span>:<span class="string">"AVENIDA COYOACAN"</span>,			   <br>
												<span class="string">"locality"</span>:<span class="string">"BENITO JUAREZ"</span>,				   <br>
												<span class="string">"region"</span>:<span class="string">"DF"</span>,							   <br>
												<span class="string">"zip"</span>:<span class="string">"03100"</span>,							   <br>
												<span class="string">"country"</span>:<span class="string">"MX"</span>,							   <br>
												<span class="string">"contact_name"</span>:<span class="string">"ING. CARLOS DAVID SANCHEZ PE\u00d1ALOZA"</span>,<br>
												<span class="string">"email"</span>:<span class="string">"atecion.clientes@semicmex.com.mx"</span>,<br>
												<span class="string">"phone"</span>:<span class="string">"55756287"</span>,						   <br>
												<span class="string">"fax"</span>:<span class="string">"55756287"</span>,						   <br>
												<span class="string">"url"</span>:<span class="string">"WWW.SEMICMEX.COM.MX"</span>,			   <br>
												<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:48"</span>,		   <br>
												<span class="string">"updated_at"</span>:<span class="string">"2016-05-12 04:46:30"</span>,		   <br>
												<span class="string">"tender_num"</span>:<span class="int">1</span>,							   <br>
												<span class="string">"award_num"</span>:<span class="int">1</span>,								   <br>
												<span class="string">"budget"</span>:<span class="int">9742882.48</span>,						   <br>
												<span class="string">"contract_budget"</span>:<span class="int">9742882.48</span>				   <br>
												</div>
											}
											</div>
										</div>
									}, ...
									</div>
									]
									</code>
								</li>


							</ul>
						</div>
						
					</div>
				</div>
			</div>
		</div>
@endsection