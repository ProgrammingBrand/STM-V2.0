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
        $apellido = $_POST['apellido'] ?? '';
        $email = $_POST['email'] ?? '';

        // Validar que los campos no estén vacíos
        if (!empty($nombre) && !empty($apellido) && !empty($email)) {
            // Preparar y ejecutar la consulta SQL
            $stmt = $conn->prepare("INSERT INTO padres (Nombre, ApellidoP, ApellidoM) VALUES (:nombre, :apellido, :email)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                echo "Registro exitoso: $nombre $apellido, $email";
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
