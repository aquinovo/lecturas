<?php
    //Cambiar el numero de Libres que se requiera por pagina
    $cantidad_resultados_por_pagina = 5;
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
                 header("Location: index.php");
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
   
   <title>Biblioteca virtual</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">

</head>
  <body>
  <div class="page-wrap">
    
        <?php
            include('lib/cabezera.php');
             mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
        ?>
        <section class="titulo">		
		
		<div id="nombre-usuario">
		<img id="icono-usuario" src="img/usr.png" />
		
			<p2>Alumno: <b><?php echo $nombreUsuario ?></b></p2>
		</div>
		<div id="titulo"><p>Biblioteca Virtual</p></div>	
		
		
        </section>
		<div id="linea-hrztl"><hr></div>
		
		<section class="contenido">
        <!-- Contenido inicial del sitio web -->
        <FORM ACTION="biblioteca.php" method="POST" >
		
		<div class="unacolumna">
        <table border="0" align="center" width="90%">
          <thead>
            <tr ><td colspan="4"></td>
                <td colspan="4" style="border:0px solid;padding:15px 15px;"><center><b>Formatos disponibles</center></td>
            </tr>
            <tr>
            <?php
            	//Variable que define el año y periodo actual
            	$consultaActual= "SELECT anio, periodo FROM fecha LIMIT 1";
              $resultadoActual=mysqli_query($conexion, $consultaActual) or die(mysql_error());
              $row=mysqli_fetch_array($resultadoActual);
              $periodo=$row['periodo'];
              $anio=$row['anio'];

              if (isset($_POST['buscar'])){
                header('Location: bibliotecaAlumno.php');        
              } 
                $i=5*($pagina-1)+1;
                $cadena="SELECT id,nombre, numeroP, epub, pdf, biblioteca, copiadora, autor_nombre, categoria, resumen,portada FROM libro WHERE periodo='".$periodo."' and anio=".$anio;
                $resultado=mysqli_query($conexion,$cadena)or die( mysql_error()); 
                $total_registros = mysqli_num_rows($resultado); 
                //Obtiene el total de páginas existentes
                $total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina);  


                $consulta ="SELECT id,nombre, numeroP, epub, pdf, biblioteca, copiadora, autor_nombre, categoria, resumen,portada FROM libro WHERE periodo='".$periodo."' and anio=".$anio." LIMIT ".$empezar_desde.",".$cantidad_resultados_por_pagina;

                $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() );  

                while($row=mysqli_fetch_array($resultado)){  
                  echo "<td  aling:'right' valign=TOP align=left width=3%><b>".$i."</td>";  //contador
                  //Imprimiendo la imagen
                  $ruta="DocUpload/Portada/".$row['portada'];
                  echo "<td width='15%'><div3><img src='$ruta'/><div3> </td>";
                  echo "<td align='left' VALIGN='top' width=30%>Nombre del libro: <b>".$row['nombre']."</b><br>";
                  echo "Autor: <b>".$row['autor_nombre']."</b><br>";
                  $resumen=str_replace(' ','*',$row['resumen']);
                  echo "<a href=biblioteca.php?resumen=".$resumen."&pagina=".$pagina.">reseña</a></td>";


                  echo "<td align='left' VALIGN='top' width=25%>Número de páginas: <b>".$row['numeroP']."</b><br>";
                  echo "Género: <b>".$row['categoria']."</td>";

                  //Boton epub
                  if($row['epub']!="NULL"){     
                    echo "<td align='center' VALIGN='top' width=6%> <a href='/DocUpload/epub/".$row['epub']."' target=_blank>EPUB</a></td>";
                  }
                  //
                  else echo "<td width=6%></td>";
                  if($row['pdf']!="NULL"){
                    echo "<td align='center' VALIGN='top' width=6%> <a href='/DocUpload/pdf/".$row['pdf']."' target=_blank>PDF</a></td>";            
                  }
                  else echo "<td width=10%></td>";
                  if($row['biblioteca']==1){
                    echo "<td align='center' VALIGN='top' width=10%>Biblioteca</td>";}
                  else echo "<td width=10%></td>";
                  if($row['copiadora']==1){
                    echo "<td align='center' VALIGN='top' width=10%>Copiadora</td> </tr>";}
                  else echo "<td width='10%'></td>";
                  echo "</tr><tr><td style='border:0px solid;padding:15px 15px;'></td></tr>";
                  $i++;
                }

              if (isset($_GET["resumen"]))  {
                       $datorecibido=str_replace('*',' ',$_GET['resumen']);
                       echo "<script type=text/javascript>
                                    alert('".$datorecibido."');
                                    </script>";
                      
              } 
                //Botones siguiente y atras con la informacion de la pagina actual
                if($pagina<=$total_paginas){
                  echo '<center>'.($pagina)." de ".$total_paginas;
                  echo "<center>"."<a href='?pagina=".($pagina-1)."'>"."Atrás"."</a> - <a href='?pagina=".($pagina+1)."'>"."Siguiente"."</a>  "."</center>";
                 } 
                 else{
                    //Si salio de limite superior mantenerse en la misma pagina   
                    //Modificar URI para acceder a paginacion.php desde localhost
                    header('Location: biblioteca.php?pagina='.$total_paginas);
                 }
                 
                 
            ?>
         </thead>          
        </table>
            <div id="redactar-botones">
              <input type="submit" name="buscar" value="Libros anteriores" id="buscar" class="guardar" />
            </div>
            </div>
            </FORM>
    </section>
	</div>
 <footer></footer>
  </body>
</html>   
