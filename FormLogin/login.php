<?php

require_once __DIR__ . '/../constantes/db_config.php';
require_once __DIR__ . '/../constantes/string_constantes.php';
require_once __DIR__ . '/../database/MySQLi/Conexion.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function cleanInput($input)
{
  return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function RedirectWelcome()
{

  header("Location: ../Botones/index.php");
}

$conexion = CreateConnection($dbCredentials);
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

  $sql = "SELECT usuarioID, EmailUsuario, passwordUser, salt, rol_id FROM Usuarios WHERE EmailUsuario = ?";
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
      $usuarioID = $fila['usuarioID'];
      $rol_id    = $fila['rol_id'];

      // 🔐 Crear token JWT
      $clave_secreta = "clave_super_segura";
      $payload = [
        "usuarioID" => $usuarioID,
        "emailUser" => $usuario,
        "rol_id"    => $rol_id,
        "exp"       => time() + 3600  // 1 hora
      ];

      $token = JWT::encode($payload, $clave_secreta, 'HS256');

      // 🍪 Guardar el token en una cookie
      setcookie("auth_token", $token, time() + 3600, "/", "", false, true);


      // Redireccionar según rol
      switch ($rol_id) {
        case 1:
          RedirectWelcome();
          break;
        case 2:
          RedirectWelcome();
          break;
        case 3:
          RedirectWelcome();
          break;
        default:
          header("");
          break;
      }
      exit();
    } else {
      echo "Usuario o contraseña incorrectos.";
      exit();
    }
  } else {
    echo "El correo no está registrado.";
    exit();
  }
}
