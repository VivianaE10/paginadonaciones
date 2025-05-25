<?php
require_once '../vendor/autoload.php';
require_once './Enums/general_message.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$clave_secreta = general_message::tokenkey->value;

// Leer la cookie
if (!isset($_COOKIE['auth_token'])) {
  header("Location: ../login/index.php");
  exit();
}

try {
  $decoded = JWT::decode($_COOKIE['auth_token'], new Key($clave_secreta, 'HS256'));

  // Si quieres limitar por rol
  if ($decoded->rol_id != 1) { // ejemplo: solo rol 1 puede ver esta página
    echo "No tienes permisos para acceder aquí.";
    exit();
  }

  // Acceso concedido. Puedes usar $decoded->usuarioID, etc.

} catch (Exception $e) {
  echo "Token inválido: " . $e->getMessage();
  exit();
}
