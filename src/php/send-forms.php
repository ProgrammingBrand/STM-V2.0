<?php
// Incluye el archivo de conexión
include 'link.php';

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
