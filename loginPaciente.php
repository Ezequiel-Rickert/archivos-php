<?php
// login_paciente.php

header('Content-Type: application/json'); // Importante para JSON

// Configuración de la base de datos
$host = "sql5.freesqldatabase.com";
$dbname = "sql5807844";
$user = "sql5807844";
$pass = "GHd3xHcTLM";
$port = 3306;

// Conexión a la base de datos
$mysqli = new mysqli($host, $user, $pass, $dbname, $port);

// Verificar conexión
if ($mysqli->connect_errno) {
    echo json_encode(["success" => false, "error" => "Error de conexión: " . $mysqli->connect_error]);
    exit();
}

// Verificar que se envíen los parámetros por POST
if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Consulta segura usando prepared statements
    $stmt = $mysqli->prepare("SELECT password FROM pacientes WHERE nombre_usuario = ? OR email = ?");
    
    if (!$stmt) {
        echo json_encode(["success" => false, "error" => "Error en la consulta: " . $mysqli->error]);
        exit();
    }

    $stmt->bind_param("ss", $usuario, $usuario); // Se puede ingresar usuario o email
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verificar contraseña
        // Si tu contraseña está hasheada, usar password_verify($password, $hashed_password)
        if ($password === $hashed_password) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Contraseña incorrecta"]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Usuario no encontrado"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Faltan parámetros"]);
}

$mysqli->close();
?>