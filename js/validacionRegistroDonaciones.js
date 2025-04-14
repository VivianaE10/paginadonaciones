function limpiarCadena(cadena) {
  return cadena.replace(/['@\s]/g, "").trim(); //Reemplaza caracteres especiales en el formulario por un string vacio
}

document
  .getElementById("registroDonaciones")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // preventDefault evita que el formulario se envíe inmediatamente, para poder hacer validaciones primero.

    //Odtener y limpiar datos 
    //.trim() para eliminar espacios al principio y final de la cadena.
    const donationAmount = limpiarCadena(
      document.getElementById("donationAmount").value.trim()
    );
    const dateDonation = limpiarCadena(
      document.getElementById("dateDonation").value.trim()
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
      document.getElementById("codeCVV)").value.trim()
    );
  
    //validar que los campos no esten vacios
    if (
      donationAmount.length === 0 ||
      dateDonation.length === 0 ||
      holderName.length === 0 ||
      cardNumber.length === 0 ||
      expiryDate.length == 0 ||
      codeCVV.length === 0 ||
    ) {
      alert("Todos los campos son obligatorios");
      return;
    } else {
      console.log("Todos los datos estan llenos");
    }

    // Si todo está correcto, enviar el formulario
    alert("Formulario validado correctamente. Enviando datos...");
    console.log("Formulario validado correctamente. Enviando datos...");
    document.getElementById("registroDonaciones").submit();
  });

  //valida un el formulario de donaciones en el navegador antes de que se envíe. Sirve para asegurar que todos los campos estén llenos y limpios antes de enviar los datos al servidor.