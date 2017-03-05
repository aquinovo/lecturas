<?php
    include('lib/cabezera2.php'); //manda a traer la cabecera principal
    mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
    $band =true;
    $cantidad_resultados_por_pagina = 1;
    //Datos recibidos de evaluacionp.php para la primera llamada y paginacion.php
    $numero=($_GET['numero']);
    $semestre=($_GET['semestre']);
    $grupo=($_GET['grupo']);
    //Comprueba si está seteado el GET de HTTP
    if (isset($_GET["pagina"]))  {
        //Si el GET de HTTP SÍ es una string / cadena, procede
        if (is_string($_GET["pagina"])) {
            //Si la string es numérica, define la variable 'pagina'
             if (is_numeric($_GET["pagina"])) {
                 //Si la petición desde la paginación es la página uno o querer acceder a 0
                 if ($_GET["pagina"] <= 1) {
                 	 $pagina = 1;
                 } else { //Si la petición desde la paginación no es para ir a la pagina 1, va a la que sea
                     $pagina = $_GET["pagina"];
                };
             } else { //Si la string no es numérica, redirige al index (por ejemplo: paginacion.php?pagina=AAA)
                 header("Location: evaluacion.php");
                die();
             };
        };
    } else { //Si el GET de HTTP no está seteado, lleva a la primera página (puede ser cambiado al index.php o lo que sea)
        $pagina = 1;
    };
    //Define el número 0 para empezar a paginar multiplicado por la cantidad de resultados por página
    $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Programa de lecturas</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
  </head>
  <body>
  <?php
    mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
  ?>
  <div class="page-wrap">
	<section class="titulo">		
        <div id="nombre-usuario">
			<img id="icono-usuario" src="img/usr.png" />
			<p2>Administrador: <b><?php echo $nombreUsuario ?></b></p2>
		</div>
		<div id="titulo"><p>Evaluación</p></div>
	</section>
    <div id="linea-hrztl"><hr></div>
	<section class="contenido">
        <FORM METHOD="POST">
        <!-- Contenido inicial del sitio web -->
        </FORM>
        <?php       
           $date = date("Y-m-d"); // Obtiene fecha actual
           $hour = date("H:i:s"); // Obtiene hora actual
           $consulta = "SELECT revision_usuario.id,alumno_id,libro_nombre,resumen,fecha,lectura,palabras,alumno.id,nombres,apellidoP,apellidoM,carrera_nombre,semestre,grupo_nombre,correoE FROM revision_usuario LEFT JOIN alumno ON revision_usuario.alumno_id = alumno.id WHERE lectura = '".$_GET['numero']."' and semestre= '".$_GET['semestre']."' and grupo_nombre='".$_GET['grupo']."'";
           $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() );
           $total_registros = mysqli_num_rows($resultado); 
            //Obtiene el total de páginas existentes
            $total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 
            //Realiza la consulta en el orden de ID ascendente (cambiar "id" por, por ejemplo, "nombre" o "edad", alfabéticamente, etc.)
            //Limitada por la cantidad de cantidad por página
            $consulta = "SELECT revision_usuario.id as uis,alumno_id,libro_nombre,fecha,hora,resumen,fecha,revision,lectura,palabras,alumno.id,nombres,apellidoP,apellidoM,carrera_nombre,semestre,grupo_nombre,correoE FROM revision_usuario LEFT JOIN alumno ON revision_usuario.alumno_id = alumno.id WHERE lectura = '".$_GET['numero']."' and semestre= '".$_GET['semestre']."' and grupo_nombre='".$_GET['grupo']."' LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina;
            $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() );
	        while ($datos=mysqli_fetch_array($resultado)){
                $este = $datos['uis'];
                $correo_E = $datos['correoE'];
                $revisando = $datos['revision'];
        ?>
       <section class="doscolumnas-izq"> 
           <div class="evaluacion-datos">
			     <div id="datos-izq">
                    <?php
                        echo '<table border=0  width=400px><tr>
                                <td width=10%>Nombre:</td><td width=90%> <b>'.$datos['nombres'].' '.$datos['apellidoP'].' '.$datos['apellidoM'].'</td></tr><tr>
                                <td width=10%>Carrera:</td><td width=90%> <b>'.$datos['carrera_nombre'].'</td></tr><tr>
                                <td width=10%>Grupo:</td><td width=90%> <b>'.$datos['grupo_nombre'].'</td></tr><tr>
                                <td width=10%>Título:</td><td width=90%> <b>'.$datos['libro_nombre'].'</td></tr><tr>
                                <td width=10%>Fecha:</td><td width=90%> <b>'.$datos['fecha'].'</td></tr><tr>
                                <td width=10%>Hora:</td><td width=90%> <b>'.$datos['hora'].'</td>';
                        echo'</tr></table>';
                    ?>
					<br>
					<div id="caracteres">
					   <LABEL>Caracteres: </LABEL>
                       <?php
                           echo'<input type="text" name=caracteres class="cara" value='. $datos['palabras']  .' readonly >';
                       ?><br>
				    </div>
                </div>
				<div id="datos-der">
				    <div id="atras-adelante">
				    <?php
                        //Botones antes (restar uno a $pagina) y siguientes (sumar uno a $pagina)    
                        echo "   <input id=button-atras type=submit name=buscar value=Atras class=guardar onClick=location.href='?pagina=".($pagina-1)."&numero=".$numero."&semestre=".$semestre."&grupo=".$grupo."'><br>";
                        echo "   <input id=button-adelante type=submit name=buscar value=Siguiente class=guardar onClick=location.href='?pagina=".($pagina+1)."&numero=".$numero."&semestre=".$semestre."&grupo=".$grupo."'>";
                    ?> 
					</div>	
				</div>
                <?php
                    echo '<FORM action=paginacion.php?pagina='.$pagina.'&numero='.$numero.'&semestre='.$semestre.'&grupo='.$grupo.' METHOD="POST">';
                    mysqli_query($conexion,"update revision_usuario Set where id='".$este."'");
                   echo'<textarea style="width: 100%;height:300px;float:right;margin-top:10px;" name="texto"  readonly>'. $datos['resumen']    .'</textarea>';
                ?>
                </div>			  
             </section>
            <aside class="doscolumnas-der">                  
				<div class="evaluacion-calificar">
				    <div id="calificar-izq">
				        <div id="evaluacion-evaluacion">				
				            <LABEL>Evaluación: </LABEL>			
				                <br>
                                <?php 
                                  echo '<select style="width:130px;display:block;"  name = evalua> '; 
                                  echo '<option >ACEPTADO</option>';
                                  echo '<option >RECHAZADO</option>';
                                  echo '</select>';
                                  echo '<input id=button-calificar-evaluacion type=submit name=cal value=Calificar class=guardar>';
                                ?>
				        </div>
				    </div>
				<div id="calificar-der">
				    <?php   
                        echo '<FORM METHOD="POST">';
                        echo "<input id=button-salir-evaluacion type=submit name=salir value=Finalizar-grupo class=guardar>";
                        echo '<form>';
                    ?>
				</div>
                <div id="label-comentarios">
                    <br><br><br>
                    <label>Comentarios: <br></label>
				</div>	
				<?php
					if (strcmp($revisando,"null")==0)
                        echo'<textarea style="width:100%; float:left;margin-top:10px;" name=revi ></textarea>';
                    else
                        echo'<textarea style="width:100%;height:300px; float:left;margin-top:10px;" name=revi >'.$revisando.'</textarea>';
                ?>  
                <?php
               }
                echo '</FORM>';
            ?>
            <?php
                 //Informacion de la pagina actual
                if(isset($_POST['cal'])) {
                    $consulta2 = "SELECT id FROM  revision_usuario WHERE id = '".$este."'"; 
                    $resultado1 = ConsultaBD($consulta2,$conexion); 
	                $datos1 = mysqli_fetch_array( $resultado1 ); 
                    if( $datos1 ){
                        mysqli_query($conexion,"update revision_usuario Set revision= '".$_POST['revi']."', estado = '".$_POST['evalua']."', administrador_id=".$_COOKIE['uid']." where id='".$datos1['id']."'");
                        // El mensaje
                        $mensaje = 'Estimado alumno:
El reporte de lectura ha sido evaluado correctamente a las '.$hour.' y fecha de envío '.$date.' ,favor de checar en el kardex.
En caso de alguna duda, acudir al Instituto de Ciencias Sociales y Humanidades, cubículo 7.';
                        // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
                        $mensaje = wordwrap($mensaje, 70, "\r\n");
                        //correo del alumno
                        $correo= $correo_E."@ndikandi.utm.mx";
                        //asunto
                        $asunto="Reporte de Lecturas";
                        $bool = mail($correo,$asunto,$mensaje);
                        if($bool){
                            echo '<script type="text/javascript">
                            alert("Se ha evaluado el alumno seleccionado y se envío un correo de notificacion.");
                            </script>';
                        }
                    }
                 }
                 if(isset($_POST['salir'])) {
                    
            ?>
                    <script type="text/javascript"> 
                        confirmar=confirm("El grupo será calificado"); 
                        var numero  = '<?php echo $_GET['numero']; ?>';
                        var grupo  = '<?php echo $_GET['grupo']; ?>';
                        var semestre  = '<?php echo $_GET['semestre']; ?>';
                        if (confirmar) 
                        // si pulsamos en aceptar
                        window.location.href = 'salir_eva.php?numero='+numero+'&semestre='+semestre+'&grupo='+grupo;  
                    </script>
            <?php
                 }
                 if($pagina<=$total_paginas){
                 	echo "<center>".($pagina)."/".$total_paginas."</center>";
                 }
                 else{
                    //Si salio de limite superior mantenerse en la misma pagina   
                    //Modificar URI para acceder a paginacion.php desde localhost
                    header('Location: paginacion.php?pagina='.$total_paginas.'&numero='.$numero.'&semestre='.$semestre.'&grupo='.$grupo);
                 }
             mysqli_close($conexion);
            ?>
    
			</div>
			</aside>
    </section>
	</div>
 <footer></footer> 
  </body>
</html>   