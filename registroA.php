<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Programa de lecturas</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
</head>
  <body>
    <div id='main'>
        <aside>
            <table width=100% border=0><tr><td width="5%"></td><td width=40%></td>
                <td><p>Registro</p></td></tr></table>
            <hr>
            <!-- Contenido inicial del sitio web -->
            <br><br>
            <?php
                include('lib/conexion.php'); // conecta con la base de datos 
                $conexion = Conectarse();    // Función que conecta con la base de datos
                mysqli_set_charset($conexion, "utf8");
            ?>
			<FORM ACTION="registroA.php" METHOD="POST"> 
			     <table border="0" width="100%"  cellspacing="0" cellpadding="0" height="45">
			         <tr><td width=15%></td>
			         <td width=30% valign=TOP align=left> <a href="registro.php">Alumno</a> \ <a href="registroA.php">Administrador</a>
                         <br><br><br><br><strong><big>Registro</big></strong><br>
			         <br>Rellenar los campos para ingresar en la base de datos.</td>
			         <td width=10%></td>
			         <td width=45%> <br><br><br><br>
				        <LABEL>Nombres: </LABEL><br>
                         <input type="text" name="nombres" size=38%><br>
				        <LABEL>Apellido paterno: </LABEL><br>
                         <input type="text" name="apellidoP" size=38%><br>
                        <LABEL>Apellido materno: </LABEL><br>
                        <input type="text" name="apellidoM" size=38%><br>
                        <LABEL>Correo electrónico: </LABEL><br>
                        <input type="text" name="correoE" size=38% ><br>
                        <br><br>
                </td></tr>
                <tr><td width=15%></td>
			         <td width=30% valign=TOP align=left></td>
			         <td width=10%></td>
			         <td width=45%> 
                         <input type="submit" name="cancelar" value="Cancelar" onclick= "self.location.href = 'index.php'"/>                 
				        <input type="submit" name="guardar" value="Guardar" />
            </td></tr>
			</table></FORM>
            <?php
                if (isset($_POST['guardar'])){
                    if( !empty($_POST['nombres']) && !empty($_POST['apellidoP']) && !empty($_POST['apellidoM'])&& !empty($_POST['correoE'])){
                        $nombres = $_POST['nombres'];
                        $apellidoM = $_POST['apellidoM'];
                        $apellidoP = $_POST['apellidoP'];
                        $correoE = $_POST['correoE'];
                        $consulta = "SELECT *from administrador WHERE correoE = '".$correoE."'"; 
	                    $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() ); 
	                    $datos = mysqli_fetch_array( $resultado ); 
                        if( $datos ){
                           echo"<script languaje='javascript'>alert('El usuario ya esta existe, vuelva a intentarlo')</script>";
                        }
                        else{
                            mysqli_query($conexion, "INSERT INTO administrador VALUES (null,'".$nombres."', '".$apellidoP."', '".$apellidoM."', '".$correoE."')");
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