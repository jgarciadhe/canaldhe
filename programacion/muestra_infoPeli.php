<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php include_once("config.php"); ?>
<?php
session_start();

$infoPeli = $_POST["infoPeli"];

$conex = mysql_connect ("$servidor","$usuario","$password");
		if (!$conex)
			{
				die('NO puede conetarse: ' . mysql_error());
			}
		else {
			//echo ("estoy conectado");
			mysql_set_charset('utf8',$conex);
			mysql_select_db ("$database");
		}
$fechaActual = date("Y-m-d");

$query =  "SELECT * FROM franjas_prueba WHERE info_pelicula = $infoPeli";
$results = mysql_query($query,$conex);
$row = mysql_fetch_array($results);
$video= $row['video_pelicula'];
$PeakMovie = $row['nom_pelicula'];
$sinopsis = $row['sinopsis_pelicula'];
$director = $row['director_pelicula'];
$protagonistas = $row['prota_peliculas'];
$genero = $row['genero_pelicula'];
$clasificacion = $row['clasificacion_pelicula'];

	?>
<div class="col-md-8" id="youtube">
			<div class="embed-responsive embed-responsive-16by9 video">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo($video); ?>"></iframe>
			</div>
      	</div>
   	  <div class="col-md-4 col-xs-12 hidden-sm hidden-xs fondosinopsis">
   	  		<h3>SINOPSIS</h3>
   	  			<h4 class="titulo3"><?php echo($PeakMovie); ?></h4>
   	  				<h5> <?php echo($sinopsis); ?></h5>
	   </div>
  	  <div class="col-xs-12 visible-xs ficharesponsive">
  	  	<h3>SINOPSIS</h3>
   	  			<h4 class="titulo3"><?php echo($PeakMovie); ?></h4>
   	  				<h5> <?php echo($sinopsis); ?></h5>  	  	
  	  </div>
   	  <div class="col-md-12 fondoficha hidden-sm hidden-xs">
		  <table>
			<tr>
				<th width="25%">FICHA TÉCNICA</th>
				<td width="50%"> Director: <?php echo($director); ?></td>
				<td align="center"> Género: <?php echo($genero); ?> </td>
			</tr>
			<tr>
				<td width="25%"></td>
				<td width="50%">Protagonistas: <?php echo($protagonistas); ?></td>
				<td align="center">Clasificación: <?php echo($clasificacion); ?></td>
			</tr> 
		 </table>   
	</div>
	<div class="col-xs-12 ficharesponsive hidden-md hidden-lg">
		  <table>
				<tr><th width="10%">FICHA TÉCNICA</th></tr>
				<tr><td>Director: <?php echo($director); ?></td></tr>
				<tr><td>Género: <?php echo($genero); ?></td></tr>
				<tr><td>Protagonistas: <?php echo($protagonistas); ?></td></tr>
				<tr><td>Clasificación: <?php echo($clasificacion); ?></td></tr> 
		 </table>   
	</div>

</body>
</html>
