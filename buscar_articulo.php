<?php
header('Content-Type: application/json');
include 'conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT id, nombre, stock, idCategoria FROM articulo WHERE id = $id";
$result = $conn->query($sql);

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    echo json_encode($row);
}else{
    echo "NO_ENCONTRADO";
}

$conn->close();
?>
