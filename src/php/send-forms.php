<?php
// Incluye el archivo de conexión
include '/src/php/link.php';

// Leer datos JSON enviados desde JavaScript
$input = json_decode(file_get_contents("php://input"), true);

try {
    // Preparar la consulta SQL
    $stmt = $pdo->prepare("INSERT INTO padres (Nombre, ApellidoP, ApellidoM, Correo, Edad, RFC, RegimenFiscal, Direccion, CodigoPostal) 
                           VALUES (:nombre, :apellidoP, :apellidoM, :correo, :edad, :rfc, :regimenFiscal, :direccion, :codigoPostal)");

    // Ejecutar la consulta con los datos recibidos
    $stmt->execute([
        ':nombre' => $input['nombre'],
        ':apellidoP' => $input['apellidoP'],
        ':apellidoM' => $input['apellidoM'],
        ':correo' => $input['correo'],
        ':edad' => $input['edad'],
        ':rfc' => $input['rfc'],
        ':regimenFiscal' => $input['regimenFiscal'],
        ':direccion' => $input['direccion'],
        ':codigoPostal' => $input['codigoPostal']
    ]);

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
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
