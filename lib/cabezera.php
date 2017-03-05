    <head>
		<style></style>
		<meta charset="utf-8">
		<title>Programa de lecturas</title>
		<link rel="stylesheet" type="text/css" href="css/layout.css">
		<link rel="stylesheet" href="css/menu.css">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="css/script.js"></script>
	</head>
	<body>
		<div id="barrasuperior">
		</div>
		<div id="cabecera">
		<img id="logo-prolect" src="img/logo-prolect.png" />
				<div id="menucontainer">
					<div id='cssmenu'>
					<ul>
							<li class='active'><a href="alumno.php">Inicio</a></li>
							<li><a href="redactar.php">Redactar</a></li>
							<li><a href="biblioteca.php">Biblioteca virtual</a></li>
							<li><a href="kardex.php">Kardex</a></li>
							<li><a href="cerrarSesion.php">Cerrar sesión</a></li>
					</ul>
					</div>
				</div>
		</div>
     <?php
        
        require_once('lib/config.php');
        //Validar que el usuario este logueado y exista un UID
        if ( ! ($_COOKIE['autenticado'] == 'SI' && isset($_COOKIE['uid'])) )
        {
            //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la
            //pantalla de login, enviando un codigo de error
            ?>
            <form name="formulario" method="post" action="index.php">
                <input type="hidden" name="msg_error" value="2">
            
            <script type="text/javascript">
                document.formulario.submit();
            </script>
                </form>
            <?php
        }
        include('lib/conexion.php'); // conecta con la base de datos 
        $conexion = Conectarse();    // Función que conecta con la base de datos
        mysqli_set_charset($conexion, "utf8");
        $consulta = "SELECT id,nombres,apellidoP,apellidoM FROM alumno WHERE id = '".$_COOKIE['uid']."'"; 
	    $resultado = ConsultaBD($consulta,$conexion); // Obtener los resultados de la consulta
	    $datos = mysqli_fetch_array( $resultado ); 
        $nombreUsuario = "";
        //Formar el nombre completo del usuario
        if( $datos )
            $nombreUsuario = $datos['nombres']." ".$datos['apellidoP']." ".$datos['apellidoM'];
      ?>
  </body>