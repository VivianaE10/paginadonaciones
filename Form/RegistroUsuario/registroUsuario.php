<?php

require_once '../../database/MySQLi/Conexion.php';

//funcion de php para capturar errores
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexion = CreateConnection();

if ($conexion->connect_error) {

  error_log("Error de conexión de la base de datos: " . $conexion->connect_error);
  echo ("Error en la conexión. intentalo más tarde");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //Obtener los datos enviados desde el formulario de registroUsuario
  //Usamos  null coalescing operator (??) para evitar warnings si no existen
  $fullName  = cleanInput($_POST['fullName'] ?? '');
  $ageUser   = (int) cleanInput($_POST['ageUser'] ?? '');
  $emailUser = cleanInput($_POST['emailUser'] ?? '');
  $dateBirth = cleanInput($_POST['dateBirth'] ?? '');
  $phoneUser = cleanInput($_POST['phoneUser'] ?? '');
  $paswordUser = ($_POST['passwordUser'] ?? '');
  $repeatPasswordUser = ($_POST['repeatPasswordUser'] ?? '');


  //validar que las contraseñas sean iguales
  if ($paswordUser !== $repeatPasswordUser) {
    $_SESSION['error'] = "Las contraseñas no coinciden.";
    header("Location: registroUser.php");
    exit();
  }

  // 👇 Validar que la contraseña no contenga espacios
  if (preg_match('/\s/', $paswordUser)) {
    $_SESSION['error'] = "La contraseña no debe contener espacios.";
    header("Location: registroUser.php");
    exit();
  }

  //Validación de campos vacíos
  if (empty($fullName) || empty($ageUser) || empty($emailUser) || empty($dateBirth) || empty($phoneUser) || empty($paswordUser)) {
    $_SESSION['error'] = "Todos los campos son obligatorios";
    header("Location: registroUser.php");
    exit();
  }

  try {

    $salt_bytes = random_bytes(16);

    $salt_hex = bin2hex($salt_bytes);
  } catch (Exception $e) {
    error_log("Error al generar la salt segura: " . $e->getMessage());
  }

  // 2. Hashear la contraseña con SHA-256 y la Salt generada

  $password_plus_salt = $paswordUser . $salt_hex;
  $hashed_password = hash('sha256', $password_plus_salt); //Genera hash SHA-256

  if ($hashed_password === false) {
    error_log("Error al hashear la contraseña para el email: " . $emailUser);
  }

  //preparar consulta en SQL 
  $sql = "INSERT INTO Usuarios (NombreUsuario, EdadUsuario, EmailUsuario, FechaNacimientoUsuario, TelefonoUsuario, PasswordUser, salt) VALUES(?,?,?,?,?,?,?)";


  //prepapar la sentencia
  $stmt = $conexion->prepare($sql);

  if ($stmt === false) {
    error_log("Error al preparar la sentencia SQL: " . $conexion->error);
    echo "Error al preparar la consulta.";
    exit();
  }

  $stmt->bind_param("sisssss", $fullName, $ageUser, $emailUser, $dateBirth, $phoneUser, $hashed_password, $salt_hex);

  //Ejecutar la sentencia preparada
  if ($stmt->execute()) {
    echo ("Datos enviados correctamente");
    redirectLogin();
  } else if ($conexion->errno == 1062) { // 1062 es el código de error para entrada duplicada
    $_SESSION['error'] = "El correo electrónico ya está registrado.";
    header("Location: registroUser.php");
    exit();
    //echo ("El correo electrónico ya está registrado.");
  } else {
    error_log("Error al ejecutar la sentencia SQL: " . $stmt->error . " (Código: " . $conexion->errno . ")");
    echo ("Ocurrió un problema al intentar registrar el usuario (execute failed).");
  }

  $stmt->close();
}

function redirectLogin()
{
  header("location: ../../FormLogin/index.php");
  exit();
}

function cleanInput($input)
{
  $input = trim($input); // Elimina espacios en blanco al inicio y final
  // Codifica caracteres especiales HTML para prevenir XSS si se imprime directamente en HTML
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  return $input;
}
