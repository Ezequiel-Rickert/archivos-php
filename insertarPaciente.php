<?php
header('Content-Type: application/json');

// Conexión a la DB
$conn = new mysqli("sql5.freesqldatabase.com", "sql5807844", "GHd3xHcTLM", "sql5807844", 3306);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Conexión fallida: " . $conn->connect_error]);
    exit;
}

// Recibir datos POST
$email = $_POST['email'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Validar que no vengan vacíos
if (empty($email) || empty($nombre) || empty($apellido) || empty($usuario) || empty($password)) {
    echo json_encode(["success" => false, "error" => "Faltan campos obligatorios"]);
    exit;
}

// Preparar la consulta (evita inyecciones SQL)
$stmt = $conn->prepare("INSERT INTO pacientes (email, nombre, apellido, usuario, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $email, $nombre, $apellido, $usuario, $password);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>