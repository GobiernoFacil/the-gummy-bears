@extends('frontend.layouts.master')

@section('content')
	<!--datos-->
	<section class="lead datos">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-xs-10 col-sm-offset-0 col-xs-offset-1">
					<h1><span>Gobierno abierto + Datos abiertos</span> ¿Cómo utilizar los datos?
					</h1>
					<a href="#" class="btn cta">¿Cómo usarlo?</a>
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
						<li><a href="#"	id="btn-dependencias">Catálogo de Dependencias</a></li>
						<li><a href="#"	id="btn-proveedores">Catálogo de Proveedores</a></li>
						<li><a href="#"	id="btn-web-service">Servicio Web Contrato</a></li>
					</ul>
					<a href="http://standard.open-contracting.org/latest/es/" class="btn default">Más información del Estándar de Contrataciones Abiertas</a>
				</div>
				<div class="col-sm-6">
					<div class="codigo">
						<!--listar contratos-->
						<div id="listar-contratos">
							<h2>Listar contratos</h2>
							<p>Genera archivo JSON con la lista de contratos para una dependencia.</p>
							<ul>
								<li><strong>Url:</strong> ocpcdmx/listarcontratos</li>
								<li><strong>Firma de entrada: </strong>
								<code>{<br>"dependencia" : "901",<br>}<br>
								</code>
								</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
											{
												<div class="box">
													"ocdsID": "OCDS-87SD3T-CONVENIO-0002-2015", <br>
													"ejercicio": "2015",<br>
													"cveDependencia": "901",<br>
													"nomDependencia": "SECRETARÍA DE FINANZAS”<br>
												</div>
											},
										</div>
										<div class="box">		
											{
												<div class="box">
													 "ocdsID": "OCDS-87SD3T-OM-30001101-0001-2015", <br>
													 "ejercicio": "2015",<br>
													"cveDependencia": "901",<br>
													"nomDependencia": "SECRETARÍA DE FINANZAS"
												</div>
											} 
										</div>
									]
									</code>
								</li>
								<li><strong>Método:</strong> POST</li>
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
							<h2>Catálogo de Proveedores</h2>
							<p>Genera archivo JSON con la lista de los proveedores de la CDMX.</p>
							<ul>
								<li><strong>Url:</strong> ocpcdmx/cproveedores</li>
								<li><strong>Firma de entrada: </strong>
								N/A
								</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
										{
											<div class="box">
												"id": "167",<br>
												"rfc": "ACC060127JD6 ",<br>
												"name": "AREA CONSULTORES Y CONSTRUCTORES", <br>
												"address": {
												<div class="box">
													"streetAddress": "RETORNO 552 ", <br>
													"locality": "AVANTE COYOACAN ", <br>
													"region": "DF ",<br>
													"postalCode": "04460", <br>
													"countryName": "MX"
												</div>
												},<br>
												"contactPoint":{ 
												<div class="box">
													"name": "AREA",<br>
													"email": null,<br>
													"telephone": "56795508", <br>
													"faxNumber": "46331316", <br>
													"url": null
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
						
						<!-- contratos-->
						<div id="web-contratos">
							<h2>Servicio Web Contrato</h2>
							<p>Genera el archivo JSON en base al estándar OCDS para mostrar el proceso de licitación.</p>
							<ul>
								<li><strong>Url:</strong> ocpcdmx/contratos</li>
								<li><strong>Firma de entrada: </strong>
									<code>{
										<div class="box">
											"dependencia" : "901",<br>
											"contrato": "OCDS-87SD3T-SEFIN-30001105-005-2013" 
										</div>
										}
									</code>
								</li>
								<li><strong>Respuesta:</strong>
									<code>
									[
										<div class="box">
										{
											<div class="box">
												"uri": "http://inovacion.finanzas.df.gob.mx/ocds", <br>
												"publishedDate": "2015-01-02",<br>
												"publisher": {																												<div class="box">
													"scheme": "http://innovacion.finanzas.df.gob.mx/ocds/ArchivoJSONDep/Dependencias.json",<br>								
													"name": "CDMX-SEFIN",<br>
													"uri": "http://www.finanzas.df.gob.mx/", "uid": "901"																	</div>
												},<br>
												"releases": [																																	<div class="box">
													{																																				<div class="box">
														"ocid": "OCDS-87SD3T-SEFIN-30001105-006-2013", <br>
														"id": "1",<br>
														"date": "30/12/2013",<br>
														"tag": "contract",<br>
														"initiationType": "tender",<br>
														"planning": {
															<div class="box">
																"budget": {
																	<div class="box">	
																		"amount": {	 
																		<div class="box">
																			"amount": "17452450.07",<br>
																			"currency": "mxn" 
																		</div>
																		},
																	</div>																													"project": "CONTRATACIÓN PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN"											
																}, <br>
																"documents": [
																	<div class="box">
																	{
																		<div class="box">																																	"id": "1",<br>
																			"title": "Suficiencia Presupuestal",<br>
																			"url": null,<br>
																			"datePublished": "30/12/2013", <br>
																			"format": "application/pdf",<br> 
																			"language": "es"
																		</div>
																	},<br> 
																	{
																		<div class="box">
																			"id": "2",<br>
																			"title": "Anexo Técnico",<br>
																			"url": null,<br>
																			"datePublished": "30/12/2013",<br>
																			"format": "application/pdf",<br>
																			"language": "es"
																		</div>
																	}
																	</div>
																]
															</div>
														},<br>
														"buyer": {
															<div class="box">
																"identifier": "901", 
																"name": "SEFIN", 
																"address": {
																	<div class="box">
																		"streetAddress": " Av. Dr. Lavista 144, Doctores",<br>
																		"locality": "Cuauhtemoc",<br>
																		"region": "CDMX",<br>
																		"postalCode": "06720",<br>
																		"countryName": "México" 
																	</div>
																},<br>
																"contactPoint": { 
																	<div class="box">
																		"name": "Pendiente", <br>
																		"email": null,<br>
																		"telephone": null,<br> 
																		"faxNumber": null,<br>
																		"url": null
																	</div>
																}
															</div>
														},<br>
														"tender": {
															<div class="box">
																"id": "30001105-006-2013",<br>
																"title": "CONTRATACIÓN PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN",<br>
																"description": "CONTRATACIÓN DEL SERVICIO DE OPERADORES PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN, ASÍ• COMO PARA EL SEGUIMIENTO Y CONTROL DE LAS ACTIVIDADES ",<br>
																"status": "active",<br>
																"items": [
																	<div class="box">
																		{
																			<div class="box">
																				"id": "1",<br>
																				"description": "CONTRATACIÓN DEL SERVICIO DE OPERADORES PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN, ASÍ• COMO PARA EL SEGUIMIENTO Y CONTROL DE LAS ACTIVIDADES ",<br>
																				"quantity": "1",<br>
																				"unit": "Contratación"
																			</div>	
																		}
																	</div>
																],<br>
																"value": {
																	<div class="box">
																		"amount": "17452450.07",<br>
																		"currency": "mxn" 
																	</div>
																},<br>
																"procurementMethod": "open", <br>
																"awardCriteria": "lowestCost", <br>
																"submissionMethod": "inPerson", <br>
																"tenderPeriod": {
																	<div class="box">
																		"startDate": "30/12/2013",<br>
																		"endDate": "03/01/2014" 
																	</div>
																},<br>
																"enquiryPeriod": { 
																	<div class="box">
																		"startDate": "03/01/2014",  <br>
																		"endDate": "03/01/2014"
																	</div>
																},<br>
																"hasEnquiries": null, <br>
																"eligibilityCriteria": null, <br>
																"awardPeriod": {
																	<div class="box">
																		"startDate": "03/01/2014", <br>
																		"endDate": "03/01/2014" 
																	</div>
																},<br>
																"numberOfTenderers": "2", <br>
																"tenders": [
																	<div class="box">
																		{
																		<div class="box">
																			"identifier": "1",<br>
																			"name": "DIGIPRO, S.A. DE C.V.", <br>
																			"address": {
																			<div class="box">
																				"streetAddress": "Blvd. Manuel Ávila Camacho No. 126-1",<br>
																				"locality": "Miguel Hidalgo",<br>
																				"region": "CDMX",<br>
																				"postalCode": "11000",<br>
																				"countryName": "México" 
																			</div>
																			},<br>
																			"contactPoint": { 
																			<div class="box">
																				"name": "pendiente",<br> 
																				"email": null, <br>
																				"telephone": null, <br>
																				"faxNumber": null, <br>
																				"url": null
																			</div>
																			} 
																		</div>
																		},<br>
																		{
																		<div class="box">
																			"identifier": "2",<br>
																			"name": "OPTIMUS CONSULTORÍA S.A. DE C.V.", <br>
																			"address": {
																			<div class="box">
																				"streetAddress": "Río Lerma 196 Bis",<br>
																				"locality": "Cuauhtémoc", <br>
																				"region": "CDMX", <br>
																				"postalCode": "06500",<br> 
																				"countryName": "México"
																			</div>
																			},<br>
																			"contactPoint": {
																			<div class="box">	
																				"name": "pendiente",<br>
																				"email": null,<br>
																				"telephone": null,<br>
																				"faxNumber": null,<br>
																				"url": null
																			</div>
																			}
																		</div>
																		}
																	</div>
																],<br>
																"procuringEntity": {
																	<div class="box">
																	"identifier": "901", <br>
																	"name": "SEFIN", <br>
																	"address": {
																		<div class="box">
																		"streetAddress": "Av. Dr. Lavista 144, Doctores",  <br>
																		"locality": "Cuauhtemoc", <br>
																		"region": "CDMX", <br>
																		"postalCode": "06720", <br>
																		"countryName": "México" 
																		</div>
																	},<br>
																	"contactPoint": { 
																		<div class="box">
																			"name": "pendiente", <br>
																			"email": null, <br>
																			"telephone": null, <br>
																			"faxNumber": null, <br>
																			"url": null
																		</div>
																	}
																	</div>
																},<br>
																"documents": [
																	<div class="box">
																	{
																		<div class="box">
																			"id": "1",<br>
																			"title": "Oficio Invitación",<br>
																			"url": null,<br>
																			"datePublished": "03/01/2014",<br>
																			"format": "application/pdf",<br>
																			"language": "es"
																		</div>
																	},
																	</div>
																	<div class="box">
																	{
																		<div class="box">
																			"id": "2",<br>
																			"title": "Junta de aclaración",<br>
																			"url": null,<br>
																			"datePublished": "03/01/2014",<br>
																			"format": "application/pdf",<br>
																			"language": "es"
																		</div>
																	}
																	</div>
																],<br>
																"milestones": null,<br>
																"amendment": null
															</div>
														},<br>
														"awards": [
															<div class="box">
															{
																<div class="box">
																	"id": "1",<br>
																	"title": "CONTRATACIÓN PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN",<br>
																	"description": "CONTRATACIÓN DEL SERVICIO DE OPERADORES PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN, ASÍ• COMO PARA EL SEGUIMIENTO Y CONTROL DE LAS ACTIVIDADES ",<br>
																	"status": "active", <br>
																	"date": "13/01/2014",<br>
																	"value": {
																		<div class="box">
																			"amount": "17452450.07",<br>
																			"currency": "mxn"
																		</div>
																	 },<br>
																	 "suppliers": {
																		 <div class="box">
																			 "identifier": "RFC",<br>
																			 "name": "OPTIMUS CONSULTORÍA S.A. DE C.V.", <br>
																			 "address": {
																				 <div class="box">
																					 "streetAddress": "Río Lerma 196 Bis", <br>
																					 "locality": "Cuauhtémoc",<br>
																					 "region": "CDMX",<br>
																					 "postalCode": "6500", <br>
																					 "countryName": "México"
																				 </div>
																			},<br>
																			"contactPoint": {
																				<div class="box">
																					"name": "pendiente",<br>
																					"email": null,<br>
																					"telephone": null,<br>
																					"faxNumber": null,<br>
																					"url": null
																				</div>
																			}
																		 </div>
																	},<br>
																	"items": [ 
																		<div class="box">
																			{
																			<div class="box">
																				"id": "1",<br>
																				"description": "CONTRATACIÓN DEL SERVICIO DE OPERADORES PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN",<br>
																				"quantity": "1",<br>
																				"unit": "Contratación" 
																			</div>
																			}
																		</div>
																	],<br>
																	"documents": [
																		<div class="box">
																		{
																			<div class="box">
																				"id": "1",<br>
																				"title": "Fallo",<br>
																				"url": null,<br>
																				"datePublished": "13/01/2014", <br>
																				"format": "application/pdf", <br>
																				"language": "es"
																			</div>
																		}
																		</div>
																	],<br>
																	"amendment": null
																</div>
															}
															</div>
														],<br>
														"contracts": [
															<div class="box">
															{
																<div class="box">
																	"id": "1",<br>
																	"awardID": "RFC-AWARD",<br>
																	"title": "CONTRATACIÓN PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN",<br>
																	"description": "CONTRATACIÓN DEL SERVICIO DE OPERADORES PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN, ASÍ• COMO PARA EL SEGUIMIENTO Y CONTROL DE LAS ACTIVIDADES ",<br>
																	"status": "active", <br>
																	"period": {
																		<div class="box">
																			"startDate": "16/01/2014",<br>
																			"endDate": "31/12/2014" 
																		</div>
																	},<br>
																	"value": {
																		<div class="box">
																			"amount": "17452450.07", <br>
																			"currency": "mxn"
																		</div>
																	},<br> 
																	"items": [
																		<div class="box">
																		{
																			<div class="box">
																			"id": "1",<br>
																			"description": "CONTRATACIÓN DEL SERVICIO DE OPERADORES PARA EL MANTENIMIENTO DE SISTEMAS Y OPERACIÓN",<br>
																			"quantity": "1",<br>
																			"unit": "Contratación"<br> 
																			</div>
																		}
																		</div>
																	],<br>
																	"dateSigned": "13/01/2014", <br>
																	"documents": [
																		<div class="box">
																		{
																			<div class="box">
																				"id": "1",<br>
																				"title": "Contrato",<br> 
																				"url": null,<br> 
																				"datePublished": "13/01/2014", <br> 
																				"format": "application/pdf", <br> 
																				"language": "es"
																			</div>
																		} 
																		</div>
																	],<br>
																	"amendment": null 
																</div>
															}
															</div>
														],<br>
														"language": "es"
													</div>																																			}	
												</div>
												]
											</div>
										}
										</div>
									]
									</code>
								</li>
								<li><strong>Método:</strong> POST</li>
							</ul>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection