<?php
// audiosRespondidos.php
// Cargar las variables de entorno desde el archivo .env
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = parse_ini_file(__DIR__ . '/.env');
    if ($dotenv) {
        $servername = $dotenv['DB_SERVERNAME'];
        $username = $dotenv['DB_USERNAME'];
        $password = $dotenv['DB_PASSWORD'];
        $dbname = $dotenv['DB_NAME'];
        echo "Variables cargadas correctamente.<br>";
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

// Almacenar los resultados para poder usarlos después de que se cierre el statement
$resultados = [];
while ($stmt->fetch()) {
  array_push($resultados, ['id' => $id, 'pregunta' => $pregunta, 'respuesta' => $respuesta]);
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ... metadatos, títulos y enlaces a CSS ... -->
    <script>
        function leerRespuesta(texto) {
        var msg = new SpeechSynthesisUtterance();
        msg.text = texto;
        window.speechSynthesis.speak(msg);
}
    </script>

</head>
<body>

    <!-- ... cabecera, navegación y otros contenidos ... -->

   <h2>Historial de Respuestas con audios</h2>
<?php foreach ($resultados as $fila): ?>
    <div id="respuesta-<?php echo $fila['id']; ?>">
        <p><strong>ID:</strong> <?php echo $fila['id']; ?></p>
        <p><strong>Pregunta:</strong> <?php echo $fila['pregunta']; ?></p>
        <p><strong>Respuesta:</strong> <?php echo $fila['respuesta']; ?></p>
        <button style="font-size: 16px; padding: 10px 20px; margin-bottom: 20px;" onclick="leerRespuesta('<?php echo htmlspecialchars(addslashes($fila['respuesta']), ENT_QUOTES); ?>')">Escuchar Respuesta</button>
    </div>
<?php endforeach; ?>


<a href='index.html' style="color: #fff; padding: 10px 20px; display: inline-block; margin-top: 20px; text-decoration: none; background-color: #007BFF; border-radius: 5px;">Volver al inicio</a>

    <!-- ... pie de página ... -->

</body>
</html>
