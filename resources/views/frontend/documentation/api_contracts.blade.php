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
						<h1 class="title_section">API de Contratos</h1>
						<!--listar contratos-->
						<div class="divider">
							<h2>Listar contratos</h2>
							<p>Este método regresa la clave única para todos los contratos disponibles. La clave se puede usar para obtener el contrato completo.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/contratos/todos">{{url('')}}/api/contratos/todos</a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
											{
												<div class="box">
													<span class="string">"id"</span>:<span class="int">1</span>,<br>
													<span class="string">"ocdsid"</span>: <span class="string">"CDS-87SD3T-SEFIN-AD-SF-DRM-001-2015"</span>, <br>
													<span class="string">"ejercicio"</span>: <span class="int">2015</span>,<br>
													<span class="string">"cvedependencia"</span>: <span class="int">901</span>,<br>
													<span class="string">"nomdependencia"</span>: <span class="string">"SECRETAR\u00cdA DE FINANZAS"</span>,<br>
													<span class="string">"published_date"</span>: <span class="string">"2015-11-04"</span>,<br>
													<span class="string">"uri"</span>: <span class="string">"http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-AD-SF-DRM-001-2015.json"</span>,<br>
													<span class="string">"publisher_id"</span>:<span class="int">1</span>,<br>
													<span class="string">"created_at"</span>: <span class="string">"2016-05-03 21:46:31"</span>,<br>
													<span class="string">"updated_at"</span>: <span class="string">"2016-05-03 21:46:33"</span>
												</div>
											},…
										</div>
									]
									</code>
								</li>
							</ul>
						</div>
						
						
						<div class="divider">
							<h2>Obtén todos los contratos por año</h2>
							<p>Similar al <em>endpoint</em> anterior, este sirve para obtener todos los contratos en un año determinado. El <em>array</em> contiene la clave única del contrato y el nombre de quien publica la información.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/contratos/ejercicio/2015">{{url('')}}/api/contratos/ejercicio/{year} </a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
											{
												<div class="box">
													<span class="string">"id"</span>:<span class="int">1</span>,<br>
													<span class="string">"ocdsid"</span>: <span class="string">"CDS-87SD3T-SEFIN-AD-SF-DRM-001-2015"</span>, <br>
													<span class="string">"ejercicio"</span>: <span class="int">2015</span>,<br>
													<span class="string">"cvedependencia"</span>: <span class="int">901</span>,<br>
													<span class="string">"nomdependencia"</span>: <span class="string">"SECRETAR\u00cdA DE FINANZAS"</span>,<br>
													<span class="string">"published_date"</span>: <span class="string">"2015-11-04"</span>,<br>
													<span class="string">"uri"</span>: <span class="string">"http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-AD-SF-DRM-001-2015.json"</span>,<br>
													<span class="string">"publisher_id"</span>:<span class="int">1</span>,<br>
													<span class="string">"created_at"</span>: <span class="string">"2016-05-03 21:46:31"</span>,<br>
													<span class="string">"updated_at"</span>: <span class="string">"2016-05-03 21:46:33"</span>
												</div>
											},…
										</div>
									]
									</code>
								</li>
							</ul>
						</div>
						
						
						<div class="divider">
							<h2>Obtén la información completa por contrato</h2>
							<p>Con este <em>endpoint</em>, se obtiene la información completa del contrato, como lo indica el <a href="http://standard.open-contracting.org/latest/es/schema/reference/">Open Contracting Partnership</a>.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/contrato/OCDS-87SD3T-SEFIN-DRM-AD-CC-008-2015">{{url('')}}/api/contrato/{ocds} </a></li>
								<li><strong>Método:</strong> GET</li>
								
							</ul>
						</div>
						
						
						<!-- contratos-->
						<div class="divider">
							<h2>Busca un contrato por palabra clave</h2>
							<p>Es posible buscar por palabra clave dentro del contrato. El campo de búsqueda se llama "<em>query</em>", y es opcional seleccionar la página de resultados de la búsqueda. La respuesta incluye el número de resultados, página que se está regresando y los resultados por página.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/contratos/buscar?query=predial">
									{{ url()}}/api/contratos/buscar/{page?}?query</a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									<code>
									{
										<div class="box">
										<span class="string">"contracts"</span>:[
											<div class="box">
											{
												<div class="box">
													<span class="string">"id"</span>:<span class="int">15</span>,<br>
													<span class="string">"ocdsid"</span>:<span class="string">"OCDS-87SD3T-SEFIN-DRM-AD-CC-010-2015"</span>,<br>
													<span class="string">"ejercicio"</span>:<span class="int">2015</span>,<br>
													<span class="string">"cvedependencia"</span>:<span class="int">901</span>,<br>
													<span class="string">"nomdependencia"</span>:<span class="string">"SECRETAR\u00cdA DE FINANZAS"</span>,<br>
													<span class="string">"published_date"</span>:<span class="string">"2015-10-12"</span>,<br>
													<span class="string">"uri"</span>:<span class="string">"http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-DRM-AD-CC-010-2015.json"</span>,<br>
													<span class="string">"publisher_id"</span>:<span class="int">1</span>,<br>
													<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:31"</span>,<br>
													<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:46:47”</span>
												</div>
											}, 
											</div>
											…],<span class="string">"page"</span>:<span class="int">1</span>,<br>
											   <span class="string">"total"</span>:<span class="int">1</span>
										</div> 
									}
									</code>
								</li>
							</ul>
						</div>
						
						<div class="divider">
							<h2>Obtén los valores oportunos del contrato</h2>
							<p>Si solo se quiere la información (agregada) más reciente del contrato, se puede usar esta API, que regresa la información del dinero presupuestado, autorizado y gastado por contrato, para el último <em>release</em> (versión del contrato). El formato en el que se obtiene la información del contrato, difiere del estándar, en cuanto a que solo es un resumen del mismo, y no el contrato completo.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/contrato/actual/OCDS-87SD3T-SEFIN-DRM-AD-CC-008-2015">
									{{ url()}}/api/contrato/actual/{ocds}</a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									
								<code>
								{
									<div class="box">
									<span class="string">"id"</span>:<span class="int">8</span>,<br>
									<span class="string">"contract_id"</span>:<span class="int">8</span>,<br>
									<span class="string">"release_id"</span>:<span class="int">8</span>,<br>
									<span class="string">"ocdsid"</span>:<span class="string">"OCDS-87SD3T-SEFIN-DRM-AD-011-2015"</span>,<br>
									<span class="string">"planning"</span>:<span class="int">1270340.49</span>,<br>
									<span class="string">"tender"</span>:<span class="int">1270340.49</span>,<br>
									<span class="string">"awards"</span>:<span class="int">1777723.76</span>,<br>
									<span class="string">"contracts"</span>:<span class="int">0</span>,<br>
									<span class="string">"date"</span>:<span class="string">"2015-10-07"</span>,<br>
									<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:47:06"</span>,<br>
									<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:47:06"</span>,<br>
									<span class="string">"local_id"</span>:<span class="int">1</span>,<br>
									<span class="string">"release"</span>:<br>
										<div class="box">
										{
										<div class="box">
										<span class="string">"id"</span>:<span class="int">8</span>,<br>
										<span class="string">"local_id"</span>:<span class="int">1</span>,<br>
										<span class="string">"contract_id"</span>:<span class="int">8</span>,<br>
										<span class="string">"ocid"</span>:<span class="string">"OCDS-87SD3T-SEFIN-DRM-AD-011-2015"</span>,<br>
										<span class="string">"date"</span>:<span class="string">"2015-10-07"</span>,<br>
										<span class="string">"initiation_type"</span>:<span class="string">"tender"</span>,<br>
										<span class="string">"planning_id"</span>:<span class="int">null</span>,<br>
										<span class="string">"buyer_id"</span>:<span class="int">1</span>,<br>
										<span class="string">"tender_id"</span>:<span class="int">null</span>,<br>
										<span class="string">"language"</span>:<span class="string">"es"</span>,<br>
										<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:40"</span>,<br>
										<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:52:15"</span>,<br>
										<span class="string">"is_latest"</span>:<span class="int">1</span>,<br>
										<span class="string">"tender"</span>:
											<div class="box">
											{
												<div class="box">
												<span class="string">"id"</span>:<span class="int">8</span>,																	 <br>
												<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:40"</span>,										 <br>
												<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:46:40"</span>,										 <br>
												<span class="string">"release_id"</span>:<span class="int">8</span>,															 <br>
												<span class="string">"local_id"</span>:<span class="string">"OCDS-87SD3T-SEFIN-DRM-AD-011-2015"</span>,							 <br>
												<span class="string">"title"</span>:<span class="string">"MIGRACI\u00d3N DE LOS SERVIDORES"</span>,								 <br>
												<span class="string">"description"</span>:<span class="string">"MIGRACI\u00d3N DE LOS SERVIDORES"</span>,						 <br>
												<span class="string">"status"</span>:<span class="string">"complete"</span>,													 <br>
												<span class="string">"amount"</span>:<span class="int">1270340.49</span>,													 <br>
												<span class="string">"currency"</span>:<span class="string">"MXN"</span>,														 <br>
												<span class="string">"procurement_method"</span>:<span class="string">"limited"</span>,											 <br>
												<span class="string">"award_criteria"</span>:<span class="string">"bestValueToGovernment"</span>,								 <br>
												<span class="string">"tender_start"</span>:<span class="string">"2015-10-20"</span>,											 <br>
												<span class="string">"tender_end"</span>:<span class="string">"2015-10-20"</span>,												 <br>
												<span class="string">"enquiry_start"</span>:<span class="string">"1970-01-01"</span>,											 <br>
												<span class="string">"enquiry_end"</span>:<span class="string">"1970-01-01"</span>,												 <br>
												<span class="string">"award_start"</span>:<span class="string">"2015-10-20"</span>,												 <br>
												<span class="string">"award_end"</span>:<span class="string">"2015-10-20"</span>,												 <br>
												<span class="string">"has_enquiries"</span>:<span class="int">1</span>,														 <br>
												<span class="string">"eligibility_criteria"</span>:<span class="string">" Servicio,Condiciones,Precio,Otro&ANEXO TECNICO"</span>,<br>
												<span class="string">"number_of_tenderers"</span>:<span class="int">3</span>,												 <br>
												<span class="string">"submission_method":<span class="string">"written"</span>
												</div>
											},
											</div>
										<span class="string">"planning"</span>:
											<div class="box">
											{
												<div class="box">
												<span class="string">"id"</span>:<span class="int">8</span>,													  <br>
												<span class="string">"release_id"</span>:<span class="int">8</span>,											  <br>
												<span class="string">"amount"</span>:<span class="int">1270340.49</span>,									  <br>
												<span class="string">"currency"</span>:<span class="string">"MXN"</span>,										  <br>
												<span class="string">"project"</span>:<span class="string">"AUTORIZACI\u00d3N PRESUPUESTAL SPP\/449\/2015"</span>,<br>
												<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:40"</span>,						  <br>
												<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:46:40"</span>
												</div>
											},
											</div>
										<span class="string">"singlecontracts"</span>:[],<br>
										<span class="string">"awards"</span>:
											<div class="box">
											[
												<div class="box">
												{	
													<div class="box">											
													<span class="string">"id"</span>:<span class="int">6</span>	,									<br>
													<span class="string">"created_at"</span>:<span class="string">"2016-05-03 21:46:40"</span>,		<br>
													<span class="string">"updated_at"</span>:<span class="string">"2016-05-03 21:46:40"</span>,		<br>
													<span class="string">"local_id"</span>:<span class="int">1</span>	,							<br>
													<span class="string">"title"</span>:<span class="string">"MIGRACI\u00d3N DE LOS SERVIDORES"</spa<br>
													<span class="string">"description"</span>:<span class="string">"MIGRACI\u00d3N DE LOS SERVIDORES"</span>,<br>
													<span class="string">"status"</span>:<span class="string">"active"</span>,						<br>
													<span class="string">"date"</span>:<span class="string">"2016-01-07"</span>,					<br>
													<span class="string">"value"</span>:<span class="int">1777723.76</span>	,						<br>
													<span class="string">"currency"</span>:<span class="string">"MXN"</span>,						<br>
													<span class="string">"release_id"</span>:<span class="int">8</span>								<br>
													</div>
												}
												</div>
											]
											</div>
										
										</div>
										}
										</div>
									</div>
									}
								</code>
								</li>
							</ul>

						</div>
						
					</div>
				</div>
			</div>
		</div>
@endsection