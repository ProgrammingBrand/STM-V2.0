<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia esto a tu host de base de datos
$dbname = 'facturas'; // Cambia a tu nombre de base de datos
$username = 'root'; // Cambia a tu usuario de base de datos
$password = ''; // Cambia a tu contraseña de base de datos

// Establecer la conexión
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Comprobar si se reciben los datos del formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'] ?? '';
        $apellidoP = $_POST['apellidoPaterno'] ?? '';
        $apellidoM = $_POST['apellidoMaterno'] ?? '';
        $curp = $_POST['curp'] ?? '';
        $nEstudios = $_POST['nivelEstudios'] ?? '';
        $gEstudios = $_POST['gradoEstudios'] ?? '';
        $matricula = $_POST['matricula'] ?? '';

        // Validar que los campos no estén vacíos
        if (!empty($nombre) && !empty($apellidoP) && !empty($apellidoM) && !empty($curp)&& !empty($nEstudios)&& !empty($gEstudios)&& !empty($matricula)) {
            // Preparar y ejecutar la consulta SQL
            $stmt = $conn->prepare("INSERT INTO alumnos (Nombre, ApellidoP, ApellidoM, CURP, NivelEducativo, Grado, Matricula, FechaRegistro) VALUES (:nombre, :apellidoPaterno, :apellidoMaterno, :curp, :nivelEstudios, :gradoEstudios, :matricula)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidoPaterno', $apellidoP);
            $stmt->bindParam(':apellidoMaterno', $apellidoM);
            $stmt->bindParam(':curp', $curp);
            $stmt->bindParam(':nivelEstudios', $nEstudios);
            $stmt->bindParam(':gradoEstudios', $gEstudios);
            $stmt->bindParam(':matricula', $matricula);

            if ($stmt->execute()) {
                echo "Registro exitoso:";
            } else {
                echo "Error al registrar los datos.";
            }
        } else {
            echo "Por favor, completa todos los campos.";
        }
    } else {
        echo "Método de solicitud no válido.";
    }
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
?>
