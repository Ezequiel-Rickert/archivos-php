<?php
$servername = "sql10.freesqldatabase.com";
$username = "sql10803375";
$password = "147KlgW4XX";
$dbname = "sql10803375";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Forzar UTF-8 para caracteres especiales
mysqli_set_charset($conn, "utf8");
?>
