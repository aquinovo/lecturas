<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Inicio</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
	</head>
	<body>
	<div class="page-wrap">
    <?php
        include('lib/cabezera2.php'); //manda a traer la cabecera principal
        mysqli_set_charset($conexion, "utf8"); // Muestra los acentos y Ñ de la base de datos
        $band =true;
    ?>
		<section class="titulo">		
		
		<div id="nombre-usuario">
		<img id="icono-usuario" src="img/usr.png" />
		
			<p2>Administrador: <b><?php echo $nombreUsuario ?></b></p2>
		</div>
		<div id="titulo"><p>Bienvenido</p></div>	
		
		
        </section>
		<div id="linea-hrztl"><hr></div>
        <section class="contenido">
        <!-- Contenido inicial del sitio web -->
        <br>
      <div class="unacolumna">	
          <br><br>
          <table class="prolect1">
           <caption><?php echo "Fechas de entrega";?></caption>
            <tbody>
            <tr>
                <th>SEMESTRE</th>
                <th>CARRERA</th>
                <th>1° ENTREGA</th>
                <th>2° ENTREGA</th>
                <th>3° ENTREGA</th>
            </tr>
        <?php
            $band = false;
            $este ='0';
            $consulta = "SELECT fecha.id,id1,id2,id3,id4,id5,id6,id7,id8,id9,id10,semestre,Primera,Segunda,Tercera FROM grupo_lectura JOIN fecha where fecha.gc_id=grupo_lectura.id"; 
            $resultado = ConsultaBD($consulta,$conexion);
            while ($datos=mysqli_fetch_assoc($resultado))    
            {
                echo "<tr><td>".$datos['semestre'];
                echo "</td><td>";
                if( $datos['id'] == 5 || $datos['id'] == 6 || $datos['id'] == 7)
                    echo "Todas las carreras";
                else{
                    for ($i = 1; $i <= 10; $i++) {
                        $iden = "id".$i;
                        if($datos[$iden]!=NULL){
                            $busquedaCarrera = "SELECT id,sobreN FROM carrera where id=".$datos[$iden]; 
                            $resCarrera = ConsultaBD($busquedaCarrera,$conexion);
                            $datosCarrera=mysqli_fetch_array($resCarrera);
                            echo $datosCarrera['sobreN'].",";
                        }
                    }
                }
                echo "</td><td>".$datos['Primera'];
                echo "</td><td>".$datos['Segunda'];
                echo "</td><td>".$datos['Tercera']."</td></tr>";
            }
            if ($band == true)
                echo'<table width=100%><tr><td>No hay datos disponibles para mostrar.</td></tr></table>';
        ?>
              </tbody>
          </table>
        </div>
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
 <footer></footer>s
  </body>
</html>   