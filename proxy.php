<?php
// proxy.php
// 🔹 Proxy inteligente para saltar el challenge InfinityFree.
// 🔹 Hace hasta 5 redirecciones automáticas hasta obtener JSON real.

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

$endpoint = "https://ezequiel-rickert.ct.ws/";
$target = isset($_GET['file']) ? basename($_GET['file']) : null;

$permitidos = ["obtener_categorias.php", "insertar_articulo.php"];
if (!$target || !in_array($target, $permitidos)) {
    http_response_code(400);
    echo json_encode(["error" => "Archivo no permitido"]);
    exit;
}

$url = $endpoint . $target;

function getFinalResponse($url, $postData = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // seguir redirecciones
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0 Safari/537.36");
    curl_setopt($ch, CURLOPT_REFERER, "https://google.com/");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    if ($postData) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    }

    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    $error = curl_error($ch);
    curl_close($ch);

    // Si no es JSON, intentar una vez más con ?i=1, ?i=2
    if ($response && strpos(trim($response), '<html>') === 0) {
        for ($i = 1; $i <= 5; $i++) {
            $nextUrl = $url . "?i=$i";
            $response = getFinalResponse($nextUrl, $postData);
            if ($response && strpos(trim($response), '<html>') !== 0) break;
        }
    }

    return $response;
}

// Método GET (obtener categorías)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $response = getFinalResponse($url);
    if (!$response) {
        http_response_code(502);
        echo json_encode(["error" => "No se pudo obtener respuesta"]);
        exit;
    }
    echo $response;
    exit;
}

// Método POST (insertar artículo)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = getFinalResponse($url, $_POST);
    if (!$response) {
        http_response_code(502);
        echo json_encode(["error" => "No se pudo enviar datos"]);
        exit;
    }
    echo $response;
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Método no permitido"]);
?>
