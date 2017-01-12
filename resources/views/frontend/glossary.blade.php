extends('frontend.layouts.master')

@section('content')
<!--glosario-->
<section class="datos_pa_labanda">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h1>Preguntas Frecuentes sobre Contrataciones Abiertas</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="codigo">
				<div class ="row">
					<div class="col-sm-10 col-sm-offset-1">
							<!--sobre contraciones abiertas-->
							<h2>Sobre Contrataciones Abiertas</h2>
							<ol>
								<li><strong><a href="#contratacionesAbiertas">¿Qué son las Contrataciones Abiertas?</a></strong></li>
								<li><strong><a href="#asociacionContrataciones">¿Qué es la Asociación de Contrataciones Abiertas?</a></strong></li>
								<li><strong><a href="#estandarContrataciones">¿Qué es el Estándar de Datos de Contrataciones Abiertas? ¿Por qué es importante?</a></strong></li>
								<li><strong><a href="#estandarDatos">¿Cómo funciona el Estándar de Datos de Contrataciones Abiertas?</a></strong></li>
								<li><strong><a href="#etapasDatos">¿Cuáles son las 5 etapas del Estándar de Datos de Contrataciones Abiertas?</a></strong></li>
							</ol>
								<div class="divider"></div>
							<!--Sobre la Iniciativa-->
							<h2>Sobre la Iniciativa</h2>
							<ol>
								<li><strong><a href="#implementacion">¿Por qué es importante esta implementación?</a></strong></li>
								<li><strong><a href="#gobiernoAbierto">¿Qué es el Gobierno Abierto?</a></strong></li>
							</ol>
							<div class="divider"></div>
						<!--Sobre la CDMX-->
						<h2>Sobre la CDMX</h2>
						<ol>
							<li><strong><a href="#encontrarDatos">¿Cuáles son los datos abiertos gubernamentales? ¿Dónde puedo encontrarlos?</a></strong></li>
							<li><strong><a href="#historia">¿Cuál es la historia de los Contratos Abiertos en la CDMX?</a></strong></li>
							<li><strong><a href="#futuro">¿Cuál es el futuro de los contratos abiertos de la CDMX?</a></strong></li>
							<li><strong><a href="#garantizar">¿Cómo se garantizará el cumplimiento de esta iniciativa?</a></strong></li>
							<li><strong><a href="#iniciativas">¿Qué otras iniciativas de transparencia existen?</a></strong></li>
						</ol>
								<div class="divider"></div>
							<!--Preguntas técnicas-->
							<h2>Preguntas técnicas</h2>
							<ol>
								<li><strong><a href="#json">¿Qué es un archivo .JSON y cómo puedo usarlo?</a></strong></li>
								<li><strong><a href="#api">¿Qué es una API y cómo se usa?</a></strong></li>
								<li><strong><a href="#procedimientos">¿Qué procedimientos de contratación existen en el Gobierno?</a></strong></li>
								<li><strong><a href="#suficiencia">¿Qué es la Suficiencia Presupuestal?</a></strong></li>
								<li><strong><a href="#criterios">¿Cuáles son los criterios de adjudicación?</a></strong></li>
								<li><strong><a href="#contratos">¿Cuáles son los tipos de contratos que existen?</a></strong></li>
								<li><strong><a href="#normatividad">¿Qué normatividad es importante consultar sobre este tema?</a></strong></li>
								<li><strong><a href="#nuevos">¿Cada cuánto hay nuevos contratos en el portal?</a></strong></li>
								<li><strong><a href="#anexos">¿Los anexos técnicos de los contratos están en el portal?</a></strong></li>
								<li><strong><a href="#hacerDatos">¿Qué puedo hacer con estos datos?</a></strong></li>
								<li><strong><a href="#noresultado">¿Qué pasa si no encuentro el contrato que estoy buscando?</a></strong></li>
								<li><strong><a href="#retroactiva">¿Los contratos serán publicados de manera retroactiva también? ¿Por qué?</a></strong></li>
								<li><strong><a href="#acudir">¿A quién puedo acudir cuando tenga dudas sobre las Contrataciones Abiertas de la Ciudad de México?</a></strong></li>
							</ol>
	<div class="divider"></div>
							<h2>Sobre Contrataciones Abiertas</h2>
							<ol>
								<li><strong><a id="contratacionesAbiertas">¿Qué son las Contrataciones Abiertas?</a></strong>
									<p>
										Las Contrataciones Abiertas son aquellos datos o información que se generan al pasar por procesos de contratación o adquisición de bienes, obras o servicios. Esta información puede ser un documento firmado o un elemento específico: fecha de inicio de proceso, montos pagados, nombre de proveedor, método de adjudicación. Un contrato, bajo el Estándar de Contrataciones Abiertas puede recabar un promedio de 150 elementos.
									</p>
								</li>
								<li><strong><a id="asociacionContrataciones">¿Qué es la Asociación de Contrataciones Abiertas?</a></strong>
									<p>
										La <a href = "http://www.open-contracting.org" target="_blank"> Asociación de Contrataciones Abiertas</a> (Open Contracting Partnership, OCP por sus siglas en inglés) se fundó en 2012. Nace con el objetivo de incrementar la divulgación y la participación en todas las etapas de la contratación pública de los gobiernos. Su labor se centra en asegurar que los gobiernos sean eficaces y eficientes, que el sector privado crezca y prospere, y que los ciudadanos reciban los bienes y servicios que necesitan y merecen.
									</p>
								</li>
								<li><strong><a id="estandarContrataciones">¿Qué es el Estándar de Datos de Contrataciones Abiertas? ¿Por qué es importante?</a></strong>
									<p>El <a href="http://standard.open-contracting.org/latest/es/" target="_blank">Estándar de Datos de Contrataciones Abiertas</a> (Open Contracting Data Standard, OCDS por sus siglas en inglés), es un estándar internacional que formaliza la publicación de datos de contrataciones de manera accesible y estructurada en las cinco fases que incluye el proceso de contratación: (1) Planeación, (2) Licitación, (3) Adjudicación, (4) Contratación e (5) Implementación.
									</p>
									<p>Este estándar está implementado actualmente para la Secretaría de Finanzas, mostrando información a partir de diciembre de 2015, la Oficialía Mayor y la Secretaría de Obras y Servicios a partir de 2017.
									</p>
									<p>La importancia de implementar un estándar internacional radica en aperturar información bajo lineamientos reconocidos y estructurados. Además, conforme otras ciudades y países lo implementen permitirá que se hagan cruces de información entre ellas.
									</p>
								</li>
								<li><strong><a id="estandarDatos">¿Cómo funciona el Estándar de Datos de Contrataciones Abiertas?</a></strong>
									<p>El estándar es una serie de líneas de código que se implementan en la herramienta de gestión presupuestal de un ente. En el caso de la Ciudad de México esa herramienta se denomina GRP (Government Resource Planning por sus siglas en inglés). Cada vez que un proceso de contratación comienza, el área de Administración de una dependencia del Gobierno utiliza la herramienta para capturar la información pertinente a cada etapa. Esto a su vez genera información en un servidor, la cual mes con mes se actualiza y se refleja en este sitio de visualización de los datos.
									</p>
								</li>
								<li><strong><a id="etapasDatos">¿Cuáles son las 5 etapas del Estándar de Datos de Contrataciones Abiertas?</a></strong>
								<p><ol>
									 <li><strong>Planeación:</strong> Definición del presupuesto de acuerdo a las necesidades que debe cubrir el gobierno.</li>
								   <li><strong>Licitación:</strong> Lanzamiento de la convocatoria pública que establece las necesidades, mediante las cuales proveedores podrán realizar ofertas.</li>
									 <li><strong>Adjudicación:</strong> Decisión y anuncio de la oferta ganadora en base al análisis de las ofertas presentadas que se determina como mejor opción.</li>
									 <li><strong>Contratación:</strong> Formalización de la oferta a través de la firma de un documento que establece el método de pago y seguimiento del bien, obra o servicio.</li>
								   <li><strong>Implementación:</strong> Seguimiento a la entrega del bien, obra o servicio según lo acordado en la anterior fase para también dar seguimiento a los pagos.</li>
								 </ol>
								</p>
								</li>
							</ol>
							<div class="divider"></div>
							<!--Sobre la Iniciativa-->
							<h2>Sobre la Iniciativa</h2>
							<ol>
								<li><strong><a id ="implementacion">¿Por qué es importante esta implementación?</a></strong>
									<p>
										<ol>
										<li>Es un ejercicio de transparencia donde se mejora la experiencia del usuario para interactuar con información que ya es pública</li>
										<li>La CDMX es la primera Ciudad en el mundo en aplicar las 5 fases que marca el Estándar de Contrataciones Abiertas, lo cual muestra que los gobierno locales pueden crear grande impactos</li>
										<li>La página está hecha en código abierto, por lo que es replicable en cualquier nivel</li>
										<li>No solamente se puede consultar la información a través de las visualizaciones que este sitio provee, sino que cualquier persona puede realizar cruces de información propio conectándose a la API</li>
										<li>Al ser un estándar internacional el que se ha implementado, permitirá realizar cruces de información con aquellas ciudades o países que también lo hayan hecho</li>
									</ol>
									</p>
								</li>
								<li><strong><a id ="gobiernoAbierto">¿Qué es el Gobierno Abierto?</a></strong>
									<p>
										Aquél que colabora con sus ciudadanos para aprovechar las capacidades y conocimiento de diferentes sectores de la sociedad para mejorar la toma de decisiones en los procesos de diseño, elaboración, implementación y evaluación de políticas públicas, servicios públicos y programas gubernamentales, de forma abierta y transparente. De acuerdo con la <a href="http://www.aldf.gob.mx/archivo-1b52054447d78a831c329f25931f03a5.pdf" target="_blank">Ley para hacer de la Ciudad de México una Ciudad más Abierta</a>, para lograr esto se tienen ocho principios básicos:
										<ol>
										 <li><strong>Transparencia:</strong> Garantizar que las acciones y decisiones sobre el uso de los recursos públicos sea del conocimiento de la población de manera accesible, y que promueva su reutilización y redistribución.</li>
										<li><strong>Participación:</strong> Promover la participación de la ciudadanía y la sociedad civil organizada para obtener su retroalimentación sobre la información que es publicada.</li>
										<li><strong>Colaboración:</strong> Promover las acciones que fomentan la corresponsabilidad entre el Gobierno y la sociedad.</li>
										<li><strong>Máxima Publicidad:</strong> Que toda la información que se define como pública,  se publique completa, de manera oportuna y accesible.</li>
										<li><strong>Usabilidad:</strong> Las herramientas gubernamentales deben comunicar la información de manera fácil y clara al usuario final o ciudadano.</li>
										<li><strong>Innovación y Aprovechamiento de la Tecnología:</strong> La manera de interactuar y participar entre gobierno y la población procurarán ser innovadores, modernos y eficientes para fomentar la utilización de datos.</li>
										<li><strong>Diseño que piensa en el Usuario:</strong> El diseño debe contemplar quién es el usuario final para que sea una herramienta fácil de usar con una experiencia satisfactoria para fomentar el uso de ella.</li>
										<li><strong>Retroalimentación:</strong> Para promover la mejora e innovación en las acciones del Gobierno se debe promover el intercambio de conocimiento e información entre las personas y las instancias del propio Gobierno.</li>
									</ol>
										Dentro de la misma línea, existe también la <a href="http://www.infodf.org.mx/documentospdf/Ley%20de%20Transparencia,%20Acceso%20a%20la%20Informaci%C3%B3n%20P%C3%BAblica%20y%20Rendici%C3%B3n%20de%20Cuentas%20de%20la%20Ciudad%20de%20M%C3%A9xico.pdf" target="_blank">Ley de Transparencia, Acceso a la Información Pública y Rendición de Cuentas de la Ciudad de México </a> que fomenta y defiende el derecho de todo ciudadano a ser informado y refuerza la obligación de las autoridades a proporcionar dicha información.
									</p>
								</li>
							</ol>
							<div class="divider"></div>
						<!--Sobre la CDMX-->
						<h2>Sobre la CDMX</h2>
						<ol>
							<li><strong><a id="encontrarDatos">¿Cuáles son los datos abiertos gubernamentales? ¿Dónde puedo encontrarlos?</a></strong>
								<p>
									Son aquellos datos que genera el gobierno a través de sus labores y procesos siempre y cuando no estén protegidos por la <a href="http://www.aldf.gob.mx/archivo-f73bdb295c017416ad640607e8aa1275.pdf" target="_blank">Ley de Protección de Datos Personales del Distrito Federal</a>.
								</p>
								<p>
									Este sitio aloja los datos de Contrataciones Abiertas de la Ciudad de México, pero adicionalmente para obtener más conjuntos de datos abiertos se pueden consultar <a href="http://www.gobiernoabierto.cdmx.gob.mx/sigdata/index.php/Publicacion/index" target="_blank">aquí</a>.
								</p>
							</li>
							<li><strong><a id="historia">¿Cuál es la historia de los Contratos Abiertos en la CDMX?</a></strong>
								<p>Esta iniciativa contempló dos fases en su desarrollo: (1) la implementación del Estándar de Contrataciones Abiertas en la herramienta de gestión presupuestal y (2) el desarrollo de un portal de visualización de los datos que genera el estándar.
								</p>
								<p>La implementación del Estándar de Contrataciones Abiertas al requerir datos de recursos económicos, se implementó en una primera instancia en la Secretaría de Finanzas, quien aloja la función de control presupuestal para la Administración Pública de la Ciudad de México.
								</p>
								<p>
								Durante el proceso hubo una colaboración entre Open Contracting Partnership, Bloomberg Associates, el Instituto Mexicano para la Competitividad y el Gobierno de la Ciudad para entender a fondo cada requerimiento técnico que plasma el estándar. Una vez hecho este análisis, la implementación en las herramientas con las que ya se cuentan en la Administración se realizó. A la par se ejecutaron pruebas hasta lograr una captura exitosa de información de procesos de contratación.
							</p>
							<p>
								Posteriormente se capacitó a las áreas encargadas de capturar esta información, la cual, una vez generada conforme al formato que dicta el estándar, requirió el desarrollo de una interfase que consumiera la información y tradujera de manera amigable. Por lo anterior fue importante la creación de un portal de visualización de los datos. El objetivo del sitio es que la información sea útil y fácil de interpretar y a su vez, estar a disposición pública para que se realicen cruces propios y herramientas adicionales.
							</p>
							<p>
								Una vez implementado el Estándar en la Secretaría de Finanzas se replicó el proceso anteriormente descrito como una segunda fase en la Oficialía Mayor y la Secretaría de Obras Servicios. En una tercera fase la implementación mostrará las demás Secretarías de la Ciudad de México en 2017.
							</p>
							</li>
							<li><strong><a id="futuro">¿Cuál es el futuro de los contratos abiertos de la CDMX?</a></strong>
								<p>
								La herramienta de contrataciones abiertas del Gobierno de la Ciudad de México se encuentra implementado en la Secretaría de Finanzas, la Oficialía Mayor y la Secretaría de Obras y Servicios. Durante 2017, todas las Secretarías del Gobierno de la Ciudad de México implementarán el Estándar de Contrataciones Abiertas que también se mostrarán en este portal.
							  </p>
								<p>
								Asimismo se busca asegurar por medios normativos que esta herramienta y otras de la misma naturaleza permanezcan no solamente como ejemplo si no como un hecho.
							  </p>
							</li>
							<li><strong><a id="garantizar">¿Cómo se garantizará el cumplimiento de esta iniciativa?</a></strong>
								<p>
								Para garantizar el cumplimiento de esta iniciativa a futuro el Gobierno de la Ciudad de México cuenta con diversas leyes que la respaldan, por ejemplo: <a href ="http://www.aldf.gob.mx/archivo-75dbcac642d4b42d9f6814bdd5f369a4.pdf" target="_blank">Ley de Gobierno Electrónico</a>, la <a href="http://www.aldf.gob.mx/archivo-1b52054447d78a831c329f25931f03a5.pdf" target="_blank">Ley de para hacer de la Ciudad de México una Ciudad más Abierta</a>, así como el <a href ="http://comunicacion.cdmx.gob.mx/noticias/nota/asegura-jefe-de-gobierno-que-cdmx-esta-un-paso-adelante-en-lucha-contra-la-corrupcion" target="_blank">Sistema Nacional Anticorrupción</a>.
							</p>
							</li>

							<li><strong><a id="iniciativas">¿Qué otras iniciativas de transparencia existen?</a></strong>
								<p>
									<ol>
										<li><strong>Plan de Prevención y Combate a la Corrupción:</strong> Plan integral anticorrupción con estrategias clave: profesionalización de servidores públicos, fortalecimiento de mecanismo de auditoría y control interno, simplificación administrativa, participación ciudadana e innovación tecnológica para la prevención de corrupción.</li>
										<li><strong>Contralores Ciudadanos:</strong> Incluye a profesionales de múltiples universidades para la auditoría y evaluación de los proyectos y contratos públicos.</li>
										<li><strong>Gobierno Eficiente:</strong> La simplificación y digitalización de los trámites del Registro Público de la Propiedad y de Comercio redujo el rezago de trámites que se tenía, mejoró los servicios para los capitalinos y redujo las vulnerabilidades de corrupción.</li>
										<li><strong>Declaraciones Patrimoniales:</strong> El Jefe de Gobierno ha requerido a su Gabinete incluyéndose a sí mismo, para hacer públicas sus declaraciones patrimoniales con el objetivo de abordar el tema de conflicto de intereses por parte de los servidores públicos.</li>
										<li><strong>Línea de Denuncia Ciudadana:</strong> Servicios de Llamadas y mensajes para denunciar actos de corrupción, así como para someter quejas en este tema de conflicto de intereses. Es operado de manera autónoma por el Consejo Ciudadano y se asegura la protección legal de los denunciantes.</li>
										<li><strong>Ley de Ciudad Abierta:</strong> Busca promover y garantizar la participación pública, así como la comunicación entre la administración pública y la sociedad civil.</li>
									</ol>
								</p>
							</li>
						</ol>
							<div class="divider"></div>
							<!--Preguntas técnicas-->
							<h2>Preguntas técnicas</h2>
							<ol>
								<li><strong><a id="json">¿Qué es un archivo .JSON y cómo puedo usarlo?</a></strong>
									<p>
										Formato para el intercambio de datos, alternativa al formato XML. Una de sus ventajas es que puede ser leído por cualquier lenguaje de programación. Si se descargan estos archivos se puede analizar el detalle de cada proceso como fue capturado así como sus documentos correspondientes.
									</p>
									<p>
										Este formato permite que los datos se puedan exportar a hojas de cálculo u otras aplicaciones que pueden interpretar los datos. Adicionalmente puede ser legible por software especializado en análisis de datos y así crear cruces de información propios.
									</p>
								</li>
								<li><strong><a id="api">¿Qué es una API y cómo se usa?</a></strong>
									<p>
										API, por sus siglas en inglés significa Application Programming Interface, es una interface a través de la cual se pueden realizar consultas en tiempo real a una plataforma sin necesidad de descargar los datos que aloja.
									</p>
									<p>
										En este caso en la sección <a href="{{url('datos-abiertos')}}" target="_blank">“Usar los datos” </a> se proveen las URL para a través de la API poder consultar los datos de este sitio.
									</p>
								</li>
								<li><strong><a id="procedimientos">¿Qué procedimientos de contratación existen en el Gobierno?</a></strong>
								<p>
									El procedimiento administrativo por el que el Gobierno adquiere o renta bienes y servicios, así como la realización de obra pública y servicios relacionados con la misma, pueden ser los siguientes:
									<ol>
							  	<li><strong>Licitación pública (Abierta):</strong> Se publica una convocatoria en la <a href ="http://www.consejeria.df.gob.mx/index.php/gaceta" target="_blank">Gaceta Oficial de la Ciudad de México </a> y otros medios electrónicos según el caso para una contratación de algún servicio, adquisición o arrendamiento de obra o servicio, para que libremente los proveedores o concursantes presenten propuestas con el fin de asegurar al Gobierno las mejores condiciones en el aspecto administrativo, legal, técnico y económico.</li>
									<li><strong>Invitación restringida a cuando menos tres proveedores o concursantes (Limitada):</strong> Cuando la licitación pública no sea idónea para asegurar a la Administración Pública de la CDMX las mejores condiciones disponibles, se podrán contratar adquisiciones, arrendamientos de bienes o servicios y obra pública y servicios relacionadas con la misma a través de un procedimiento de invitación a cuando menos tres proveedores o concursantes. En este caso no se publica en la Gaceta Oficial ni en la página de la Institución, sino que se emiten invitaciones a las personas físicas o morales que se estiman por medio de un estudio de mercado tengan los precios más bajos tomando en consideración la calidad y cantidad de los bienes, obra pública o servicios a contratar. </li>
									<li><strong>Adjudicación directa (Limitada):</strong> En caso de no presentarse el mínimo de propuestas señaladas en un procedimiento de invitación a cuando menos tres personas y se haya declarado desierto el procedimiento de licitación, el titular del área responsable de la contratación en la dependencia o entidad podrá adjudicar directamente el contrato siempre que no se modifiquen los requisitos establecidos en dichas invitaciones o en las bases de licitación. Esto se encuentra descrito en la Ley de Adquisiciones para el Distrito Federal en el artículo 55 y en la <a href="http://www.aldf.gob.mx/archivo-2d0009cb4b1cb3a4349753ad589d4ba0.pdf" target="_blank">Ley de Obras Públicas para el Distrito Federal </a>en los artículos 62 y 63 se establecen los criterios para el caso de obra pública y servicios relacionados con la misma.</li>
									<li><strong>Convenio de colaboración (Selectiva):</strong> Existen instituciones de Gobierno que ya ofrecen el servicio que se está buscando y por ello se debe acudir a ésta. Esto lo establece el artículo primero de la Ley de Adquisiciones para el Distrito Federal. Un ejemplo de esto podría ser la Comisión Mexicana de Impresión (COMISA) o la Policía Bancaria e Industrial (PBI).  </li>
									<li><strong>Adjudicación directa selectiva (Selectivo):</strong> Esta opción establece que hay proveedores que por tema de marca, patente o derechos de autor, solamente ellos pueden ofrecer el servicio o bien y por lo tanto es necesario recurrir a ellos. Ésta y cualquier otra consideración fuera de una licitación pública, las contempla el artículo 54 en sus diversas fracciones de la Ley de Adquisiciones. Asimismo se encuentra considerado en la Ley de Obras Públicas para el Distrito Federal.</li>
							  </ol>
								</p>
								<p>
								De acuerdo con la Ley de Adquisiciones para el Distrito Federal, todo proceso de contratación debe ser analizado y aprobado por el Comité de Autorizaciones de Adquisiciones, Arrendamientos y Prestación de Servicios de la Administración Pública del Distrito Federal. El Comité cuenta con Subcomités de Adquisiciones, Arrendamientos y Prestación de Servicios en cada una de las dependencias, órganos desconcentrados y entidades del Gobierno de la Ciudad de México que se encargan de representar al Comité en cada uno de estos entes.
								</p>
								<p>
								De igual forma, existen los Comités Delegacionales que tienen autonomía funcional del Comité y se rigen por el Reglamento de la Ley de Adquisiciones para el Distrito Federal. Sin embargo, sus funciones y atribuciones están encaminadas al mismo fin que las del Comité.
								</p>
								<p>
								En el caso de obras públicas, según el Reglamento de la <a href ="http://www3.contraloriadf.gob.mx/prontuario/index.php/normativas/Template/ver_mas/64005/47/1/0" target="_blank">Ley de Obras Públicas del Distrito Federal </a>, en el Artículo 8A existe: el Comité Central, los Comités de las Entidades, los Subcomités de las dependencias y órganos desconcentrados y los subcomités delegacionales. Éstos se establecen para la toma de decisiones, emisión de dictámenes, generación de directrices y políticas internas en sus respectivas competencias, los cuales tendrán por objeto promover que las obras públicas se realicen de manera racional, óptima, eficiente y transparente, y que cumplan con lo establecido en la Ley, el Reglamento y demás disposiciones aplicables.
								</p>
								<p>
								Para más información puedes consultar la <a href="http://www.aldf.gob.mx/archivo-b23bfec910d4dd4b6b1f1fff8ab0e453.pdf" target="_blank"> Ley de Adquisiciones para el Distrito Federal</a>,  el <a href="http://www.consejeria.cdmx.gob.mx/images/leyes/reglamentos/REGLAMENTODELALEYDEADQUISICIONESPARAELDISTRITOFEDERALII.pdf" target="_blank">Reglamento de la Ley de Adquisiciones para el Distrito Federal</a>, la <a href="http://www.aldf.gob.mx/archivo-2d0009cb4b1cb3a4349753ad589d4ba0.pdf" target="_blank">Ley de Obras Públicas del Distrito Federal</a>, la <a href="http://www3.contraloriadf.gob.mx/prontuario/index.php/normativas/Template/ver_mas/65345/32/2/1" target="_blank">Ley de Obras Públicas y Servicios Relacionados con las Mismas</a> y sus respectivos reglamentos.
								</p>
								</li>
								<li><strong><a id="suficiencia">¿Qué es la Suficiencia Presupuestal?</a></strong>
									<p>
									Es la provisión de recursos para cubrir los requerimientos de remuneración de servicios personales para la adquisición de bienes, la ejecución de obra pública y la contratación de servicios. Dictado por el Artículo 28 de la Ley de Adquisiciones y el Artículo 23 de la Ley de Obras Públicas del Distrito Federal.
									</p>
								</li>
								<li><strong><a id="criterios">¿Cuáles son los criterios de adjudicación?</a></strong>
									<p>
										Este es un proceso de análisis mediante el cual se determinará la adjudicación del bien o servicio que deben cumplir con las mejores condiciones para el Gobierno en el aspecto administrativo, legal, técnico y económico. La CDMX determina mediante dos criterios:
										<ol>
											<li><strong>Mejor valor para el gobierno:</strong> Posterior al análisis, una propuesta sobresale porque la oferta las mejores condiciones en los cuatro aspectos anteriormente mencionados.</li>
											<li><strong>Solo hay un participante:</strong>En este rubro recaen aquellas opciones que se contienen en el artículo 1o, 54 y 55 de la Ley de Adquisiciones. Es decir, adjudicación directa, adjudicación directa limitada y convenio de colaboración.</li>
                   </ol>
									</p>
								</li>
								<li><strong><a id="contratos">¿Cuáles son los tipos de contratos que existen?</a></strong>
									<p>
										Se encontrarán  varios formatos de contratos en este portal y esto se debe a que el tipo de contrato se rige por el monto adjudicado, todos tienen la misma formalidad y están aprobados por la Consejería Jurídica y de Servicios Legales (CEJUR). Estos se encuentran en el punto 4.7 de la <a href="http://www.om.cdmx.gob.mx/circularuno_unobis/circularunoyunobis.pdf" target="_blank">Circular 1 </a>publicada en la Gaceta Oficial.
										<ol>
											<li><strong>Facturas debidamente requisitada:</strong> Se utiliza cuando el monto a contratar es menor a 50 mil pesos.</li>
										  <li><strong>Contrato Pedido:</strong> Contratos realizados por montos entre 50,001 pesos hasta 200,000 pesos.</li>
											<li><strong>Contrato Tipo:</strong> Efectuado cuando el monto rebasa los 200,001 pesos.</li>
											<li><strong>Contrato Multianual:</strong> Puede ser cualquiera de los formatos anteriores según el monto, sin embargo este se caracteriza por el tiempo en el que se ejerce ya que abarca más de un ejercicio fiscal.</li>
									</ol>
									</p>
									<p>
									Para el caso de la obra pública, en el Artículo 44 de la Ley de Obra Pública del Distrito Federal que los contratos de obra pública:
									<ol>
									<li><strong>A base de precios unitarios:</strong> donde la remuneración que deba cubrirse al contratista se hará:<br>
									<strong>a)</strong>  En el caso de obra, por unidad de concepto de trabajo terminado;<br>
									<strong>b)</strong>  En el caso de servicios relacionados con la obra pública, por unidad de concepto de servicio realizado;<br>
								  </li>
									<li><strong>A precio alzado:</strong> en cuyo caso el importe del pago total fijo que deba cubrirse al contratista será por ministraciones que se establecerán en el contrato, en función de avances de trabajos realizados o de actividades o subactividades terminadas
									Por administración: donde el importe de la remuneración que deba cubrirse al contratista se hará vía comprobantes, facturas, nómina pagada y un porcentaje de indirectos sobre lo anterior.
								  </li>
								</ol>
									</p>
								</li>
								<li><strong><a id="normatividad">¿Qué normatividad es importante consultar sobre este tema?</a></strong>
									<p>
									<ol>
											<li><a href="http://www.aldf.gob.mx/archivo-1b52054447d78a831c329f25931f03a5.pdf" target="_blank">Ley de para hacer de la Ciudad de México una Ciudad más Abierta</a></li>
											<li><a href="http://www.aldf.gob.mx/archivo-75dbcac642d4b42d9f6814bdd5f369a4.pdf" target="_blank">Ley de Gobierno Electrónico</a></li>
											<li><a href="http://www.infodf.org.mx/documentospdf/Ley%20de%20Transparencia,%20Acceso%20a%20la%20Informaci%C3%B3n%20P%C3%BAblica%20y%20Rendici%C3%B3n%20de%20Cuentas%20de%20la%20Ciudad%20de%20M%C3%A9xico.pdf" target="_blank">Ley de Transparencia, Acceso a la Información Pública y Rendición de Cuentas de la Ciudad de México</a></li>
											<li><a href="http://www.aldf.gob.mx/archivo-b23bfec910d4dd4b6b1f1fff8ab0e453.pdf" target="_blank">Ley de Adquisiciones para el Distrito Federal</a></li>
										  <li><a href="http://www.consejeria.cdmx.gob.mx/images/leyes/reglamentos/REGLAMENTODELALEYDEADQUISICIONESPARAELDISTRITOFEDERALII.pdf" target="_blank">Reglamento de la Ley de Adquisiciones para el Distrito Federal</a></li>
										  <li><a href="http://www.aldf.gob.mx/archivo-f73bdb295c017416ad640607e8aa1275.pdf" target="_blank">Ley de Protección de Datos Personales del Distrito Federal</a></li>
											<li><a href="http://www.aldf.gob.mx/archivo-2d0009cb4b1cb3a4349753ad589d4ba0.pdf" target="_blank">Ley de Obras Públicas del Distrito Federal</a></li>
											<li><a href="http://www3.contraloriadf.gob.mx/prontuario/index.php/normativas/Template/ver_mas/64005/47/1/0" target="_blank">Reglamento de la Ley de Obras Públicas del Distrito Federal</a></li>
											<li><a href="http://www3.contraloriadf.gob.mx/prontuario/index.php/normativas/Template/ver_mas/65345/32/2/1" target="_blank">Ley de Obras Públicas y Servicios Relacionados con las Mismas</a></li>
											<li><a href="http://www.diputados.gob.mx/LeyesBiblio/regley/Reg_LOPSRM.pdf" target="_blank">Reglamento de la Ley de Obras Públicas y Servicios Relacionados con las Mismas</a></li>
										  <li><a href="http://dof.gob.mx/nota_detalle.php?codigo=5282650&fecha=18/12/2012" target="_blank">Políticas, Bases y Lineamientos en Materia de Obras Públicas y Servicios Relacionados con las Mismas</a></li>
								  </ol>
									</p>
								</li>
								<li><strong><a id="nuevos">¿Cada cuánto hay nuevos contratos en el portal?</a></strong>
									<p>
										Los días 20 de cada mes se actualiza la información de este portal desde su lanzamiento el 20 de junio de 2016. A partir de febrero de 2017, el portal actualizará la información el día 5 de cada mes.
									</p>
								</li>
								<li><strong><a id="anexos">¿Los anexos técnicos de los contratos están en el portal?</a></strong>
									<p>
										Sí. En la fase 4, “Contratación”, encontrarás los respaldos documentales del contrato incluyendo su anexo técnico. Adicionalmente, cada fase de un proceso de contratación muestra el respaldo documental.
									</p>
								</li>
								<li><strong><a id="hacerDatos">¿Qué puedo hacer con estos datos?</a></strong>
									<p>
										A través de la API que se encuentra en la pestaña de <a href="{{url('datos-abiertos')}}" target="_blank">Usar los Datos</a> se pueden accesar los archivos .JSON para realizar cruces de información propios entre los mismo contratos y otras bibliotecas de información, para así crear herramientas o análisis adicionales a los que muestra este portal.
									</p>
									<p>
									 Para más información sobre los términos que usa el Estándar dentro de los archivos .json se puede descargar este documento: <a href ="https://docs.google.com/document/d/1B9Quoo23vhephvbwdvnpO3E2Wuw-mHYDAhsTzj3Pxbw/edit?usp=sharing" target="_blank">Catálogo de elementos</a>.
								 </p>
								 <p>
									 Los Términos y Condiciones de uso de los datos de Contrataciones Abiertas de la Ciudad de México se pueden consultar <a href="{{url('privacidad')}}" target="_blank">aquí</a>.
									</p>
								</li>
								<li><strong><a id="noresultado">¿Qué pasa si no encuentro el contrato que estoy buscando?</a></strong>
									<p>
										Los contratos que se podrán encontrar en este portal incluyen aquellos de la Secretaría de Finanzas a partir de diciembre de 2015, y los de la Oficialía Mayor y la Secretaría de Obras y Servicios a partir de enero 2017.
									</p>
									<p>
										Si se está buscando algún contrato que contemple otras fechas se podrán consultar en en las respectivas páginas de Transparencia de cada Secretaría o realizar una solicitud de información pública.
									</p>
								</li>
								<li><strong><a id="retroactiva">¿Los contratos serán publicados de manera retroactiva también? ¿Por qué?</a></strong>
									<p>
									No se publicarán en el sitio de Contrataciones Abiertas aquellos procesos que hayan sucedido antes de la fecha de implementación del Estándar de Datos de Contrataciones Abiertas porque no se cuenta con los recursos humanos ni financieros para ordenar la información conforme lo dicta el estándar. Por lo que todo proceso de contratación que no se encuentre en este portal deberá ser consultado en el portal de Transparencia de cada dependencia.
									</p>
								</li>
								<li><strong><a id="acudir">¿A quién puedo acudir cuando tenga dudas sobre las Contrataciones Abiertas de la Ciudad de México?</a></strong>
									<p>
										Cualquier comentario puede dirigirse al contacto que cada Secretaría tiene asignado <a href="{{url('contacto')}}" target="_blank">aquí</a>.
									</p>
								</li>
							</ol>
							<!--Descargar-->
							<h2>¿Quieres saber más?</h2>
							<p>Para más información sobre las Contrataciones Abiertas de la CDMX descarga  el <a href="{{ url('archivos/Cuadernillo-Contrataciones-Abiertas-CDMX.pdf')}}">cuadernillo de presentación de Contrataciones Abiertas</a>.</p>
							<div class="divider w"></div>
					</div>
				</div>
				<!-- old glossary
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<!--gobierno abierto->
							<h2>Gobierno Abierto</h2>
							<p>Aquél que colabora con sus ciudadanos para aprovechar las capacidades y conocimiento de diferentes sectores de la sociedad para mejorar la toma de decisiones en los procesos de diseño, elaboración, implementación y evaluación de políticas públicas, servicios públicos y programas gubernamentales, de forma abierta y transparente. De acuerdo con la <a href="http://www.aldf.gob.mx/archivo-1b52054447d78a831c329f25931f03a5.pdf">Ley de para hacer de la Ciudad de México una Ciudad más Abierta</a>, para lograr esto se tienen ocho principios básicos:</p>
							<ol>
								<li><strong>Transparencia:</strong> Garantizar que las acciones y decisiones sobre el uso de los recursos públicos sea del conocimiento de la población de manera accesible, y que promueva su reutilización y redistribución.</li>
								<li><strong>Participación:</strong> Promover la participación de la ciudadanía y la sociedad civil organizada para obtener su retroalimentación sobre la información que es publicada.</li>
								<li><strong>Colaboración:</strong> Promover las acciones que fomentan la corresponsabilidad entre el Gobierno y la sociedad.</li>
								<li><strong>Máxima Publicidad:</strong> Que toda la información que se defina como pública,  se publique completa, de manera oportuna y que sea accesible.</li>
								<li><strong>Usabilidad:</strong> Las herramientas gubernamentales deben comunicar la información de manera fácil y clara al usuario final o ciudadano. </li>
								<li><strong>Innovación y Aprovechamiento de la Tecnología:</strong> La manera de interactuar y participar entre gobierno y la población procurarán ser innovadores, modernos y eficientes para fomentar la utilización de datos. </li>
								<li><strong>Diseño que piensa en el Usuario:</strong> El diseño debe contemplar quién es el usuario final para que sea una herramienta fácil de usar con una experiencia satisfactoria para fomentar el uso de ella. </li>
								<li><strong>Retroalimentación:</strong> Para promover la mejora e innovación en las acciones del Gobierno se debe promover el intercambio de conocimiento e información entre las personas y las instancias del propio Gobierno. </li>
							</ol>
							<p>Dentro de la misma línea, existe también la <a href="http://www.infodf.org.mx/documentospdf/Ley%20de%20Transparencia,%20Acceso%20a%20la%20Informaci%C3%B3n%20P%C3%BAblica%20y%20Rendici%C3%B3n%20de%20Cuentas%20de%20la%20Ciudad%20de%20M%C3%A9xico.pdf">Ley de Transparencia, Acceso a la Información Pública y Rendición de Cuentas de la Ciudad de México</a> que fomenta y defiende el derecho de todo ciudadano a ser informado y refuerza la obligación de las autoridades a proporcionar dicha información.</p>

							<div class="divider"></div>

							<!--datos abiertos gubernamentales->
							<h2>Datos abiertos gubernamentales</h2>
							<p>Son los datos que se incluyen en el contrato, siempre y cuando no estén protegidos por la <a href="http://www.aldf.gob.mx/archivo-f73bdb295c017416ad640607e8aa1275.pdf">Ley de Protección de Datos Personales del Distrito Federal</a>.</p>

							<div class="divider w"></div>

							<!--Alianza para las Contrataciones Abierta->
							<h2>Alianza para las Contrataciones Abierta</h2>
							<p>La <a href="http://www.open-contracting.org/">Alianza de Contrataciones Abiertas</a> (Open Contracting Partnership, OCP por sus siglas en inglés) se fundó en 2012. Nace con el objetivo de incrementar la divulgación y la participación en todas las etapas de la contratación pública de los gobiernos. Su labor se centra en asegurar que los gobiernos sean eficaces y eficientes, que el sector privado crezca y prospere, y que los ciudadanos reciban los bienes y servicios que necesitan y merecen.</p>
							<div class="divider"></div>

							<!--Estándar de Datos de Contrataciones Abiertas->
							<h2>Estándar de Datos de Contrataciones Abiertas</h2>
							<p>El <a href="http://standard.open-contracting.org/latest/es/#">Estándar de Datos de Contrataciones Abiertas</a> (Open Contracting Data Standard, OCDS por sus siglas en inglés), es un estándar internacional que formaliza la publicación de datos de contrataciones de manera accesible y estructurada en las cinco fases que incluye el proceso de contratación: </p>
							<ol>
								<li><strong>Planeación:</strong> En esta fase, el gobierno define un presupuesto de acuerdo a las necesidades que debe cubrir ya sean bienes o servicios.</li>
								<li><strong>Licitación:</strong> se establecen las necesidades del gobierno por medio de una convocatoria. En función de ésta, las empresas se acercarán con sus propuestas para ofertar al gobierno.</li>
								<li><strong>Adjudicación:</strong> Una vez que el gobierno ha considerado ya todas las ofertas y ha analizado los pro y los contra, se toma una decisión y se anuncia al proveedor asignado para el contrato.</li>
								<li><strong>Contratación:</strong> Con la decisión tomada, el gobierno firma un contrato donde se establecen las particularidades del bien o servicio y se fijan los periodos de pago y entrega. </li>
								<li><strong>Implementación o seguimiento al contrato:</strong> Durante este paso, es responsabilidad del gobierno dar seguimiento de la entrega y funcionalidad del bien o servicio que contrató. Así como hacer los pagos correspondientes por ese bien o servicio.</li>
							</ol>
							<p>Todas estas fases conforman el proceso de contratación del OCDS, el cual  está implementado actualmente para la Secretaría de Finanzas y muestra información a partir de diciembre de 2015.</p>
							<div class="divider"></div>

							<!--Proceso de Contratación->
							<h2>Proceso para contratar un bien o servicio</h2>
							<p>Procedimiento administrativo por el que el Gobierno adquiere o renta bienes y servicios. Los métodos de contratación o adquisición según la Ley, son los siguientes:</p>
							<ul>
								<li><strong>Licitación pública (Abierta):</strong> Se publica una convocatoria en la <a href="http://www.consejeria.df.gob.mx/index.php/gaceta">Gaceta Oficial de la Ciudad de México</a> y otros medios electrónicos según el caso para una contratación de algún servicio, adquisición o arrendamiento, para que libremente los proveedores presenten propuestas con el fin de asegurar al Gobierno las mejores condiciones en el aspecto administrativo, legal, técnico y económico.</li>
								<li><strong>Invitación restringida a cuando menos tres proveedores (Limitada):</strong> Cuando la licitación pública no sea idónea para asegurar a la Administración Pública de la CDMX las mejores condiciones disponibles, se podrán contratar adquisiciones, arrendamientos y servicios a través de un procedimiento de invitación a cuando menos tres proveedores. En este caso no se publica en la Gaceta Oficial ni en la página de la Institución, sino que se emiten invitaciones a las personas físicas o morales que se estiman por medio de un estudio de mercado tengan los precios más bajos tomando en consideración la calidad y cantidad de los bienes o servicios a contratar. </li>
								<li><strong>Adjudicación directa (Limitada):</strong> En caso de no presentarse el mínimo de proposiciones señaladas en un procedimiento de invitación a cuando menos tres personas y se haya declarado desierto el procedimiento de licitación, el titular del área responsable de la contratación en la dependencia o entidad podrá adjudicar directamente el contrato siempre que no se modifiquen los requisitos establecidos en dichas invitaciones o en las bases de licitación. Esto se encuentra descrito en la Ley de Adquisiciones para el Distrito Federal en el artículo 55.</li>
								<li><strong>Convenio de colaboración (Selectiva):</strong>Existen instituciones de Gobierno que ya ofrecen el servicio que se está buscando y por ello se debe acudir a ésta. Esto lo establece el artículo primero de la Ley de Adquisiciones para el Distrito Federal. Un ejemplo de esto podría ser la Comisión Mexicana de Impresión (COMISA) o la Policía Bancaria e Industrial (PBI).</li>
								<li><strong>Adjudicación directa selectiva (Selectivo):</strong> Esta opción establece que hay proveedores que por tema de marca, patente o derechos de autor, solamente ellos pueden ofrecer el servicio o bien y por lo tanto es necesario recurrir a ellos. Ésta y cualquier otra consideración fuera de una licitación pública, las contempla el artículo 54 en sus diversas fracciones de la Ley de Adquisiciones.

								</li>
							</ul>
							<p>De acuerdo con la Ley de Adquisiciones para el Distrito Federal, todo proceso de contratación debe ser analizado y aprobado por el Comité de Autorizaciones de Adquisiciones, Arrendamientos y Prestación de Servicios de la Administración Pública del Distrito Federal.</p>

							<p>El Comité cuenta con Subcomités de Adquisiciones, Arrendamientos y Prestación de Servicios en cada una de las dependencias, órganos desconcentrados y entidades del Gobierno de la Ciudad de México que se encargan de representar al Comité en cada uno de estos entes.</p>

							<p>De igual forma, existen los Comités Delegacionales que tienen autonomía funcional del Comité y se rigen por el Reglamento de la Ley de Adquisiciones para el Distrito Federal. Sin embargo, sus funciones y atribuciones están encaminadas al mismo fin que las del Comité.</p>

							<p>Para más información puedes consultar la <a href="http://www.aldf.gob.mx/archivo-b23bfec910d4dd4b6b1f1fff8ab0e453.pdf">Ley de Adquisiciones para el Distrito Federal</a> y el <a href="http://www.consejeria.cdmx.gob.mx/images/leyes/reglamentos/REGLAMENTODELALEYDEADQUISICIONESPARAELDISTRITOFEDERALII.pdf">Reglamento de la Ley de Adquisiciones para el Distrito Federal</a>.</p>
							<div class="divider"></div>

							<!--CRITERIOS DE ADJUDICACIÓN->
							<h2>Criterios de Adjudicación</h2>
							<p>Este es un proceso de análisis mediante el cual se determinará la adjudicación del bien o servicio que deben cumplir con las mejores condiciones para el Gobierno en el aspecto administrativo, legal, técnico y económico. La CDMX determina mediante dos criterios:</p>
							<ol>
								<li><strong>Mejor valor para el gobierno:</strong> Este término implica que posterior al análisis una propuesta sobresale en cuanto a que oferta las mejores condiciones en los cuatro aspectos anteriormente mencionados.</li>
								<li><strong>Solo hay un participante:</strong> En este rubro recaen aquellas opciones que se contienen en el artículo 1o, 54 y 55 de la Ley de Adquisiciones. Es decir, adjudicación directa, adjudicación directa limitada y convenio de colaboración.</li>
							</ol>
							<div class="divider"></div>

							<!--SUFICIENCIA PRESUPUESTAL->
							<h2>Suficiencia Presupuestal</h2>
							<p>Provisión de recursos para cubrir los requerimientos de remuneración de servicios personales para la adquisición de bienes y la contratación de servicios. Dictado por el Artículo 28 de la Ley de Adquisiciones.</p>
							<div class="divider"></div>

							<!--TIPOS DE CONTRATOS SEGÚN EL MONTO ADJUDICADO->
							<h2>Tipos de Contratos según el monto adjudicado</h2>
							<p>Te encontrarás con  varios formatos de contratos en este portal y esto se debe a que el tipo de contrato se rige por el monto adjudicado, todos tienen la misma formalidad y están aprobados por la Consejería Jurídica y de Servicios Legales (CEJUR). Estos se encuentran en el punto 4.7 de la <a href="http://www.om.cdmx.gob.mx/circularuno_unobis/circularunoyunobis.pdf">Circular 1</a> publicada en la Gaceta Oficial.</p>
							<ol>
							<li><strong>Facturas debidamente requisitada:</strong> Este formato se utiliza cuando el monto a contratar es menor a 50 mil pesos.</li>
							<li><strong>Contrato Pedido:</strong> Son aquellos contratos realizados por montos entre 50,001 pesos hasta 200,000 pesos.</li>
							<li><strong>Contrato Tipo:</strong> Este se efectúa cuando el monto rebasa los 200,001 pesos.</li>
							<li><strong>Contrato Multianual:</strong> Puede tener cualquiera de los formatos anteriores por el monto, sin embargo este se caracteriza por el tiempo en el que se ejerce ya que abarca más de un ejercicio fiscal.</li>
							</ol>
							<div class="divider"></div>

							<!--Archivos json->
							<h2>Archivos .json</h2>
							<p>Formato para el intercambio de datos, alternativa al formato XML. Una de sus ventajas es que puede ser leído por cualquier lenguaje de programación. Si descargas estos archivos podrás ver a detalle en qué fase va una contratación, así como sus documentos correspondientes.</p>
							<p>Para más información sobre los términos que usa el Estándar dentro de los archivos .json puedes descargar este documento: <a href="{{ url('archivos/CatalogosElementosEstandarContratacionesAbiertas-CDMX.pdf')}}">Catálogo de elementos.pdf</a></p>
							<div class="divider w"></div>


							<!--Descargar->
							<h2>¿Quieres saber más?</h2>
							<p>Para más información sobre las Contrataciones Abiertas de la CDMX descarga  el <a href="{{ url('archivos/Cuadernillo-Contrataciones-Abiertas-CDMX.pdf')}}">cuadernillo de presentación de Contrataciones Abiertas</a>.</p>
							<div class="divider w"></div>
					</div>
				</div>
				!-->
			</div>
			</div>
		</div>
	</div>
</section>
@endsection
