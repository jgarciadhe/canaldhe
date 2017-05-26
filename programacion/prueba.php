<!DOCTYPE html>
<html lang="es">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Programación - Canal DHE</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">
<link rel="icon" href="img/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/camera.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/instag-slider.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="style.css" type="text/css" media="screen">
<!-- <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen"> -->
<link href="css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/bootstrap-3.3.7.js"></script>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript" src="js/camera.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.ui.totop.js" type="text/javascript"></script>


<script>
	$(document).ready(function(){
	$("#lunes").click(function(){
        	$.post("mostrarprogramacion2.php", {diaProg: "lunes"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);}); }); });
	
	$(document).ready(function(){
	$("#martes").click(function(){
     $.post("mostrarprogramacion2.php", {diaProg: "martes"}, function(htmlexterno){$("#cargaexterna").html(htmlexterno);	}); }); });
	
	$(document).ready(function(){
	$("#miercoles").click(function(){
        	$.post("mostrarprogramacion2.php", {diaProg: "miercoles"}, function(htmlexterno){$("#cargaexterna").html(htmlexterno); }); }); });
	
	$(document).ready(function(){
	$("#jueves").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "jueves"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	
	$(document).ready(function(){
	$("#viernes").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "viernes"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	
	$(document).ready(function(){
	$("#sabado").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "sabado"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	
	$(document).ready(function(){
	$("#domingo").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "domingo"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	$(document).ready(function(){
	$("#lunesres").click(function(){
        	$.post("mostrarprogramacion2.php", {diaProg: "lunes"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);}); }); });
	
	$(document).ready(function(){
	$("#martesres").click(function(){
     $.post("mostrarprogramacion2.php", {diaProg: "martes"}, function(htmlexterno){$("#cargaexterna").html(htmlexterno);	}); }); });
	
	$(document).ready(function(){
	$("#miercolesres").click(function(){
        	$.post("mostrarprogramacion2.php", {diaProg: "miercoles"}, function(htmlexterno){$("#cargaexterna").html(htmlexterno); }); }); });
	
	$(document).ready(function(){
	$("#juevesres").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "jueves"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	
	$(document).ready(function(){
	$("#viernesres").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "viernes"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	
	$(document).ready(function(){
	$("#sabadores").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "sabado"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	
	$(document).ready(function(){
	$("#domingores").click(function(){
      $.post("mostrarprogramacion2.php", {diaProg: "domingo"}, function(htmlexterno){
   $("#cargaexterna").html(htmlexterno);});});});
	</script>

</head>

<body class="fondo">

	<?php include_once("config.php"); ?>

	<?php
	session_start();

	//calcular Hora Colombia
	$mostrarHora = date( 'H:i' );
	$var = date( 'H:i:s' );
	$hora2 = "00:00";
	$var = split( ":", $var );
	$hora2 = split( ":", $hora2 );
	$horas = ( int )$var[ 0 ] + ( int )$hora2[ 0 ];
	$minutos = ( int )$var[ 1 ] + ( int )$hora2[ 1 ];
	$horas += ( int )( $minutos / 60 );
	$minutos = $minutos % 60;
	if ( $horas == 24 )$horas = "00";
	if ( $horas == 25 )$horas = "01";
	if ( $minutos == 0 )$minutos = 00;
	if ( $minutos < 10 )$minutos = "0" . $minutos;
	$HoraCol = $horas . ":" . $minutos;
	$dia2 = date("d");
	$mes = date("m");

	$conex = mysql_connect( "$servidor", "$usuario", "$password" );
	if ( !$conex ) {
		die( 'NO puede conetarse: ' . mysql_error() );
	} else {
		//echo ("estoy conectado");
		mysql_set_charset('utf8',$conex);
		mysql_select_db( "$database" );
	}

	$jd = cal_to_jd( CAL_GREGORIAN, date( "m" ), date( "d" ), date( "Y" ) );
	$dw = ( jddayofweek( $jd, 1 ) );
	
	switch ( $dw ) {
		case "Monday":
			$dia = "lunes";
			break;
		case "Tuesday":
			$dia = "martes";
			break;
		case "Wednesday":
			$dia = "miercoles";
			break;
		case "Thursday":
			$dia = "jueves";
			break;
		case "Friday":
			$dia = "viernes";
			break;
		case "Saturday":
			$dia = "sabado";
			break;
		default:
			$dia = "domingo";
	}

	
	$results_1 = mysql_query( "SELECT * FROM $dia WHERE hora_inicio <= '$HoraCol' AND hora_final>='$HoraCol'" );
	$row_1 = mysql_fetch_array( $results_1 );
	$EstasViendo = $row_1[ 'titulo_pelicula' ];
	$horafin = $row_1[ 'hora_final' ];

	$results_2 = mysql_query( "SELECT * FROM $dia WHERE hora_inicio = '$horafin'" );
	$row_2 = mysql_fetch_array( $results_2 );
	$acontinuacion = $row_2[ 'titulo_pelicula' ];
	$horainicio1 = $row_2[ 'hora_inicio' ];
	$horainicio2 = substr( $horainicio1, 0, -3 );
	
	$results_3 = mysql_query("SELECT * FROM $dia ORDER BY id ASC");	
	$row_3 = mysql_fetch_array($results_3);
	$fechaActual= $row_3['fecha'];

	$results = mysql_query("SELECT * FROM $dia ORDER BY id ASC");
	
	$conlunes = mysql_fetch_array(mysql_query("SELECT fecha FROM lunes where id='1'"));	
	$fechalunes= $conlunes['fecha'];
	
	$conmartes = mysql_fetch_array(mysql_query("SELECT fecha FROM martes where id='1'"));	
	$fechamartes= $conmartes['fecha'];
	
	$conmiercoles = mysql_fetch_array(mysql_query("SELECT fecha FROM miercoles where id='1'"));	
	$fechamiercoles= $conmiercoles['fecha'];
	
	$conjueves = mysql_fetch_array(mysql_query("SELECT fecha FROM jueves where id='1'"));	
	$fechajueves= $conjueves['fecha'];
	
	$conviernes = mysql_fetch_array(mysql_query("SELECT fecha FROM viernes where id='1'"));	
	$fechaviernes= $conviernes['fecha'];
	
	$consabado = mysql_fetch_array(mysql_query("SELECT fecha FROM sabado where id='1'"));	
	$fechasabado= $consabado['fecha'];
	
	$condomingo = mysql_fetch_array(mysql_query("SELECT fecha FROM domingo where id='1'"));	
	$fechadomingo= $condomingo['fecha'];
	?>
	
	<!--==============================header=================================-->
	
	<header id="masthead" class="site-header header-default  light">
	<div class="container">
		<div class="amy-inner">
			<div class="pull-left">
				<div id="amy-site-logo">

	<a href="http://canaldhe.com/">
<img class="amy-logo amy-logo1x" src="http://canaldhe.com/wp-content/uploads/2017/04/logotipo-canal-dhe.png" alt="Canal DHE">


</a>

</div>							</div>
			<div class="pull-right">
				<nav id="amy-site-nav" class="amy-site-navigation amy-primary-navigation">
<div class="menu-mainnav-container"><ul id="menu-mainnav" class="nav-menu"><li id="menu-item-94" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-93 current_page_item menu-item-94"><a href="http://canaldhe.com/">Inicio</a></li>
<li id="menu-item-206" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206"><a href="http://canaldhe.com/peliculas/">Películas</a></li>
<li id="menu-item-428" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-428"><a href="http://canaldhe.com/newprogramacion/">Programación</a></li>
<li id="menu-item-796" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-796"><a href="http://canaldhe.com/noticias/">Noticias</a></li>
<li id="menu-item-156" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-156"><a href="http://canaldhe.com/top-rated/">Top rated</a></li>
</ul></div>
</nav>				<div id="amy-menu-toggle"><a><span></span></a></div>							</div>
		</div>
	</div>
	<div id="amy-site-header-shadow"></div>
</header>
<div id="amy-navigation-mobile">
<div class="menu-mainnav-container"><ul id="menu-mainnav-1" class="menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-94"><a href="http://canaldhe.com/">Inicio</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206"><a href="http://canaldhe.com/peliculas/">Películas</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-428"><a href="http://canaldhe.com/DHEChannel/programacion/#martes">Programación</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-796"><a href="http://canaldhe.com/noticias/">Noticias</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-156"><a href="http://canaldhe.com/top-rated/">Top rated</a></li>
</ul></div>
</div>

<section id="contenido">

		<div class="container">
			
	<div class="row">
		<div class="col-md-1 col-xs-12">
			<div class="btn-group-vertical progbuttons hidden-xs hidden-sm">
			  <button type="button" id="lunes" class="hvr-wobble-top Menu_lunes"></button>
			  <button type="button" id="martes" class="hvr-wobble-top Menu_martes "></button>
			  <button type="button" id="miercoles" class="hvr-wobble-top Menu_miercoles"></button>
			   <button type="button" id="jueves" class="hvr-wobble-top Menu_jueves"></button>
			   <button type="button" id="viernes" class="hvr-wobble-top Menu_viernes"></button>
			  <button type="button" id="sabado" class="hvr-wobble-top Menu_sabado"></button>
			  <button type="button" id="domingo" class="hvr-wobble-top Menu_domingo"></button>
			</div>
			
				<div class="dropdown hidden-md hidden-lg">
					<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Elije un día
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
						<li><button type="button" id="lunesres"><?php echo ("$fechalunes"); ?></button></li>
						<li><button type="button" id="martesres"><?php echo ("$fechamartes"); ?></button></li>
						<li><button type="button" id="miercolesres"><?php echo ("$fechamiercoles"); ?></button></li>
						<li><button type="button" id="juevesres"><?php echo ("$fechajueves"); ?></button></li>
						<li><button type="button" id="viernesres"><?php echo ("$fechaviernes"); ?></button></li>
						<li><button type="button" id="sabadores"><?php echo ("$fechasabado"); ?></button></li>
						<li><button type="button" id="domingores"><?php echo ("$fechadomingo"); ?></button></li>
					  </ul>	
				</div><br>
		</div>
	<div class="col-md-10">
		<div class="programacion" id="parrillaProgramacion">
			<div id="cargaexterna" class="col-md-12">   
	
		<div class="diactualprog col-xs-12"><div class="diactual"><?php echo htmlEntities($fechaActual); ?></div></div>

		<?php		while($mostrador = mysql_fetch_array($results))
			{
				if ($mostrador['titulo_pelicula'] == $EstasViendo && $mostrador['hora_inicio'] <= $HoraCol && $mostrador['hora_final'] >= $HoraCol) {
					echo "<div class='estasviendo hidden-xs hidden-sm'>";
					
				} else {
				echo "<div class='fondoprog'>";
				}
				echo "<table class='tablaprog' border='1'><tr><th width='12%'><div class='letraprog'>";
				$rest = substr($mostrador['hora_inicio'], 0, -3); 
				echo $rest;
				echo "</div></th>";
				$queryImg =  "SELECT * FROM peliculas WHERE nom_pelicula='$mostrador[titulo_pelicula]'";
				$resultsImg = mysql_query($queryImg,$conex);
				$rowImg = mysql_fetch_array($resultsImg);
				echo "<th width='30%' class='hidden-xs hidden-sm'><a  href=/templates/canaldhe/detallePelicula.php?id=".$rowImg['id'].">";
				echo "<img class='img-responsive' src='http://www.canaldhe.com/images/imgPeliculas/".$rowImg['imagen_pelicula']."'/>";
				echo "</a></th>";
				echo "<th width='57%'><div class='letraprog'>";
				echo "<a href=/templates/canaldhe/detallePelicula.php?id=".$rowImg['id'].">";
				
				if ($mostrador['titulo_pelicula'] == $EstasViendo && $mostrador['hora_inicio'] <= $HoraCol && $mostrador['hora_final'] >= $HoraCol) {
				echo "<span class='letraprog'>"; 
				echo htmlEntities($mostrador['titulo_pelicula']);
				echo "</span>";
				} else {
				echo "<span class='letraprog'>"; 
				echo htmlEntities($mostrador['titulo_pelicula']);
				echo "</span></th>";
				}
				echo "</a></div></tr></table></div>";
				
				if ($mostrador['titulo_pelicula'] == $EstasViendo  && $mostrador['hora_inicio'] <= $HoraCol && $mostrador['hora_final'] >= $HoraCol) {
					$numPel = $cant;
				}
				
				$cant ++;
			}
				
	echo "<script type='text/javascript'>";
	echo "scrollAmount =". $numPel * 125 .";";
	echo "$('#parrillaProgramacion').animate({scrollTop: scrollAmount},3000);
	</script>";
	
	echo "<script type='text/javascript'>
		function printer()
			{
				$('.scroll-pane').jScrollPane();
			}";
	
	echo "$(window).load(function(){

		setTimeout('printer()',3000);	
			});
		</script>";

				?>
		  </div>
	    </div>
	  </div>
	</div>
</div>
  </section>
	<footer id="amy-colophon" class="amy-site-footer">
<div class="container">
<div class="amy-footer-widgets">
<div class="row">
<div class="col-md-4 col-sm-4">
<div class="amy-widget widget_text"><div class="amy-widget-title"><h4>Twitter</h4></div>			<div class="textwidget"><div class="amy-widget-content">   <a class="twitter-timeline"  href="https://twitter.com/Canal_DHE" data-widget-id="278490435331178496">Tweets por el @Canal_DHE.</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div></div>
		<div class="clear"></div></div>
</div>
<div class="col-md-4 col-sm-4">
<div class="amy-widget widget_text"><div class="amy-widget-title"><h4>Instagram</h4></div>			<div class="textwidget"><div class="amy-widget-content"></div></div>
		<div class="clear"></div></div><div class="amy-widget jr-insta-slider"><div class='jr-insta-thumb'>
<ul class='no-bullet thumbnails jr_col_2'>
<li><a href="https://www.instagram.com/p/BUHvdK_DnID/" target="_blank" title="Ella est buscando la verdad de sus PREMONICIONES a continuacinhellip"><img src="https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/18443664_278098112652910_5428242288755081216_n.jpg" alt="Ella est buscando la verdad de sus PREMONICIONES a continuacinhellip" title="Ella est buscando la verdad de sus PREMONICIONES a continuacinhellip" /></a></li><li><a href="https://www.instagram.com/p/BUFZIDMD7-i/" target="_blank" title="Est por comenzar el mejor show de todo CHICAGO Ahellip"><img src="https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/18513541_109601496285560_4280448678746914816_n.jpg" alt="Est por comenzar el mejor show de todo CHICAGO Ahellip" title="Est por comenzar el mejor show de todo CHICAGO Ahellip" /></a></li><li><a href="https://www.instagram.com/p/BUFQNyvjiTW/" target="_blank" title="Por qu ellos son los hombres ms buscados desde Texashellip"><img src="https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/18444848_179275315933528_1965780993503657984_n.jpg" alt="Por qu ellos son los hombres ms buscados desde Texashellip" title="Por qu ellos son los hombres ms buscados desde Texashellip" /></a></li><li><a href="https://www.instagram.com/p/BUFW9C6jRvy/" target="_blank" title="Hoy no te pierdas TENEMOS QUE HABLAR DE KEVIN ahellip"><img src="https://scontent.cdninstagram.com/t51.2885-15/s640x640/sh0.08/e35/c135.0.810.810/18514235_319998511765389_6806268883385712640_n.jpg" alt="Hoy no te pierdas TENEMOS QUE HABLAR DE KEVIN ahellip" title="Hoy no te pierdas TENEMOS QUE HABLAR DE KEVIN ahellip" /></a></li></ul>
</div><div class="clear"></div></div>
</div>
<div class="col-md-4 col-sm-4">
<div class="amy-widget widget_text"><div class="amy-widget-title"><h4>Facebook</h4></div>			<div class="textwidget"><div class="amy-widget-content"><div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="https://www.facebook.com/canaldhe" data-tabs="timeline" data-height="180" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/canaldhe" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/canaldhe">Canal DHE</a></blockquote></div></div></div>
		<div class="clear"></div></div><div class="amy-widget widget_text">			<div class="textwidget"><div class="amy-widget-content"><br/></div></div>
		<div class="clear"></div></div><div class="amy-widget widget_text"><div class="amy-widget-title"><h4>Contáctanos</h4></div>			<div class="textwidget"><div class="amy-widget-content"><div class="fa fa-envelope-o" aria-hidden="true"> <span class="contact">contacto@canaldhe.com</span></div>

<div class="box">
	<a class="button" href="#popup1">Formulario</a>
</div>

<div id="popup1" class="overlay">
	<div class="popup">
		<h2>Contáctanos</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			<div role="form" class="wpcf7" id="wpcf7-f24-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"></div>
<form action="/peliculas/#wpcf7-f24-o1" method="post" class="wpcf7-form" novalidate="novalidate">
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="24" />
<input type="hidden" name="_wpcf7_version" value="4.7" />
<input type="hidden" name="_wpcf7_locale" value="en_US" />
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f24-o1" />
<input type="hidden" name="_wpnonce" value="0e88f0f37b" />
</div>
<p><span class="wpcf7-form-control-wrap name"><input type="text" name="name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Nombre" /></span><span class="wpcf7-form-control-wrap email-143"><input type="email" name="email-143" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email" /></span></p>
<p><span class="wpcf7-form-control-wrap subject-582"><input type="text" name="subject-582" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Asunto" /></span></p>
<p><span class="wpcf7-form-control-wrap textarea-993"><textarea name="textarea-993" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Mensaje"></textarea></span></p>
<p><input type="submit" value="Enviar" class="wpcf7-form-control wpcf7-submit" /></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
		</div>
	</div>
</div></div></div>
		<div class="clear"></div></div>
</div>
</div>
</div>
</div>
</footer>
<div id="amy-copyright" class="amy-copyright">
<div class="container"><div class="amy-inner">
<div class="amy-copyright-left pull-left">
<div class="amy-copyright-module amy-module-text " style="">

©copyright 2017 Canal DHE
</div>
</div>

</div></div>
</div>	</div>

	<script type='text/javascript' src='http://canaldhe.com/wp-content/plugins/simple-tooltips/zebra_tooltips.js?ver=4.7.4'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js?ver=3.51.0-2014.06.20'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var _wpcf7 = {"recaptcha":{"messages":{"empty":"Por favor, prueba que no eres un robot."}},"cached":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.7'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/plugins/lazy-load/js/jquery.sonar.min.js?ver=0.6.1'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/plugins/lazy-load/js/lazy-load.js?ver=0.6.1'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/widget.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/slick.min.js?ver=1.6.0'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/isotope.pkgd.js?ver=3.0.1'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/masonry-horizontal.js?ver=2.0.0'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/kinetic.js?ver=2.0.1'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/smoothdivscroll.js?ver=1.3'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/jquery.mousewheel.min.js?ver=3.1.11'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.11.4'></script>
<script type='text/javascript'>
jQuery(document).ready(function(jQuery){jQuery.datepicker.setDefaults({"closeText":"Cerrar","currentText":"Hoy","monthNames":["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],"monthNamesShort":["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],"nextText":"Siguiente","prevText":"Previo","dayNames":["Domingo","Lunes","Martes","Mi\u00e9rcoles","Jueves","Viernes","S\u00e1bado"],"dayNamesShort":["Dom","Lun","Mar","Mie","Jue","Vie","Sab"],"dayNamesMin":["D","L","M","X","J","V","S"],"dateFormat":"d MM, yy","firstDay":1,"isRTL":false});});
</script>
<script type='text/javascript' src='http://canaldhe.comField_Date.js?ver=1494944815'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/jquery.fancybox.js?ver=2.1.5'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/vendor/bootstrap-tab.js?ver=3.3.6'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var amy_script = {"ajax_url":"http:\/\/canaldhe.com\/wp-admin\/admin-ajax.php","viewport":"992","site_url":"http:\/\/canaldhe.com\/","theme_url":"http:\/\/canaldhe.com\/wp-content\/themes\/amy-movie","enable_fb_login":null,"fb_app_id":null,"enable_google_login":null,"gg_app_id":null,"gg_client_id":null,"amy_rtl":"","amy_rate_already":"You already rate a movie","amy_rate_done":"You vote done"};
/* ]]> */
</script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/themes/amy-movie/js/script.js?ver=1.0.0'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-includes/js/wp-embed.min.js?ver=4.7.4'></script>
<script type='text/javascript' src='http://canaldhe.com/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=5.1'></script>
                			            
                <script type="text/javascript">
                    jQuery(function() {
                                                
                        jQuery(".tooltips img").closest(".tooltips").css("display", "inline-block");
                    
                        new jQuery.Zebra_Tooltips(jQuery('.tooltips').not('.custom_m_bubble'), {
                            'background_color':     '#000000',
                            'color':				'#ffffff',
                            'max_width':  250,
                            'opacity':    0.95, 
                            'position':    'center'
                        });
                        
                                            
                    });
                </script>      
                <script type="text/javascript">
$(document).ready(function() {
	$('#lunes').click(function(){
        $('.Menu_lunes').css('background-image', 'url(img/botonLunes2.png)');
		$('.Menu_martes').css('background-image', 'url(img/botonMartes1.png)');
		$('.Menu_miercoles').css('background-image', 'url(img/botonMiercoles1.png)');
		$('.Menu_jueves').css('background-image', 'url(img/botonJueves1.png)');
		$('.Menu_viernes').css('background-image', 'url(img/botonViernes1.png)');
		$('.Menu_sabado').css('background-image', 'url(img/botonSabado1.png)');
		$('.Menu_domingo').css('background-image', 'url(img/botonDomingo1.png)');
    });
}); 
		</script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#martes').click(function(){
       $('.Menu_lunes').css('background-image', 'url(img/botonLunes1.png)');
		$('.Menu_martes').css('background-image', 'url(img/botonMartes2.png)');
		$('.Menu_miercoles').css('background-image', 'url(img/botonMiercoles1.png)');
		$('.Menu_jueves').css('background-image', 'url(img/botonJueves1.png)');
		$('.Menu_viernes').css('background-image', 'url(img/botonViernes1.png)');
		$('.Menu_sabado').css('background-image', 'url(img/botonSabado1.png)');
		$('.Menu_domingo').css('background-image', 'url(img/botonDomingo1.png)');
    });	});
		</script>
		<script type="text/javascript">
		$(document).ready(function() {
	$('#miercoles').click(function(){
       $('.Menu_lunes').css('background-image', 'url(img/botonLunes1.png)');
		$('.Menu_martes').css('background-image', 'url(img/botonMartes1.png)');
		$('.Menu_miercoles').css('background-image', 'url(img/botonMiercoles2.png)');
		$('.Menu_jueves').css('background-image', 'url(img/botonJueves1.png)');
		$('.Menu_viernes').css('background-image', 'url(img/botonViernes1.png)');
		$('.Menu_sabado').css('background-image', 'url(img/botonSabado1.png)');
		$('.Menu_domingo').css('background-image', 'url(img/botonDomingo1.png)');
    });	});
			</script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#jueves').click(function(){
       $('.Menu_lunes').css('background-image', 'url(img/botonLunes1.png)');
		$('.Menu_martes').css('background-image', 'url(img/botonMartes1.png)');
		$('.Menu_miercoles').css('background-image', 'url(img/botonMiercoles1.png)');
		$('.Menu_jueves').css('background-image', 'url(img/botonJueves2.png)');
		$('.Menu_viernes').css('background-image', 'url(img/botonViernes1.png)');
		$('.Menu_sabado').css('background-image', 'url(img/botonSabado1.png)');
		$('.Menu_domingo').css('background-image', 'url(img/botonDomingo1.png)');
    });	});
		</script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#viernes').click(function(){
       $('.Menu_lunes').css('background-image', 'url(img/botonLunes1.png)');
		$('.Menu_martes').css('background-image', 'url(img/botonMartes1.png)');
		$('.Menu_miercoles').css('background-image', 'url(img/botonMiercoles1.png)');
		$('.Menu_jueves').css('background-image', 'url(img/botonJueves1.png)');
		$('.Menu_viernes').css('background-image', 'url(img/botonViernes2.png)');
		$('.Menu_sabado').css('background-image', 'url(img/botonSabado1.png)');
		$('.Menu_domingo').css('background-image', 'url(img/botonDomingo1.png)');
    });	});
		</script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#sabado').click(function(){
       $('.Menu_lunes').css('background-image', 'url(img/botonLunes1.png)');
		$('.Menu_martes').css('background-image', 'url(img/botonMartes1.png)');
		$('.Menu_miercoles').css('background-image', 'url(img/botonMiercoles1.png)');
		$('.Menu_jueves').css('background-image', 'url(img/botonJueves1.png)');
		$('.Menu_viernes').css('background-image', 'url(img/botonViernes1.png)');
		$('.Menu_sabado').css('background-image', 'url(img/botonSabado2.png)');
		$('.Menu_domingo').css('background-image', 'url(img/botonDomingo1.png)');
    });	});
		</script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#domingo').click(function(){
       $('.Menu_lunes').css('background-image', 'url(img/botonLunes1.png)');
		$('.Menu_martes').css('background-image', 'url(img/botonMartes1.png)');
		$('.Menu_miercoles').css('background-image', 'url(img/botonMiercoles1.png)');
		$('.Menu_jueves').css('background-image', 'url(img/botonJueves1.png)');
		$('.Menu_viernes').css('background-image', 'url(img/botonViernes1.png)');
		$('.Menu_sabado').css('background-image', 'url(img/botonSabado1.png)');
		$('.Menu_domingo').css('background-image', 'url(img/botonDomingo2.png)');
    });	
		});
	</script>
	<script src="js/bootstrap-3.3.7.js"></script>  

</body>

</html>