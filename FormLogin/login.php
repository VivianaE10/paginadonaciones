<?php
require_once '../database/MySQLi/Conexion.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function redirectWelcome()
{
  header("Location: ../Botones/index.php");
  exit();
}

function cleanInput($input)
{
  $input = trim($input);
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  return $input;
}

$conexion = CreateConnection();
if (!$conexion) {
  echo "Error en la conexión. Inténtalo más tarde.";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario  = cleanInput($_POST['emailUser'] ?? '');
  $password = $_POST['passwordUser'] ?? '';

  if (empty($usuario) || empty($password)) {
    echo "Todos los campos son obligatorios";
    exit();
  }

  $sql = "SELECT usuarioID, passwordUser, salt FROM Usuarios WHERE EmailUsuario = ?";
  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $resultado = $stmt->get_result();

  if ($resultado->num_rows === 1) {
    $fila = $resultado->fetch_assoc();
    $hashBase = $fila['passwordUser'];
    $saltBase = $fila['salt'];

    $hash_inlogin = hash('sha256', $password . $saltBase);

    if ($hash_inlogin === $hashBase) {
      $_SESSION['emailUser'] = $usuario;
      $_SESSION['usuarioID'] = $fila['usuarioID'];
      redirectWelcome(); // No echo antes de esto
    } else {
      $_SESSION['error'] = "Usuario o contraseña incorrectos";
      header("Location: index.php");
      exit();
    }
  } else {
    $_SESSION['error'] = "El correo no está registrado";
    header("Location: index.php");
    exit();
  }
}
