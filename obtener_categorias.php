<?php
include 'conexion.php';

$sql = "SELECT id, descripcion FROM categoria ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

$categorias = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categorias[] = array(
            "id" => $row['id'],
            "descripcion" => $row['descripcion']
        );
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($categorias, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>
