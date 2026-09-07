# URL2PDF

> Plataforma web para convertir páginas web en documentos PDF a partir de una URL.

![URL2PDF](https://img.shields.io/badge/URL2PDF-Web%20to%20PDF-2563EB?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-20.x-339933?style=for-the-badge&logo=node.js&logoColor=white)
![Playwright](https://img.shields.io/badge/Playwright-Chromium-2EAD33?style=for-the-badge&logo=playwright&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

---

## 📋 Descripción

**URL2PDF** es una aplicación web diseñada para convertir páginas web en documentos PDF de manera rápida y sencilla.

El usuario introduce una dirección URL, el sistema verifica que el enlace sea válido y accesible, posteriormente procesa la página mediante un navegador Chromium automatizado y genera un documento PDF listo para descargar.

El proyecto combina un frontend desarrollado con **HTML, Bootstrap y JavaScript**, un backend basado en **PHP** y un motor de conversión desarrollado con **Node.js y Playwright**.

---

## ✨ Características

- Conversión de páginas web a PDF.
- Validación de URLs.
- Compatibilidad con protocolos HTTP y HTTPS.
- Renderizado de páginas mediante Chromium.
- Soporte para contenido generado mediante JavaScript.
- Generación de documentos en formato A4.
- Conservación de fondos y estilos de la página.
- Descarga automática del PDF.
- Eliminación del archivo temporal después de la descarga.
- Interfaz responsive.
- Diseño basado en Bootstrap 5.
- Indicador de procesamiento.
- Mensajes de validación y errores.
- Arquitectura separada entre frontend, backend y motor de conversión.

---

## 🛠️ Tecnologías utilizadas

### Frontend

- HTML5
- CSS3
- JavaScript
- Bootstrap 5.3
- Bootstrap Icons

### Backend

- PHP 8.x
- cURL
- PHP Sessions / HTTP handling
- File System API

### Motor de conversión

- Node.js 20+
- npm
- Playwright
- Chromium

### Servidor de desarrollo

- Apache
- XAMPP

---

## 🏗️ Arquitectura

La aplicación utiliza una arquitectura híbrida:

```text
                    ┌─────────────────────┐
                    │       Usuario       │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │     index.php       │
                    │  Interfaz Bootstrap │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │       app.js        │
                    │ Validación cliente  │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │   verificar.php     │
                    │  Validación URL     │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │    convertir.php    │
                    │ Orquestación PHP    │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      Node.js        │
                    │     Playwright      │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      Chromium       │
                    │ Renderizado web     │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │      archivo.pdf    │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │    descargar.php    │
                    │  Descarga del PDF   │
                    └─────────────────────┘
