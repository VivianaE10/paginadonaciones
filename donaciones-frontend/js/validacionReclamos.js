function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim();
}

document
  .getElementById("reclamosForm")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // evitar envío automático

    // Obtener y limpiar datos reales del formulario
    const tipoReclamo = document.getElementById("tipoReclamo").value;
    const fecha = document.getElementById("fecha").value.trim();
    const mensaje = document.getElementById("message").value.trim();

    // Validar que los campos no estén vacíos
    if (fecha.length === 0 || mensaje.length === 0) {
      alert("Todos los campos son obligatorios");
      return;
    }

    console.log("Todos los datos están llenos");
    alert("Formulario validado correctamente. Enviando datos...");

    // Redirección
    setTimeout(() => {
      window.location.href = "../../index.html";
    }, 100);
  });
//valida un el formulario de donaciones en el navegador antes de que se envíe. Sirve para asegurar que todos los campos estén llenos y limpios antes de enviar los datos al servidor.
