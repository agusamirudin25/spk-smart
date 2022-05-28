<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Pendukung Keputusan Penilaian Kinerja Guru</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('') ?>assets/images/logo/favicon.png">

    <!-- Core css -->
    <link href="<?= base_url('') ?>assets/css/app.min.css" rel="stylesheet" />
     <!-- Core Vendors JS -->
    <script src="<?= base_url('') ?>assets/js/vendors.min.js"></script>

    <!-- Core JS -->
    <script src="<?= base_url('') ?>assets/js/app.min.js"></script>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="<?= base_url('') ?>">
                        <img src="<?= base_url('') ?>assets/images/logo/logo.png" alt="Logo">
                        <img class="logo-fold" src="<?= base_url('') ?>assets/images/logo/logo-fold.png" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="<?= base_url('') ?>">
                        <img src="<?= base_url('') ?>assets/images/logo/logo-white.png" alt="Logo">
                        <img class="logo-fold" src="<?= base_url('') ?>assets/images/logo/logo-fold-white.png" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">

                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img src="<?= base_url() ?>assets/images/avatars/thumb-1.jpg" alt="">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold"><?= session_get('nama') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('Auth/logout') ?>" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Dashboard') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <?php if(session_get('type') == 1) : ?>
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Pengguna') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-user"></i>
                                </span>
                                <span class="title">Kelola Pengguna</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Guru') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-team"></i>
                                </span>
                                <span class="title">Kelola Guru</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Kriteria') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-hdd"></i>
                                </span>
                                <span class="title">Kelola Kriteria</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Kompetensi') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-bars"></i>
                                </span>
                                <span class="title">Kelola Kompetensi</span>
                            </a>
                        </li>
                        <?php else : ?>
                            <li class="nav-item dropdown">
                                <a href="<?= base_url('Kuesioner') ?>">
                                    <span class="icon-holder">
                                        <i class="anticon anticon-read"></i>
                                    </span>
                                    <span class="title">Kuesioner</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Keputusan') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-switcher"></i>
                                </span>
                                <span class="title">Keputusan</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Laporan') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-file-pdf"></i>
                                </span>
                                <span class="title">Laporan</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="<?= base_url('Auth/logout') ?>">
                                <span class="icon-holder">
                                    <i class="anticon anticon-logout"></i>
                                </span>
                                <span class="title">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">