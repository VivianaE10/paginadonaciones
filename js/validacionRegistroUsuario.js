function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}

function limpiarCorreo(correo) {
  return correo.trim().replace(/['\s]/g, "".trim());
}

function mostarError(mensaje) {
  const divError = document.getElementById("mensajeError");
  divError.textContent = mensaje;
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
  const dateBirth = document.getElementById("dateBirth").value.trim();
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
    mostarError("Todos los campos son obligatorios");
    //alert("Todos los campos son obligatorios");
    return;
  } else {
    console.log("Todos los datos estan llenos");
  }

  // Validar que la fecha no sea futura
  const fechaNacimiento = new Date(dateBirth);
  const hoy = new Date();

  // Normalizar horas para evitar diferencias por la hora del sistema
  fechaNacimiento.setHours(0, 0, 0, 0);
  hoy.setHours(0, 0, 0, 0);

  if (fechaNacimiento > hoy) {
    mostarError("La fecha de nacimiento no puede ser en el futuro.");
    //alert("La fecha de nacimiento no puede ser en el futuro.");
    console.log(
      "Fecha de nacimiento inválida:",
      fechaNacimiento.toISOString().split("T")[0]
    );
    return;
  }

  // Validar que las contraseñas coincidan
  if (passwordUser !== repeatPasswordUser) {
    mostarError("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
    //alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
    console.log("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
    return;
  }

  //verificar que la contraseña tenga caracteres especiales
  const tieneMayuscula = /[A-Z]/.test(passwordUser);
  const tieneEspecial = /[!@#$%^&*(),.?":{}|<>]/.test(passwordUser);

  if (!tieneMayuscula || !tieneEspecial) {
    let mensaje = "La contraseña debe contener:";
    if (!tieneMayuscula) mensaje += "\n- Al menos una letra mayúscula.";
    if (!tieneEspecial)
      mensaje += "\n- Al menos un carácter especial (como @, #, $, %, etc.).";

    mostarError(mensaje);
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
