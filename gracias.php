<?php
$nombre = '';

// Verificar si 'nombre' existe en $_GET
if (isset($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ernesto Lora">
    <meta name="robots" content="index, follow">
    <title>Gracias por tu pregunta</title>
</head>


<body>
    <h1>¡Gracias, <?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>!</h1>
    <p>Hemos recibido tu pregunta y te responderemos lo antes posible.</p>
    <p>Puedes ver y escuchar otras respuestas, en la siguientes páginas:</p>
    <a href="respuesta.php" style="color: #fff; padding: 10px 20px; display: inline-block; margin-top: 20px; text-decoration: none; background-color: #007BFF; border-radius: 5px";>Respuestas</a><br>
    <a href="audiosRespondidos.php" style="color: #fff; padding: 10px 20px; display: inline-block; margin-top: 20px; text-decoration: none; background-color: #007BFF; border-radius: 5px";>Audios Respondidos</a>
</body>

</html>
