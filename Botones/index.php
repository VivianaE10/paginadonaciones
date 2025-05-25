<?php
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$clave_secreta = "clave_super_segura";
$rol_id = null;

if (isset($_COOKIE['auth_token'])) {
  try {
    $decoded = JWT::decode($_COOKIE['auth_token'], new Key($clave_secreta, 'HS256'));
    $rol_id = $decoded->rol_id;
  } catch (Exception $e) {
    echo "Error de token: " . $e->getMessage();
    exit();
  }
} else {
  header("Location: ../login/index.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="top-nav" id="home">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-auto">
          <p> <i class='bx bxs-envelope'></i> donaciones@gmail.com</p>
          <p> <i class='bx bxs-phone-call'></i> 123 456-7890</p>
        </div>
        <div class="col-auto social-icons">
          <a href="#"><i class='bx bxl-facebook'></i></a>
          <a href="#"><i class='bx bxl-twitter'></i></a>
          <a href="#"><i class='bx bxl-instagram'></i></a>
          <a href="#"><i class='bx bxl-pinterest'></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
      <?php if (in_array($rol_id, [1, 2])): ?>
        <div class="col-sm-6 mb-3 mb-sm-5">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Registro Donaciones🩵</h5>
              <p class="card-text">"Tu ayuda puede cambiar vidas. Gracias por tu apoyo y solidaridad."</p>
              <a href="../Form/RegistroDonaciones/registroDonaciones.html" class="btn btn-primary" style="color: white">Donar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Reclamos PQR 📰🗓️</h5>
              <p class="card-text">Cuentanos como podemos ayudarte</p>
              <a href="../Form/formReclamos/reclamos.html" class="btn btn-primary" style="color: white">PQRS</a>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <?php if (in_array($rol_id, [1, 3])): ?>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar campañas 🎉📚</h5>
              <p class="card-text">Modifica la información de tus campañas activas o crea nuevas</p>
              <a href="../Form/FormCampañas/index.php" class="btn btn-primary" style="color: white">Editar</a>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>