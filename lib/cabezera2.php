<head>
		<style> </style>
		<meta charset="utf-8">
		<title>Programa de lecturas</title>
		<link rel="stylesheet" type="text/css" href="css/layout.css">
		<link rel="stylesheet" href="css/menu.css">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="css/script.js"></script>
	</head>
	<body>
		
		<div id="cabecera">
		<img id="logo-prolect" src="img/logo-prolect.png" />
		
		<div id="menucontainer">	
		<div id='cssmenu'>
				<ul>
					<li class='active'><a href="administrador.php">Inicio</a>
					<li class='has-sub'><a href="#">Lecturas</a>
							<ul>
								<li><a href="altaLibro.php">Altas</a></li>
								<li><a href="bajaLibro.php">Bajas</a></li>
							</ul>
					</li>
					<li><a href="evaluacion.php">Evaluación</a>
					<li><a href="agregarFechas.php">Agregar Fechas</a>
					<li><a href="kardexAd.php">Kárdex</a></li>
					<li><a href="bibliotecaAd.php">Biblioteca virtual</a></li>
					<li class="has-sub"><a href="#" >Alumno</a>
					<ul>	
						<li>
							<a href="registro.php">Alta</a>
						</li>
						<li>
							<a href="bajaAlumno.php">Baja</a>
						</li>
						<li>
							<a href="modificaAlumno.php">Modificar</a>
						</li>
					</ul>
					<li><a href="cerrarSesion.php">Cerrar sesión</a></li>
				</ul>
		</div>
		</div>	
		</div>	
      <?php
        include('lib/config.php');
        //Validar que el usuario este logueado y exista un UID
        if ( ! ($_COOKIE['autenticado'] == 'SI' && isset($_COOKIE['uid'])) )
        {
            //En caso de que el usuario no este autenticado, crear un formulario y redireccionar a la
            //pantalla de login, enviando un codigo de error
            ?>
            <form name="formulario" method="post" action="index.php">
                <input type="hidden" name="msg_error" value="2">
            </form>
            <script type="text/javascript">
                document.formulario.submit();
            </script>
            <?php
        }
       include('lib/conexion.php'); // conecta con la base de datos 
        $conexion = Conectarse();    // Función que conecta con la base de datos
        mysqli_set_charset($conexion, "utf8");
        $consulta = "SELECT id,nombres,apellidoP,apellidoM FROM administrador WHERE id = '".$_COOKIE['uid']."'"; 
	    $resultado = mysqli_query($conexion,$consulta ) or die( mysql_error() ); 
	    $datos = mysqli_fetch_array( $resultado ); 
        $nombreUsuario = "";
        //Formar el nombre completo del usuario
        if( $datos )
            $nombreUsuario = $datos['nombres']." ".$datos['apellidoP']." ".$datos['apellidoM'];
      ?>
	</body>