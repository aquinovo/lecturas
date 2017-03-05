<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Evaluación</title>
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
				<div id="titulo"><p>Evaluación</p></div>
		</section>
			<div id="linea-hrztl"><hr></div>
		<section class="contenido">
            
        <FORM ACTION="evaluacion.php" METHOD="POST">
            <div class="unacolumna">
                    <label>Número de lectura:</label>
                    <?php 
                        echo '<select style="width:90px; height:30px;margin-right:30px;" name = numero> ';
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
                        echo '<select style="width:90px; height:30px;margin-right:30px;" name = semestre > '; 
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
                        echo '<select style="width:90px; height:30px;" name = grupo> '; 
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
                        echo '  <div class="unacolumna"> <input type="submit" name="buscar" value="Buscar" class="guardar"/> </div>';
                    ?>
            </div>
                </FORM>
            <table align="center" width="80%" border=0><tr>
                <td>
                <?php 
                    if (isset($_POST['buscar'])) {
                        header('Location: paginacion.php?numero='.$_POST['numero'].'&semestre='.$_POST['semestre'].'&grupo='.$_POST['grupo'].'');  
                    }   
                   mysqli_close($conexion);
                ?>
                </td>
                </tr>
            </table>
            </section>
	</div>
 <footer></footer>
  </body>
</html>   