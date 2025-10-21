<?php
include 'conexion.php';

// Consulta para traer todos los artículos con el nombre de la categoría
$sql = "SELECT a.id, a.nombre, a.stock, c.descripcion AS categoria
        FROM articulo a
        INNER JOIN categoria c ON a.idCategoria = c.id
        ORDER BY a.id ASC";

$result = mysqli_query($conn, $sql);

$articulos = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $articulos[] = array(
            "id" => $row['id'],
            "nombre" => $row['nombre'],
            "stock" => $row['stock'],
            "categoria" => $row['categoria']
        );
    }
}

// Devolver JSON con UTF-8 correcto
header('Content-Type: application/json; charset=utf-8');
echo json_encode($articulos, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>