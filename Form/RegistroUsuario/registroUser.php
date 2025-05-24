<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro de Usuarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />
</head>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../../css/style.css">

  <title>Registro de Usuarios</title>
</head>

<body>
  <!-- TOP NAV -->
  <div class="top-nav" id="home" style="position: sticky; top: 0; z-index: 1000">
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
  <main>
    <form id="registroUsuario" class="container-sm mt-5" style="max-width: 720px" action="registroUsuario.php"
      method="post">
      <fieldset>
        <legend class="text-center">Registro Usuarios</legend>
        <div class="mb-3">
          <label for="fullName" class="form-label">Nombre Completo:</label>
          <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Fernando Marin" />
        </div>
        <div class="mb-3">
          <label for="ageUser" class="form-label">Que edad tienes:</label>
          <input type="number" id="ageUser" name="ageUser" class="form-control" placeholder="30" required />
        </div>
        <div class="mb-3">
          <label for="emailUser" class="form-label">Correo:</label>
          <input type="email" id="emailUser" name="emailUser" class="form-control" placeholder="correo@correo.com"
            required />
        </div>
        <div class="mb-3">
          <label for="dateBirth" class="form-label">Fecha de Nacimiento:</label>
          <input type="date" id="dateBirth" class="form-control" name="dateBirth" required />
        </div>
        <div class="mb-3">
          <label for="phoneUser" class="form-label">Teléfono:</label>
          <input type="tel" id="phoneUser" name="phoneUser" class="form-control" placeholder="3110002222" required
            maxlength="10" min="1" max="10" />
        </div>
        <div class="mb-3">
          <label for="passwordUser" class="form-label">Contraseña:</label>
          <input type="password" id="passwordUser" class="form-control" name="passwordUser" required minlength="8" />
        </div>
        <div class="mb-3">
          <label for="repeatPasswordUser" class="form-label">Repite la contraseña:</label>
          <input type="password" id="repeatPasswordUser" class="form-control" name="repeatPasswordUser" />
        </div>
        <!--Si el código tienene un error despues de que sea validado en php aparecera en el formulario-->
        <?php
        if (isset($_SESSION['error'])) {
          echo "<div style='color: red;'>" . $_SESSION['error'] . "</div>";
          unset($_SESSION['error']);
        }
        ?>
        <!--Alertas de error desde JavaScript-->
        <div id="mensajeError" style="color: red; font-weight: bold;"></div>
        <div>
          <button type="submit" class="btn btn-primary">Resgistrarse</button>
        </div>
      </fieldset>
    </form>
  </main>

  <script src="../../js/validacionRegistroUsuario.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
</body>

</html>