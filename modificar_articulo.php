<?php
include 'conexion.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
$stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
$idCategoria = isset($_POST['idCategoria']) ? intval($_POST['idCategoria']) : 0;

$sql = "UPDATE articulo SET nombre='$nombre', stock=$stock, idCategoria=$idCategoria WHERE id=$id";

if($conn->query($sql) === TRUE){
    echo "OK";
}else{
    echo "ERROR: " . $conn->error;
}

$conn->close();
?>
