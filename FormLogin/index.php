<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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

  <main class="container-sm">
    <div class="mt-5 d-flex flex-column align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="#0056D2"
        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-user-scan">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
        <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
        <path d="M4 16v2a2 2 0 0 0 2 2h2" />
        <path d="M16 4h2a2 2 0 0 1 2 2v2" />
        <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
        <path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" />
      </svg>
      <form class="w-100" style="max-width: 400px;" action="login.php" id="login" method="post">
        <div class="pt-5">
          <legend class="text-center">Inicio de sesión</legend>
          <div class="mb-3">
            <label for="emailUser" class="form-label">Correo registrado</label>
            <input type="email" class="form-control" name="emailUser" id="emailUser" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Ingrese el correo </div>
          </div>
          <div class="mb-3">
            <label for="passwordUser" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="passwordUser" id="passwordUser">
          </div>
          <?php
          if (isset($_SESSION['error'])) {
            echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
          }
          ?>
          <div id="mensajeError" style="color: red; font-weight: bold;"></div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary px-4">login</button>
          </div>
        </div>
      </form>
    </div>
  </main>

  <script src="../js/validacionesLogin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>

</body>

</html>