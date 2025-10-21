<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servidor activo - Render</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: #f1f1f1;
            text-align: center;
            margin-top: 12%;
        }
        h1 {
            color: #4CAF50;
            font-size: 2em;
        }
        p {
            color: #bbb;
            font-size: 1em;
        }
        code {
            background: #1e1e1e;
            padding: 8px 14px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 12px;
            font-size: 0.95em;
        }
        a {
            color: #90caf9;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            margin-top: 30px;
            font-size: 0.8em;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>✅ Servidor PHP operativo en Render</h1>
    <p>El entorno <strong>PHP + Apache</strong> está funcionando correctamente.</p>
    
    <p>Endpoints disponibles:</p>
    <code>
        <a href="obtener_categorias.php">obtener_categorias.php</a><br>
        <a href="insertar_articulo.php">insertar_articulo.php</a>
    </code>

    <footer>
        <p>PHP versión: <strong><?php echo phpversion(); ?></strong></p>
        <p>Ubicación actual: <strong><?php echo $_SERVER['SERVER_NAME']; ?></strong></p>
    </footer>
</body>
</html>
