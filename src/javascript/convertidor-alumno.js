document.getElementById("userForm").addEventListener("submit", handleSubmit);

function handleSubmit(event) {
    event.preventDefault();

    // Capturar datos del formulario
    const alumnoData = {
        nombre: document.getElementById("nombre").value,
        apellidoP: document.getElementById("apellidoPaterno").value,
        apellidoM: document.getElementById("apellidoMaterno").value,
        curp: document.getElementById("curp").value,
        grado: document.getElementById("gradoEstudios").value,
        matricula: document.getElementById("matricula").value,
        nivelEducativo: document.getElementById("nivelEstudios").value,
        fechaRegistro: new Date().toISOString().split('T')[0],
        foto: document.getElementById("photo-data").value // Foto capturada
    };

    fetch("registrarAlumno.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(alumnoData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Alumno registrado exitosamente.");
        } else {
            alert("Error al registrar al alumno: " + data.error);
        }
    })
    .catch(error => {
        console.error("Error en la solicitud:", error);
        alert("Ocurrió un error al procesar la solicitud.");
    });
}
