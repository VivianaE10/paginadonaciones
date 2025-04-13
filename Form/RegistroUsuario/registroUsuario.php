<?php
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


  //Validación de campos vacíos
  if (empty($fullName) || empty($ageUser) || empty($emailUser) || empty($dateBirth) || empty($phoneUser) || empty($paswordUser)) {
    echo ("Todos los campos son obligatorios");
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

  echo "<pre>";
  var_dump($fullName);
  var_dump($ageUser);
  var_dump($emailUser);
  var_dump($dateBirth);
  var_dump($phoneUser);
  var_dump($hashed_password);
  var_dump($salt_hex);
  echo "</pre>";

  //prepapar la sentencia
  $stmt = $conexion->prepare($sql);

  if ($stmt === false) {
    error_log("Error al preparar la sentencia SQL: " . $conexion->error);
    echo "Error al preparar la consulta.";
    exit();
  }

  echo ($fullName . $ageUser . $emailUser . $dateBirth . $phoneUser . $hashed_password . $salt_hex);

  $stmt->bind_param("sisssss", $fullName, $ageUser, $emailUser, $dateBirth, $phoneUser, $hashed_password, $salt_hex);

  //Ejecutar la sentencia preparada
  if ($stmt->execute()) {
    echo ("Datos enviados correctamente");
    redirectLogin();
  } else if ($conexion->errno == 1062) { // 1062 es el código de error para entrada duplicada
    echo ("El correo electrónico ya está registrado.");
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
function cleanInput($input)
{
  $input = trim($input); // Elimina espacios en blanco al inicio y final
  // Codifica caracteres especiales HTML para prevenir XSS si se imprime directamente en HTML
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  return $input;
}
