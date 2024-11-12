// JavaScript: Procesamiento y envío de datos
function handleSubmit(event) {
  event.preventDefault();

  // Captura y estructura de datos
  const data = {
    nombre: document.getElementById("nombre").value,
    apellidoP: document.getElementById("apellidoPaterno").value,
    apellidoM: document.getElementById("apellidoMaterno").value,
    correo: document.getElementById("curp").value,
    edad: calculateAge(document.getElementById("curp").value), // Función para calcular edad
    rfc: document.getElementById("rfc").value,
    regimenFiscal: document.getElementById("regimenFiscal").value,
    direccion: `${document.getElementById("numeroInterior").value} ${document.getElementById("numeroExterior").value} ${document.getElementById("colonia").value}, ${document.getElementById("municipio").value}, ${document.getElementById("estado").value}`,
    codigoPostal: document.getElementById("codigoPostal").value,
    
  };

  // Envío de datos a PHP
  fetch("/src/php/send-forms.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then(response => response.json())
    .then(responseData => {
      if (responseData.success) {
        alert("Datos enviados correctamente.");
      } else {
        alert("Error al enviar los datos.");
      }
    })
    .catch(error => {
      console.error("Error:", error);
    });
}

// Función para calcular la edad a partir del CURP
function calculateAge(curp) {
  const birthYear = parseInt(curp.slice(4, 6));
  const year = birthYear > 23 ? 1900 + birthYear : 2000 + birthYear;
  const birthDate = new Date(year, curp.slice(6, 8) - 1, curp.slice(8, 10));
  const ageDifMs = Date.now() - birthDate.getTime();
  const ageDate = new Date(ageDifMs);
  return Math.abs(ageDate.getUTCFullYear() - 1970);
}
