@extends('frontend.layouts.master')

@section('content')
<!--glosario-->
<section class="datos_pa_labanda">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<h1>Términos Clave - Portal Contrataciones Abiertas</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="codigo">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<!--gobierno abierto-->
							<h2>Gobierno Abierto</h2>
							<p>Aquél que colabora con sus ciudadanos para aprovechar la inteligencia de diferentes sectores de la sociedad para tomar mejores decisiones en los procesos de diseño, elaboración, implementación y evaluación de políticas públicas, servicios públicos y programas gubernamentales, de forma abierta y transparente. Según la <a href="http://www.aldf.gob.mx/archivo-1b52054447d78a831c329f25931f03a5.pdf">Ley de para hacer de la Ciudad de México una Ciudad más Abierta</a>, para esto se tienen 8 principios básicos: 
</p>
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
							<p>Otra ley que habla sobre este tema es la <a href="http://www.infodf.org.mx/documentospdf/Ley%20de%20Transparencia,%20Acceso%20a%20la%20Informaci%C3%B3n%20P%C3%BAblica%20y%20Rendici%C3%B3n%20de%20Cuentas%20de%20la%20Ciudad%20de%20M%C3%A9xico.pdf">Ley de Transparencia, Acceso a la Información Pública y Rendición de Cuentas de la Ciudad de México</a>.</p>
						
							<div class="divider"></div>
							
							<!--datos abiertos gubernamentales-->
							<h2>Datos abiertos gubernamentales</h2>
							<p>Son los datos que se incluyen en el contrato, siempre y cuando no estén protegidos por la <a href="http://www.aldf.gob.mx/archivo-f73bdb295c017416ad640607e8aa1275.pdf">Ley de Protección de Datos Personales</a>.</p>

							<div class="divider w"></div>
							
							<!--Asociación de Contrataciones Abiertas-->
							<h2>Asociación de Contrataciones Abierta</h2> 
							<p>La <a href="http://www.open-contracting.org/">Asociación de Contrataciones Abiertas</a> (Open Contracting Partnership, OCP por sus siglas en inglés) se fundó en 2012. Nace con el objetivo de incrementar la divulgación y la participación en todas las etapas de la contratación pública de los gobiernos. Su labor se centra en asegurar que los gobiernos sean eficaces y eficientes, que el sector privado crezca y prospere, y que los ciudadanos reciban los bienes y servicios que necesitan y merecen.</p>
							<div class="divider"></div>
						
							<!--Estándar de Datos de Contrataciones Abiertas-->
							<h2>Estándar de Datos de Contrataciones Abiertas</h2>
							<p>El <a href="http://standard.open-contracting.org/latest/es/#">Estándar de Datos de Contrataciones Abiertas</a> (Open Contracting Data Standard, OCDS por sus siglas en inglés), es un estándar internacional que formaliza la publicación de datos de contrataciones de manera accesible y estructurada en las cuatro fases que incluye el proceso de contratación: </p>
							<ol>
								<li><strong>Planeación:</strong> En esta fase, el gobierno define un presupuesto de acuerdo a las necesidades que debe cubrir ya sean bienes o servicios.</li>
								<li><strong>Licitación:</strong> se establecen las necesidades del gobierno por medio de una convocatoria. En función de ésta, las empresas se acercarán con sus propuestas para ofertar al gobierno.</li>
								<li><strong>Adjudicación:</strong> Una vez que el gobierno ha considerado ya todas las ofertas y ha analizado los pro y los contra, se toma una decisión y se anuncia al proveedor asignado para el contrato.</li>
								<li><strong>Contratación:</strong> Con la decisión tomada, el gobierno firma un contrato donde se establecen las particularidades del bien o servicio y se fijan los periodos de pago y entrega. </li>
								<li><strong>Implementación o seguimiento al contrato:</strong> Durante este paso, es responsabilidad del gobierno dar seguimiento de la entrega y funcionalidad del bien o servicio que contrató. Así como hacer los pagos correspondientes por ese bien o servicio.</li>
							</ol>	
							<p>Todas estas fases conforman el proceso de contratación del OCDS, el cual  está implementado actualmente para la Secretaría de Finanzas y muestra información a partir de diciembre de 2015.</p>
							<div class="divider"></div>
							
							<!--Proceso de Contratación-->
							<h2>Proceso de Contratación</h2>
							<p>Procedimiento administrativo por el que el Gobierno adquiere o renta bienes y servicios. Una contratación puede suceder por alguna de estas tres maneras:</p>
							<ul>
								<li><strong>Licitación pública:</strong> Se publica una convocatoria publicada en la <a href="http://www.consejeria.df.gob.mx/index.php/gaceta">Gaceta Oficial de la Ciudad de México</a> para una contratación de algún servicio, adquisición o arrendamiento, para que libremente los proveedores presenten propuestas a fin de asegurar al Gobierno las mejores condiciones en cuanto a precio, calidad, financiamiento, oportunidad, crecimiento económico, generación de empleo.</li>
								<li><strong>Invitación restringida a cuando menos tres proveedores:</strong> Cuando la licitación pública no sea idónea para asegurar a la Administración Pública de la CDMX las mejores condiciones disponibles, se podrán contratar adquisiciones, arrendamientos y servicios a través de un procedimiento de invitación a cuando menos tres proveedores. En este caso no se publica en la Gaceta Oficial ni en la página de la Institución, sino que se emiten invitaciones a las personas físicas o morales que se estiman por medio de un estudio de mercado tengan los precios más bajos tomando en consideración la calidad y cantidad de los bienes o servicios a contratar. </li>
								<li><strong>Adjudicación directa:</strong> En caso de no presentarse el mínimo de proposiciones señaladas en un procedimiento de invitación a cuando menos tres personas y se haya declarado desierto el procedimiento de licitación, el titular del área responsable de la contratación en la dependencia o entidad podrá adjudicar directamente el contrato siempre que no se modifiquen los requisitos establecidos en dichas invitaciones o en las bases de licitación. La <a href="http://www.aldf.gob.mx/archivo-b23bfec910d4dd4b6b1f1fff8ab0e453.pdf">Ley de Adquisiciones para el Distrito Federal</a> en el artículo 54 marca los casos en los que se aplica esta opción.</li>
							</ul>
							<p>De acuerdo con la Ley de Adquisiciones para el Distrito Federal, todo proceso de contratación debe ser analizado y aprobado por el Comité de Autorizaciones de Adquisiciones, Arrendamientos y Prestación de Servicios de la Administración Pública del Distrito Federal.</p>

							<p>El Comité cuenta con Subcomités de Adquisiciones, Arrendamientos y Prestación de Servicios en cada una de las dependencias, órganos desconcentrados y entidades del Gobierno de la Ciudad de México que se encargan de representar al Comité en cada uno de estos entes.</p>
							
							<p>De igual forma, existen los Comités Delegacionales que tienen autonomía funcional del Comité y se rigen por el Reglamento de la Ley de Adquisiciones para el Distrito Federal. Sin embargo, sus funciones y atribuciones están encaminadas al mismo fin que las del Comité.</p>
							
							<p>Para más información puedes consultar la <a href="http://www.aldf.gob.mx/archivo-b23bfec910d4dd4b6b1f1fff8ab0e453.pdf">Ley de Adquisiciones para el Distrito Federal</a> y el <a href="http://www.consejeria.cdmx.gob.mx/images/leyes/reglamentos/REGLAMENTODELALEYDEADQUISICIONESPARAELDISTRITOFEDERALII.pdf">Reglamento de la Ley de Adquisiciones para el Distrito Federal</a>.</p>
							<div class="divider"></div>
						
							<!--proceso-->
							<h2>Archivos .json</h2>
							<p>Formato para el intercambio de datos, alternativa al formato XML. Una de sus ventajas es que puede ser leído por cualquier lenguaje de programación. Si descargas estos archivos podrás ver a detalle en qué fase va una contratación, así como sus documentos correspondientes.</p>
													
							<div class="divider w"></div>							
							
							
						
						

					</div>						
				</div>
			</div>	
			</div>
		</div>
	</div>
</section>
@endsection