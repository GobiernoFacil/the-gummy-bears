<?php $url = "http://" .  $_SERVER['HTTP_HOST'] ."/";?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es-MX"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo !$title ? "" :  $title ;?></title>
	<meta name="description" content="<?php echo !$description ? "" :  $description ;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex">
	<link rel="canonical" href="<?php echo !$canonical ? "" :  $canonical ;?>">		
	<!-- FB-->
	<meta property="og:title" content="<?php echo !$title ? "" :  $title ;?>"/>
	<meta property="og:site_name" content="Contrataciones Abiertas de la CDMX"/>
	<meta property="og:description" content="<?php echo !$description ? "" :  $description ;?>"/>
	<meta property="og:image" content="<?php echo $url;?>img/<?php echo !$og_image ? "cdmx_og.png" : $og_image ;?>"/>
	<meta property="fb:app_id" content=""/>
	<link rel="shortcut icon" href="img/icon/CDMX_16.png" sizes="16x16">
	<link rel="shortcut icon" href="img/icon/CDMX_32.png" sizes="32x32">
	<link rel="shortcut icon" href="img/icon/CDMX_64.png" sizes="64x64">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/styles.css">
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

<body <?php echo !$body_class ? "" : 'class="' . $body_class .'"';?>>
	<!--menu-->
	<nav id="menu">
		<div class="container">
			<div class="row">
				<div class="col-xs-3 col-sm-3">
				<h2><a href="http://www.df.gob.mx/"  class="cdmx">CDMX | SEFIN</a></h2>
				</div>
				<div class="col-xs-6 col-sm-6">
					<h1><a href="index.php">CONTRATACIONES <strong>ABIERTAS</strong></a></h1>
				</div>
				<div class="col-xs-3 col-sm-3">
					<div class="mobile">
						<a href="#" class="bento_menu"></a>
					</div>
					<ul class="nav_links">
						<li><a href="datos.php">Usa los Datos</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<nav id="menu-mobile">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h3>Menú <a href="#" class="close">X</a></h3>
					<ul>
						<li><a href="index.php">¿Qué son?</a></li>
						<li><a href="datos.php">Datos</a></li>
						<li><a href="#">¿Quiénes Participan?</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	<div id="countdown"></div>