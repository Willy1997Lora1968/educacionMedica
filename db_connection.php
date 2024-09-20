<?php
// Cargar las variables de entorno desde el archivo .env
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = parse_ini_file(__DIR__ . '/.env');
    $servername = $dotenv['DB_SERVERNAME'];
    $username = $dotenv['DB_USERNAME'];
    $password = $dotenv['DB_PASSWORD'];
    $dbname = $dotenv['DB_NAME'];
} else {
    die('.env file not found');
}

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
$conn->close();
?>
