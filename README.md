# paginadonaciones


🧑‍🤝‍🧑 Integrantes del proyecto

🎓 Viviana Ospina

🎓 Daniel Arias

🎓 Sergio García


<h1 align="center">🤝 Proyecto Donaciones</h1>

<p align="center">
  Un sistema web para gestionar y registrar donaciones de forma eficiente, segura y amigable.
</p>

---

## 🧩 Descripción

**Donaciones** es una plataforma web desarrollada con PHP, JavaScript y MySQL que permite a los usuarios realizar donaciones, registrarlas, y llevar el seguimiento de cada una. Se enfoca en ofrecer una experiencia simple y confiable para conectar a donantes con causas sociales.

---

## 🏹 Objetivo General

Desarrollar una aplicación web que permita gestionar de manera eficiente, segura y accesible el registro y control de donaciones, facilitando la interacción entre donantes y organizaciones beneficiarias, mediante el uso de tecnologías como PHP, JavaScript y MySQL, y aplicando buenas prácticas de desarrollo web y seguridad informática.
---

## 📚 Modelo ER de la base de datos

<p align="center">
  <img src="img/Diagrama ER Donaciones.png" alt="Pantalla de inicio" width="600"/>
</p>

---

## 🖥️ Código JS de validaciones de los formularios

```
function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}

function limpiarCorreo(correo) {
  return correo.trim().replace(/['\s]/g, "".trim());
}

function mostrarError(mensaje) {
  const divError = document.getElementById("mensajeError");
  divError.textContent = mensaje;

}

document.getElementById("login").addEventListener("submit", function (e) {
  e.preventDefault();

  //Obtener y limpiar datos

  const emailUser = limpiarCorreo(
    document.getElementById("emailUser").value.trim()
  );
  const passwordUser = limpiarCadena(
    document.getElementById("passwordUser").value.trim()
  );

  if (emailUser.length === 0) {
    mostrarError("Porfavor ingrese el correo");
    //alert("Porfavor ingrese el correo");
  } else if (passwordUser.length === 0) {
    mostrarError("Porfavor ingrese la contraseña");
    //alert("Porfavor ingrese la contraseña");
  }

  document.getElementById("login").submit();
});

```
## 💾 Código PHP para el registro de donaciones

Este script maneja el registro de donaciones realizadas por usuarios autenticados. Realiza validaciones de seguridad, inserta datos en la base de datos y gestiona errores comunes. A continuación, se detallan sus principales funciones:

### 📌 Funcionalidades

- Verifica que el usuario haya iniciado sesión mediante `$_SESSION`.
- Limpia y valida los datos recibidos desde el formulario (como número de tarjeta, fecha, CVV, etc.).
- Previene inyecciones SQL usando sentencias preparadas (`prepare()` y `bind_param()`).
- Inserta los datos de la donación en la base de datos.
- Redirige al usuario tras el registro exitoso.
- Muestra mensajes de error y logs en caso de fallos de conexión o ejecución.
- Utiliza funciones auxiliares para conexión a la base de datos (`CreateConnection()`), limpieza de datos (`cleanInput()`), y redirección (`redirectLogin()`).

### ⚙️ Consideraciones técnicas

- Se usa `mysqli` con conexión segura y `utf8mb4` como charset.
- Se incluye validación de longitud del número de tarjeta con `preg_match`.
- Se evitan campos vacíos con validaciones manuales en `if`.

### 🛡️ Seguridad

- Protección contra SQL Injection mediante consultas preparadas.
- Evita Cross-Site Scripting (XSS) usando `htmlspecialchars()`.

### 📄 Código fuente

```php
<?php

session_start();
// Asegurarse que el usuario esté logueado
$usuarioID = $_SESSION['usuarioID'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conexion = CreateConnection();

if ($conexion->connect_error) {
  error_log("Error de conexión de la base de datos: " . $conexion->connect_error);
  echo ("Error en la conexión. intentalo más tarde");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //capturando los datos
  $donationAmount  = cleanInput($_POST['donationAmount'] ?? '');
  $holderName = cleanInput($_POST['holderName'] ?? '');
  $cardNumber = $_POST['cardNumber'];

  if (!preg_match('/^\d{15,16}$/', $cardNumber)) {
      die("El número de tarjeta debe tener entre 15 y 16 dígitos");
  }

  $expiryDate = cleanInput($_POST['expiryDate'] ?? '');
  $codeCVV = ($_POST['codeCVV'] ?? '');

  if (empty($donationAmount) || empty($holderName) || empty($cardNumber) || empty($expiryDate) || empty($codeCVV)) {
    echo ("Todos los campos son obligatorios");
    exit();
  }

  $sql = "INSERT INTO registro_donaciones (UsuarioID, CantidadDonar, NombreTitular, NumeroTarjeta, fechaVencimiento, CodigoCVV) VALUES (?, ?, ?, ?, ?, ?)";

  $stmt = $conexion->prepare($sql);

  if ($stmt === false) {
    error_log("Error al preparar la sentencia SQL: " . $conexion->error);
    echo "Error al preparar la consulta.";
    exit();
  }

  $stmt->bind_param("isssss", $usuarioID, $donationAmount, $holderName, $cardNumber, $expiryDate, $codeCVV);

  if ($stmt->execute()) {
    echo ("Datos enviados correctamente");
    redirectLogin();
  } else if ($conexion->errno == 1062) {
    echo ("El correo electrónico ya está registrado.");
  } else {
    error_log("Error al ejecutar la sentencia SQL: " . $stmt->error . " (Código: " . $conexion->errno . ")");
    echo ("Ocurrió un problema al intentar registrar la donación.");
  }

  $stmt->close();
}

function redirectLogin()
{
  header("location: /paginadonaciones/index.php");
  exit();
}

function CreateConnection()
{
  $host = "yamanote.proxy.rlwy.net";
  $port = 31557;
  $usuario_db = "root";
  $contrasena_db = "uoqkCVjLUzCPAFJLvDkZpdssluARhvXT";
  $nombre_db = "donaciones";

  mysqli_report(MYSQLI_REPORT_OFF);
  $conexion = new mysqli($host, $usuario_db, $contrasena_db, $nombre_db, $port);

  if ($conexion->connect_error) {
    error_log("Error de conexión a la base de datos: (" . $conexion->connect_error . ") " . $conexion->connect_error);
    return false;
  }

  if (!$conexion->set_charset("utf8mb4")) {
    error_log("Error al establecer el charset UTF-8: " . $conexion->error);
  } else {
    echo ("conexion exitosa");
  }
  return $conexion;
}

function cleanInput($input)
{
  $input = trim($input);
  $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
  return $input;
}
---

## 🛠️ Tecnologías utilizadas

- 🐘 PHP
- 🌐 HTML, CSS, JavaScript,  **Bootstrap**  
- 🐬 MySQL
- 🔒 Seguridad: Validaciones, cifrado y protección contra SQL Injection

---
---
## 📌 Conclusiones
- El desarrollo del sistema Donaciones permitió aplicar conocimientos prácticos de programación web, fortaleciendo las habilidades técnicas del equipo.

- La implementación de medidas de seguridad demostró ser esencial para garantizar la integridad y confidencialidad de los datos.

- El sistema ofrece una solución funcional para la gestión de donaciones, útil para organizaciones sin ánimo de lucro.

- El trabajo colaborativo fue clave para lograr una correcta división de tareas y enriquecer el desarrollo del proyecto.

- Este proyecto evidencia cómo la tecnología puede ser una herramienta para generar impacto social positivo.

---
---
## 📚 Bibliografía

Midudev.(2024, abril 4).Aprende PHP 8 desde cero: Curso para principiantes + Aplicación con Deploy
[Video]. YouTube. https://www.youtube.com/watch?app=desktop&v=BcGAPkjt_IE

Ayuda con Chat GPT

Descarga de plantillas de html, css y js: https://htmlrev.com/free-bootstrap-templates.html
---
