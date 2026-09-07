<?php

declare(strict_types=1);


/*
|--------------------------------------------------------------------------
| Respuesta JSON
|--------------------------------------------------------------------------
*/

header('Content-Type: application/json; charset=utf-8');


/*
|--------------------------------------------------------------------------
| Función para responder
|--------------------------------------------------------------------------
*/

function responseJson(
    bool $success,
    string $message = '',
    int $status = 200
): never {

    http_response_code($status);

    echo json_encode(
        [
            'success' => $success,
            'message' => $message
        ],
        JSON_UNESCAPED_UNICODE
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Verificar método
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    responseJson(
        false,
        'Método de solicitud no permitido.',
        405
    );
}


/*
|--------------------------------------------------------------------------
| Obtener URL
|--------------------------------------------------------------------------
*/

$url = trim(
    $_POST['url'] ?? ''
);


if ($url === '') {

    responseJson(
        false,
        'La URL es obligatoria.',
        400
    );
}


/*
|--------------------------------------------------------------------------
| Validar formato
|--------------------------------------------------------------------------
*/

if (!filter_var($url, FILTER_VALIDATE_URL)) {

    responseJson(
        false,
        'La URL no tiene un formato válido.',
        400
    );
}


/*
|--------------------------------------------------------------------------
| Analizar URL
|--------------------------------------------------------------------------
*/

$parts = parse_url($url);

if ($parts === false) {

    responseJson(
        false,
        'No se pudo analizar la URL.',
        400
    );
}


/*
|--------------------------------------------------------------------------
| Validar protocolo
|--------------------------------------------------------------------------
*/

$scheme = strtolower(
    $parts['scheme'] ?? ''
);

if (!in_array(
    $scheme,
    ['http', 'https'],
    true
)) {

    responseJson(
        false,
        'Solo se permiten enlaces HTTP o HTTPS.',
        400
    );
}


/*
|--------------------------------------------------------------------------
| Validar dominio
|--------------------------------------------------------------------------
*/

$host = $parts['host'] ?? '';

if ($host === '') {

    responseJson(
        false,
        'La URL no contiene un dominio válido.',
        400
    );
}


/*
|--------------------------------------------------------------------------
| Crear conexión CURL
|--------------------------------------------------------------------------
*/

$ch = curl_init($url);

if ($ch === false) {

    responseJson(
        false,
        'No se pudo iniciar la conexión.',
        500
    );
}


/*
|--------------------------------------------------------------------------
| Configuración CURL
|--------------------------------------------------------------------------
*/

curl_setopt_array(
    $ch,
    [
        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_FOLLOWLOCATION => true,

        CURLOPT_MAXREDIRS => 5,

        CURLOPT_CONNECTTIMEOUT => 10,

        CURLOPT_TIMEOUT => 20,

        CURLOPT_USERAGENT =>
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) ' .
            'AppleWebKit/537.36 ' .
            '(KHTML, like Gecko) ' .
            'Chrome/140.0 Safari/537.36',

        CURLOPT_NOBODY => true,

        CURLOPT_SSL_VERIFYPEER => true,

        CURLOPT_SSL_VERIFYHOST => 2,

        CURLOPT_ENCODING => ''
    ]
);


/*
|--------------------------------------------------------------------------
| Ejecutar solicitud
|--------------------------------------------------------------------------
*/

curl_exec($ch);


/*
|--------------------------------------------------------------------------
| Obtener información
|--------------------------------------------------------------------------
*/

$error = curl_error($ch);

$errorNumber = curl_errno($ch);

$status = curl_getinfo(
    $ch,
    CURLINFO_HTTP_CODE
);

$effectiveUrl = curl_getinfo(
    $ch,
    CURLINFO_EFFECTIVE_URL
);


/*
|--------------------------------------------------------------------------
| Cerrar CURL
|--------------------------------------------------------------------------
*/

curl_close($ch);


/*
|--------------------------------------------------------------------------
| Error de conexión
|--------------------------------------------------------------------------
*/

if ($error !== '') {

    responseJson(
        false,
        'No fue posible acceder al enlace.',
        200
    );
}


/*
|--------------------------------------------------------------------------
| Verificar código HTTP
|--------------------------------------------------------------------------
*/

if (
    $status >= 200 &&
    $status < 400
) {

    responseJson(
        true,
        'Enlace válido y accesible.'
    );
}


/*
|--------------------------------------------------------------------------
| Código 401 / 403
|--------------------------------------------------------------------------
*/

if (
    $status === 401 ||
    $status === 403
) {

    responseJson(
        false,
        'El sitio requiere autorización o bloqueó la solicitud.'
    );
}


/*
|--------------------------------------------------------------------------
| Código 404
|--------------------------------------------------------------------------
*/

if ($status === 404) {

    responseJson(
        false,
        'La página no existe (404).'
    );
}


/*
|--------------------------------------------------------------------------
| Otros errores HTTP
|--------------------------------------------------------------------------
*/

if ($status >= 400) {

    responseJson(
        false,
        "El servidor respondió con código HTTP $status."
    );
}


/*
|--------------------------------------------------------------------------
| No se obtuvo respuesta válida
|--------------------------------------------------------------------------
*/

responseJson(
    false,
    'No fue posible comprobar la disponibilidad del enlace.'
);