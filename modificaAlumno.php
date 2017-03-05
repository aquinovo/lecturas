<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Baja de Alumno</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
</head>
  <body>
    <div class='page-wrap'>
            <?php
                include('lib/cabezera2.php'); //manda a traer la cabecera principal
            	mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
            ?>
            <section class="titulo">    
	        <div id="nombre-usuario">
	          <img id="icono-usuario" src="img/usr.png" />
	          <p2>Administrador: <b><?php echo $nombreUsuario ?></b></p2>
	        </div>
	        <div id="titulo"><p>Modificar Alumno</p></div>
	      </section>
	      <div id="linea-hrztl"><hr></div>
	      <!-- Contenido inicial del sitio web -->
	      <section class="contenido">

          <FORM id="baja" method="POST" enctype="multipart/form-data">  
	      <section class="doscolumnas-izq">
	      <div class="alineacion-izq">	   
	        <strong><big>Modificar datos del alumno</big></strong>
	        <br><br>Ingresar la matrícula del alumno para modificar sus datos.	        
	      </div>
	      </section>

	      <aside class="doscolumnas-der">
	      	<div class="alineacion-der">
					 
				<LABEL>Matrícula: </LABEL><br>
                <input type="text" name="matricula" size=30% placeholder="2013021314"><br>              
                <div class="botones">  
                <input type="submit" name="buscar" value="Buscar" id="buscar"/>
                </div>
		      </div>
              </aside>
		    </FORM>                  
            <?php
                //Muestra el formulario con los datos del alumno 
            if (isset($_POST['buscar'])){
                if( !empty($_POST['matricula']) ){
                $buscar=$_POST['matricula'];
                $consulta="SELECT nombres, apellidoP, apellidoM, correoE, grupo_nombre, carrera_nombre, semestre FROM alumno WHERE matricula=".$buscar;
                //Obtiene el resultado de la búsqueda
                $resultado=ConsultaBD($consulta, $conexion);
                $datos=mysqli_fetch_array($resultado);
                echo "<FORM id='alta' method='POST' enctype='multipart/form-data'> ";
                if($datos){
                  echo "<LABEL>Nombres: </LABEL><br>
                <input type='text' name='nombres' value='".$datos['nombres']."' size=38%><br>
                  <LABEL>Apellido paterno: </LABEL><br>
                <input type='text' name='apellidoP' value='".$datos['apellidoP']."' size=38%><br>
                <LABEL>Apellido materno: </LABEL><br>
                <input type='text' name='apellidoM' value='".$datos['apellidoM']."'size=38%><br>
                 <LABEL>Matrícula: </LABEL><br>
                <input type='text' name='matricula' value='".$buscar."' size=38%><br>
                <LABEL>Correo electrónico: </LABEL><br>
                <input type='text' name='correoE' value='".$datos['correoE']."' size=38%><br>
                <LABEL>Carrera: </LABEL><br>
                <input type='text' name='carrera' value='".$datos['carrera_nombre']."' size=38%><br>
                <LABEL>Semestre: </LABEL><br>
                <input type='text' name='semestre' value='".$datos['semestre']."' size=38%><br>
                <LABEL>Grupo: </LABEL><br>
                <input type='text' name='grupo' value='".$datos['grupo_nombre']."' size=38%><br><br><br>";

                echo "<div class='botones'> 
                  <a href='administrador.php'><input type='button' value='Cancelar' name='cancelar' id='cancelar' /></a>
                <input type='submit' name='guardar' id='guardar' value='Guardar' onclick='window.location.href('registro.php');' /> 
               </div>
           ";
                }                            
                else
                  echo 'No existe un alumno con esa matrícula';
                echo "</FORM>";
              }
              else{         
                echo"<script languaje='javascript'>alert('Existen campos vacios')</script>";
              }
            }
            if (isset($_POST['guardar'])){
              if( !empty($_POST['nombres']) && !empty($_POST['apellidoP']) && !empty($_POST['apellidoM'])&& !empty($_POST['correoE']) && !empty($_POST['grupo'])){
                $nombres = $_POST['nombres'];
                $apellidoM = $_POST['apellidoM'];
                $apellidoP = $_POST['apellidoP'];
                $correoE = $_POST['correoE'];
                $carrera = $_POST["carrera"];
                $semestre = $_POST['semestre'];
                $grupo = $_POST['grupo'];
                $matricula=$_POST['matricula'];

                $consulta = "UPDATE alumno SET nombres='".$nombres."', apellidoP='".$apellidoP."', apellidoM='".$apellidoM."', correoE='".$correoE."', matricula=".$matricula.", carrera_nombre='".$carrera."', semestre=".$semestre.", grupo_nombre='".$grupo."' WHERE matricula=".$matricula.""; 
                mysqli_query($conexion,$consulta);
                echo '<script type="text/javascript">
                                alert("Gracias, ha sido registrado modificado.");
                                </script>'; 
              }
              else{
                echo"<script languaje='javascript'>alert('Existen campos vacios')</script>";
              }
            }                
            //Termina conexión con base de datos
            mysqli_close($conexion);   
            ?></div>
        </section>
        </div>
 <footer></footer>
  </body>
</html>   