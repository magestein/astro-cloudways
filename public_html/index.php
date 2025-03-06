<?php
// Obtener la ruta solicitada
$request_uri = $_SERVER['REQUEST_URI'];

// Configuración simple de proxy
$nodeAppUrl = "http://localhost:3000" . $request_uri;

// Para depuración
error_log("Intentando conectar a: " . $nodeAppUrl);

// Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $nodeAppUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);  // Capturar también los headers
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // Seguir redirecciones

// Pasar los headers de la solicitud original
$headers = [];
foreach ($_SERVER as $key => $value) {
    if (strpos($key, 'HTTP_') === 0) {
        // Convertir HTTP_ACCEPT a Accept
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[] = "$header: $value";
    }
}
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Pasar el método HTTP correcto
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $_SERVER['REQUEST_METHOD']);

// Si es POST, pasar los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
}

// Obtener la respuesta
$response = curl_exec($ch);

// Verificar errores
if(curl_errno($ch)) {
    error_log("Error cURL: " . curl_error($ch));
    header("HTTP/1.1 500 Internal Server Error");
    echo '<h1>Error de conexión</h1>';
    echo '<p>No se pudo conectar al servidor de aplicaciones. Error: ' . curl_error($ch) . '</p>';
    exit;
}

// Separar headers y cuerpo
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header_text = substr($response, 0, $header_size);
$body = substr($response, $header_size);

// Procesar y enviar los headers
$headers = explode("\r\n", $header_text);
foreach ($headers as $header) {
    if (
        !empty($header) && 
        !strpos($header, 'Transfer-Encoding:') && 
        !strpos($header, 'Connection:') &&
        !strpos($header, 'Content-Length:')
    ) {
        header($header);
    }
}

// Cerrar la conexión
curl_close($ch);

// Mostrar la respuesta
echo $body; 