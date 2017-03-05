<!DOCTYPE html>
<html lang="en">
  	<head>
   <style></style>
   <meta charset="utf-8">
   
   <title>Baja de libros</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">

	</head>
  	<body>
	<div class="page-wrap">
    
        <?php
            include('lib/cabezera2.php'); //manda a traer la cabecera principal
            mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
        ?>
		
        <section class="titulo">		
				<div id="nombre-usuario">
					<img id="icono-usuario" src="img/usr.png" />
					<p2>Administrador: <b><?php echo $nombreUsuario ?></b></p2>
				</div>
				<div id="titulo"><p>Lecturas - Bajas</p></div>
			</section>
			<div id="linea-hrztl"><hr></div>
	
		<section class="contenido">
        <?php
        
        //Inicia conexión con base de datos
        
    	  echo '
    		
    		<FORM id="baja" ACTION="bajaLibro.php" METHOD="POST"> 
    		
    		<section class="doscolumnas-izq">
			<div class="alineacion-izq">
    		<strong><big>Baja de lectura</big></strong><br>
    		<br>Ingresa una palabra clave del título del libro (ejemplo: relato)
    		</div>
			</section>
			
			<aside class="doscolumnas-der">
			<div class="alineacion-der">
    		   			
            <input type="text" name="titulo" size=30%>
          <div class="botones">
    			<input type="submit" name="buscar" value="Buscar" id="buscar"/>
			</div>
             </div>
			 </aside>
    		</form>';

			//Muestra titulos relacionados
        if (isset($_POST['buscar'])){
         	if( !empty($_POST['titulo']) ){
            $buscar=$_POST['titulo'];
            $band = false;
            $consulta="SELECT id, nombre, autor_nombre, categoria FROM libro WHERE nombre like '%".$buscar."%'";
            $resultado=mysqli_query($conexion, $consulta) or die (mysql_error());   

            //Configura la tabla  
            echo '<div style="text-align:center;">';       
            echo '<br><br><br><br><table border="1" width="50%"  cellspacing="0" cellpadding="0" height="45" style="margin: 0 auto;"> ';            
            echo '<thead><tr><th>id</th> <th>nombre</th><th>Autor</th><th>Género</th><th>Seleccionar</th></tr></thead>';
            //Muestra datos en la tabla
            echo '<form action = "bajaLibro.php" method = "post">';  

            while($row=mysqli_fetch_row($resultado)){
              for($j=0; $j<4; $j++){
                  echo '<td>'.$row[$j].'</td>';            
              }
				    echo '<td><input type="checkbox" name = "libro[]" value='.$row[0].'></td> </tr>';
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
        if(!(empty($_POST['libro']))){
    			foreach($_POST['libro'] as $idlibro){
            $consulta = "SELECT pdf, epub, portada FROM libro WHERE id=".$idlibro;
            $consulta = ConsultaBD($consulta,$conexion);
            $datos = mysqli_fetch_array( $consulta );
            if($datos['pdf']!="NULL")
              unlink('./DocUpload/pdf/'.$datos['pdf']);
            if($datos['epub']!="NULL")
              unlink('./DocUpload/epub/'.$datos['epub']);
            if($datos['portada']!="NULL")
              unlink('./DocUpload/Portada/'.$datos['portada']);
        		$sentencia = "DELETE FROM libro WHERE id=".$idlibro;
					mysqli_query($conexion, $sentencia) or die (mysql_error()); 
    			}
			}

			//Termina conexión con base de datos
			mysqli_close($conexion); 

      ?>
    </div>
</section> 
</div>
 <footer></footer>
  </body>
</html>   