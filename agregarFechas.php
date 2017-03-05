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
		<div id="titulo"><p>Fechas de entrega</p></div>	
        </section>
		<div id="linea-hrztl"><hr></div>
        <section class="contenido">
      <div class="unacolumna">	
        <label>Año:</label>
        <select name="anioActual" style="width:130px; height:30px; margin-right:40px;">
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
            <option>2020</option>
        </select>
        <label>Periodo:</label>
        <select name="periodoActual" style="width:130px; height:30px; margin-right:40px;">
            <option>A</option>
            <option>B</option>
        </select><br><br>
        <table class="prolect1">
            <tbody>
            <tr>
                <th>SEMESTRE</th>
                <th>CARRERAS</th>
                <th>1° ENTREGA</th>
                <th>2° ENTREGA</th>
                <th>3° ENTREGA</th>
            </tr>
        <?php
            $band = false;
            $este ='0';
            $carrera=[];
            $fechaE = [];
            $fecha =  array(3);
            $semestre = [];
            $k = 0;
            $concatenaCarr = "";
            //Buscar todas las carreras
            $consulta = "SELECT id,id1,id2,id3,id4,id5,id6,id7,id8,id9,id10 FROM grupo_lectura"; 
            $resultado = ConsultaBD($consulta,$conexion);
            while ($datos=mysqli_fetch_assoc($resultado))    
            {
                if( $datos['id'] == 5 || $datos['id'] == 6 || $datos['id'] == 7){
                    $carrera[$datos['id']]="Todas las carreras";
                }
                else{
                    for ($i = 1; $i <= 10; $i++) {
                        $iden = "id".$i;
                        if($datos[$iden]!=NULL){
                            $busquedaCarrera = "SELECT id,sobreN FROM carrera where id=".$datos[$iden]; 
                            $resCarrera = ConsultaBD($busquedaCarrera,$conexion);
                            $datosCarrera=mysqli_fetch_array($resCarrera);
                            if( $concatenaCarr == "")
                                $concatenaCarr = $datosCarrera['sobreN'];
                            else
                                $concatenaCarr = $concatenaCarr.", ".$datosCarrera['sobreN'];
                        }
                    }
                    $carrera[$datos['id']]=$concatenaCarr;
                    $concatenaCarr="";
                }
            }
            $consulta = "SELECT semestre,Primera,Segunda,Tercera FROM fecha"; 
            $resultado = ConsultaBD($consulta,$conexion);
            while ($datos=mysqli_fetch_assoc($resultado))    
            {
                $fechaE[$k][0]=$datos['Primera'];
                $fechaE[$k][1]=$datos['Segunda'];
                $fechaE[$k][2]=$datos['Tercera'];
                $semestre[$k] = $datos['semestre'];
                $k= $k +1;
            }
            ?>
            <form method="POST" action="agregarFechas.php" >
            <tr><td><select name="uno" selected="2" style="width:40px; height:30px; margin-right:40px;">
                <option>1</option>
                <option>2</option>
            </select>
            </td><td><?php echo $carrera[1]; ?>
            </td><td><input type="text" name="Primera1" placeholder="aaaa-mm-dd" size="10"/> 
            </td><td><input type="text" name="Segunda1" placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Tercera1"  placeholder="aaaa-mm-dd" size="10"/>
            </td></tr>
            <tr><td><select name="dos" style="width:40px; height:30px; margin-right:40px;">
                <option>1</option>
                <option>2</option>
            </select>
            </td><td><?php echo $carrera[2]; ?>
            </td><td><input type="text" name="Primera2"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Segunda2"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Tercera2"  placeholder="aaaa-mm-dd" size="10"/>
            </td></tr>
            <tr><td><select name="tres" style="width:40px; height:30px; margin-right:40px;">
                <option>3</option>
                <option>4</option>
            </select>
            </td><td><?php echo $carrera[3]; ?>
            </td><td><input type="text" name="Primera3"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Segunda3"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Tercera3"  placeholder="aaaa-mm-dd" size="10"/>
            </td></tr>
            <tr><td><select name="cuatro" style="width:40px; height:30px; margin-right:40px;">
                <option>3</option>
                <option>4</option>
            </select>
            </td><td><?php echo $carrera[4]; ?>
            </td><td><input type="text" name="Primera4"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Segunda4"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Tercera4"  placeholder="aaaa-mm-dd" size="10"/>
            </td></tr>
            <tr><td><select name="cinco" style="width:40px; height:30px; margin-right:40px;">
                <option>5</option>
                <option>6</option>
            </select>
            </td><td><?php echo $carrera[5]; ?>
            </td><td><input type="text" name="Primera5"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Segunda5"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Tercera5"  placeholder="aaaa-mm-dd" size="10"/>
            </td></tr>
            <tr><td><select name="seis" style="width:40px; height:30px; margin-right:40px;">
                <option>7</option>
                <option>8</option>
            </select>
            </td><td><?php echo $carrera[6]; ?>
            </td><td><input type="text" name="Primera6"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Segunda6"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Tercera6"  placeholder="aaaa-mm-dd" size="10"/>
            </td></tr>
            <tr><td><select name="siete" style="width:40px; height:30px; margin-right:40px;">
                <option>9</option>
                <option>10</option>
            </select>
            </td><td><?php echo $carrera[7]; ?>
            </td><td><input type="text" name="Primera7"  placeholder="aaaa-mm-dd" size="10" />
            </td><td><input type="text" name="Segunda7"  placeholder="aaaa-mm-dd" size="10"/>
            </td><td><input type="text" name="Tercera7"  placeholder="aaaa-mm-dd" size="10"/>
            </td></tr>
              </tbody>
          </table>
            <div id="redactar-botones">
                <input id="redactar-guardar" type="submit" name="guardar" value="Guardar" class="guardar"><input id="redactar-enviar" type="submit" name="cancelar" value="Cancelar" class="guardar">  

            </div> 
        </form> 
        <?php 
            if (isset($_POST['guardar'])) {
                echo " Primera".$_POST['uno'];
                mysqli_query($conexion, "UPDATE fecha SET Primera = '".$_POST['Primera1']."',Segunda = '".$_POST['Segunda1']."', Tercera= '".$_POST['Tercera1']."', semestre=".$_POST['uno']." where gc_id=1");
                mysqli_query($conexion, "UPDATE fecha SET Primera = '".$_POST['Primera2']."',Segunda = '".$_POST['Segunda2']."', Tercera= '".$_POST['Tercera2']."', semestre=".$_POST['dos']." where gc_id=2");
                mysqli_query($conexion, "UPDATE fecha SET Primera = '".$_POST['Primera3']."',Segunda = '".$_POST['Segunda3']."', Tercera= '".$_POST['Tercera3']."', semestre=".$_POST['tres']." where gc_id=3");
                mysqli_query($conexion, "UPDATE fecha SET Primera = '".$_POST['Primera4']."',Segunda = '".$_POST['Segunda4']."', Tercera= '".$_POST['Tercera4']."', semestre=".$_POST['cuatro']." where gc_id=4");
                mysqli_query($conexion, "UPDATE fecha SET Primera = '".$_POST['Primera5']."',Segunda = '".$_POST['Segunda5']."', Tercera= '".$_POST['Tercera5']."', semestre=".$_POST['cinco']." where gc_id=5");
                mysqli_query($conexion, "UPDATE fecha SET Primera = '".$_POST['Primera6']."',Segunda = '".$_POST['Segunda6']."', Tercera= '".$_POST['Tercera6']."', semestre=".$_POST['seis']." where gc_id=6");
                mysqli_query($conexion, "UPDATE fecha SET Primera = '".$_POST['Primera7']."',Segunda = '".$_POST['Segunda7']."', Tercera= '".$_POST['Tercera7']."', semestre=".$_POST['siete']." where gc_id=7");
                ?>
                <script type="text/javascript"> 
                    alert("Las fechas de entrega para este periodo han sido guardadas correctamente.");
                    location.href = "administrador.php"; 
                </script>
                <?php

            }
            if (isset($_POST['cancelar'])){
            ?>
            <script type="text/javascript"> 
                if (confirmar) 
                    // si pulsamos en aceptar
                    window.location.href = 'agregarFechas.php';  
            </script>
            <?php
            }
        ?>
        </div>
    </section>
	</div>
 <footer></footer>s
  </body>
</html>   