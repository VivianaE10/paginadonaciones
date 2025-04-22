function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}

document
  .getElementById("reclamosForm")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // preventDefault evita que el formulario se envíe inmediatamente, para poder hacer validaciones primero.

    //Odtener y limpiar datos
    //.trim() para eliminar espacios al principio y final de la cadena.

    const tipoPeticion = limpiarCadena(
      document.getElementById("tipoReclamo").value.trim()
    );

    const dateReclamo = limpiarCadena(
      document.getElementById("fecha").value.trim()
    );
    const noteReclamo = limpiarCadena(
      document.getElementById("message").value.trim()
    );

    //validar que los campos no esten vacios
    if (
      tipoPeticion.length === 0 ||
      dateReclamo.length === 0 ||
      noteReclamo.length === 0
    ) {
      alert("Todos los campos son obligatorios");
      return;
    } else {
      console.log("Todos los datos estan llenos");
    }

    // Si todo está correcto, enviar el formulario
    alert("Formulario validado correctamente. Enviando datos...");
    console.log("Formulario validado correctamente. Enviando datos...");
    document.getElementById("reclamos").submit();
  });

//valida un el formulario de donaciones en el navegador antes de que se envíe. Sirve para asegurar que todos los campos estén llenos y limpios antes de enviar los datos al servidor.
