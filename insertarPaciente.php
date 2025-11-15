<?php
$conn = new mysqli("sql5.freesqldatabase.com", "sql5807844", "GHd3xHcTLM", "sql5807844");
if ($conn->connect_error) { die("Conexión fallida: " . $conn->connect_error); }

$email = $_POST['email'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "INSERT INTO tutores (email, nombre, apellido, usuario, password) VALUES ('$email','$nombre','$apellido','$usuario','$password')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success"=>true]);
} else {
    echo json_encode(["success"=>false, "error"=>$conn->error]);
}
$conn->close();
?>