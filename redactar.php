<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf8">
   <title>Redactar</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
   <link rel="stylesheet" href="css/demo.css">
   <script type="text/javascript">
      function cuenta(){
          document.forms[0].caracteres.value=document.forms[0].texto.value.length
      }
      function miFuncion() {
         alert('Has hecho click en "miboton"');
      }
    </script>

   </head>
   <body>
    <div class="page-wrap">
      <?php
        include('lib/cabezera.php'); // Se incluye la cabecera del alumno
        mysqli_set_charset($conexion, "utf8"); // Permite mostrar los acentos y Ñ de la base de datos
		    date_default_timezone_set ('America/Mexico_City');// Cambiamos la zona horaria
        $date = date("Y-m-d"); // Obtiene fecha actual
        $hour = date("H:i:s"); // Obtiene hora actual
        //echo " time ".time();
      ?>	
      <section class="titulo">			
        <div id="nombre-usuario">
		     <img id="icono-usuario" src="img/usr.png" />
          <p2>Alumno: <b><?php echo $nombreUsuario ?></b></p2>
        </div>
	     <div id="titulo"><p>Redactar</p></div>		
      </section>
      <div id="linea-hrztl"><hr></div>	
      <section class="contenido">
        <!-- Contenido inicial del sitio web -->
      <section class="doscolumnas-izq"> 
		<div class="redactar">
		  <?php  
             echo '<form action="redactar.php" method="post" >';
             // Obtenemos los datos del alumno dependiendo el usuario que se haya logueado
             $consulta = "SELECT matricula,correoE,carrera_nombre,semestre,grupo_nombre FROM alumno WHERE id = '".$_COOKIE['uid']."'";
             $resultado = ConsultaBD($consulta,$conexion);
             $datos = mysqli_fetch_array( $resultado );
             // Mostramos los datos del usuario si ya esta registrado en la base de datos
             if( $datos ){
                 echo '<table border=0 width=100%><tr>
                       <td width=10%>Matrícula:</td><td width=90%> <b>'.$datos['matricula'].'</td></tr><tr>
                       <td width=10%>Carrera:</td><td width=90%> <b>'.$datos['carrera_nombre'].'</td></tr><tr>
                       <td width=10%>Semestre:</td><td width=90%> <b>'.$datos['semestre'].'</td></tr><tr>
                       <td width=10%>Grupo:</td><td width=90%> <b>'.$datos['grupo_nombre'].'</td>';
                 echo'</tr></table>';
                 $carrera_nombre=$datos['carrera_nombre']; //Guardamos la informacion del nombre de la carrera y el semestre del usuario.
                 $semestre=$datos['semestre'];
                 $correo_E = $datos['correoE'];
           ?>
           <br>
           <?php 
            $consulta = "SELECT libro_nombre,resumen,lectura,palabras FROM lectura_usuario WHERE alumno_id = '".$_COOKIE['uid']."'";
            $resultado = ConsultaBD($consulta,$conexion);
            $datos1=mysqli_fetch_assoc($resultado);

            $consultaAnio = "SELECT anio,periodo FROM fecha LIMIT 1";
            $resultadoAnio = ConsultaBD($consultaAnio,$conexion);
            $datos=mysqli_fetch_assoc($resultadoAnio);
            $anioActual= $datos['anio'];
            $periodoActual=$datos['periodo'];

            $consulta = "SELECT *FROM libro where anio=".$anioActual." and periodo='".$periodoActual."'";
            $resultado = ConsultaBD($consulta,$conexion);
            echo 'Titulo de lectura: &nbsp;&nbsp;&nbsp; ';
            echo '<select style="width:300px" name = libros> ';
             // Hacer una consulta de los nombres de los libros existentes      
             while ($datos=mysqli_fetch_assoc($resultado))    
             {
                if($datos1['libro_nombre']==$datos['nombre'])
                 echo '<option selected="selected">';
                else
                  echo '<option>';
                 echo ''.$datos["nombre"]; 
                 echo '</option>';
             }  
             echo '</select>';
            ?>
            <br>
			<br>
			<?php 
      $lect=['Primera','Segunda','Tercera'];
        echo 'Número de lectura: ';
        echo '<select style="width:300px;margin-left:2px;" name = numero> ';  
        $i=0;
        while($i<3){
          if($datos1['lectura']==$lect[$i]){
            echo '<option selected="selected">'.$datos1['lectura'].'</option>';
          }
          else
            echo '<option >'.$lect[$i].'</option>';
          $i++;
        }
        echo '</select>';
      ?>
		</div>
    </section>		
    <aside class="doscolumnas-der">
        <div class="redactar-der">
            <?php
              echo '<table border=0 width=100%><tr>
                    <td width=25%>Fecha:</td><td width=25%> <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$date.'</td></tr><tr>
                    <td width=25%>Hora:</td><td  text-align:right width=25%> <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$hour.'</td>';
              echo'</tr></table><br>';
             }
            ?>
						<br><br><br>
            Mínimo requerido: <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7,500</b><br>
            Máximo recomendado: <b>10,844</b><br>
            <?php 
              $consulta = "SELECT libro_nombre,resumen,lectura,palabras FROM lectura_usuario WHERE alumno_id = '".$_COOKIE['uid']."'";
              $resultado = ConsultaBD($consulta,$conexion);
              $datos=mysqli_fetch_assoc($resultado);
              echo' Caracteres escritos: <input id=caracteres-escritos type=text name=caracteres class="cara" value='. $datos['palabras']  .' >';
            ?>
		</div>
		</aside>
        <?php 
            //Mostrar los datos de la reseña del usuario si es que que ya ha guardado una versión.
            $consulta = "SELECT libro_nombre,resumen,lectura,palabras FROM lectura_usuario WHERE alumno_id = '".$_COOKIE['uid']."'";
            $resultado = ConsultaBD($consulta,$conexion);
            $datos=mysqli_fetch_assoc($resultado);
            //Mostrar la información del resumen en un textarea
            echo'<textarea style="width:100%;margin-top:20px;height:200px;" name="texto" onKeyDown="cuenta()" onKeyUp="cuenta()">'. $datos['resumen']  .'</textarea>';
        ?>
        <div id="redactar-botones">
            <input id="redactar-guardar" type="submit" name="guardar" value="Guardar" class="guardar">       
            <input id="redactar-enviar" type="submit" name="enviar" value="Enviar" class="guardar">        
        </div>    
        <?php 
           echo '</form>';
        //Si el usuario ha presionado el boton de guardar, realizamos dichas operaciones.
            if (isset($_POST['guardar'])) {
                //solo se guarda el resumen del alumno, si los campos no estan vacios de lo contrario, aparecera un mensaje de error.
                if( !empty($_POST['texto']) && !empty($_POST['caracteres'])){
                  $consulta = "SELECT id,alumno_id FROM lectura_usuario WHERE alumno_id = '".$_COOKIE['uid']."'"; 
                  $resultado = ConsultaBD($consulta,$conexion); 
                  $resumen = $_POST['texto'];
	                $datos = mysqli_fetch_array( $resultado ); 
                  $string = str_replace(array("'"),'',$resumen);
                  //Si ya existe un resumen guardado, solo se deberá actualizar la información de lo contario, de inserta a la tabla de las lecturas.
                  if( $datos ){
                    mysqli_query($conexion,"Update lectura_usuario Set libro_nombre='".$_POST['libros']."',resumen='".$string."',fecha='".$date."', lectura='".$_POST['numero']."',palabras='".$_POST['caracteres']."' where id='".$datos['id']."'");
                  }
                  else
                  {
                    $alumno = $_COOKIE['uid'];
                    $libros = $_POST['libros'];
                    $lectura = $_POST['numero'];
                    $caract = $_POST['caracteres'];
                    mysqli_query($conexion, "INSERT INTO lectura_usuario VALUES (null,".$alumno.",null, '".$libros."', '".$resumen."','".$date."','".$hour."','".$lectura."',null,null,".$caract.",null,null,null,null)");
                  }
                  echo '<script type="text/javascript">
                    alert("Su reseña se ha guardado correctamente.");
                    location.href = "redactar.php";
                    </script>';
                }
                else{
                    echo"<script languaje='javascript'>alert('Existen campos vacios')</script>";
                }
            }
            //Si el usuario ha presionado el boton de enviar, realizamos dichas operaciones.
            if(isset($_POST['enviar'])) {
                //$codigo1 = generarCodigo(6); // genera un código de 6 caracteres de longitud.
                if( !empty($_POST['texto']) && !empty($_POST['caracteres']) && $_POST['caracteres']>=7500 && $_POST['caracteres']<=10844){
                  //obtenemos la informacion del formulario para que sea procesada
                  $alumno = $_COOKIE['uid'];
                  $libros = $_POST['libros'];
                  $resumen = $_POST['texto'];
                  $lectura = $_POST['numero'];
                  $caract = $_POST['caracteres'];
                  //Realizar una consulta del id de la carrera del alumno
                  $consulta1 = "SELECT id FROM carrera where nombre='".$carrera_nombre."'"; 
                  $resultado1 = ConsultaBD($consulta1,$conexion);
                  $este ='0';
                  if($datos1 = mysqli_fetch_assoc($resultado1)){
                    $consulta = "SELECT id,id1,id2,id3,id4,id5,id6,id7,id8,id9,id10 FROM grupo_lectura"; 
                    $resultado = ConsultaBD($consulta,$conexion);
                    while ($datos = mysqli_fetch_assoc($resultado))    
                    {
                        for ($i = 1; $i <= 10; $i++) {
                          $iden = "id".$i;
                          if($datos[$iden]==$datos1['id']){
                            $este = $datos['id'];
                          }
                        }
                        if($este!='0'){
                          $nom = "SELECT id,Primera,Segunda,Tercera,gc_id,semestre,anio,periodo FROM fecha where  gc_id='".$este."' and semestre='".$semestre."'"; 
                          $res2 = ConsultaBD($nom,$conexion);
                          //Asignar a la variable fecha, la informacion de la consulta por semestre del alumno.
                          while ($oo=mysqli_fetch_assoc($res2)) {
                            if(strcmp($lectura,"Primera")==0)
                              $fechas=date($oo['Primera']);
                            if(strcmp($lectura,"Segunda")==0)
                              $fechas=date($oo['Segunda']);
                            if(strcmp($lectura,"Tercera")==0)
                              $fechas=date($oo['Tercera']);
                          }
                          $este ='0';
                       }
                      }
                    }  
                    // Realizar la diferencia de fechas de la actual con la que debe entregar el reporte
                    $segundos=strtotime($fechas) - strtotime($date);
                    $diferencia_dias=intval($segundos/60/60/24);
                    //El resumen solo se envia si no se ha pasado de la fecha de entrega, dependiendo el numero de lectura que envia
                    $identificador = uniqid();
                    if($diferencia_dias<0){
                      $estados = "FUERA DE TIEMPO";
                    }else{
                      $estados = "ENTREGADO";
                    }
                    $string = str_replace(array("'"),'',$resumen);
                    $consulta = "SELECT id, alumno_id,lectura FROM revision_usuario WHERE alumno_id = '".$_COOKIE['uid']."' and lectura='".$lectura."'"; 
                    $resultado = ConsultaBD($consulta,$conexion); 
                    $datos = mysqli_fetch_array( $resultado ); 
                    if( $datos ){
                      $result = mysqli_query($conexion, "UPDATE revision_usuario SET libro_nombre='".$libros."', resumen='".$string."', fecha='".$date."', hora='".$hour."', lectura='".$lectura."', palabras=".$caract.", recibir='".$estados."', codigo='".$identificador."' WHERE alumno_id=".$datos['alumno_id']." and id=".$datos['id']);
                    }
                    else                      
                      $result = mysqli_query($conexion, "INSERT INTO revision_usuario(id,alumno_id,administrador_id,libro_nombre,resumen,fecha,hora,lectura,enviado,revision,palabras,acentos,espacios,recibir,estado,codigo) VALUES (null,".$alumno.",null, '".$libros."', '".$string."', '".$date."', '".$hour."', '".$lectura."',null,null,".$caract.",null,null,'".$estados."',null, '".$identificador."')");

                    //$result = mysqli_query($conexion, "INSERT INTO revision_usuario(id,alumno_id,administrador_id,libro_nombre,resumen,fecha,hora,lectura,enviado,revision,palabras,acentos,espacios,frases,estado) VALUES (null,12,null, 'en mi', 'te espero por aqui', '2016-05-06','12:00:00','Tercera',null,null,20000,null,null,null,null)");
                    //mysqli_query($conexion,"delete from lectura_usuario where alumno_id='".$alumno."'");
                    $consulta = "SELECT id,alumno_id FROM lectura_usuario WHERE alumno_id = '".$_COOKIE['uid']."'"; 
                    $resultado = ConsultaBD($consulta,$conexion); 
                    $datos = mysqli_fetch_array( $resultado ); 
                    if( $datos ){
                      mysqli_query($conexion,"Update lectura_usuario Set libro_nombre='".$libros."',resumen='".$string."',fecha='".$date."', lectura='".$lectura."',palabras='".$caract."' where id='".$datos['id']."'");
                    }
                    else
                    {
                      $alumno = $_COOKIE['uid'];
                      $libros = $_POST['libros'];
                      $lectura = $_POST['numero'];
                      $caract = $_POST['caracteres'];
                      mysqli_query($conexion, "INSERT INTO lectura_usuario VALUES (null,".$alumno.",null, '".$libros."', '".$string."','".$date."','".$hour."','".$lectura."',null,null,".$caract.",null,null,null,null)");
                    }
                    if( $result){
                      $mensaje = 'Estimado alumno:
    El reporte de lectura del libro '.$libros.' para la '.$lectura.' entrega ha sido enviado correctamente a las '.$hour.' con fecha de envío '.$date.' ,y con un id = '.$identificador.' con estado: '.$estados.'. Favor de checar en el kardex.
                              
    En caso de alguna duda, acudir al Instituto de Ciencias Sociales y Humanidades, cubículo 7.';
                      // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
                      $mensaje = wordwrap($mensaje, 70, "\r\n");
                      //correo del alumno
                      $correo= $correo_E."@ndikandi.utm.mx";
                      //asunto
                      $asunto="Confirmación de envío";
                      $bool = mail($correo,$asunto, $mensaje, "FROM: Programa de Lecturas");  
                      if($bool){
                         echo '<script type="text/javascript">
                                alert("Se ha enviado tu reporte de lectura al administrador y se te ha enviado un correo de notificacion.");
                                location.href="redactar.php";
                                </script>';
                      }
                      else
                          echo"<script languaje='javascript'>alert('no entro')</script>";
                    }
                    else
                      echo"<script languaje='javascript'>alert('Error al enviar su reporte, intentalo de nuevo.')</script>";
                  }
                
                else{
                  //Mostrar mensaje de error cuando se los campos estan vacios
                  echo '<script type="text/javascript">
                    alert("La reseña debe estar escrita entre 7500 y 10844 caracteres.");
                    location.href = "redactar.php";
                    </script>'; 
                }
              }
              mysqli_close($conexion);
            ?>
    <script>!window.jQuery && document.write(unescape('%3Cscript src="css/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
	<script type="text/javascript" src="css/demo.js"></script>
    </section>
	</div>
 <footer></footer>
  </body>
</html>    
