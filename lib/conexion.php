<?php
/*
Archivo para la conexión de la base de datos
*/
    function Conectarse() //función que sirve para hacer la conexión con la base de datos de MySQL
    {
        $dominio = "localhost";
        $usuario = "root";
        $contrasena ="";
        $nDB = "bd";
        $conexion = mysqli_connect($dominio, $usuario , $contrasena,$nDB );


        if (!$conexion) {
          echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
          echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
          echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
          exit;
        }
        return $conexion;
    }
    // Función para realizar la consulta con la base de datos 
    function ConsultaBD($consulta,$con){ 
        $resultado = mysqli_query($con,$consulta ) or die( mysql_error() ); 
        return $resultado;
    }
?> 
