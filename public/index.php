
<?php



?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="URL2PDF - Convierte cualquier página web en un archivo PDF."
    >

    <title>URL2PDF | Convertidor de URL a PDF</title>


    <!-- =========================================================
         BOOTSTRAP 5
    ========================================================== -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- =========================================================
         BOOTSTRAP ICONS
    ========================================================== -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- =========================================================
         CSS PERSONALIZADO
    ========================================================== -->

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body class="bg-light">


<!-- =============================================================
     NAVBAR
============================================================== -->

<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">

    <div class="container py-2">

        <!-- LOGO -->

        <a
            href="index.php"
            class="navbar-brand d-flex align-items-center gap-2 fw-bold"
        >

            <span
                class="d-flex align-items-center justify-content-center bg-primary text-white rounded-3"
                style="width:42px;height:42px;"
            >
                <i class="bi bi-file-earmark-pdf-fill fs-5"></i>
            </span>

            <span class="fs-4">
                URL<span class="text-primary">2PDF</span>
            </span>

        </a>


        <!-- ESTADO -->

        <div
            class="d-flex align-items-center gap-2 text-success fw-semibold"
        >

            <span
                class="rounded-circle bg-success"
                style="width:10px;height:10px;"
            ></span>

            Servicio disponible

        </div>

    </div>

</nav>



<!-- =============================================================
     HERO
============================================================== -->

<main>

<section class="py-5">

    <div class="container">

        <!-- HERO TEXT -->

        <div class="row justify-content-center text-center">

            <div class="col-lg-8">

                <span class="badge bg-primary-subtle text-primary px-3 py-2 mb-3">

                    <i class="bi bi-lightning-charge-fill"></i>

                    Conversión rápida y sencilla

                </span>


                <h1 class="display-4 fw-bold mb-3">

                    Convierte cualquier
                    <span class="text-primary">
                        URL a PDF
                    </span>

                </h1>


                <p class="lead text-secondary">

                    Introduce el enlace de una página web,
                    verifica que esté disponible y conviértela
                    en un documento PDF en pocos segundos.

                </p>

            </div>

        </div>



        <!-- =====================================================
             CONVERTER CARD
        ====================================================== -->

        <div class="row justify-content-center mt-5">

            <div class="col-lg-8 col-xl-7">

                <div class="card border-0 shadow-lg rounded-4">

                    <div class="card-body p-4 p-md-5">


                        <!-- HEADER -->

                        <div class="text-center mb-4">

                            <div
                                class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3"
                                style="width:60px;height:60px;"
                            >

                                <i
                                    class="bi bi-globe2 fs-3"
                                ></i>

                            </div>


                            <h2 class="h3 fw-bold">

                                Convertir página web

                            </h2>


                            <p class="text-secondary mb-0">

                                Pega la URL que deseas convertir.

                            </p>

                        </div>



                        <!-- =================================================
                             FORM
                        ================================================== -->

                        <form
                            id="urlForm"
                            action="convertir.php"
                            method="POST"
                        >


                            <!-- URL -->

                            <div class="mb-3">

                                <label
                                    for="url"
                                    class="form-label fw-semibold"
                                >

                                    URL de la página

                                </label>


                                <div class="input-group input-group-lg">

                                    <span class="input-group-text bg-white">

                                        <i
                                            class="bi bi-link-45deg text-primary"
                                        ></i>

                                    </span>


                                    <input
                                        type="url"
                                        id="url"
                                        name="url"
                                        class="form-control"
                                        placeholder="https://ejemplo.com"
                                        autocomplete="off"
                                        required
                                    >

                                </div>

                            </div>



                            <!-- =================================================
                                 MENSAJE
                            ================================================== -->

                            <div
                                id="urlMessage"
                                class="message mb-3"
                            ></div>



                            <!-- =================================================
                                 BUTTONS
                            ================================================== -->

                            <div class="d-grid gap-2 d-md-flex">

                                <button
                                    type="button"
                                    id="verifyButton"
                                    class="btn btn-outline-primary btn-lg flex-fill"
                                >

                                    <i class="bi bi-check-circle me-2"></i>

                                    Verificar enlace

                                </button>


                                <button
                                    type="submit"
                                    id="convertButton"
                                    class="btn btn-primary btn-lg flex-fill"
                                    disabled
                                >

                                    <i class="bi bi-file-earmark-pdf me-2"></i>

                                    Generar PDF

                                </button>

                            </div>



                            <!-- =================================================
                                 LOADING
                            ================================================== -->

                            <div
                                id="loading"
                                class="alert alert-primary mt-4 hidden"
                            >

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="spinner-border text-primary"
                                        role="status"
                                    >

                                        <span class="visually-hidden">
                                            Cargando...
                                        </span>

                                    </div>


                                    <div>

                                        <strong>
                                            Generando PDF...
                                        </strong>


                                        <p class="mb-0 small">

                                            Estamos procesando la página web.
                                            Esto puede tardar unos segundos.

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



        <!-- =====================================================
             FEATURES
        ====================================================== -->

        <div class="row g-4 mt-5">


            <!-- FEATURE 1 -->

            <div class="col-md-4">

                <div class="card h-100 border-0 shadow-sm rounded-4">

                    <div class="card-body p-4 text-center">

                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle mb-3"
                            style="width:55px;height:55px;"
                        >

                            <i class="bi bi-check-lg fs-4"></i>

                        </div>


                        <h3 class="h5 fw-bold">
                            Fácil de usar
                        </h3>


                        <p class="text-secondary mb-0">

                            Solo introduce la URL,
                            verifica el enlace y genera tu PDF.

                        </p>

                    </div>

                </div>

            </div>



            <!-- FEATURE 2 -->

            <div class="col-md-4">

                <div class="card h-100 border-0 shadow-sm rounded-4">

                    <div class="card-body p-4 text-center">

                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-warning-subtle text-warning rounded-circle mb-3"
                            style="width:55px;height:55px;"
                        >

                            <i class="bi bi-lightning-charge-fill fs-4"></i>

                        </div>


                        <h3 class="h5 fw-bold">
                            Conversión rápida
                        </h3>


                        <p class="text-secondary mb-0">

                            Procesamos las páginas automáticamente
                            utilizando tecnología de renderizado web.

                        </p>

                    </div>

                </div>

            </div>



            <!-- FEATURE 3 -->

            <div class="col-md-4">

                <div class="card h-100 border-0 shadow-sm rounded-4">

                    <div class="card-body p-4 text-center">

                        <div
                            class="d-inline-flex align-items-center justify-content-center bg-info-subtle text-info rounded-circle mb-3"
                            style="width:55px;height:55px;"
                        >

                            <i class="bi bi-shield-lock-fill fs-4"></i>

                        </div>


                        <h3 class="h5 fw-bold">
                            Proceso seguro
                        </h3>


                        <p class="text-secondary mb-0">

                            Los archivos generados son temporales
                            y se eliminan después de la descarga.

                        </p>

                    </div>

                </div>

            </div>

        </div>



        <!-- =====================================================
             SECURITY
        ====================================================== -->

        <div class="row justify-content-center mt-5">

            <div class="col-lg-9">

                <div class="alert alert-light border shadow-sm rounded-4 p-4">

                    <div class="d-flex gap-3">

                        <div>

                            <i
                                class="bi bi-shield-check text-success fs-2"
                            ></i>

                        </div>


                        <div>

                            <h3 class="h5 fw-bold">

                                Tu información está protegida

                            </h3>


                            <p class="text-secondary mb-0">

                                URL2PDF procesa únicamente la dirección
                                web que proporcionas. Los archivos PDF
                                generados son temporales y se eliminan
                                después de la descarga.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

</main>



<!-- =============================================================
     FOOTER
============================================================== -->

<footer class="bg-dark text-white py-4">

    <div class="container">

        <div class="row align-items-center">


            <div class="col-md-6 text-center text-md-start">

                <h5 class="mb-1">
                    <i class="bi bi-file-earmark-pdf-fill me-2"></i>
                    URL2PDF
                </h5>

                <p class="text-white-50 mb-0">

                    Conversor de páginas web a PDF.

                </p>

            </div>


            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">

                <small class="text-white-50">

                    © <?php echo date('Y'); ?> URL2PDF

                </small>

            </div>

        </div>

    </div>

</footer>



<!-- =============================================================
     BOOTSTRAP JS
============================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>



<!-- =============================================================
     APP JS
============================================================== -->

<script
    src="assets/js/app.js"
></script>


</body>

</html>