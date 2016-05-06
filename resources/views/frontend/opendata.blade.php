@extends('frontend.layouts.master')

@section('content')
	<!--datos-->
	<section class="lead datos">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-xs-10 col-sm-offset-0 col-xs-offset-1">
					<h1><span>Gobierno abierto + Datos abiertos</span> 
					</h1>
					<a href="#" class="btn cta">¿Cómo utilizar los datos?</a>
				</div>
			</div>
		</div>
	</section>
	
	<!--usa los datos-->
	<section class="datos_pa_labanda">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>¿Cómo utilizar los datos?</h1>
					<p>El uso de un <strong>Estándar de Datos para Contrataciones Abiertas</strong> forma parte de la estrategia del Gobierno de la CD<span class="mx">MX</span> para garantizar a sus ciudadanos un <strong>Gobierno abierto</strong>.</p>
					<p>Este estándar ayudará a prevenir y reducir la corrupción en el proceso de contratación, permitiendo conseguir una mejor rentabilidad de las inversiones y asegurar así bienes y servicios de alta calidad para los ciudadanos.</p>
					<p>El Estándar le dará a los interesados acceso a datos vinculados, permitiéndoles usar los datos sobre contrataciones de un forma más efectiva.</p>
					<!-- usar nav-->
					<ul class="usa_datos">
						<li><a href="#" id="btn-listar-contratos" class="current">Listar contratos</a></li>
						<!--<li><a href="#"	id="btn-dependencias">Catálogo de Dependencias</a></li>-->
						<li><a href="#"	id="btn-proveedores">Lista de Proveedores</a></li>
						<li><a href="#"	id="btn-web-service">Busca un contrato</a></li>
					</ul>
					<a href="http://standard.open-contracting.org/latest/es/" class="btn default">Más información del Estándar de Contrataciones Abiertas</a>
				</div>
				<div class="col-sm-6">
					<div class="codigo">
						<!--listar contratos-->
						<div id="listar-contratos">
							<h2>Listar contratos</h2>
							<p>Este método regresa la clave única para todos los contratos disponibles. La clave se puede usar para obtener el contrato completo</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{url('')}}/api/contratos/todos">{{url('')}}/api/contratos/todos</a></li>
								<li><strong>Método:</strong> GET</li>
								
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
											{
												<div class="box">
													"id":1,<br>
													"ocdsid": "CDS-87SD3T-SEFIN-AD-SF-DRM-001-2015", <br>
													"ejercicio": "2015",<br>
													"cvedependencia": "901",<br>
													"nomdependencia": "SECRETAR\u00cdA DE FINANZAS",<br>
													"published_date": "2015-11-04",<br>
													"uri": "http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-AD-SF-DRM-001-2015.json",<br>
													"publisher_id":1,<br>
													"created_at": "2016-05-03 21:46:31",<br>
													"updated_at": "2016-05-03 21:46:33"
												</div>
											},
										</div>
									]
									</code>
								</li>
							</ul>
						</div>
						<!-- catalogo de dependecias-->
						<div id="catalogo-dependecias">
							<h2>Catálogo de Dependencias</h2>
							<p>Genera archivo JSON con la lista de dependencias de la CDMX.</p>
							<ul>
								<li><strong>Url:</strong> ocpcdmx/cdependencias</li>
								<li><strong>Firma de entrada: </strong>
								N/A
								</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
										{
											<div class="box">
											"id": "901",<br>
											"name": "SECRETARÍA DE FINANZAS", <br>
											"address":{
											<div class="box">
												"streetAddress": "PLAZA DE LA CONSTITUCION AREA1", <br>
												"locality": "CUAUHTÉMOC,CENTRO ",<br>
												"region": "DF",<br>
												"postalCode": "6000",<br>
												"countryName": "MX" <br>												
											</div>
											},<br>
											"contactPoint":{
												<div class="box">
													"name": "Alberto Chavez Trejo", <br>
													"email": "achavez@finanzas.df.gob.mx", <br>
													"telephone": “55883388”,<br>
													"faxNumber": null,<br>
													"url": "www.finanzas.df.gob.mx"<br>
												</div>
											}
											</div>
										}
										</div>
									]
									</code>
								</li>
								<li><strong>Método:</strong> GET</li>
							</ul>
						</div>
						
						<!-- catálogo de proveedores-->
						<div id="catalogo-proveedores">
							<h2>Lista de Proveedores</h2>
							<p>Obtén la información de contacto de todos los proveedores que han participado en una licitación o han obtenido un contrato con la CDMX. Esta lista solo cuenta con los proveedores que aparecen en los contratos publicados en el sitio.</p>
							<ul>
								<li><strong>Url:</strong> <a href="{{ url('api/proveedores/todos')}}"> {{ url('api/proveedores/todos') }} </a></li>
								<li><strong>Método:</strong> GET</li>
								
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
										{
											<div class="box">
												"id": "1",<br>
												"rfc": "CUMB306206M8 ",<br>
												"name": "SERVICIOS INTEGRALES CONTRA INCENDI", <br>
												"total":null,<br>
												"street”:”CHIPITLÁN”,<br>
												”locality":"SAN MATEO; TEXAS”,<br>
												”region”:”PUE”,<br>
												”zip”:”74000”,<br>
												”country":"MX",<br>
												"contact_name”:”ARTURO C.”,<br>
												”email":"No Capturado",<br>
												"phone”:”555-55-55”,<br>
												”fax”:”555-55-55”,<br>
												”url":"No Capturado",<br>
												"created_at":"2016-05-03 21:46:33",<br>
												"updated_at":"2016-05-03 21:52:16",<br>
												"tender_num":3,<br>
												"award_num":3,<br>
												"budget":2278067.39 
											</div>
										}
										</div>
									]
									</code>
								</li>
							</ul>
						</div>
						
						<!-- contratos-->
						<div id="web-contratos">
							<h2>Busca un contrato por palabra clave</h2>
							<p>Es posible buscar por palabra clave dentro del contrato. El campo de búsqueda se llama “query”, y es opcional seleccionar la página de resultados de la búsqueda. La respuesta incluye el número de resultados, página que se está regresando y los resultados por página.</p>
							<ul>
								<li><strong>Url:</strong> {{ url()}}/api/contratos/buscar/{page?}?query</a></li>
								<li><strong>Método:</strong> GET</li>
								<li><strong>Respuesta:</strong>
									<code>
									{
										<div class="box">
										"contracts":[
											<div class="box">
											{
												<div class="box">
													id":15,<br>
													"ocdsid":"OCDS-87SD3T-SEFIN-DRM-AD-CC-010-2015",<br>
													"ejercicio":2015,<br>
													"cvedependencia":901,<br>
													"nomdependencia":"SECRETAR\u00cdA DE FINANZAS",<br>
													"published_date":"2015-10-12",<br>
													"uri":"http:\/\/www.contratosabiertos.cdmx.gob.mx\/OCDS-87SD3T-SEFIN-DRM-AD-CC-010-2015.json",<br>
													"publisher_id":1,<br>
													"created_at":"2016-05-03 21:46:31",<br>
													"updated_at":"2016-05-03 21:46:47”
												</div>
											}, 
											</div>
											…],”page":1,"total":1	 
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
	</section>
@endsection