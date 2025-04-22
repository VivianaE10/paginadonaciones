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

---

## 🛠️ Tecnologías utilizadas

- 🐘 PHP
- 🌐 HTML, CSS, JavaScript
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
FalconMasters. (2020, mayo 7). Validación de formularios con JavaScript [Video]. YouTube. https://www.youtube.com/watch?v=vUEEpn2r7bI

Midudev.(2024, abril 4).Aprende PHP 8 desde cero: Curso para principiantes + Aplicación con Deploy
[Video]. YouTube. https://www.youtube.com/watch?app=desktop&v=BcGAPkjt_IE

Ayuda con Chat GPT

Descarga de plantillas de html, css y js: https://htmlrev.com/free-bootstrap-templates.html
---