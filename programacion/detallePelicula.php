<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=gb18030">



<style>

.iluminar {



-moz-box-shadow: 0 0px 5px #000000;

-webkit-box-shadow: 0 0px 5px #000000;

box-shadow: 0 0px 5px #000000;

}



</style>

</head>



<body>

<?php include_once("config.php"); ?>



<?php

$conex = mysql_connect ("$servidor","$usuario","$password");

if (!$conex)

{

die('NO puede conetarse: ' . mysql_error());

}

mysql_set_charset('utf8',$conex);

mysql_select_db ("$database", $conex);

$id = $_GET["id"];

$resultado = mysql_query ("SELECT * FROM peliculas WHERE id='$id'");



while($mostrador = mysql_fetch_array($resultado))

{

	echo"<div class='row hidden-xs'>

          	<div class='col-xs-5'><img  class='img-responsive' src='http://www.canaldhe.com/templates/canaldhe/detallePelicula/".$mostrador['imagen_detalle']."'>

          </div>

          <div class='col-xs-7'>

          <div class='detalletitulo'>

          	<h3>".$mostrador['nom_pelicula']."</h3><h4>Sinopsis</h4>         	

          </div>

			<div class='detallesinopsis'>

				<h5>".$mostrador['sinopsis_pelicula']."</h5>

			</div>

    	  <div class='detallepeli'>

    	  	<table>

    	  		<tr>

    	  			<td><h4>Director: </h4></td>

    	  			 <td><h5>".$mostrador['director_pelicula']."</h5></td>

    	  		</tr>

    	  		<tr>

    	  			<td><h4>Protagonistas:</h4></td><td><h5>".$mostrador['prota_peliculas']."</h5></td>

    	  		</tr>

    	  		<tr>

    	  			<td><h4>Género:</h4></td><td><h5>".$mostrador['genero_pelicula']."</h5></td>

    	  		</tr>

    	  		<tr>

    	  			<td><h4>Clasificación:</h4></td><td><h5>".$mostrador['clasificacion_pelicula']."</h5></td>

    	  		</tr>

    	  	</table>

    	  </div>

     	</div>

     </div>";



echo"<div class='col-xs-12 detalleresponsive visible-xs'>

          <div class='detalletitulo'>

			<h4>Sinopsis</h4>         	

          </div>

			<div class='detallesinopsis'>

				<h5>".$mostrador['sinopsis_pelicula']."</h5>

			</div>

    	  <div class='detallepeli'>

    	  	<table>

    	  		<tr>

    	  			<td><h4>Director: </h4></td></tr>

					<tr>

    	  			 <td><h5>".$mostrador['director_pelicula']."</h5></td>

    	  		</tr>

    	  		<tr>

    	  			<td><h4>Protagonistas:</h4></td></tr>

				<tr>

					<td><h5>".$mostrador['prota_peliculas']."</h5></td>

    	  		</tr>

    	  		<tr>

    	  			<td><h4>Género:</h4></td><td><h5>".$mostrador['genero_pelicula']."</h5></td>

    	  		</tr>

    	  		<tr>

    	  			<td><h4>Clasificación:</h4></td><td><h5>".$mostrador['clasificacion_pelicula']."</h5></td>

    	  		</tr>

    	  	</table>

    	  </div>

     	</div> "		

?>



<?php

}

?>







</body>