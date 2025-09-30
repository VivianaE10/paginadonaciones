console.log("✅ Script cargado correctamente");

function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}
document
  .getElementById("registroDonaciones")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // preventDefault evita que el formulario se envíe inmediatamente, para poder hacer validaciones primero.
    console.log("Validación iniciada..."); // ← Esto debería aparecer
    //Odtener y limpiar datos
    //.trim() para eliminar espacios al principio y final de la cadena.
    const donationAmount = limpiarCadena(
      document.getElementById("donationAmount").value.trim()
    );
    const holderName = limpiarCadena(
      document.getElementById("holderName").value.trim()
    );
    const cardNumber = limpiarCadena(
      document.getElementById("cardNumber").value.trim()
    );
    const expiryDate = limpiarCadena(
      document.getElementById("expiryDate").value.trim()
    );
    const codeCVV = limpiarCadena(
      document.getElementById("codeCVV").value.trim()
    );

    //validar que los campos no esten vacios
    if (
      donationAmount.length === 0 ||
      holderName.length === 0 ||
      cardNumber.length === 0 ||
      expiryDate.length == 0 ||
      codeCVV.length === 0
    ) {
      alert("Todos los campos son obligatorios");
      return;
    }

    // Validación del número de tarjeta
    const tarjetaNumeros = /^\d{15,16}$/;
    if (!tarjetaNumeros.test(cardNumber)) {
      alert(
        "El número de tarjeta debe tener exactamente 16 dígitos numéricos."
      );
      return;
    }

    // Validación de código CVV (exactamente 3 dígitos)
    const cvvRegex = /^\d{3}$/;
    if (!cvvRegex.test(codeCVV)) {
      alert("El código CVV debe tener exactamente 3 dígitos numéricos.");
      return;
    }

    // Si todo está correcto, enviar el formulario
    alert("Formulario validado correctamente. Enviando datos...");
    console.log("Formulario validado correctamente. Enviando datos...");
    window.location.href = "../../index.html";
  });

//valida un el formulario de donaciones en el navegador antes de que se envíe. Sirve para asegurar que todos los campos estén llenos y limpios antes de enviar los datos al servidor.
