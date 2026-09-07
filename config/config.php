
<?php

declare(strict_types=1);


/*
|--------------------------------------------------------------------------
| RUTAS PRINCIPALES
|--------------------------------------------------------------------------
*/

define(
    'BASE_PATH',
    dirname(__DIR__)
);


/*
|--------------------------------------------------------------------------
| NODE.JS
|--------------------------------------------------------------------------
|
| Ruta donde está instalado Node.js en Windows.
|
*/

define(
    'NODE_PATH',
    'C:\\Program Files\\nodejs\\node.exe'
);


/*
|--------------------------------------------------------------------------
| CONVERSOR
|--------------------------------------------------------------------------
|
| Archivo Node.js que utiliza Playwright
| para abrir la URL y generar el PDF.
|
*/

define(
    'CONVERTER_PATH',
    BASE_PATH .
    DIRECTORY_SEPARATOR .
    'node' .
    DIRECTORY_SEPARATOR .
    'converter.js'
);


/*
|--------------------------------------------------------------------------
| CARPETA DE PDFs
|--------------------------------------------------------------------------
*/

define(
    'DOWNLOAD_PATH',
    BASE_PATH .
    DIRECTORY_SEPARATOR .
    'public' .
    DIRECTORY_SEPARATOR .
    'downloads'
);


/*
|--------------------------------------------------------------------------
| CREAR CARPETA DE DESCARGAS
|--------------------------------------------------------------------------
*/

if (!is_dir(DOWNLOAD_PATH)) {

    if (!mkdir(
        DOWNLOAD_PATH,
        0777,
        true
    )) {

        throw new RuntimeException(
            'No se pudo crear la carpeta de descargas.'
        );
    }
}


/*
|--------------------------------------------------------------------------
| COMPROBAR NODE.JS
|--------------------------------------------------------------------------
*/

if (!file_exists(NODE_PATH)) {

    throw new RuntimeException(
        'No se encontró Node.js en: ' .
        NODE_PATH
    );
}


/*
|--------------------------------------------------------------------------
| COMPROBAR CONVERSOR
|--------------------------------------------------------------------------
*/

if (!file_exists(CONVERTER_PATH)) {

    throw new RuntimeException(
        'No se encontró el conversor en: ' .
        CONVERTER_PATH
    );
}