<html>
<script>
function mostrar(id) {
        $(document).ready(function () {
            $("#result").hide("slow");
            $("#cargar_reporte").show("slow");
            $("#editar_resul").load("/programacion/detallePelicula.php?id=" + id, " ", function () {
                $("#editar_resul").show("slow");
                $("#cargar_reporte").hide("slow");
            });
        });
    }

	</script>

<?php include_once("config.php"); 


session_start();
date_default_timezone_set('America/Bogota');
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
$jd=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));

	$dw = (jddayofweek($jd,1));

$diaProg= $_POST['diaProg'];

switch ($dw)
{
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
   $dia =  "jueves";
   break;
case "Friday":
   $dia =  "viernes";
   break;
case "Saturday":
   $dia =  "sabado";
   break;
default:
   $dia =  "domingo";
}

$fechaActual = date("Y-m-d"); 

$query_1 =  "SELECT * FROM $dia WHERE hora_inicio <= '$HoraCol' AND hora_final >= '$HoraCol'";
$results_1 = mysql_query($query_1,$conex);
$row_1 = mysql_fetch_array($results_1);
$EstasViendo = $row_1['titulo_pelicula'];



$query_2 =  "SELECT * FROM $diaProg ORDER BY id ASC";
$results_2 = mysql_query($query_2,$conex);	
$row_2 = mysql_fetch_array($results_2);
$fechaActual= $row_2['fecha'];


$query =  "SELECT * FROM $diaProg ORDER BY id ASC";
$results = mysql_query($query,$conex);
	

?>


<!--<div id='parrillaProgramacion' class='shadow'  style='float:left;   padding-top:20px; padding-bottom:20px; width:850px; background: url(http://www.canaldhe.com/nueva/images/parrillaProg.png) top center no-repeat;'>-->
<div class="diactualprog col-xs-12"><div class="diactual"><?php echo htmlEntities($fechaActual); ?></div></div>
 
  <?php while($mostrador = mysql_fetch_array($results))
			{
				if ($mostrador['titulo_pelicula'] == $EstasViendo && $dia == $diaProg && $mostrador['hora_inicio'] <= $HoraCol && $mostrador['hora_final'] >= $HoraCol) {
					echo "<div class='estasviendo'>";
					
				} else {
					echo "<div class='fondoprog'>";						
				}
				echo "<table class='tablaprog' border='1'><tr><th width='12%' class='hora'><div class='letraprog'>";
				$rest = substr($mostrador['hora_inicio'], 0, -3); 
				echo $rest;
				echo "</div></th>";
				$queryImg =  "SELECT * FROM peliculas WHERE nom_pelicula='$mostrador[titulo_pelicula]'";
				$resultsImg = mysql_query($queryImg,$conex);
				$rowImg = mysql_fetch_array($resultsImg);
				echo "<th width='25%' class='hidden-xs hidden-sm'><a href='#' data-target='#myModalmostrar' data-toggle='modal' onclick='mostrar(" . $rowImg['id'] . ")'>";
				echo "<img class='img-responsive' src='http://www.canaldhe.com/images/imgPeliculas/".$rowImg['imagen_pelicula']."'/>";
				echo "</a></th>";
				echo "<th width='40%'><div class='letraprog'>";
				echo "<a href='#' data-target='#myModalmostrar' data-toggle='modal' onclick='mostrar(" . $rowImg['id'] . ")'>";
				
				if ($mostrador['titulo_pelicula'] == $EstasViendo  && $dia == $diaProg && $mostrador['hora_inicio'] <= $HoraCol && $mostrador['hora_final'] >= $HoraCol) {
				echo "<span>"; 
				echo htmlEntities($mostrador['titulo_pelicula']);
				echo "</span>";
				} else {
				echo "<span>"; 
				echo htmlEntities($mostrador['titulo_pelicula']);
				echo "</span></th>";
				}
				echo "</a></div></tr></table></div>";
				
				if ($mostrador['titulo_pelicula'] == $EstasViendo  && $dia == $diaProg && $mostrador['hora_inicio'] <= $HoraCol && $mostrador['hora_final'] >= $HoraCol) {
					$numPel = $cant;
				}
				
				$cant ++;
			}
if ($dia == $diaProg) {
	echo "<script type='text/javascript'>";
	echo "scrollAmount =". $numPel * 125 .";";
	echo "$('#parrillaProgramacion').animate({scrollTop: scrollAmount},3000);
	</script>";
	
	/*echo "<script type='text/javascript'>
		function printer()
			{
				$('.scroll-pane').jScrollPane();
			}";
	
	echo "$(window).load(function(){

		setTimeout('printer()',3000);	
			});
		</script>";
	
} else {
	echo "<script type='text/javascript' id='sourcecode'>
		$(function()
			{
				$('.scroll-pane').jScrollPane();
			});
			</script>";*/
}
?>
<div class="modal" id="myModalmostrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

            <div class="modal-body">
                <div class="col-sm-16">
                    <div class="widget-box">
                        <div class="widget-header">
                            <div class="widget-toolbar">
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="modal-body datagrid table-responsive" >
                                 
                                <div class="panel-body" id="editar_resul" >
 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
 
            </div>                            
        </div>
    </div>
</div>
</body>
</html>
