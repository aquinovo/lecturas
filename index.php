<!DOCTYPE html>
<html lang="en">
  <head>
   <style></style>
   <meta charset="utf-8">
   <title>Programa de lecturas</title>
   <link rel="stylesheet" type="text/css" href="css/layout.css">
   <link rel="stylesheet" type="text/css" href="css/diseno.css">
	<!--Importar scripts de javascript -->
	<script src="js/jquery171.js" type="text/javascript"></script> 
	<script src="js/jquery.validate.js" type="text/javascript"></script>
	<script src="js/jquery.alerts.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
			$(document).ready(function() {
					$("#frmlogin").validate();
					$("#usuario").focus();
			});
	</script>
  </head>
  
  <body>
  <div id="cabecera-login">
  <div id="logo_utm"></div>
  <div id="titulo-index"><p>ProLec</p></div>
  <div id="version-index">versión 3.0</div>
  </div>
	<div id="content_login">
	
		<div id="logo_login"></div>
		
		<form  name="frmlogin"  method="POST" action="validarUsuario.php">
			<div class="usuario-login">
				<div id="logo-user"></div>
				<input TYPE="text" NAME="usuario" id="usuario" class="myinput2" placeholder="Usuario" ></input>
			</div>
			<div class="password-login">
				<div id="logo-password"></div>
				<input TYPE="password" NAME="password" id="password" class="myinput2"  placeholder="Contraseña" ></input>
			</div>
			
			<div class="boton-login">
				<input TYPE="submit" name="enviar" VALUE="Entrar" class="myinput" id="input-button"></input>
			</div>
			
		</form> 
	</div>
	<div id='main'>
    <?php
      if( isset( $_POST['msg_error'] ) )
      {
          switch( $_POST['msg_error'] )
          {
              case 1:
                ?>
                    <script type="text/javascript">
                        jAlert("El usuario o password son incorrectos.", "Seguridad");
                        $("#password").focus();
                    </script>
                <?php
                break;         
              case 2:
                ?>
                    <script type="text/javascript">
                        jAlert("La seccion a la que intentaste entrar esta restringida.\n Solo permitida para usuarios registrados.", "Seguridad");
                    </script>
                <?php       
                break;
          }       //Fin switch
      }
    ?>
    </div>
	
    </body>
</html>