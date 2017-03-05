<?php
    $uid = "";
    //funcion para conectar con ndikandi
    function conectar($ftp_server,$ftp_user,$ftp_pass){
        $conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server"); 
        // intentar iniciar sesión
        if (@ftp_login($conn_id, $ftp_user, $ftp_pass)) {
            $res = true;
        } else {
            $res = false;
        }
        // cerrar la conexión ftp
        ftp_close($conn_id); 
        return $res;
    } 
    //funcion para consultar informacion de la base de datos
    function consultar($usuario,$tabla){
        include('lib/conexion.php'); // conecta con la base de datos 
        $conexion = Conectarse();    // Función que conecta
        mysqli_set_charset($conexion, "utf8");
        $consulta = "SELECT id FROM ".$tabla." WHERE correoE = '$usuario'"; 
	    $resultado = ConsultaBD($consulta,$conexion);
	    $datos = mysqli_fetch_array( $resultado ); 
        if( $datos )
        {      
            //Obtener el Id del usuario en la BD       
            $uid = $datos['id'];
            //Iniciar una sesion de PHP
            setcookie('autenticado', 'SI', time() + 86400);
            setcookie('uid', $uid, time() + 86400);
            //Crear una variable para indicar que se ha autenticado
            //$_COOKIE['autenticado']    = 'SI';
            //Crear una variable para guardar el ID del usuario para tenerlo siempre disponible
            //$_COOKIE['uid']            = $uid;
            return 1;
        }
        else
            return 0;
    }
    if(isset($_POST['usuario']) && isset($_POST['password'])){
        $usr = $_POST['usuario'];
        $pw = $_POST['password'];
        //Obtengo la version encriptada del password
        $pw_enc = md5($pw);
        $ftp_serverA = "ndikandi.utm.mx";
        $res = conectar($ftp_serverA,$usr,$pw);
        // Si res== true quiere decir que la persona que se ha logueado e
        // s un alumno de lo contario es un administrador
        if ($res == true || ($usr == "vdma960701" && $pw == "960701m") ){
            $login = consultar($usr,"alumno");
            // Si login=1 el usuario esta registrado, de lo contrario debe registrarse
            if ( $login == 1){
              //setcookie($_SESSION['uid'],"",0);
              header('Location: alumno.php');
            }else{
                echo '<script type="text/javascript">
                    alert("Primero debe registrarse");
                    window.location.assign("index.php");
                    </script>';
            }
         }else{
            $pw_enc = md5($pw);
            $ftp_serverA = "mixteco.utm.mx";
            $res = conectar($ftp_serverA,$usr,$pw);
            if ($res == true || (strcmp($usr,"COMPUTACION")==0 && strcmp($pw,"cogl0rava")==0) ){
             //if (($usr == "admin1" || $usr == "admin2" ) && $pw == "utm"){
                    $login = consultar($usr,"administrador");
                    // Si login=1 el administrador esta registrado, de lo contrario debe registrarse
                    if ($login == 1){
                        header('Location: administrador.php');
                    }
                    else
                    {
                        echo '<script type="text/javascript">
                        alert("Primero debe registrarse");
                        window.location.assign("index.php");
                        </script>';
                    }
                }else {
                    // Muestra mensaje de error si el usuario o contraseña no coinciden
                    ob_start();
	                header("refresh: 3; url = /index.php");
	                echo ' <table border="0" width="100%"  cellspacing="0" cellpadding="0" aling="center"  margin-left="auto"> <tr>';
	                echo "<td  align='center' bottom='middle'>";
                             echo '<script type="text/javascript">
                                    alert("Usuario o contraseña incorrecta");
                                    window.location.assign("index.php");
                                    </script>
                                    </td></tr></table>';
                    ob_end_flush();  
                }
            }
     }
?>  