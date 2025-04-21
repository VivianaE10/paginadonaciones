<?php

require_once '../database/MySQLi/Conexion.php';

//funcion de php para capturar errores
session_start();

function redirectWelcome()
{
  header("location: ../Botones/index.php");
  exit();
}

function cleanInput($input)
{
  $input = trim($input); // Elimina espacios en blanco al inicio y final
  // Codifica caracteres especiales HTML para prevenir XSS si se imprime directamente en HTML
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  return $input;
}

$conexion = CreateConnection();

if ($conexion->connect_error) {
  error_log("Error de conexión de la base de datos: " . $conexion->connect_error);
  echo ("Error en la conexión. intentalo más tarde");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $usuario  = cleanInput($_POST['emailUser'] ?? '');
  $password = ($_POST['passwordUser'] ?? '');

  //validación de campos vacíos
  if (empty($usuario) || empty($password)) {
    echo ("Todos los campos son obligatorios");
  }

  //Buscar el correo existente
  $sql = "select usuarioID, passwordUser, salt from Usuarios where EmailUsuario = ?";

  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    $hashBase = $fila['passwordUser'];
    $saltBase = $fila['salt'];

    //Hashear la contraseña ingresada con el salt guarado
    $password_plus_salt_login = $password . $saltBase;
    $hash_inlogin = hash('sha256', $password_plus_salt_login);

    if ($hash_inlogin === $hashBase) {
      session_start();
      $_SESSION['emailUser'] = $usuario;
      $_SESSION['usuarioID'] = $fila['usuarioID'];  // Guarda el ID del usuario logueado
      echo ("Login exitoso");
      redirectWelcome();
    } else {
      $_SESSION['error'] = "Usuario o Contraseña incorrectos";
      header("Location: index.php");
      //echo (" " . " Contraseña incorrecta");
    }
  } else {
    $_SESSION['error'] = "el correo no esta registardo";
    header("Location: index.php");
    //echo (" " . " el correo no esta registardo");
  }
  // echo "<pre>";
  // var_dump($usuario);
  // var_dump($password);
  // var_dump($hashBase);
  // var_dump($saltBase);
  // var_dump($hash_inlogin);
  // var_dump($hash_inlogin === $hashBase);
  // echo "</pre>";
}
