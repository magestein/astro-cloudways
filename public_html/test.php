<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:3000");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if(curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
} else {
    echo "Conexión exitosa. Primeros 100 caracteres de la respuesta: " . substr($response, 0, 100);
}
curl_close($ch); 