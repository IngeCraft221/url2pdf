<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';


/*
|--------------------------------------------------------------------------
| Verificar método de solicitud
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido.');
}


/*
|--------------------------------------------------------------------------
| Obtener URL
|--------------------------------------------------------------------------
*/

$url = trim($_POST['url'] ?? '');

if ($url === '') {
    http_response_code(400);
    exit('La URL es obligatoria.');
}


/*
|--------------------------------------------------------------------------
| Validar URL
|--------------------------------------------------------------------------
*/

if (!filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    exit('La URL proporcionada no es válida.');
}


/*
|--------------------------------------------------------------------------
| Validar protocolo
|--------------------------------------------------------------------------
*/

$parts = parse_url($url);

$scheme = strtolower(
    $parts['scheme'] ?? ''
);

if (!in_array(
    $scheme,
    ['http', 'https'],
    true
)) {
    http_response_code(400);
    exit('Solo se permiten URLs HTTP o HTTPS.');
}


/*
|--------------------------------------------------------------------------
| Generar nombre del PDF
|--------------------------------------------------------------------------
*/

$filename =
    'url2pdf_' .
    date('Ymd_His') .
    '_' .
    bin2hex(random_bytes(4)) .
    '.pdf';


/*
|--------------------------------------------------------------------------
| Ruta de salida
|--------------------------------------------------------------------------
*/

$output =
    DOWNLOAD_PATH .
    DIRECTORY_SEPARATOR .
    $filename;


/*
|--------------------------------------------------------------------------
| Crear comando Node.js
|--------------------------------------------------------------------------
*/

$command =
    escapeshellarg(NODE_PATH) .
    ' ' .
    escapeshellarg(CONVERTER_PATH) .
    ' ' .
    escapeshellarg($url) .
    ' ' .
    escapeshellarg($output);


/*
|--------------------------------------------------------------------------
| Ejecutar conversor
|--------------------------------------------------------------------------
*/

$outputLog = [];

$returnCode = 0;

exec(
    $command . ' 2>&1',
    $outputLog,
    $returnCode
);


/*
|--------------------------------------------------------------------------
| Verificar resultado
|--------------------------------------------------------------------------
*/

if (
    $returnCode !== 0 ||
    !file_exists($output) ||
    filesize($output) === 0
) {

    http_response_code(500);

    echo '<!DOCTYPE html>';
    echo '<html lang="es">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Error - URL2PDF</title>';

    echo '<style>';

    echo '
        body {
            margin: 0;
            padding: 40px;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }

        h1 {
            color: #dc2626;
        }

        pre {
            background: #111827;
            color: #e5e7eb;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    ';

    echo '</style>';
    echo '</head>';

    echo '<body>';

    echo '<div class="container">';

    echo '<h1>Error al generar el PDF</h1>';

    echo '<p>';
    echo 'No fue posible convertir la página web en PDF.';
    echo '</p>';

    if (!empty($outputLog)) {

        echo '<h3>Información del proceso:</h3>';

        echo '<pre>';

        echo htmlspecialchars(
            implode(
                PHP_EOL,
                $outputLog
            ),
            ENT_QUOTES,
            'UTF-8'
        );

        echo '</pre>';
    }

    echo '<a href="index.php">';
    echo 'Volver a URL2PDF';
    echo '</a>';

    echo '</div>';

    echo '</body>';
    echo '</html>';

    exit;
}


/*
|--------------------------------------------------------------------------
| Redirigir a descarga
|--------------------------------------------------------------------------
*/

header(
    'Location: descargar.php?file=' .
    rawurlencode($filename)
);

exit;