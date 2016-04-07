	<!--footer-->
	<footer>
		<div class="partners">
			<div class="container">
				<div class="row">
					<h4>Con el apoyo de</h4>
					<div class="col-sm-4">
						<a href="http://www.bloombergassociates.org/" class="bloomberg">Bloomberg Associates</a>
					</div>
					<div class="col-sm-4">
						<a href="http://www.open-contracting.org/" class="ocds">Open Contracting Data Standard</a>
					</div>
					<div class="col-sm-4">
						<a href="http://imco.org.mx/" class="imco">IMCO</a>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<h2><a href="http://www.df.gob.mx/" class="cdmx_w">CDMX</a></h2>
					<h3>CONTRATACIONES <strong>ABIERTAS</strong></h3>
				</div>
				<div class="col-sm-3 author">
					<p>Forjado Artesanalmente por 
						<a href="http://gobiernofacil.com/" class="gobiernofacil">Gobierno Fácil</a></p>
				</div>
			</div>
		</div>
		<div class="copy">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<p>® 2015 Gobierno del Distrito Federal</p>
					</div>
					<div class="col-sm-4">
						<p class="center">¿Dudas?  compras@df.gob.mx</p>
					</div>
					<div class="col-sm-5">
						<p class="right">Plaza de la Constitución S/N Primer Piso, Centro, Cuauhtémoc, C.P. 06010</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
	
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45473222-11', 'auto');
  ga('send', 'pageview');

	</script>
	<?php if( $body_class=="home") :?>
	<script data-main="js/main" src="js/bower_components/requirejs/require.js"></script>
	<?php endif;?>
	<?php if( $body_class=="datos") :?>
	<script data-main="js/main_datos" src="js/bower_components/requirejs/require.js"></script>
	<?php endif;?>
	
	<script src="js/bower_components/countdownjs/countdown.min.js"></script>
	<script src="js/main.home.js"></script>
</body>
</html>