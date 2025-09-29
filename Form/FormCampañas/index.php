
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro campañas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../../css/style.css">   
</head>
<body>
  <!-- TOP NAV -->
  <div class="top-nav" id="home" style="position: sticky; top: 0; z-index: 1000">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-auto">
          <p><i class='bx bxs-envelope'></i> donaciones@gmail.com</p>
          <p><i class='bx bxs-phone-call'></i> 123 456-7890</p>
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
    <div class="mt-3 d-flex flex-column align-items-center">
      <form id="registroCampanas" class="container-sm mt-1" style="max-width: 720px" action="#" method="post" enctype="multipart/form-data">
        <fieldset>
          <legend class="text-center">Registro Campañas</legend>

          <div class="mb-3">
            <label class="form-label">Nombre Campaña</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Fecha de fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-control">
              <option value="activa">Activa</option>
              <option value="inactiva">Inactiva</option>
              <option value="finalizada">Finalizada</option>
            </select>
          </div>

          <div class="text-center mt-3 mb-5">
             <button type="button" class="btn btn-primary" id="guardarBtn">
                Guardar
             </button>
    
          </div>
        </fieldset>
      </form>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
</body>