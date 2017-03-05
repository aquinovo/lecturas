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
	        <div id="titulo"><p>Eliminar Alumno</p></div>
	      </section>
	      <div id="linea-hrztl"><hr></div>
	      <!-- Contenido inicial del sitio web -->
	      <section class="contenido">

          <FORM id="baja" method="POST" enctype="multipart/form-data">  
	      <section class="doscolumnas-izq">
	      <div class="alineacion-izq">	   
	        <strong><big>Baja de alumno</big></strong>
	        <br><br>Ingresar la matrícula del alumno para eliminarlo de la base de datos.	        
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
                //Muestra titulos relacionados
            if (isset($_POST['buscar'])){
                if( !empty($_POST['matricula']) ){
                $buscar=$_POST['matricula'];
                $band = false;
                $consulta="SELECT id, nombres, apellidoP, apellidoM, carrera_nombre, semestre FROM alumno WHERE matricula=".$buscar;

                $resultado=mysqli_query($conexion, $consulta) or die (mysql_error());   

                //Configura la tabla  
                echo '<div style="text-align:center;">';       
                echo '<br><br><br><br><table border="1" width="50%"  cellspacing="0" cellpadding="0" height="45" style="margin: 0 auto;"> ';            
                echo '<thead><tr><th>id</th> <th>Nombre</th><th>Carrera</th><th>Semestre</th><th>Seleccionar</th></tr></thead>';
                //Muestra datos en la tabla
                echo '<form action = "bajaAlumno.php" method = "post">';  

                while($row=mysqli_fetch_row($resultado)){
                  for($j=0; $j<6; $j++){
                    if($j==1){
                      echo '<td>'.$row[$j]." ".$row[$j+1]." ".$row[$j+2].'</td>';   
                        $j=3;                        
                    }
                    else
                      echo '<td>'.$row[$j].'</td>';            
                  }
                  echo '<td><input type="checkbox" name = "seleccionados[]" value='.$row[0].'></td> </tr>';
                  $band = true;
                }
                if($band == true){
                    
                  echo '</table><br>';
                  echo '<input type="submit" value="Aceptar" class="button" data-type="zoomout"/>
                  </form>'; 
                } 
                else
                  echo '<center><td  colspan="5">No hay títulos de libros con esa palabra</td></table>';
                
              }
              else{         
                echo"<script languaje='javascript'>alert('Existen campos vacios')</script>";
              }
            }

                //Elimina los titulos selecionados de la base de datos
            if(!(empty($_POST['seleccionados']))){
                    foreach($_POST['seleccionados'] as $idA){       
                    $sentencia = "DELETE FROM alumno WHERE id=".$idA;
                        mysqli_query($conexion, $sentencia) or die (mysql_error()); 
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