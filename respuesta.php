<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta name="description" content="Respuestas sobre traumatología">
    <meta name="author" content="Ernesto Lora">
    <meta name="robots" content="index, follow">
    <title>Respuestas</title>
    <link rel="stylesheet" type="text/css" href="styles/respuesta.css">
</head>

<body>
    <?php
    // Cargar las variables de entorno desde el archivo .env
    if (file_exists(__DIR__ . '/.env')) {
        $dotenv = parse_ini_file(__DIR__ . '/.env');
        if ($dotenv) {
            $servername = $dotenv['DB_SERVERNAME'];
            $username = $dotenv['DB_USERNAME'];
            $password = $dotenv['DB_PASSWORD'];
            $dbname = $dotenv['DB_NAME'];
        } else {
            die('Error al cargar el archivo .env');
        }
    } else {
        die('.env file not found');
    }

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la sentencia SQL
    $stmt = $conn->prepare("SELECT id, pregunta, respuesta FROM copia_tabla WHERE respondida = 1 ORDER BY id DESC");

    // Ejecutar la sentencia
    $stmt->execute();

    // Vincular los resultados a variables
    $stmt->bind_result($id, $pregunta, $respuesta);

    echo "<div class='container'>";
    echo "<h1>Historial de Respuestas</h1>";

    // Recorrer los resultados
    while ($stmt->fetch()) {
        echo "<div class='question'>";
        echo "<strong>ID:</strong> $id <br>";
        echo "<strong>Pregunta:</strong> $pregunta <br>";
        echo "<strong>Respuesta:</strong> $respuesta";
        echo "</div>";
    }

    echo "<a href='index.html' class='back-button'>Volver al inicio</a>";
    echo "</div>";

    $stmt->close();
    $conn->close();
    ?>
</body>

</html>