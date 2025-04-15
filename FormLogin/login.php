<?php

require_once '../database/MySQLi/Conexion.php';

$conexion = CreateConnection();

function redirectWelcome()
{
  header("location: ../Botones/index.php");
  exit();
}

if ($conexion->connect_error) {
  error_log("Error de conexión de la base de datos: " . $conexion->connect_error);
  echo ("Error en la conexión. intentalo más tarde");
  exit();
} else {
  redirectWelcome();
}
