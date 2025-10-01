function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim();
}

function limpiarCorreo(correo) {
  return correo.trim().replace(/['\s]/g, "");
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
    mostrarError("Por favor ingrese el correo");
    return; // 👈 detener ejecución
  } else if (passwordUser.length === 0) {
    mostrarError("Por favor ingrese la contraseña");
    return; // 👈 detener ejecución
  }

  // Si todo está correcto
  mostrarError("");
  alert("Inicio de sesión válido ✅");
  console.log("Login validado correctamente");

  // Redirigir
  window.location.href = "../../botones/index.html";
});
