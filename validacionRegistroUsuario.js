function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}

function limpiarCorreo(correo) {
  return correo.trim().replace(/['@\s]/g, "");
}

document
  .getElementById("registroUsuario")
  .addEventListener("submit", function (e) {
    e.preventDefault();

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
    const passwordUser = limpiarCadena(
      document.getElementById("passwordUser").value.trim()
    );
    const repeatPasswordUser = limpiarCadena(
      document.getElementById("repeatPasswordUser").value.trim()
    );
  });
