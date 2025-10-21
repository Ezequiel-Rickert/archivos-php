<?php
include 'conexion.php';

// Recibir datos del POST
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$stock = $_POST['stock'];
$idCategoria = $_POST['idCategoria'];

// Preparar y ejecutar la consulta segura
$stmt = $conn->prepare("INSERT INTO articulo (id, nombre, stock, idCategoria) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isii", $id, $nombre, $stock, $idCategoria);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
