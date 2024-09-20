<?php
include 'db.connection.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si los datos del formulario existen en $_POST
if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['pregunta'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $pregunta = $_POST['pregunta'];

    // Preparar la sentencia SQL
    $stmt = $conn->prepare("INSERT INTO copia_tabla (nombre, correo, pregunta) VALUES (?, ?, ?)");

    // Vincular los parámetros a la sentencia preparada
    $stmt->bind_param("sss", $nombre, $correo, $pregunta);

    // Ejecutar la sentencia
    if ($stmt->execute() === TRUE) {
        // Redirigir al usuario a la página de agradecimiento
        header("Location: gracias.php?nombre=".urlencode($nombre));
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

