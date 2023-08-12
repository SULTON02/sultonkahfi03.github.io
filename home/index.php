
<?php
session_start();
require '../mainconfig.php';

?>




<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $web['NamaWeb']; ?> - #1 SMM Panel Indonesia</title>
    <link rel="icon" type="image/x-icon" href="assets/border/ya.jpg"/>
    <meta name="description" content="<?= $web['Description']; ?>">
    <meta name="keywords" content="<?= $web['Keyword']; ?>">
    <meta name="author" content="">
    <meta name="theme-color" content="#9d1bfa">
    <link rel="stylesheet" href="assets/src/plugins/aos/dist/aos.css">
    <link rel="stylesheet" href="assets/src/plugins/lightgallery_js/dist/css/lightgallery.min.css">
    <link rel="stylesheet" href="assets/src/plugins/flickity/dist/flickity.min.css">
    <link rel="stylesheet" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/src/css/theme-blue.css">
    <link rel="manifest" href="assets/src/js/pwa/manifest.json">
    <link rel="apple-touch-icon" href="assets/border/ss.jpg">
    <link rel="shortcut icon" href="assets/border/ss.jpg">
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&amp;display=swap" rel="stylesheet">
</head>
<body id="top">
    <a id="skippy" class="visually-hidden-focusable" href="#content">
        <div class="container">
            <span class="skiplink-text">Skip to main content</span>
        </div>
    </a>
    <progress id="progress-bar" class="progress-one" max="100">
        <span class="progress-container">
            <span class="progress-bar"></span>
        </span>
    </progress>
    <header>
        <nav class="main-nav navbar navbar-expand-lg hover-navbar dark-to-light fixed-top navbar-dark">
            <div class="container">
                <a class="navbar-brand main-logo" href="#">
                    <!-- <img src=assets/border/ss.jpg" class="me-3"> -->
                    <span class="h2 text-white logo-light fw-bold mt-2" style="margin-left: 10px;"><?= $web['NamaWeb']; ?></span>
                    <span class="h2 text-primary logo-dark fw-bold mt-2" style="margin-left: 10px;"><?= $web['NamaWeb']; ?></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo" aria-controls="navbarTogglerDemo" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../halaman/price_list">Layanan</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarhome" class="nav-link dropdown-toggle" href="javascript:;" role="button" data-bs-toggle="dropdown" aria-expanded="false">Informasi</a>
                            <ul class="dropdown-menu dropdown-menu-lg-center" aria-labelledby="navbarhome">
                                                                    <li><a class="dropdown-item" href="../halaman/kontak-kami">Kontak</a></li>
                                                                    <li><a class="dropdown-item" href="../halaman/ketentuan_layanan">Ketentuan Layanan</a></li>
                                                                    <li><a class="dropdown-item" href="../halaman/halaman_bantuan">Halaman Bantuan</a></li>
                                                                    <li><a class="dropdown-item" href="../halaman/rules_pemesanan">Rules Pemesanan</a></li>
                                                                    <li><a class="dropdown-item" href="../halaman/web_panel">Web Panel</a></li>
                                                                    <li><a class="dropdown-item" href="../halaman/contoh_target">Contoh Target Pemesanan</a></li>
                                                            </ul>
                        </li>
                    </ul>
                                            <div class="d-grid d-lg-block my-3 my-lg-0 ms-0 ms-lg-4">
                            <a class="btn btn-white btn-sm" href="../auth/register">
                                <i class="fas fa-user-plus me-1"></i>
                                Daftar
                            </a>
                        </div>
                                        <div class="d-grid d-lg-block my-3 my-lg-0 ms-0 ms-lg-4">
                        <a class="btn btn-warning btn-sm" href="../auth/login">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            Masuk
                        </a>
                    </div>
                </div><!-- end collapse menu -->
            </div>
        </nav><!-- End Navbar -->
    </header><!-- end header -->
    <!-- =========={ MAIN }==========  -->
    <main id="content">
        <!-- =========={ HERO }==========  -->
        <div id="hero" class="section bg-gradient-primary py-8 py-lg-9 overflow-hidden">
            <!-- background overlay -->
            <div class="overlay bg-gradient-primary opacity-90 z-index-n1"></div>
            <!-- rocket moving up animation -->
            <div class="particle">
                <div class="particle-move-up d-none d-lg-block particle-move-up-1 text-light z-index-n1 opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up particle-move-up-2 text-light z-index-n1 opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1rem" height="1rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up d-none d-sm-block particle-move-up-3 text-light z-index-n1 opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up d-none d-xl-block particle-move-up-4 text-light z-index-n1 opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1rem" height="1rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up d-none d-sm-block particle-move-up-5 text-light z-index-n1 opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up border-success text-light particle-move-up-6 z-index-n1 opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up particle-move-up-7 z-index-n1 text-light opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up particle-move-up-8 z-index-n1 text-light opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="1.2rem" height="1.2rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
                <div class="particle-move-up particle-move-up-9 z-index-n1 text-light opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="rotate-315" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M461.81,53.81a4.4,4.4,0,0,0-3.3-3.39c-54.38-13.3-180,34.09-248.13,102.17a294.9,294.9,0,0,0-33.09,39.08c-21-1.9-42-.3-59.88,7.5-50.49,22.2-65.18,80.18-69.28,105.07a9,9,0,0,0,9.8,10.4l81.07-8.9a180.29,180.29,0,0,0,1.1,18.3,18.15,18.15,0,0,0,5.3,11.09l31.39,31.39a18.15,18.15,0,0,0,11.1,5.3,179.91,179.91,0,0,0,18.19,1.1l-8.89,81a9,9,0,0,0,10.39,9.79c24.9-4,83-18.69,105.07-69.17,7.8-17.9,9.4-38.79,7.6-59.69a293.91,293.91,0,0,0,39.19-33.09C427.82,233.76,474.91,110.9,461.81,53.81ZM298.66,213.67a42.7,42.7,0,1,1,60.38,0A42.65,42.65,0,0,1,298.66,213.67Z" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                        <path class="text-warning" fill="currentColor" d="M109.64,352a45.06,45.06,0,0,0-26.35,12.84C65.67,382.52,64,448,64,448s65.52-1.67,83.15-19.31A44.73,44.73,0,0,0,160,402.32" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                    </svg>
                </div>
            </div>
            <!-- scribble -->
            <figure class="scribble scale-4 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right" data-aos-delay="300">
                <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                </svg>
            </figure>
            <!-- scribble -->
            <figure class="scribble scale-5 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right" data-aos-delay="200">
                <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                </svg>
            </figure>
            <!-- scribble -->
            <figure class="scribble scale-6 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right" data-aos-delay="100">
                <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                </svg>
            </figure>
            <!-- scribble -->
            <figure class="scribble scale-7 opacity-10 top-50 start-0 z-index-n1" data-aos="fade-up-right">
                <svg class="text-secondary" width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M42.5,-66.2C57.1,-56.7,72.5,-48.4,81.1,-35.3C89.8,-22.2,91.8,-4.4,89.6,13C87.3,30.4,80.7,47.4,69.5,60.1C58.3,72.9,42.4,81.5,25.9,84.6C9.5,87.8,-7.4,85.4,-22.7,79.8C-37.9,74.1,-51.5,65.2,-60.9,53.3C-70.4,41.4,-75.8,26.6,-79,10.8C-82.1,-5,-83.1,-21.7,-77.7,-36.4C-72.4,-51,-60.7,-63.7,-46.7,-73.5C-32.7,-83.3,-16.4,-90.1,-1.2,-88.2C13.9,-86.3,27.8,-75.7,42.5,-66.2Z" transform="translate(100 100)" />
                </svg>
            </figure>
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center">
                    <!-- hero content -->
                    <div class="col-md-9 col-lg-6 align-self-center pe-lg-5" data-aos="flip-up">
                        <div class="text-center text-lg-start mt-4 mt-lg-0">
                            <div class="mb-3">
                                <span class="badge bg-secondary rounded">#1 SMM Panel Indonesia</span>
                                <!-- <span class="text-light ms-1">#1 SMM Panel Indonesia</span> -->
                            </div>
                            <div class="mb-5">
                                <h1 class="display-5 fw-bold text-white mb-3"><span class="text-warning"><?= $web['NamaWeb']; ?></span> <br> SMM Panel <span data-toggle="typed" data-options='{"strings": ["Terbaik", "Tercepat", "Termurah"]}'></span>
                                </h1>
                                <p class="lead text-light"><?= $web['NamaWeb']; ?> <?= $web['Description']; ?></p>
                            </div>
                            <a class="btn btn-warning hover-button-up" href="../auth/login">
                                <i class="fas fa-sign-in-alt me-2"></i>Masuk
                            </a>
                                                            <a class="btn btn-white hover-button-up" href="../auth/register">
                                    <i class="fas fa-user-plus me-2"></i>Daftar
                                </a>
                                                    </div>
                    </div>
                    <!-- hero image -->
                    <div class="col-md-9 col-lg-6 align-self-center">
                        <div class="px-3 px-sm-7 px-md-2 px-xl-7 mt-5 mt-lg-0 mb-n9" data-aos="fade-up" data-aos-delay="100">
                            <img class="img-fluid animated-up-down" src="assets/src/img-min/svg/start_up--blue.svg" alt="images title">
                        </div>
                    </div>
                </div><!-- end row -->
            </div>
            <!-- waves start -->
            <figure class="waves-bottom-center text-light mb-lg-n4 z-index-n1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                    <path class="opacity-20 translate-top-2" fill="currentColor" fill-opacity="1" d="M0,160L60,186.7C120,213,240,267,360,245.3C480,224,600,128,720,106.7C840,85,960,139,1080,149.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                    <path class="opacity-30 translate-top-1" fill="currentColor" fill-opacity="1" d="M0,160L60,186.7C120,213,240,267,360,245.3C480,224,600,128,720,106.7C840,85,960,139,1080,149.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                    <path fill="currentColor" fill-opacity="1" d="M0,160L60,186.7C120,213,240,267,360,245.3C480,224,600,128,720,106.7C840,85,960,139,1080,149.3C1200,160,1320,128,1380,112L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                </svg>
            </figure>
        </div><!-- end hero -->
        <!-- =========={ FEATURES }==========  -->
        <div id="features" class="section pt-5 pb-4 pb-md-5 bg-light">
            <div class="container">
                <div class="position-relative">
                    <!-- scribble -->
                    <figure class="scribble scale-2 d-none d-md-block top-0 end-0 mt-md-n4 mt-lg-n7 me-lg-7 z-index-n1">
                        <svg class="text-secondary opacity-90" width="76" height="72" viewBox="0 0 193.000000 184.000000" xmlns="http://www.w3.org/2000/svg">
                            <g transform="translate(0.000000,184.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none">
                                <path d="M633 1723 c-3 -10 -19 -51 -35 -91 -33 -84 -34 -103 -10 -124 28 -24
                53 -29 88 -18 35 12 55 48 48 91 -2 13 -6 46 -9 72 -9 69 -65 117 -82 70z"></path>
                                <path d="M1330 1613 c-27 -54 -49 -107 -48 -117 5 -37 47 -55 111 -47 80 10
                84 16 69 103 -15 85 -45 158 -66 158 -9 0 -36 -40 -66 -97z"></path>
                                <path d="M973 1513 c-3 -10 -21 -54 -39 -98 -40 -95 -41 -109 -12 -129 29 -20
                143 -22 151 -3 6 16 1 48 -19 139 -20 86 -65 137 -81 91z"></path>
                                <path d="M261 1328 c-5 -13 -21 -49 -35 -81 -32 -72 -33 -92 -2 -113 32 -20
                134 -10 144 14 10 28 -27 145 -55 174 -32 34 -41 35 -52 6z"></path>
                                <path d="M605 1306 c-8 -19 -20 -66 -26 -106 -15 -91 -6 -103 79 -103 32 0 64
                3 71 8 19 11 9 72 -23 142 -46 100 -77 118 -101 59z"></path>
                                <path d="M1319 1253 c-7 -15 -29 -66 -50 -111 -22 -46 -39 -89 -39 -96 0 -7
                11 -23 25 -36 22 -20 27 -22 55 -10 16 7 39 10 49 7 11 -3 28 1 37 8 16 11 17
                21 6 111 -16 129 -57 192 -83 127z"></path>
                                <path d="M1680 1058 c-5 -13 -25 -63 -45 -113 -20 -49 -38 -95 -41 -102 -5
                -10 9 -27 48 -59 22 -18 124 -27 148 -14 18 9 21 18 17 43 -12 70 -48 204 -63
                235 -20 38 -50 42 -64 10z"></path>
                                <path d="M903 901 c-27 -81 -28 -92 -16 -116 9 -17 20 -25 30 -21 8 3 29 6 47
                6 18 0 41 6 51 14 17 12 18 17 6 57 -54 181 -74 191 -118 60z"></path>
                                <path d="M141 913 c-15 -30 -41 -125 -41 -153 0 -50 74 -87 114 -57 19 14 19
                20 8 102 -11 86 -29 125 -58 125 -7 0 -17 -8 -23 -17z"></path>
                                <path d="M1324 813 c-4 -16 -17 -49 -30 -75 -28 -56 -29 -75 -6 -105 15 -20
                23 -21 67 -15 47 7 50 9 53 38 3 35 -24 152 -40 172 -17 20 -37 14 -44 -15z"></path>
                                <path d="M537 688 c-20 -46 -37 -90 -37 -99 0 -22 26 -43 45 -35 8 3 15 1 15
                -4 0 -15 43 -12 84 5 43 18 45 34 15 123 -19 57 -47 92 -74 92 -6 0 -28 -37
                -48 -82z"></path>
                                <path d="M995 620 c-7 -11 -55 -186 -55 -199 0 -17 42 -51 63 -51 42 0 96 21
                101 38 6 19 -29 135 -58 190 -16 32 -39 41 -51 22z"></path>
                                <path d="M1379 330 c-25 -77 -31 -105 -23 -118 11 -18 56 -36 116 -47 32 -6
                36 -4 42 18 7 30 -20 180 -40 219 -10 18 -22 28 -38 28 -20 0 -27 -12 -57
                -100z"></path>
                                <path d="M566 290 c-20 -51 -30 -113 -22 -144 7 -29 49 -46 112 -46 44 0 44 0
                44 35 0 40 -41 149 -67 177 -26 29 -49 22 -67 -22z"></path>
                            </g>
                        </svg>
                    </figure>
                </div>
                <!-- section header -->
                <header class="text-center mx-auto mb-5">
                    <h2 class="h3 fw-bold">Features</h2>
                    <hr class="divider my-4 mx-auto bg-warning border-warning">
                    <p class="lead text-muted">Fitur modern yang akan membuat Anda lebih mudah.</p>
                </header>
                <!-- row -->
                <div class="row text-center">
                    <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up">
                        <!-- service block -->
                        <div class="p-4 mb-5 rounded-3 bg-white shadow-sm hover-box-up">
                            <div class="text-primary mb-3">
                                <!-- icon -->
                                <i class="fas fa-user-shield fs-1"></i>
                            </div>
                            <h3 class="h5">Secure Data</h3>
                            <p>Seluruh pesanan diproses tanpa menggunakan password akun sosial media Anda, ini memastikan akun Anda aman.</p>
                        </div> <!-- end service block -->
                    </div>
                    <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up" data-aos-delay="100">
                        <!-- service block -->
                        <div class="p-4 mb-5 rounded-3 bg-white shadow-sm hover-box-up">
                            <div class="text-primary mb-3">
                                <!-- icon -->
                                <i class="
fas fa-headset fs-1"></i>
                            </div>
                            <h3 class="h5">Full Support</h3>
                            <p>Kami siap membantu Anda jika Anda mengalami kesulitan atau tidak mengerti terkait layanan yang kami sediakan.</p>
                        </div><!-- end service block -->
                    </div>
                    <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up" data-aos-delay="200">
                        <!-- service block -->
                        <div class="p-4 mb-5 rounded-3 bg-white shadow-sm hover-box-up">
                            <div class="text-primary mb-3">
                                <!-- icon -->
                                <i class="fas fa-desktop fs-1"></i>
                            </div>
                            <h3 class="h5">UI Responsive</h3>
                            <p>Website kami mendukung semua perangkat Anda baik Smartphone, Tablet, Desktop, ataupun perangkat lainnya.</p>
                        </div><!-- end service block -->
                    </div>
                    <div class="col-md-6 col-lg-4 px-4 px-md-3" data-aos="fade-up" data-aos-delay="200">
                        <!-- service block -->
                        <div class="p-4 mb-5 rounded-3 bg-white shadow-sm hover-box-up">
                            <div class="text-primary mb-3">
                                <!-- icon -->
                                <i class="fas fa-tags fs-1"></i>
                            </div>
                            <h3 class="h5">Low Price</h3>
                            <p>Harga Termurah & Layanan Lengkap, Cocok Untuk Reseller Atau Untuk Sendiri.</p>
                        </div><!-- end service block -->
                    </div>
                </div><!-- end row -->
            </div>
        </div><!-- End features -->
        <!-- =========={ STATISTIC }==========  -->
        <div id="counters" class="section pt-6 pt-md-7 pb-5 pb-md-6 bg-dark jarallax">
            <!-- background parallax -->
            <img class="jarallax-img" src="assets/src/img-min/bg/bg-planet.jpg" alt="title">
            <!-- background overlay -->
            <div class="overlay bg-primary opacity-80 z-index-n1"></div>
            <div class="container">
                <!-- row -->
                                <div class="row text-center text-uppercase way-refresh">
                    <div class="col-lg-4 col-sm-6">
                        <div class="p-4 bg-white rounded-3 border position-relative mb-4">
                            <div class="display-4 mb-1 text-primary">
                                <span class="counter">21.294</span><span class="small">+</span>                            </div>
                            <small class="d-block text-uppercase text-primary">Pengguna Aktif</small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="p-4 bg-white rounded-3 border position-relative mb-4">
                            <div class="display-4 mb-1 text-primary">
                                <span class="small">IDR</span> <span class="counter">2.340 <span class="small">JUTA</span></span>
                            </div>
                            <small class="d-block text-uppercase text-primary">Deposit Selesai</small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="p-4 bg-white rounded-3 border position-relative mb-4">
                            <div class="display-4 mb-1 text-primary">
                                <span class="small">IDR</span> <span class="counter">1.698 <span class="small">JUTA</span></span>
                            </div>
                            <small class="d-block text-uppercase text-primary">Pesanan Selesai</small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="p-4 bg-white rounded-3 border position-relative mb-4">
                            <div class="display-4 mb-1 text-primary">
                                <span class="small"></span> <span class="counter">1.326 <span class="small">+</span></span>
                            </div>
                            <small class="d-block text-uppercase text-primary">Total Layanan Aktif</small>
                        </div>
                    </div>
                </div><!-- end row -->
            </div>
        </div><!-- End Statistic -->
        <!-- =========={ FAQ }==========  -->
        <div id="faq" class="section py-6 py-md-7 bg-white">
            <div class="container">
                <!-- section header -->
                <header class="text-center mx-auto mb-5">
                    <h2 class="h3 fw-bold">Popular Questions</h2>
                    <hr class="divider my-4 mx-auto bg-warning border-warning">
                </header>
                <!-- row -->
                <div class="row justify-content-center">
                    <div class="accordion-list col-md-8">
                        <div id="Accordione" class="accordion">
                            <!-- faq list -->
                            <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up">
                                <div class="card-header py-2 mb-0" id="HeadingOnee">
                                    <div class="d-grid mb-0">
                                        <button class="btn btn-link btn-block btn-accordion fw-medium d-flex px-0 justify-content-between" data-bs-toggle="collapse" data-bs-target="#CollapseOnee" aria-expanded="true" aria-controls="CollapseOnee">
                                            Apa itu <?= $web['NamaWeb']; ?> ?
                                            <span class="collapse-arrow-end">
                                                <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div id="CollapseOnee" class="collapse show" aria-labelledby="HeadingOnee" data-bs-parent="#Accordione">
                                    <div class="card-body">
                                        <p><?= $web['NamaWeb']; ?> adalah platform bisnis yang menyediakan berbagai layanan social media marketing yang bergerak terutama di Indonesia. Dengan bergabung bersama kami, Anda dapat menjadi penyedia jasa social media atau reseller social media seperti jasa penambah Followers, Likes, dll. Saat ini tersedia berbagai layanan untuk social media terpopuler seperti Instagram, Facebook, Twitter, Youtube, dll.</p>
                                    </div>
                                </div>
                            </div>
                                                            <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up" data-aos-delay="100">
                                    <div class="card-header py-2 mb-0" id="HeadingTwoe">
                                        <div class="d-grid mb-0">
                                            <button class="btn btn-link btn-block btn-accordion fw-medium d-flex px-0 justify-content-between collapsed" data-bs-toggle="collapse" data-bs-target="#CollapseTwoe" aria-expanded="false" aria-controls="CollapseTwoe">
                                                Bagaimana cara mendaftar ?
                                                <span class="collapse-arrow-end">
                                                    <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="CollapseTwoe" class="collapse" aria-labelledby="HeadingTwoe" data-bs-parent="#Accordione">
                                        <div class="card-body">
                                            <p>Anda dapat mendaftar secara gratis pada halaman pendaftaran. <a href="../auth/register"><b><em>Klik Disini</em></b></a> untuk melakukan pendaftaran.</p>
                                        </div>
                                    </div>
                                </div>
                            <!-- faq list -->
                            <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up" data-aos-delay="200">
                                <div class="card-header py-2 mb-0" id="HeadingThreee">
                                    <div class="d-grid mb-0">
                                        <button class="btn btn-link btn-block btn-accordion fw-medium d-flex px-0 justify-content-between collapsed" data-bs-toggle="collapse" data-bs-target="#CollapseThreee" aria-expanded="false" aria-controls="CollapseThreee">
                                            Bagaimana cara membuat pesanan ?
                                            <span class="collapse-arrow-end">
                                                <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div id="CollapseThreee" class="collapse" aria-labelledby="HeadingThreee" data-bs-parent="#Accordione">
                                    <div class="card-body">
                                        <p>Untuk membuat pesanan sangatlah mudah, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman pesanan dengan mengklik menu yang sudah tersedia.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- faq list -->
                            <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up" data-aos-delay="300">
                                <div class="card-header py-2 mb-0" id="HeadingFoure">
                                    <div class="d-grid mb-0">
                                        <button class="btn btn-link btn-block btn-accordion fw-medium d-flex px-0 justify-content-between collapsed" data-bs-toggle="collapse" data-bs-target="#CollapseFoure" aria-expanded="false" aria-controls="CollapseFoure">
                                            Bagaimana cara deposit atau isi saldo ?
                                            <span class="collapse-arrow-end">
                                                <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div id="CollapseFoure" class="collapse" aria-labelledby="HeadingFoure" data-bs-parent="#Accordione">
                                    <div class="card-body">
                                        <p>Untuk melakukan deposit atau isi saldo sangatlah mudah, Anda hanya perlu masuk terlebih dahulu ke akun Anda dan menuju halaman deposit dengan mengklik menu yang sudah tersedia. Kami menyediakan deposit otomatis melalui bank, ewallet dan pulsa. Anda juga dapat deposit atau isi saldo secara manual dengan cara menghubungi salah satu tim kami.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- faq list -->
                            <div class="card mb-3 border-0 collapse-shadow" data-aos="fade-up" data-aos-delay="300">
                                <div class="card-header py-2 mb-0" id="HeadingFive">
                                    <div class="d-grid mb-0">
                                        <button class="btn btn-link btn-block btn-accordion fw-medium d-flex px-0 justify-content-between collapsed" data-bs-toggle="collapse" data-bs-target="#CollapseFive" aria-expanded="false" aria-controls="CollapseFive">
                                            Apakah saya bisa melakukan pemesanan melalui website saya ?
                                            <span class="collapse-arrow-end">
                                                <svg class="bi bi-chevron-down" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div id="CollapseFive" class="collapse" aria-labelledby="HeadingFive" data-bs-parent="#Accordione">
                                    <div class="card-body">
                                        <p>Tentu saja bisa, kami menyediakan fitur <b><em>Rest API</em></b> untuk memudahkan Anda melakukan transaksi diluar website kami.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
            </div>
        </div><!-- End FAQ -->
    </main><!-- end main -->
    <!-- =========={ FOOTER }==========  -->
    <footer class="bg-secondary">
        <!--Start footer copyright-->
        <div class="footer-dark">
            <div class="container py-4 border-top border-smooth">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="d-block my-3">&copy; <?= date ('Y') ?> <b><?= $web['NamaWeb']; ?>.</b> Crafted with <i class="fas fa-heart text-danger"></i> by <b>MediaStore</b></p>
                    </div>
                </div>
            </div>
        </div>
        <!--End footer copyright-->
    </footer><!-- End Footer -->
    <script>
    var url = 'https://cdn.vuexy.id/assets/js/whatsappWidget.js';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
  "enabled":true,
  "chatButtonSetting":{
      "backgroundColor":"#4D4C7D",
      "ctaText":"",
      "borderRadius":"20",
      "marginLeft":"0",
      "marginBottom":"15",
      "marginRight":"15",
      "position":"right"
  },
  "brandSetting":{
      "brandName":"Sulton",
      "brandSubTitle":"Online",
    "brandImg":"https://i.postimg.cc/BbWg6NGJ/e3b28f8be6592e66e9f3468bb28d918e.jpg",
      "welcomeText":"Halo Kak, apakah ada yang bisa kami bantu?",
      "messageText":"Halo kak",
      "backgroundColor":"#4D4C7D",
      "ctaText":"Hubungi kami",
      "borderRadius":"25",
      "autoShow":false,
      "phoneNumber":"6282231484231"
  }
};
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
      var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
    <!-- =========={ SCROLL TO TOP }==========  -->
    <a href="#top" class="p-3 border position-fixed end-1 bottom-1 z-index-10 back-top" title="Scroll To Top">
        <!-- <i class="fas fa-arrow-up"></i> -->
        <svg class="bi bi-arrow-up" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
            <path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z" clip-rule="evenodd"></path>
        </svg>
    </a>
    <!-- =========={ JAVASCRIPT }==========  -->
    <!-- Popper and Bootstrap js -->
    <script src="assets/src/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Plugin js -->
    <script src="assets/src/plugins/jarallax/dist/jarallax.min.js"></script>
    <script src="assets/src/plugins/jarallax/dist/jarallax-video.min.js"></script>
    <script src="assets/src/plugins/lightgallery_js/dist/js/lightgallery.min.js"></script>
    <script src="assets/src/plugins/lightgallery_js/demo/js/lg-thumbnail.min.js"></script>
    <script src="assets/src/plugins/lightgallery_js/demo/js/lg-video.js"></script>
    <script src="assets/src/plugins/aos/dist/aos.js"></script>
    <script src="assets/src/plugins/waypoints/lib/noframework.waypoints.min.js"></script>
    <script src="assets/src/plugins/counterup2/dist/index.js"></script>
    <script src="assets/src/plugins/flickity/dist/flickity.pkgd.min.js"></script>
    <script src="assets/src/plugins/typed_js/lib/typed.min.js"></script>
    <script src="assets/src/plugins/isotope-layout/dist/isotope.pkgd.min.js"></script>
    <script src="assets/src/plugins/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="assets/src/plugins/vanilla-lazyload/dist/lazyload.min.js"></script>
    <script src="assets/src/plugins/hc-sticky/dist/hc-sticky.js"></script>
    <!-- Theme js -->
    <script src="assets/src/js/theme.js"></script>
    <!-- JS Optimize -->
    </body>
</html>

