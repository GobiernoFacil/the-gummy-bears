	<?php 	
	$body_class 	= "home";
	$title 			= "Contrataciones Abiertas de la Ciudad de México";
	$description 	= "Contrataciones Abiertas de la Ciudad de México";
	$og_image		= "img/og/contrataciones-abiertas-cdmx.png";
	$canonical		= $url;
	include "templates/header.php";?>
	
	<ul id="menu_scroll">
		<li><a id="goto-step1" href="#" class="current"></a>
		<li><a id="goto-step2" href="#"></a>
		<li><a id="goto-step3" href="#"></a>
		<li><a id="goto-step4" href="#"></a>
	</ul>
	<!--participación-->
	<section class="participacion">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-xs-10 col-sm-offset-0 col-xs-offset-1">
					<h1><span>Tu participación</span> en las <span class="mx">contrataciones</span> de la 
					CD<span class="mx">MX</span> <span>ayuda</span> a <span>combatir</span> <strong>la corrupción.</strong>
					</h1>
					<a href="#" class="btn cta">¿Cómo participar?</a>
				</div>
			</div>
		</div>
	</section>
	
	<!--etapas-->
	<section class="etapas">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<h1>La <span>CD</span><strong>MX</strong> es la <span>primer ciudad del mundo</span> en implementar el 
						<a href="http://standard.open-contracting.org/?lang=es">Estándar de Contrataciones Abiertas</a></h1>
					
					<div id="mini-description-a" style="opacity:0">Con el <strong>Estándar de Contrataciones Abiertas</strong>, ahora los contratos públicos se liberarán desde la etapa de planeación hasta su ejecución, permitiéndote dar seguimiento al gasto de fondos públicos y mejorar la prestación de servicios.</div>

					<!-- stage nav-->
					<?php include "includes/contrataciones/stages_nav.php";?>
						<a href="glosario.php" class="btn">Consulta el Glosario para conocer más sobre Contrataciones Abiertas</a>

				</div>
				<div class="col-sm-6 pasos">
					<!-- planeación -->
					<div class="slide e-1 planeacion">
							<?php include "includes/contrataciones/stages-planeacion.php";?>
					</div>
					<!--licitación-->
					<div class="slide e-2 licitacion">
						<?php include "includes/contrataciones/stages-licitacion.php";?>
					</div>
					<!--adjudicacion-->
					<div class="slide e-2 adjudicacion">
						<?php include "includes/contrataciones/stages-adjudicacion.php";?>
					</div>
					<!--contrato-->
					<div class="slide e-2 contrato">
						<?php include "includes/contrataciones/stages-contrato.php";?>
					</div>
					<!--implementación-->
					<div class="slide e-2 implementacion">
						<?php include "includes/contrataciones/stages-implementacion.php";?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!--win-->
	<section class="win">
		<div class="container">
			<div class="row">
				<?php include "includes/contrataciones/win.php";?>
			</div>
		</div>
	</section>
	
	<!--tools-->
	<section class="tools">
		<div class="container">
			<div class="row">
				<?php include "includes/contrataciones/tools.php";?>
			</div>
		</div>
	</section>
<?php include "templates/footer.php";?>