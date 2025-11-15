<?php
header('Content-Type: application/json');

// Conexión DB
$host = "sql5.freesqldatabase.com";
$dbname = "sql5807844";
$user = "sql5807844";
$pass = "GHd3xHcTLM";
$port = 3306;

$mysqli = new mysqli($host, $user, $pass, $dbname, $port);

if ($mysqli->connect_errno) {
    echo json_encode(["success" => false, "error" => "Error de conexión: " . $mysqli->connect_error]);
    exit();
}

// Verificar parámetros
if (isset($_POST['id_tutor'], $_POST['id_paciente'], $_POST['texto'], $_POST['fecha'], $_POST['hora'])) {

    $idTutor = $_POST['id_tutor'];
    $idPaciente = $_POST['id_paciente'];
    $texto = $_POST['texto'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $imagen = $_POST['imagen'] ?? null;
    $alarma_sonora = isset($_POST['alarma_sonora']) ? $_POST['alarma_sonora'] : 0;
    $tono = $_POST['tono'] ?? null;

    $stmt = $mysqli->prepare("INSERT INTO recordatorios (id_tutor, id_paciente, texto, fecha, hora, imagen, alarma_sonora, tono) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssis", $idTutor, $idPaciente, $texto, $fecha, $hora, $imagen, $alarma_sonora, $tono);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $stmt->error]);
    }

    $stmt->close();

} else {
    echo json_encode(["success" => false, "error" => "Faltan parámetros obligatorios"]);
}

$mysqli->close();
?>