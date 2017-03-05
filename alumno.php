<!DOCTYPE html>
<html lang="en">
  <head>
      <style></style>
   <title>Inicio</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
	</head>
	<body>
	<div class="page-wrap">
    <?php
        include('lib/cabezera.php'); //manda a traer la cabecera principal
        mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
        $band =true;
    ?>
		<section class="titulo">		
		
		<div id="nombre-usuario">
		<img id="icono-usuario" src="img/usr.png" />
		
			<p2>Alumno: <b><?php echo $nombreUsuario ?></b></p2>
		</div>
		<div id="titulo"><p>Bienvenido</p></div>	
		
		
        </section>
		<div id="linea-hrztl"><hr></div>
        <section class="contenido">
        <!-- Contenido inicial del sitio web -->
        <br>
        <div class="unacolumna">
            <?php
                $consulta1 = "SELECT carrera.id as uis,nombre,alumno.id,nombres,apellidoP,apellidoM,carrera_nombre,semestre,grupo_nombre,correoE FROM carrera JOIN alumno ON carrera.nombre = alumno.carrera_nombre WHERE alumno.id=".$_COOKIE['uid']."";
                $resultado1 = mysqli_query($conexion,$consulta1 ) or die( mysql_error() );
                $band = false;
                // Realiza la consulta con la base de datos buscando el id de la carrera seleccionada
                $este ='0';
                // Si existe al menos un dato para mostrar, se sigue con la siguiente sentencia
                if($datos1=mysqli_fetch_assoc($resultado1)){
            ?>
                <br><br>
                <table class="prolect1">
                <caption><?php echo $datos1['nombre']; ?></caption>
                <tbody>
                    <tr>
                        <th>SEMESTRE</th>
                        <th>PRIMERA ENTREGA</th>
                        <th>SEGUNDA ENTREGA</th>
                        <th>TERCERA ENTREGA</th>
                    </tr>
            <?php
                $consulta = "SELECT id,id1,id2,id3,id4,id5,id6,id7,id8,id9,id10 FROM grupo_lectura"; 
                $resultado = ConsultaBD($consulta,$conexion);
                while ($datos=mysqli_fetch_assoc($resultado))    
                {
                    for ($i = 1; $i <= 10; $i++) {
                        $iden = "id".$i;
                        if($datos[$iden]==$datos1['uis']){
                            $este = $datos['id'];
                        }
                    }
                    if($este!='0'){
                    $nom = "SELECT id,Primera,Segunda,Tercera,gc_id,semestre,anio,periodo FROM fecha where gc_id='".$este."' and semestre=".$datos1['semestre']; 
                    $res2 = ConsultaBD($nom,$conexion);
                    // Se busca una consulta que coincida con el anio, periodo seleccionado
                    while ($oo=mysqli_fetch_assoc($res2)) {
                        echo '<tr>
                              <td>'.$oo["semestre"].'
                              </td>';
                        $date = date("Y-m-d"); // Se obtiene la fecha actual
                        $color1 = "#410401";
                        $color2 = "#410401";
                        $color3 = "#410401";
                        $una="Tiempo agotado";
                        $dos="Tiempo agotado";
                        $tres="Tiempo agotado";
                        echo'<td>'.$oo["Primera"];
                        // Hacer la diferencia de la fecha actual con la fecha en la que se debe entregar el reporte de lectura de cada semestre de la carrera seleccionada y por el numero de lectura.
                        $segundos=strtotime($oo["Primera"]) - strtotime($date);
                        $diferencia_dias=intval($segundos/60/60/24);
                        if($diferencia_dias >= 0 ){
                            $una = $diferencia_dias;
                            $color1 = "#9c5811";
                        }
                        echo '</td>';
                        echo'<td>'.$oo["Segunda"];
                        $segundos=strtotime($oo["Segunda"]) - strtotime($date);
                        $diferencia_dias=intval($segundos/60/60/24);
                        if($diferencia_dias >= 0 ){
                            $dos = $diferencia_dias;
                            $color2 = "#9c5811";
                        }
                        echo '</td>';
                        echo'<td>'.$oo["Tercera"];
                        $segundos=strtotime($oo["Tercera"]) - strtotime($date);
                        $diferencia_dias=intval($segundos/60/60/24);
                        if($diferencia_dias >= 0 ){
                            $tres = $diferencia_dias;
                            $color3 = "#9c5811";
                        }
                        echo '</td></tr>';
                        echo '<tr>';
                        echo '<td></td>
                            <td style="color:'.$color1.';font-weight:bold;">'.$una.'</td>
                            <td style="color:'.$color2.';font-weight:bold;">'.$dos.'</td>
                            <td style="color:'.$color3.';font-weight:bold;">'.$tres.'</td>
                            </tr>';
                        $band =false;
                    }
                }
                $este ='0';
            }
        }
        if ($band == true)
            echo'<table width=100%><tr><td>No hay datos disponibles para mostrar.</td></tr></table>';
    ?>
    </tbody></table></div>
    <div class="unacolumna-inicio">
            <div class="table-inicio-izq" >
            <table class="prolect1">
           <caption>Documentos</caption>
            <tbody>
                <div class="inicio-documentos">
                <div style="text-align:center; margin-bottom:10px;">
                </div>
                    <tr><td><a class="simple" href="documentos/Lineamientos.pdf" target="_blank" >Lineamientos para Reporte de Lectura (Reseña)</a></td></tr>
                    <tr><td><a class="simple" href="documentos/Revisión.pdf" target="_blank" >Revisión del Reporte de Lectura.</a></td></tr>
                   <tr><td><a class="simple" href="documentos/Presentación.pdf" target="_blank">Presentación Programa de Lectura UTM.</a></td></tr>
                </div>
            </tbody>
            </table>
            </div> 
            <div class="table-inicio-der">
                <table class="prolect1">
               <caption>Ligas de interés</caption>
                <tbody>
                <div class="inicio-ligas">
                    <div style="text-align:center; margin-bottom:10px;">
                    </div>
                    <tr><td><a class="simple"  href="https://www.facebook.com/contactoprogramadelectura/" target="_blank">Liga de Facebook</a></td></tr>
                    <tr><td><a class="simple"  href="http://dem.colmex.mx/" target="_blank">Diccionario del español de México</a></td></tr>
                    <tr><td><a  class="simple" href="http://dle.rae.es/" target="_blank">Diccionario de la real académia Española</a></td></tr>
                    <tr><td><a  class="simple" href="http://sitios.ruv.itesm.mx/portales/crea/" target="_blank">Centro de Recursos para la Escritura Académica del Tecnológico de Monterrey</a></td></tr>
                    <tr><td><a class="simple" href="http://www.udlap.mx/centrodeescritura/discursoAcademico.aspx" target="_blank">Discurso Academico</a></td></tr>
                </div>	
                </tbody>
                </table>
            </div> 		
        </div>
	</section>
	</div>
 <footer></footer>
  </body>
</html>  