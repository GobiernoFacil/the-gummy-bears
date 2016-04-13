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
	
	</div><!--page ends-->
</div>	<!--pages stack ends-->
<button class="menu-button"><span>Menu</span></button>
<script>
  var BASE_PATH  = "{{url('/')}}";
</script>
<script src="{{ url('js/modernizr-custom.js') }}"></script>

@if ($body_class == 'home2' || $body_class == 'glosario' || $body_class == 'contact' || $body_class == 'terms')
<script data-main="{{ url('js/apps/home/main') }}" src="{{ url('js/bower_components/requirejs/require.js') }}"></script>
@endif
@if ($body_class == 'contract')
<script data-main="{{ url('js/apps/home-v2/main') }}" src="{{ url('js/bower_components/requirejs/require.js') }}"></script>
@endif
@if ($body_class == 'contract single')
<script data-main="{{ url('js/apps/contrato-landing/main') }}" src="{{ url('js/bower_components/requirejs/require.js') }}"></script>
@endif
@if ($body_class == 'proveedor' || $body_class == 'dependencia')
<script data-main="{{ url('js/apps/dependencia/main') }}" src="{{ url('js/bower_components/requirejs/require.js') }}"></script>
@endif
@if ($body_class == 'queson')
<script data-main="{{ url('js/apps/quees/main') }}" src="{{ url('js/bower_components/requirejs/require.js') }}"></script>
@endif
@if ($body_class == 'datos')
<script data-main="{{ url('js/apps/opendata/main') }}" src="{{ url('js/bower_components/requirejs/require.js') }}"></script>
@endif
<script src="{{ url('js/main.js')}}"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45473222-11', 'auto');
  ga('send', 'pageview');

	</script>
	
	</body>
</html>