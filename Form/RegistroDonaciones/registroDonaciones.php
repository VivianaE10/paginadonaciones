<!-- se encarga de recibir los datos del formulario de donaciones y guardarlos en una base de datos MySQL. -->

<?php

require_once __DIR__ . '/../../constantes/db_config.php';
require_once __DIR__ . '/../../constantes/string_constantes.php';
require_once __DIR__ . '/../../database/MySQLi/Conexion.php';

session_start();
// Asegurarse que el usuario esté logueado
$usuarioID = $_SESSION['usuarioID'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexion = CreateConnection($dbCredentials);

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
  $holderName = cleanInput($_POST['holderName'] ?? '');

  $cardNumber = $_POST['cardNumber'];
  if (!preg_match('/^\d{15,16}$/', $cardNumber)) {
    die("El número de tarjeta debe tener entre 15 y 16 dígitos");
  }

  $expiryDate = cleanInput($_POST['expiryDate'] ?? '');

  $codeCVV = ($_POST['codeCVV'] ?? '');


  //Verifica que ningun campos vacío
  if (empty($donationAmount) || empty($holderName) || empty($cardNumber) || empty($expiryDate) || empty($codeCVV)) {
    echo ("Todos los campos son obligatorios");
    exit(); //exit(); para que no continúe intentando ejecutar la consulta cuando los datos están incompletos.
  }

  //preparar consulta en SQL 
  $sql = "INSERT INTO registro_donaciones (UsuarioID,CantidadDonar,NombreTitular, NumeroTarjeta, fechaVencimiento, CodigoCVV) VALUES(?,?,?,?,?,?)";

  // var_dump() y echo funcionan para probar, pero debería quitarlos cuando el codigo esté funcionando
  echo "<pre>";
  var_dump($donationAmount);
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

  echo ($donationAmount  . $holderName . $cardNumber . $expiryDate . $codeCVV);

  $stmt->bind_param("isssss", $usuarioID, $donationAmount, $holderName, $cardNumber, $expiryDate, $codeCVV);

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
  header("location: ../../Botones/index.php");
  exit();
}

function cleanInput($input)
{
  $input = trim($input); // Elimina espacios en blanco
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8'); // Protege contra XSS
  return $input;
}
// - Se recibe la información enviada por POST
// - Se limpian los campos para evitar XSS
// - Se valida que todos los campos estén completos
// - Se insertan los datos en la tabla `registro_donaciones`
// - Se muestra mensaje de éxito o error según el caso f