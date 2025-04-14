<?php


require_once '../Form/RegistroUsuario/registroUsuario.php';
function redirectWelcome()
{
  header("location: ../Botones/index.php");
  exit();
}

if ($conexion->connect_error) {
  echo ('Error de conexion');
} else {
  redirectWelcome();
}
