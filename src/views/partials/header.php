<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clinica - Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= $base ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= $base ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="<?= $base ?>/assets/css/google-fonts.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/css/material-icons.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= $base ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= $base ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/css/style_search.css" rel="stylesheet">
    <link href="<?= $base ?>/assets/css/sweetalert2.css" rel="stylesheet">

    <script src="<?= $base ?>/assets/js/jquery.js"></script>
    <script src="<?= $base ?>/assets/js/sweetalert2.js"></script>

    <!-- =======================================================
  * Template Name: Presento - v3.2.0
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="<?= $base ?>">Clínica<span>.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt=""></a>-->
            <div class="search-container">
                <input class="search-input" type='search' placeholder="Procure um serviço" id="search_input" />
                <span class="search-icon" id="search_icon">
                    <i class="material-icons" style="color: white;">search</i>
                </span>
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0">



                <ul>
                    <li><a class="nav-link scrollto" href="<?= $base ?>">Home</a></li>
                    <!--<li><a class="nav-link scrollto" href="#about">Sobre</a></li>
                    <li><a class="nav-link scrollto " href="#portfolio">Galeria</a></li>
                    <li><a class="nav-link scrollto" href="#team">Time de Médicos</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Entre em contato</a></li>-->
                    <li class="dropdown"><a href="#"><span>Agendar</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= $base ?>/unidades/exames">Agendar Exame</a></li>
                            <li><a href="<?= $base ?>/unidades/procedimentos">Agendar Procedimento</a></li>
                            <li><a href="<?= $base ?>/unidades/consultas">Agendar Consulta</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Marcados</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= $base ?>/exames/agendados">Exames Marcados</a></li>
                            <li><a href="<?= $base ?>/procedimentos/agendados">Procedimentos Marcados</a></li>
                            <li><a href="<?= $base ?>/consultas/agendados">Consultas Marcados</a></li>

                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Realizados</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= $base ?>/exames/realizados">Exames Realizados</a></li>
                            <li><a href="<?= $base ?>/procedimentos/realizados">Procedimentos Realizados</a></li>
                            <li><a href="<?= $base ?>/consultas/realizados">Consultas Realizados</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="<?= $base ?>/signout" class="get-started-btn">Logout</a>
        </div>
    </header>