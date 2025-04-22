<?php

require_once "../../database/MySQLi/Conexion.php";

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
  $id_usuario = $_SESSION['usuarioID']; // Aquí recuperas el ID del login
  $fullName  = cleanInput($_POST['nombre'] ?? '');
  $emailUser = cleanInput($_POST['email'] ?? '');
  $dateReclamo = cleanInput($_POST['fechaInconveniente'] ?? '');
  $messageReclamo = cleanInput($_POST['message'] ?? '');


  //Validación de campos vacíos

  if (empty($fullName) || empty($emailUser) || empty($dateReclamo) || empty($messageReclamo)) {
    echo ("Todos los campos son obligatorios");
    exit();
  }

  //preparar consulta en SQL

  $sql = "INSERT INTO PQR ()"
}


function cleanInput($input)
{
  $input = trim($input); // Elimina espacios en blanco al inicio y final
  // Codifica caracteres especiales HTML para prevenir XSS si se imprime directamente en HTML
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  return $input;
}


?>















<!--<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reclamos</title> -->
<!-- Agregar los enlaces a los estilos de Bootstrap -->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
  
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
          <h2 class="card-title">¡Enviado!</h2>
          <h5 class="card-title">Gracias por confiar en nosotros</h5>
          <h5 class="card-title">Pronto nos contactaremos con tigo</h5>
          </div>
          <div class="card-body d-flex justify-content-between">
            <p><strong>Entregado con exito </strong>.</p>
            <div class="button text-end">
            <a href="#" class="  btn btn-danger text-end">Incio</a></div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

<!-- Agregar el enlace al script de Bootstrap (requerido para algunos componentes interactivos) -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>-->


<!--//' OR '1'='1-->