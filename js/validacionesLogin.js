function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}

function limpiarCorreo(correo) {
  return correo.trim().replace(/['\s]/g, "".trim());
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
    alert("Porfavor ingrese el correo");
  } else if (passwordUser.length === 0) {
    alert("Porfavor ingrese la contraseña");
  }

  document.getElementById("login").submit();
});
