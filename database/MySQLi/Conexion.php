<?php

function CreateConnection()
{
  // Datos de conexión a la base de datos
  $host = "yamanote.proxy.rlwy.net";
  $port = 31557;
  $usuario_db = "root"; // Cambia si es necesario
  $contrasena_db = "uoqkCVjLUzCPAFJLvDkZpdssluARhvXT"; //  Cambia si es necesario
  $nombre_db = "donaciones"; // Cambia sies necesario

  // Desactivar reporte de errores de mysqli para manejarlo manualmente
  mysqli_report(MYSQLI_REPORT_OFF);

  // Intentar conexión
  $conexion = new mysqli($host, $usuario_db, $contrasena_db, $nombre_db, $port);

  // Verificar errores de conexión explícitamente
  if ($conexion->connect_error) {
    error_log("Error de conexión a la base de datos: (" . $conexion->connect_error . ") " . $conexion->connect_error);
    return false; // Devolver false en caso de error
  }

  // Establecer charset (recomendado)
  if (!$conexion->set_charset("utf8mb4")) {
    error_log("Error al establecer el charset UTF-8: " . $conexion->error);
    // No es crítico, pero bueno saberlo
  } else {
    echo ("conexion extitosa");
  }
  return $conexion;
}

//-> la flecha significa poo
// hay dos formas de conectarnos una es con programacion orientada a objetos y la otra la procedural
//Forma Procedural
// $mysqli = mysqli_connect($sever, $username, $password, $database);
//forma de comprobar conexion procedural 
// if(!$mysqli) 
// die("fallo la conexion" . mysqli_connect_error())
