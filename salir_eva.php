 <?php     
           $date = date("Y-m-d"); // Obtiene fecha actual
           $hour = date("H:i:s"); // Obtiene hora actual
           include('lib/cabezera2.php');
           mysqli_set_charset($conexion, "utf8"); 
           $consulta = "SELECT revision_usuario.id as uis,alumno_id,libro_nombre,resumen,fecha,revision,lectura,palabras,alumno.id,nombres,apellidoP,apellidoM,carrera_nombre,semestre,grupo_nombre,correoE,estado FROM revision_usuario LEFT JOIN alumno ON revision_usuario.alumno_id = alumno.id WHERE lectura = '".$_GET['numero']."' and semestre=".$_GET['semestre']." and grupo_nombre='".$_GET['grupo']."' and estado is null";
                   $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() );
                   while ($datos=mysqli_fetch_array($resultado)){
                        mysqli_query($conexion,"Update revision_usuario Set estado ='Aceptado', administrador_id=".$_COOKIE['uid']." where id='".$datos['uis']."'");
                        // Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
                       $mensaje = 'Estimado alumno:
El reporte de lectura ha sido evaluado correctamente a las '.$hour.' y fecha de envío '.$date.' ,favor de checar en el kardex.
En caso de alguna duda, acudir al Instituto de Ciencias Sociales y Humanidades, cubículo 7.';
                        $mensaje = wordwrap($mensaje, 70, "\r\n");
                        //correo del alumno
                        $correo= $correo_E."@ndikandi.utm.mx";
                        //asunto
                        $asunto="Reporte de Lecturas";
                        $bool = mail($correo,$asunto,$mensaje);
                    }
                    echo '<script type="text/javascript">
                            window.location.assign("evaluacion.php");
                          </script>';
            mysqli_close($conexion);
?>
