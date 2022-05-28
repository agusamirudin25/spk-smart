<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Sistem Pendukung Keputusan Menentukan Ekstrakurikuler Siswa</title>
    <meta name="description" content="Sistem Pendukung Keputusan Menentukan Ekstrakurikuler Siswa" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/favicon.ico') ?>">
    <link rel="icon" href="<?= base_url('assets/favicon.ico') ?>" type="image/x-icon">

    <!-- Toggles CSS -->
    <link href="<?= base_url('assets/vendors/jquery-toggles/css/toggles.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/vendors/jquery-toggles/css/themes/toggles-light.css') ?>" rel="stylesheet" type="text/css">

    <!-- Toastr CSS -->
    <link href="<?= base_url('assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.css') ?>" rel="stylesheet" type="text/css">

    <link href="<?= base_url('assets') ?>/vendors/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets') ?>/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/dist/css/style.css') ?>" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="<?= base_url('assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="<?= base_url() ?>">
                <h3>SPK</h3>
            </a>
            <ul class="navbar-nav hk-navbar-content">
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-body">
                                <span><?= session_get('nama') ?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <a class="dropdown-item" href="<?= base_url('Auth/logout') ?>"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-light">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Dashboard') ?>">
                                <span class="feather-icon"><i data-feather="chrome"></i></span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Pengguna') ?>">
                                <span class="feather-icon"><i data-feather="users"></i></span>
                                <span class="nav-link-text">Pengguna</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Kriteria') ?>">
                                <span class="feather-icon"><i data-feather="cpu"></i></span>
                                <span class="nav-link-text">Kriteria</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Alternatif') ?>">
                                <span class="feather-icon"><i data-feather="command"></i></span>
                                <span class="nav-link-text">Alternatif</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Penilaian') ?>">
                                <span class="feather-icon"><i data-feather="server"></i></span>
                                <span class="nav-link-text">Penilaian</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('Auth/logout') ?>">
                                <span class="feather-icon"><i data-feather="log-out"></i></span>
                                <span class="nav-link-text">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->

        <!-- Main Content -->
        <div class="hk-pg-wrapper">