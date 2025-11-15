<?php
// Evitar warnings/notices y limpiar buffer
error_reporting(0);
ini_set('display_errors', 0);
ob_start();

header('Content-Type: application/json'); // importante para JSON

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
    ob_clean();
    echo json_encode(["success" => false, "error" => "Error de conexión"]);
    exit();
}

// Verificar que se envíen los parámetros por POST
if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT password FROM pacientes WHERE nombre_usuario = ? OR email = ?");
    $stmt->bind_param("ss", $usuario, $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if ($password === $hashed_password) { // o password_verify si está hasheado
            ob_clean();
            echo json_encode(["success" => true]);
        } else {
            ob_clean();
            echo json_encode(["success" => false, "error" => "Contraseña incorrecta"]);
        }
    } else {
        ob_clean();
        echo json_encode(["success" => false, "error" => "Usuario no encontrado"]);
    }

    $stmt->close();
} else {
    ob_clean();
    echo json_encode(["success" => false, "error" => "Faltan parámetros"]);
}

$mysqli->close();
ob_end_flush();
?>