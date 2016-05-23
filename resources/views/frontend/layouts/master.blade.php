<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-MX" class="no-js"> <!--<![endif]-->
    <head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ !empty($title) ?   $title  : "" }}</title>
		<meta name="description" content="{{ !empty($description) ? $description : "" }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css"  href="{{ url('css/normalize.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}"/>
		<!--	 FB-->
		<meta property="og:title" content="{{  !empty($title) ?   $title  : '' }}"/>
		<meta property="og:site_name" content="Contrataciones Abiertas de la CDMX"/>
		<meta property="og:description" content="{{ !empty($description) ? $description : ''}}"/>
		@if( !empty($og_image) )
		<meta property="og:image" content="{{ url($og_image) }}"/>
		@else
		<meta property="og:image" content="{{ url('img/cdmx_og.png') }}"/>
		@endif
		<meta property="fb:app_id" content=""/>		<link rel="shortcut icon" href="{{ url('img/icon/CDMX_16.png') }}" sizes="16x16">
		<link rel="shortcut icon" href="{{ url('img/icon/CDMX_32.png') }}" sizes="32x32">
		<link rel="shortcut icon" href="{{ url('img/icon/CDMX_64.png') }}" sizes="64x64">
		@if($body_class == "datos")
		<link rel="canonical" href="{{url('datos-abiertos')}}" />
		@endif
<!--
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::	
.oPYo.        8       o                              ooooo     .o         o 8 
8    8        8                                      8                      8 
8      .oPYo. 8oPYo. o8 .oPYo. oPYo. odYo. .oPYo.   o8oo   .oPYo. .oPYo. o8 8 
8   oo 8    8 8    8  8 8oooo8 8  `' 8' `8 8    8    8     .oooo8 8    '  8 8 
8    8 8    8 8    8  8 8.     8     8   8 8    8    8     8    8 8    .  8 8 
`YooP8 `YooP' `YooP'  8 `Yooo' 8     8   8 `YooP'    8     `YooP8 `YooP'  8 8 
:....8 :.....::.....::..:.....:..::::..::..:.....::::..:::::.....::.....::....
:::::8 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::..:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
-->
    </head>
<body {!! (!isset($body_class)) ? '' : 'class="' . $body_class . '"'!!}>
	<!--nav-->
	@include('frontend.layouts.pages-nav') 

	<!--nav page-->
	<!--AVISO VEDA ELECTORAL -->
<div class="veda_electoral">
    <div>  
       <span>"Este contenido será modificado temporalmente en atención a las disposiciones legales y normativas en materia electoral, con motivo del periodo de campaña del 18 de abril al 5 de junio del presente año"
        </span>
    </div>
</div>
<!--AVISO VEDA ELECTORAL -->
	@include('frontend.layouts.nav')         
	
	<!--content-->
    @yield('content')
		
     <!--footer-->
	@include('frontend.layouts.footer')
</body>
</html>