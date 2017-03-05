<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <title>Kardex</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
   <script type="text/javascript">
       function cuenta(){
           document.forms[0].caracteres.value=document.forms[0].texto.value.length
       }
   </script> 
  </head>
  <body>
  <div class="page-wrap">
    <?php
        include('lib/cabezera.php'); //Llamar la cabecera del usuario
        mysqli_set_charset($conexion, "utf8");
        $band =true;
    ?>
    <section class="titulo">		
		<div id="nombre-usuario">
		  <img id="icono-usuario" src="img/usr.png" />
	      <p2>Alumno: <b><?php echo $nombreUsuario ?></b></p2>
		</div>
		<div id="titulo"><p>Kárdex</p></div>	
    </section>
	<div id="linea-hrztl"><hr></div>
	<section class="contenido">
    <!-- Contenido inicial del sitio web -->
    <div class="unacolumna-inicio">
        <div class="table-inicio-izq" >
            <div class="inicio-documentos">
            <?php
                //Obtener los datos del usuario logueado
                $consulta = "SELECT correoE,carrera_nombre,semestre,grupo_nombre FROM alumno WHERE id = '".$_COOKIE['uid']."'";
                $resultado = ConsultaBD($consulta,$conexion);
                $datos = mysqli_fetch_array( $resultado );
                date_default_timezone_set ('America/Mexico_City'); // Cambiar la zona horaria
                $date = date("Y-m-d"); //Obtener fecha actual
                $hour = date("H:i:s"); //Obtener hora actual
                $band = true;
                if( $datos ){
                    echo '
                        Matrícula:<b>'.$datos['correoE'].'</b><br>
                        Carrera:<b>'.$datos['carrera_nombre'].'</b><br>
                        Semestre:<b>'.$datos['semestre'].'</b><br>
                        Grupo:<b>'.$datos['grupo_nombre'].'</b><br>';
                    echo'<br>';
            ?>
            </div>
        </div>
        <div class="table-inicio-der">
            <div class="inicio-documentos">
            <?php
                echo 'Fecha:<b>'.$date.'</b><br>
                    Hora:<b>'.$hour.'</b>';
                }
                ?>
            </div>
       </div>
    </div>
    <div class="unacolumna">
        <form method="post">  
            <input  id="redactar-actualizar" type="button" value="Actualizar Página" onclick="window.location.reload('kardex.php')" />
        </form> 
        <br>
       <table class="prolect1">
        <?php
          $consulta1 = "SELECT carrera_nombre FROM alumno WHERE alumno.id=".$_COOKIE['uid']."";
          $resultado1 = mysqli_query($conexion,$consulta1 ) or die( mysql_error() );
          $datos1=mysqli_fetch_assoc($resultado1);
        ?>
        <caption><?php echo $datos['carrera_nombre'];?></caption>
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>TÍTULO DE LA LECTURA</th>
                    <th>FECHA</th>
                    <th>NÚMERO DE LECTURA</th>
                    <th>REPORTE</th>
                    <th>NOMBRE DE LA PERSONA QUE CALIFICÓ</th>
                </tr>
            <?php
                 // Obtener la información de los reportes de lectura enviados al adminsitrador y ver cual es el estatus que se le ha puesto
                  $consulta = "SELECT libro_nombre,fecha,lectura,codigo,estado,nombres,apellidoP,apellidoM FROM revision_usuario JOIN administrador WHERE alumno_id = '".$_COOKIE['uid']."' and administrador.id=revision_usuario.administrador_id"; 
                  $resultado = ConsultaBD($consulta,$conexion);
                  while($datos=mysqli_fetch_assoc($resultado))    
                  {
                      $libro =" ";
                      $fecha = " ";
                      $lectura = " ";
                      $revision = " ";
                      $estado = " ";
                      $id = " ";
                      echo '<tr>';
                      
                      if(strcmp($datos['libro_nombre'],"null")!=0){
                          $libro = $datos['libro_nombre'];
                          if(strcmp($datos['fecha'],"null")!=0)
                              $fecha = $datos['fecha'];
                          if(strcmp($datos['lectura'],"null")!=0)
                              $lectura = $datos['lectura'];
                          if(strcmp($datos['nombres'],"null")!=0)
                              $revision = $datos['nombres']." ".$datos['apellidoP']." ".$datos['apellidoM'];
                          if(strcmp($datos['estado'],"null")!=0)
                              $estado = $datos['estado'];
                          if(strcmp($datos['codigo'],"null")!=0)
                              $id = $datos['codigo'];
                          echo'<td>'.$id.'</td>';
                          echo'<td>'.$libro.'</td>';
                          echo'<td>'.$fecha.'</td>';
                          echo'<td>'.$lectura.'</td>';
                          echo'<td>'.$estado.'</td>'; 
                          echo'<td>'.$revision.'</td>';
                          echo '</tr>';
                      }
                     $band=false;
                  }
                  mysqli_close($conexion);
            ?>
            <?php
                if ($band == true)
                    echo'<table width=100%><tr><td>No hay datos disponibles para mostrar.</td></tr></table>';
                ?>
           </tbody></table>
        </div>
    </section>
	</div>
 <footer></footer>
  </body>
</html>    