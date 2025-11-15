<?php
// loginTutor.php

// Configuración de la base de datos
$host = "sql5.freesqldatabase.com";
$dbname = "sql5807844";
$user = "sql5807844";
$pass = "GHd3xHcTLM";
$port = 3306;

// Conexión
$mysqli = new mysqli($host, $user, $pass, $dbname, $port);

// Verificar conexión
if ($mysqli->connect_error) {
    die("error"); // Para que Android reciba algo
}

// Obtener datos de POST
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($usuario) || empty($password)) {
    echo "error";
    exit();
}

// Preparar la consulta
$stmt = $mysqli->prepare("SELECT password FROM tutores WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hash_password);
    $stmt->fetch();

    // Verificar contraseña
    if ($password === $hash_password) { // Cambiar a password_verify() si usás hash
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}

$stmt->close();
$mysqli->close();
?>