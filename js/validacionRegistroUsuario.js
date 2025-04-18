function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}

function limpiarCorreo(correo) {
  return correo.trim().replace(/['\s]/g, "".trim());
}

function validarFormulario(event) {
  event.preventDefault();
  //Odtener y limpiar datos
  const fullName = limpiarCadena(
    document.getElementById("fullName").value.trim()
  );
  const ageUser = limpiarCadena(
    document.getElementById("ageUser").value.trim()
  );
  const emailUser = limpiarCorreo(
    document.getElementById("emailUser").value.trim()
  );
  const dateBirth = limpiarCadena(
    document.getElementById("dateBirth").value.trim()
  );
  const phoneUser = limpiarCadena(
    document.getElementById("phoneUser").value.trim()
  );
  const passwordUser = document.getElementById("passwordUser").value.trim();
  const repeatPasswordUser = document
    .getElementById("repeatPasswordUser")
    .value.trim();

  //validar que los campos no esten vacios
  if (
    fullName.length === 0 ||
    ageUser.length === 0 ||
    emailUser.length === 0 ||
    dateBirth.length === 0 ||
    phoneUser.length == 0 ||
    passwordUser.length === 0 ||
    repeatPasswordUser.length === 0
  ) {
    alert("Todos los campos son obligatorios");
    return;
  } else {
    console.log("Todos los datos estan llenos");
  }

  // Validar que las contraseñas coincidan
  if (passwordUser !== repeatPasswordUser) {
    alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
    console.log("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
    return;
  }

  // Si todo está correcto, enviar el formulario
  alert("Formulario validado correctamente. Enviando datos...");
  console.log("Formulario validado correctamente. Enviando datos...");
  document.getElementById("registroUsuario").submit();
}

document
  .getElementById("registroUsuario")
  .addEventListener("submit", validarFormulario);
