<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../frontend/login.php");
    exit();
}

$page = isset($_GET['p']) ? $_GET['p'] : 'dashboard';
$role = $_SESSION['role'];

?>


<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>Dashboard</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="../assets/images/favicon.svg" type="image/x-icon"> <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="../assets/fonts/feather.css" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="../assets/fonts/fontawesome.css" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="../assets/fonts/material.css" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" >
<link rel="stylesheet" href="../assets/css/style-preset.css" >

</head>
<!-- [Head] end -->

<!-- [Body] Start -->
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
    </div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header mt-2">
        <a href="?p=dashboard" class="b-brand text-primary">
            <span class="pc-mtext ">
               <h3>Wali Nagari</h3>
            </span>
        </a>
        </div>
        <div class="navbar-content">
        <ul class="pc-navbar">
    <?php 
    if ($role == 'admin'): 
    ?>
        <li class="pc-item <?= ($page == 'dashboard') ? 'active' : ''; ?>">
            <a href="?p=dashboard" class="pc-link">
                <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                <span class="pc-mtext">Dashboard</span>
            </a>
        </li>
        <li class="pc-item <?= ($page == 'penduduk') ? 'active' : ''; ?>">
            <a href="?p=penduduk" class="pc-link">
                <span class="pc-micon"><i class="ti ti-file"></i></span>
                <span class="pc-mtext">Data Penduduk</span>
            </a>
        </li>
        <li class="pc-item <?= ($page == 'struktur') ? 'active' : ''; ?>">
            <a href="?p=struktur" class="pc-link">
                <span class="pc-micon"><i class="ti ti-users"></i></span>
                <span class="pc-mtext">Struktur</span>
            </a>
        </li>
        <li class="pc-item <?php echo ($page == 'berita') ? 'active' : ''; ?>">
        <a href="?p=berita" class="pc-link">
            <span class="pc-micon"><i class="ti ti-news"></i></span>
            <span class="pc-mtext">Berita</span>
        </a>
        </li>
    <?php endif; ?>

    <?php if ($role == 'admin' || $role == 'sekretaris'): ?>
        <li class="pc-item <?= ($page == 'visi') ? 'active' : ''; ?>">
            <a href="?p=visi" class="pc-link">
                <span class="pc-micon"><i class="ti ti-eye"></i></span>
                <span class="pc-mtext">Visi & Misi</span>
            </a>
        </li>
        <li class="pc-item <?= ($page == 'sejarah') ? 'active' : ''; ?>">
            <a href="?p=sejarah" class="pc-link">
                <span class="pc-micon"><i class="ti ti-book"></i></span>
                <span class="pc-mtext">Sejarah</span>
            </a>
        </li>
        <li class="pc-item <?= ($page == 'galeri') ? 'active' : ''; ?>">
            <a href="?p=galeri" class="pc-link">
                <span class="pc-micon"><i class="ti ti-camera"></i></span>
                <span class="pc-mtext">Galeri</span>
            </a>
        </li>
    <?php endif; ?>

    <li class="pc-item">
        <a href="logout.php" class="pc-link">
            <span class="pc-micon"><i class="ti ti-logout"></i></span>
            <span class="pc-mtext">Logout</span>
        </a>
    </li>
</ul>

        </div>
    </div>
    </nav>
<!-- [ Sidebar Menu ] end --> 
 
<!-- [ Header TopBar  ] start -->
    <header class="pc-header">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none m-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <i class="ti ti-search"></i>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown drp-search">
                        <form class="px-3">
                        <div class="form-group mb-0 d-flex align-items-center">
                            <i data-feather="search"></i>
                            <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
                        </div>
                        </form>
                    </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                    <form class="header-search">
                        <i data-feather="search" class="icon-search"></i>
                        <input type="search" class="form-control" placeholder="Search here. . .">
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    <!-- [Mobile Media Block end] -->
    </header>
<!-- [ Header ] end -->


<!-- [ Main Content ] start -->
    <main>
        <div class="pc-container">
            <div class="pc-content">
                <?php
                $page=isset($_GET['p']) ? $_GET['p'] : 'dashboard';

                if ($page=='dashboard') include 'dashboard.php';
                if ($page=='penduduk') include 'penduduk.php';
                if ($page=='struktur') include 'struktur.php';
                if ($page=='visi') include 'visi.php';
                if ($page=='sejarah') include 'sejarah.php';
                if ($page=='berita') include 'berita.php';
                if ($page=='galeri') include 'galeri.php';

            ?>

            </div>
        </div>

        

    </main>



  

  <!-- [ Main Content ] end -->

  <!-- [Page Specific JS] start -->
  <script src="../assets/js/plugins/apexcharts.min.js"></script>
  <script src="../assets/js/pages/dashboard-default.js"></script>
  <!-- [Page Specific JS] end -->
  <!-- Required Js -->
  <script src="../assets/js/plugins/popper.min.js"></script>
  <script src="../assets/js/plugins/simplebar.min.js"></script>
  <script src="../assets/js/plugins/bootstrap.min.js"></script>
  <script src="../assets/js/fonts/custom-font.js"></script>
  <script src="../assets/js/pcoded.js"></script>
  <script src="../assets/js/plugins/feather.min.js"></script>
  <script>layout_change('light');</script>
  <script>change_box_container('false');</script>
  <script>layout_rtl_change('false');</script>
  <script>preset_change("preset-1");</script>
  <script>font_change("Public-Sans");</script>
  
    

</body>
<!-- [Body] end -->

</html>