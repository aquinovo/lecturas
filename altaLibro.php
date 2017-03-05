<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Alta de libros</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
   <link rel="stylesheet" href="css/demo.css">
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
        <div id="titulo"><p>Menú de lecturas</p></div>
      </section>
      <div id="linea-hrztl"><hr></div>
      <!-- Contenido inicial del sitio web -->
      <section class="contenido">
      
      <div class="overlay-container">
        <div class="window-container zoomin">
          <h3>Información</h3> <br>
          <center>¿Esta seguro de salir?</center><br/><br/>
          <a href="administrador.php">
            <span class="close">Aceptar</span>
          </a>
          <a href="altaLibro.php">
            <span class="close">Cancelar</span>
          </a>
        </div>
        <div class="window-container zoomout">
          <h3>Informacón </h3> <br>
            <center>holaa</center><br/><br/>
            <a href="altaLibro.php">
           <span class="close">Cerrar</span>
            </a>
        </div>
      </div>

      <script>!window.jQuery && document.write(unescape('%3Cscript src="css/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
      <script type="text/javascript" src="css/demo.js"></script>

    		<section class="doscolumnas-izq">
      <div class="alineacion-izq">
      
        <strong><big>Alta de lectura</big></strong>
        <br><br>Rellenar los campos para ingresar un nuevo título de lectura en la base de datos<br><br><br><br>
        
      </div>
      </section>
        
      <aside class="doscolumnas-der">


    		  <div class="alineacion-der">
      <FORM id="alta" method="POST" enctype="multipart/form-data">            
        <LABEL>Número de libro: </LABEL><br>
        <?php
          $cadena="SELECT count(*)+1 as canti FROM libro";
          $result=mysqli_query($conexion,$cadena)or die( mysql_error());  
          $datos=mysqli_fetch_array($result);
          echo '<input type="text" name="nuLibro" value='.$datos['canti'].' size=30% ><br><br> ';
          //Restaurar valores de formulario
          $titulo = "";
          $autor = "";
          $editorial = "";
          $paginas = "";
          $etiqueta = "";
          $resumen = "";
          $periodo="";
          $anio="";

          if(isset($_POST['nomLibro'])){
            $titulo = $_POST['nomLibro'];
          }
          if(isset($_POST['autor'])){
            $autor=$_POST['autor'];
          }
          if(isset($_POST['editorial'])){
            $editorial=$_POST['editorial'];
          }
          if(isset($_POST['paginas'])){
            $paginas=$_POST['paginas'];
          }
          if(isset($_POST['etiqueta'])){
            $etiqueta=$_POST['etiqueta'];
          }
          if(isset($_POST['resumen'])){
            $resumen=$_POST['resumen'];
          }
          if(isset($_POST['periodo'])){
            $resumen=$_POST['periodo'];
          }
          if(isset($_POST['anio'])){
            $resumen=$_POST['anio'];
          }
         
          //Formulario
      echo 
        "<LABEL>Nombre de libro: </LABEL><br>
          <input type='text' name='nomLibro' value='".$titulo."'><br><br>
        <LABEL>Autor: </LABEL><br>
          <INPUT type='text' name='autor' value='".$autor."'></INPUT><br><br>
        <LABEL>Editorial: </LABEL><br>
          <INPUT type='text' name='editorial' size=30% value='".$editorial."'></INPUT><br><br>
        <LABEL>Número de páginas: </LABEL><br>
          <INPUT type='text' name='paginas' value='".$paginas."'></INPUT><br><br>
        <LABEL>Género: </LABEL><br>
          <INPUT type='text' name='etiqueta' value='".$etiqueta."'></INPUT><br><br>
         <LABEL>Periodo: </LABEL><br>
          <INPUT type='text' name='periodo' value='".$periodo."'></INPUT>
          <LABEL>Año: </LABEL>
          <INPUT type='text' name='anio' value='".$anio."' size=100%></INPUT><br><br>
        <LABEL>Reseña: </LABEL><br>                
          <textarea name='resumen' rows='10' cols='40' value='".$resumen."'></textarea><br><br>
        <LABEL>Subir libro en pdf: </LABEL><br>
        <input  type='file' name='adjuntoPdf' id='adjuntoPdf'/><br><br>
        <LABEL>Subir libro en EPUB: </LABEL><br>       
        <input type='file' name='adjuntoEpub' /><br><br>
        <LABEL>Subir Portada: </LABEL><br>
        <input type='file' name='imagen'/><br><br>
        <LABEL>Disponible en: </LABEL><br><br>       
        <input name='biblioteca' type='checkbox' value='biblioteca'/>Biblioteca<br>
        <input name='copiadora' type='checkbox' value='copiadora'/>Copiadora<br><br>"; 
        ?>
        
        <div class="botones"> 
        <a href="administrador.php"><input type="button" value="Cancelar" name="cancelar" id="cancelar" />
                </a>
        <input type="submit" name="guardar" id="guardar" value="Guardar" onclick="window.location.href('altaLibro.php');" /> 
       </div>
     </div>
    </FORM>
    
        
</section>
         <?php
        if (isset($_POST['guardar'])){
          if( !empty($_POST['nomLibro']) && !empty($_POST['autor']) && !empty($_POST['editorial'])&& !empty($_POST['paginas']) && !empty($_POST['etiqueta']) && !empty($_POST['resumen'])){
          	$biblio=0; $copi=0; $imagen="NULL"; $nombrePDF="NULL"; $nombreEPUB="NULL";$bandera=0;
            $titulo=$_POST['nomLibro'];
            $autor=$_POST['autor'];
            $editorial=$_POST['editorial'];
            $paginas=$_POST['paginas'];
            $etiqueta=$_POST['etiqueta'];
            $resumen=$_POST['resumen'];
            $periodo=$_POST['periodo'];
            $anio=$_POST['anio'];

            if(isset($_POST['biblioteca'])){$biblio=1;}
			      if(isset($_POST['copiadora'])){$copi=1;}
            //Leer un pdf guardando la ruta del archivo
            if($_FILES["adjuntoPdf"]["error"]>0){echo "";}
            else{
              $consulta = "SELECT id FROM libro WHERE pdf='".$_FILES['adjuntoPdf']['name']."'";
              $consulta = ConsultaBD($consulta,$conexion);
              $datos = mysqli_fetch_array( $consulta );
              if(!$datos){
                $ruta="DocUpload/pdf/".$_FILES['adjuntoPdf']['name'];
                if(!file_exists($ruta)){
                  $resultado=@move_uploaded_file($_FILES['adjuntoPdf']['tmp_name'], $ruta);
                  if($resultado){
                    $nombrePDF=$_FILES['adjuntoPdf']['name'];   
                  }                      
                }
                else echo "ocurrio un error al mover el archivo pdf";
              }
              else $bandera=1;
            }
            //Leer un epub guardando la ruta del archivo
            if($_FILES["adjuntoEpub"]["error"]>0) echo "";
            else{
              $consulta = "SELECT id FROM libro WHERE epub='".$_FILES['adjuntoEpub']['name']."'";
              $consulta = ConsultaBD($consulta,$conexion);
              $datos = mysqli_fetch_array( $consulta );
              if(!$datos){ 
                $ruta="DocUpload/epub/".$_FILES['adjuntoEpub']['name'];
                if(!file_exists($ruta)){
                  $resultado=@move_uploaded_file($_FILES['adjuntoEpub']['tmp_name'], $ruta);
                  if($resultado){ 
                    $nombreEPUB=$_FILES['adjuntoEpub']['name']; } 
                  else echo "ocurrio un error al mover el archivo epub";
                }
              else echo "la ruta no existe epub";
              }
              else{ 
                $bandera=1;}
            }
            if($bandera==1)
              echo "<script type=text/javascript>
                        alert('El libro agregado ya existe, intentelo de nuevo');
                        window.location.assign(altaLibro.php);
                        </script>";
            //Guardar la ruta de una imagen
            if($_FILES["imagen"]["error"]>0){echo "";}
            else{
                $ruta="DocUpload/Portada/".$_FILES['imagen']['name'];
                if(!file_exists($ruta)){
                  $resultado=@move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
                  if($resultado){ 
                  $imagen=$_FILES['imagen']['name']; } 
                  else echo "ocurrio un error al mover el archivo de la imagen";
                }
              else echo "la ruta no existe de la imagen";
            }
            if($bandera==0){
              $cadena="INSERT INTO libro VALUES (null,'".$titulo."', '".$autor."', '".$editorial."', '".$resumen."', '".$paginas."','".$etiqueta."',".$biblio.",".$copi.",'".$nombrePDF."','".$nombreEPUB."', '".$imagen."', ".$anio.", '".$periodo."')";
              mysqli_query($conexion, $cadena);
            }
          mysqli_close($conexion); 
           echo '<script type=text/javascript>
                        alert("El libro '.$titulo.' ha sido guardado correctamente.");
                        location.href = "altaLibro.php";
                 </script>'; 
        }
        else
          echo "<script type=text/javascript>
                      alert('Existen campos vacios');
                      window.location.assign(altaLibro.php);
                      </script>";   

        }
      ?>
  </div>
    </aside>  
 <footer></footer>
  </body>
</html>  
