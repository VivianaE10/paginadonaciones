<!-- se encarga de recibir los datos del formulario de donaciones y guardarlos en una base de datos MySQL. -->

<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexion = CreateConnection();

if ($conexion->connect_error) {

  error_log("Error de conexión de la base de datos: " . $conexion->connect_error);
  echo ("Error en la conexión. intentalo más tarde");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //capturando los datos
  //Obtener los datos enviados desde el formulario de registroUsuario
  //Usamos  null coalescing operator (??) para evitar warnings si no existen
  $donationAmount  = cleanInput($_POST['donationAmount'] ?? '');
  $dateDonation = cleanInput($_POST['dateDonation'] ?? '');
  $holderName = cleanInput($_POST['holderName'] ?? '');
  $cardNumber = cleanInput($_POST['cardNumber'] ?? '');
  $expiryDate = cleanInput($_POST['expiryDate'] ?? '');
  $codeCVV= ($_POST['codeCVV'] ?? '');


  //Verifica que ningun campos vacío
  if (empty($donationAmount) || empty($dateDonation) || empty($holderName) || empty($cardNumber) || empty($expiryDate) || empty($codeCVV)) {
    echo ("Todos los campos son obligatorios");
    exit();//exit(); para que no continúe intentando ejecutar la consulta cuando los datos están incompletos.
  }

  //preparar consulta en SQL 
  $sql = "INSERT INTO registro_donaciones (CantidadDonar, fechaDonacion, NombreTitular, NumeroTarjeta, fechaVencimiento, CodigoCVV) VALUES(?,?,?,?,?,?)";

  // var_dump() y echo funcionan para probar, pero debería quitarlos cuando el codigo esté funcionando
  echo "<pre>";
  var_dump($donationAmount);
  var_dump($dateDonation);
  var_dump($holderName);
  var_dump($cardNumber);
  var_dump($expiryDate);
  var_dump($codeCVV);
  echo "</pre>";

  //prepapar la sentencia
  $stmt = $conexion->prepare($sql);

  if ($stmt === false) {
    error_log("Error al preparar la sentencia SQL: " . $conexion->error);
    echo "Error al preparar la consulta.";
    exit();
  }

  echo ($donationAmount . $dateDonation . $holderName . $cardNumber . $expiryDate . $codeCVV);

  $stmt->bind_param("ssssss", $donationAmount, $dateDonation, $holderName, $cardNumber, $expiryDate, $codeCVV);

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

// - Se recibe la información enviada por POST
// - Se limpian los campos para evitar XSS
// - Se valida que todos los campos estén completos
// - Se insertan los datos en la tabla `registro_donaciones`
// - Se muestra mensaje de éxito o error según el caso