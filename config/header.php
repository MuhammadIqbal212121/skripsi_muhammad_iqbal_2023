<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Puskesmas Sungai Besar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- SweetAlert2 -->
  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>

  <script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
  </script>

</head>
<?php
include '../config/koneksi.php';
$akun = mysqli_query($koneksi, "SELECT * FROM login WHERE id_login = " . $_SESSION['id_login']);
$data_akun = mysqli_fetch_array($akun);
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">



    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <img src="../img/kopdinas.png" alt="Logo" class="brand-image elevation-3" style="margin-left:0px">
        <span class="brand-text font-weight-light">Puskesmas Sungai Besar</span>

      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= $data_akun['foto'] ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="akun.php" class="d-block"><?= $data_akun['username'] ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>
            <?php
            if (isset($_SESSION['id_login'])) {

            ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Master Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="poli.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Poli</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="dokter.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dokter</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pasien.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pasien</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="hamil.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ibu Hamil</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="anak.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Anak</p>
                    </a>
                  </li>
                </ul>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clock"></i>
                  <p>
                    Penjadwalan
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="antrianpasien.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Antrian Pasien</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="jadwal.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Dokter</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="karang_gigi.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Karang gigi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="imunisasi.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Imunisasi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="jadwal_hamil.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ibu Hamil</p>
                    </a>
                  </li>
                </ul>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-bar"></i>
                  <p>
                    Chart
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="chart.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chart Poli</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="chart_imunisasi.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chart Imunisasi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="chart_antrian.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chart antrian</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="chart_hamil.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Chart Ibu Hamil</p>
                    </a>
                  </li>
                </ul>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Cetak Data / Report
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="laporan_antrian.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Antrian</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan_poli_rekapitulasi.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Rekapitulasi / Poli</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan_poli_keluhan.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Rekapitulasi / Poli / Keluhan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan_jadwal_gigi.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Karang Gigi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan_jadwal_hamil.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Ibu Hamil / Bulan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan_jadwal_hamil_tgl.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Ibu Hamil / Hari</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan_jadwal_imunisasi.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Imunisasi / Bulan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="laporan_jadwal_imunisasi_tgl.php" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Imunisasi / Hari</p>
                    </a>
                  </li>

                </ul>
              <?php
            } ?>
              <li class="nav-item">
                <a href="../config/logout.php" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    LogOut
                  </p>
                </a>
              </li>
              </li>
              </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $page ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"><?= $page ?></a></li>
                <li class="breadcrumb-item active"><?php isset($_GET['page']) ? print($_GET['page']) : "" ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->