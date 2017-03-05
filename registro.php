<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Registro Alumno</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
</head>
  <body>
    <div id='main'>
        <aside>
            <?php
                include('lib/cabezera2.php'); //manda a traer la cabecera principal
            	mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
            ?>
            <section class="titulo">    
	        <div id="nombre-usuario">
	          <img id="icono-usuario" src="img/usr.png" />
	          <p2>Administrador: <b><?php echo $nombreUsuario ?></b></p2>
	        </div>
	        <div id="titulo"><p>Registrar Alumno</p></div>
	      </section>
	      <div id="linea-hrztl"><hr></div>
	      <!-- Contenido inicial del sitio web -->
	      <section class="contenido">
	      <section class="doscolumnas-izq">
	      <div class="alineacion-izq">	   
	        <strong><big>Registro</big></strong>
	        <br><br>Rellenar los campos para ingresar en la base de datos.<br><br><br><br>	        
	      </div>
	      </section>

	      <aside class="doscolumnas-der">
	      	<div class="alineacion-der">
			<FORM id="alta" method="POST" enctype="multipart/form-data"> 			 
				<LABEL>Nombres: </LABEL><br>
                <input type="text" name="nombres" size=38%><br>
				<LABEL>Apellido paterno: </LABEL><br>
                <input type="text" name="apellidoP" size=38%><br>
                <LABEL>Apellido materno: </LABEL><br>
                <input type="text" name="apellidoM" size=38%><br>
                 <LABEL>Matrícula: </LABEL><br>
                <input type="text" name="matricula" size=38%><br>
                <LABEL>Correo electrónico: </LABEL><br>
                <input type="text" name="correoE" size=38% placeholder="ic2013021314"><br>
                <LABEL>Carrera: </LABEL><br>
                <?php
                    $consulta = "SELECT *FROM carrera"; 
                    $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() ); 
                    $resultado_consulta_mysql=mysqli_query($conexion,$consulta);
                    echo '<select style="width:258px" name = carrera> ';  
                    while ($datos=mysqli_fetch_assoc($resultado))    
                    {
                        echo '<option >';
                        echo ''.$datos["nombre"]; 
                        echo '</option>';
                    }  
                    echo '</select>';
                ?>
                <br><br>
                <LABEL>Semestre: </LABEL><br>
                <select style="width:258px" name=semestre>
                  	<?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo '<option>';
                            echo ''.$i; 
                            echo '</option>';
                        }
                    ?>
                </select><br>
                <LABEL>Grupo: </LABEL><br> 
                    <?php
                        $consulta = "SELECT *FROM grupo"; 
                        $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() ); 
                        $resultado_consulta_mysql=mysqli_query($conexion,$consulta);
                        echo '<select style="width:258px" name = grupo> ';  
                        while ($datos=mysqli_fetch_assoc($resultado))    
                        {
                            echo '<option >';
                            echo ''.$datos["codigo"]; 
                            echo '</option>';
                        }  
                        echo '</select>';
                        ?>
                 <br><br><br>
                
                <div class="botones"> 
			        <a href="administrador.php"><input type="button" value="Cancelar" name="cancelar" id="cancelar" /></a>
		        <input type="submit" name="guardar" id="guardar" value="Guardar" onclick="window.location.href('registro.php');" /> 
		       </div>
		     </div>
		    </FORM>
            <?php
                if (isset($_POST['guardar'])){
                    if( !empty($_POST['nombres']) && !empty($_POST['apellidoP']) && !empty($_POST['apellidoM'])&& !empty($_POST['correoE']) && !empty($_POST['grupo'])){
                        $nombres = $_POST['nombres'];
                        $apellidoM = $_POST['apellidoM'];
                        $apellidoP = $_POST['apellidoP'];
                        $correoE = $_POST['correoE'];
                        $carrera = $_POST["carrera"];
                        $semestre = $_POST['semestre'];
                        $grupo = $_POST['grupo'];
                        $matricula = $_POST['matricula'];
                        $consulta = "SELECT *from alumno WHERE correoE = '".$correoE."'"; 
	                    $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() ); 
	                    $datos = mysqli_fetch_array( $resultado ); 
                        if( $datos ){
                           echo"<script languaje='javascript'>alert('El usuario ya esta existe, vuelva a intentarlo')</script>";
                        }
                        else{
                            mysqli_query($conexion, "INSERT INTO alumno VALUES (null,'".$nombres."', '".$apellidoP."', '".$apellidoM."', '".$correoE."', '".$matricula."', '".$carrera."','".$semestre."', '".$grupo."')");
                            mysqli_close($conexion); // Cerramos la conexion con la base de datos
                            echo '<script type="text/javascript">
                                alert("Gracias, ha sido registrado exitosamente.");
                                </script>';        
                        }
                }
                else{
                    echo"<script languaje='javascript'>alert('Existen campos vacios')</script>";
                }
            }
        ?>
    </aside></div>
 <footer></footer>
  </body>
</html>   