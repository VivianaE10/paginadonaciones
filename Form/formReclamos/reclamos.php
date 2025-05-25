<?php


// require_once __DIR__ . '/../../constantes/db_config.php';
// require_once __DIR__ . '/../../constantes/string_constantes.php';
// require_once __DIR__ . '/../../database/MySQLi/Conexion.php';


//funcion de php para capturar errores
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexion = CreateConnection($dbCredentials);


if ($conexion->connect_error) {

  error_log("Error de conexión de la base de datos: " . $conexion->connect_error);
  echo ("Error en la conexión. intentalo más tarde");
  exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id_usuario = $_SESSION['usuarioID']; // Aquí recuperas el ID del login
  $tipoReclamo = cleanInput($_POST['tipoReclamo'] ?? '');
  $fechaInconveniente = cleanInput($_POST['fecha'] ?? '');
  $descripcionReclamo = cleanInput($_POST['message'] ?? '');

  if (empty($tipoReclamo) || empty($fechaInconveniente) || empty($descripcionReclamo)) {
    echo ("Todos los campos son obligatorios");
  }

  $sql = "INSERT INTO PQR (CategoriaPQR, fechaInconveniente, usuarioID, DescripcionPQR ) VALUES(?,?,?,?)";

  //Preparar consulta sql

  $stmt = $conexion->prepare($sql);

  echo "<pre>";
  var_dump($id_usuario);
  var_dump($tipoReclamo);
  var_dump($fechaInconveniente);
  var_dump($descripcionReclamo);
  echo "</pre>";


  $stmt->bind_param("ssis", $tipoReclamo, $fechaInconveniente, $id_usuario, $descripcionReclamo);



  //ejecutar la consulta SQL
  if ($stmt->execute()) {
    echo ("PQR enviada correctamente");
    redirectReclamo();
  } else {
    //echo("Los datos no fueron enviados");
    echo ("Error al enviar la PQR: " . $stmt->error);
    error_log("Error al ejecutar la consulta SQL: " . $stmt->error);
  }
  $stmt->close();
}

function redirectReclamo()
{
  header("location: reclamosEnviados.php");
  exit();
}

function cleanInput($input)
{
  $input = trim($input); // Elimina espacios en blanco al inicio y final
  // Codifica caracteres especiales HTML para prevenir XSS si se imprime directamente en HTML
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  return $input;
}
