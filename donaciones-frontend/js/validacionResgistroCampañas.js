document.getElementById("guardarBtn").addEventListener("click", function () {
  // Validación simple
  const nombre = document.querySelector("input[name='nombre']").value.trim();
  const descripcion = document
    .querySelector("textarea[name='descripcion']")
    .value.trim();

  if (!nombre || !descripcion) {
    alert("Por favor completa los campos obligatorios.");
    return;
  }

  // Redirigir a la ruta deseada
  window.location.href = "/donaciones-frontend/index.html";
});
