<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';


/*
|--------------------------------------------------------------------------
| Obtener nombre del archivo
|--------------------------------------------------------------------------
*/

$file = $_GET['file'] ?? '';

if ($file === '') {
    http_response_code(400);
    exit('Archivo no especificado.');
}


/*
|--------------------------------------------------------------------------
| Seguridad: evitar rutas externas
|--------------------------------------------------------------------------
*/

$file = basename($file);


/*
|--------------------------------------------------------------------------
| Validar extensión
|--------------------------------------------------------------------------
*/

if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'pdf') {
    http_response_code(400);
    exit('Tipo de archivo no permitido.');
}


/*
|--------------------------------------------------------------------------
| Construir ruta
|--------------------------------------------------------------------------
*/

$path =
    DOWNLOAD_PATH .
    DIRECTORY_SEPARATOR .
    $file;


/*
|--------------------------------------------------------------------------
| Verificar que el archivo exista
|--------------------------------------------------------------------------
*/

if (
    !file_exists($path) ||
    !is_file($path)
) {
    http_response_code(404);
    exit('Archivo no encontrado.');
}


/*
|--------------------------------------------------------------------------
| Verificar que sea un PDF
|--------------------------------------------------------------------------
*/

$mimeType = mime_content_type($path);

if (
    $mimeType !== 'application/pdf' &&
    $mimeType !== 'application/octet-stream'
) {
    http_response_code(400);
    exit('El archivo no es un PDF válido.');
}


/*
|--------------------------------------------------------------------------
| Limpiar buffers
|--------------------------------------------------------------------------
*/

while (ob_get_level() > 0) {
    ob_end_clean();
}


/*
|--------------------------------------------------------------------------
| Cabeceras de descarga
|--------------------------------------------------------------------------
*/

header(
    'Content-Type: application/pdf'
);

header(
    'Content-Disposition: attachment; filename="' .
    $file .
    '"'
);

header(
    'Content-Length: ' .
    filesize($path)
);

header(
    'Cache-Control: no-cache, no-store, must-revalidate'
);

header(
    'Pragma: no-cache'
);

header(
    'Expires: 0'
);


/*
|--------------------------------------------------------------------------
| Descargar archivo
|--------------------------------------------------------------------------
*/

readfile($path);


/*
|--------------------------------------------------------------------------
| Eliminar PDF después de descargar
|--------------------------------------------------------------------------
*/

@unlink($path);

exit;