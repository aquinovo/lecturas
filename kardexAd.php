<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta content="text/html/csv" charset="utf-8">
   <title>Kardex</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
    <style>
        td{
            text-align: left;
        }
    </style>
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
		<div id="titulo"><p>Kárdex</p></div>	
		
		
        </section>
		<div id="linea-hrztl"><hr></div>
		
		<section class="contenido">
        <!-- Contenido inicial del sitio web -->
        <div class="unacolumna">
         <FORM ACTION="kardexAd.php" METHOD="POST">  
            <label>Número de lectura:</label>
            <?php 
                echo '<select style="width:90px; height:30px; margin-right:30px;" name = numero> ';  
                if($_POST['numero']=="Primera")
                {
                    echo '<option selected="selected">Primera</option>';
                    echo '<option >Segunda</option>';
                    echo '<option >Tercera</option>';   
                }  
                elseif($_POST['numero']=="Segunda")
                {
                    echo '<option >Primera</option>';
                    echo '<option selected="selected">Segunda</option>';
                    echo '<option >Tercera</option>';   
                } 
                elseif($_POST['numero']=="Tercera")
                {
                    echo '<option >Primera</option>';
                    echo '<option >Segunda</option>';
                    echo '<option selected="selected">Tercera</option>';   
                } 
                else
                {
                    echo '<option >Primera</option>';
                    echo '<option >Segunda</option>';
                    echo '<option >Tercera</option>';
                }  
                echo '</select>';
            ?>
            <label>Semestre:</label>
            <?php
                echo '<select style="width:90px; height:30px; margin-right:30px;" name = semestre > '; 
                for ($i = 1; $i <= 10; $i++) {
                    if($_POST['semestre']==$i){
                        echo '<option selected="selected">'.$i.'</option>';
                    }
                    else
                        echo '<option>'.$i.'</option>';
                }
                echo '</select>';
            ?>
         <label>Grupo:</label>
            <?php 
                $consulta = "SELECT codigo FROM grupo";
                $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() );
                echo '<select style="width:90px; height:30px;margin-right:30px;" name = grupo> '; 
                while ($datos=mysqli_fetch_assoc($resultado))    
                {
                    if($_POST['grupo']==$datos["codigo"])
                        echo '<option selected="selected">'.$datos["codigo"].'</option>';
                    else
                        echo '<option >'.$datos["codigo"].'</option>';
                } 
                echo '</select>';
            ?>
            <br><br>
            <?php 
                echo '  <div class="unacolumna"> <input type="submit" name="buscar" value="Buscar" class="guardar"/></div>';
            ?>
            </div>
             </FORM>
			<div class="unacolumna">
                <?php 
                require_once 'excel/PHPExcel/PHPExcel.php';
                // Creamos nueva instancia de PHPExcel
                $objPHPExcel = new PHPExcel();
                // Seleccionando la fuente a utilizar
                $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
                $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
                
                $objPHPExcel2 = new PHPExcel();
                // Seleccionando la fuente a utilizar
                $objPHPExcel2->getDefaultStyle()->getFont()->setName('Arial');
                $objPHPExcel2->getDefaultStyle()->getFont()->setSize(10);
                    if (isset($_POST['buscar'])) {
                        $alum ="SELECT id,apellidoP,apellidoM,nombres,correoE,carrera_nombre from alumno WHERE semestre=".$_POST['semestre']." and grupo_nombre='".$_POST['grupo']."' order BY apellidoP";
                        $res = mysqli_query($conexion,$alum ) or die( mysql_error() );
                        if($da=mysqli_fetch_array($res)){
                ?>
                <p align="right"><a href="documentos/reporteLectura.xlsx" target="_blank">Entregado y No entregado</a> 
                /
                <a href="documentos/reporteLectura2.xlsx" target="_blank">Aceptado y Rechazado</a></p>
                <br>
                <table class="prolect1">
                    <caption><?php echo $da['carrera_nombre'];?></caption>
                    <caption><?php echo "".$_POST['numero']." lectura, ".$_POST['semestre']." semestre, ".$_POST['grupo'];?></caption>
                        <tbody>
                            <tr>
                                <th>NÚMERO</th>
                                <th>MATRÍCULA</th>
                                <th>NOMBRE</th>
                                <th>ESTADO</th>
                                <th>EVALUACIÓN</th>
                                <th>ID</th>
                            </tr>
                            <?php
                            // Escribiendo los datos del reporte de entrega
                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
                            $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue('A1',$da['carrera_nombre'].$_POST['grupo']." , ".$_POST['numero']." lectura")
                                        ->setCellValue('A2', 'NÚMERO')
                                        ->setCellValue('B2', 'MATRÍCULA')
                                        ->setCellValue('C2', 'NOMBRE')
                                        ->setCellValue('D2', 'REPORTE');
                            $objPHPExcel->getActiveSheet()->getStyle("A1:D1")->getFont()->setBold(true)->setSize(20);
                            $objPHPExcel->getActiveSheet()->getStyle("A2:D2")->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
                            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                            
                            // Escribiendo los datos del reporte de aceptado o rechazado
                            $objPHPExcel2->setActiveSheetIndex(0)->mergeCells('A1:D1');
                            $objPHPExcel2->setActiveSheetIndex(0)
                                        ->setCellValue('A1', $da['carrera_nombre'].$_POST['grupo']." , ".$_POST['numero']." lectura")
                                        ->setCellValue('A2', 'NÚMERO')
                                        ->setCellValue('B2', 'MATRÍCULA')
                                        ->setCellValue('C2', 'NOMBRE')
                                        ->setCellValue('D2', 'EVALUACIÓN');
                            $objPHPExcel2->getActiveSheet()->getStyle("A1:D1")->getFont()->setBold(true)->setSize(20);
                            $objPHPExcel2->getActiveSheet()->getStyle("A2:D2")->getFont()->setBold(true);
                            $objPHPExcel2->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                            $objPHPExcel2->getActiveSheet()->getColumnDimension('C')->setWidth(40);
                            $objPHPExcel2->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                           $alum ="SELECT id,apellidoP,apellidoM,nombres,correoE,carrera_nombre,matricula from alumno WHERE semestre=".$_POST['semestre']." and grupo_nombre='".$_POST['grupo']."' order BY apellidoP";
                            $res = mysqli_query($conexion,$alum ) or die( mysql_error() ); 
                            $i = 1; 
                            $c = 3;
                            while ($da=mysqli_fetch_array($res)){
                                echo '<tr>';
                                echo "<td>".$i."</td>";
                                echo "<td>".$da['matricula']."</td>";
                                echo "<td>".$da['apellidoP']." ".$da['apellidoM']." ".$da['nombres']."</td>";
                                $consulta = "SELECT revision_usuario.id as uis,alumno_id,administrador_id,recibir,estado,codigo,administrador.id,nombres,apellidoP,apellidoM FROM revision_usuario LEFT JOIN administrador ON revision_usuario.administrador_id = administrador.id WHERE lectura = '".$_POST['numero']."' and alumno_id=".$da['id']."";
                                $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() );
                                $nombre_C = $da['apellidoP']." ".$da['apellidoM']." ".$da['nombres'];
	                            if ($datos=mysqli_fetch_array($resultado)){
                                   echo "<td>".$datos['recibir']."</td>";
                                   echo "<td>".$datos['estado']."</td>";
                                   echo "<td>".$datos['codigo']."</td>";
                                   $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue('A'.$c, $i)
                                        ->setCellValue('B'.$c, $da['matricula'])
                                        ->setCellValue('C'.$c, $nombre_C)
                                        ->setCellValue('D'.$c, "ENTREGADO");
                                    
                                    $objPHPExcel2->setActiveSheetIndex(0)
                                        ->setCellValue('A'.$c, $i)
                                        ->setCellValue('B'.$c, $da['matricula'])
                                        ->setCellValue('C'.$c, $nombre_C)
                                        ->setCellValue('D'.$c, $datos['estado']);
                                }
                                else{
                                   echo "<td>NO ENTREGADO</td>";
                                   echo "<td>RECHAZADO</td>";
                                   echo "<td>".$datos['codigo']."</td>";
                                   $objPHPExcel->setActiveSheetIndex(0)
                                        ->setCellValue('A'.$c, $i)
                                        ->setCellValue('B'.$c, $da['matricula'])
                                        ->setCellValue('C'.$c, $nombre_C)
                                        ->setCellValue('D'.$c, "NO ENTREGÓ");
                                    
                                    $objPHPExcel2->setActiveSheetIndex(0)
                                        ->setCellValue('A'.$c, $i)
                                        ->setCellValue('B'.$c, $da['matricula'])
                                        ->setCellValue('C'.$c, $nombre_C)
                                        ->setCellValue('D'.$c, "RECHAZADO");
                                }
                                echo '</tr>';
                                $i = $i +1;
                                $c = $c +1;
                            }
                            ?>
                            <?php
                                mysqli_close($conexion);
                        }
                        else
                            echo'<h2><center>No hay datos para mostrar</h2>';
                    }   
                    // Nombramos la hoja
                    $objPHPExcel->getActiveSheet()->setTitle('ReporteLectura');
                    // Activamos para que al abrir el excel nos muestre la primer hoja
                    $objPHPExcel->setActiveSheetIndex(0);
                    // Guardamos el archivo, en este caso lo guarda con el mismo nombre del php
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    $objWriter->save('documentos/reporteLectura.xlsx');
                
                     // Nombramos la hoja
                    $objPHPExcel2->getActiveSheet()->setTitle('ReporteLectura');
                    // Activamos para que al abrir el excel nos muestre la primer hoja
                    $objPHPExcel2->setActiveSheetIndex(0);
                    // Guardamos el archivo, en este caso lo guarda con el mismo nombre del php
                    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel2, 'Excel2007');
                    $objWriter->save('documentos/reporteLectura2.xlsx');
                ?>
            </tbody>
        </table>            
     </div>
  </section> 
  </div>
 <footer></footer>
  </body>
</html>   