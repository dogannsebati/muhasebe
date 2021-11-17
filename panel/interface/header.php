<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Muhasebe Panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="style/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="style/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="style/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="style/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="style/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="style/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="style/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="style/dist/css/admin.css">
    <link rel="icon" type="image/png" href="style/resim/logo.png">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index" class="brand-link">
                <img src="style/resim/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Muhasebe</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">Hoşgeldiniz <?= $SH->getAdminSession()['ad_soyad'] ?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="index" style="background-color:green" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    ANASAYFA
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu">
                            <a href="" class="nav-link">
                                <i class="fas fa-lira-sign"></i></i>
                                <p>
                                    GELİRLER
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="alacaklar-1" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ALACAKLAR</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="satislar-1" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SATIŞLAR</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu">
                            <a href="#" class="nav-link">
                                <i class="fas fa-lira-sign"></i>
                                <p>
                                    GİDERLER
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="masraflar-1" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>MASRAFLAR</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="odemeler-1" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ÖDEMELER</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="personel-1" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>PERSONEL</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item menu">
                            <a href="nakit-1" class="nav-link">
                                <i class="fas fa-lira-sign"></i>
                                <p>
                                    NAKİT YÖNETİMİ
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    ÇIKIŞ YAP
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>