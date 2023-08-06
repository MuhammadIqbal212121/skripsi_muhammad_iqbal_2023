<?php
  include 'config/koneksi.php';
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $pass = md5($_POST['password']);
  $query = mysqli_query($koneksi, "SELECT * FROM `login` WHERE username = '$username' AND password = '$pass'");
if (mysqli_num_rows($query) > 0) {
  $data = mysqli_fetch_array($query);
  session_start();
  $_SESSION['id_login'] = $data['id_login'];
  $_SESSION['username'] = $data['username'];
    echo "<script>
    alert('Berhasil Login');
    window.location = 'admin/index.php';
    </script>";
}else {
  echo "<script>
  alert('Username Atau Password Salah');
  </script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Puskesmas Sungai Besar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="">
<div class="container-fluid mt-4 mb-5">

<div class="col-12 text-center">
  <img src="img/kopbjb.png" class="float-left mt-4 w-2">
  <img src="img/kopdinas.png" class="float-right mt-4">
  <b style="color: #000000; font-size: 20px; text-shadow: 2px 2px #D1D1D1;">PEMERINTAH KOTA BANJARBARU<br>DINAS KESEHATAN</b>
    <br><b style="color: rgba(0, 143, 55,0.7); font-size: 30px; text-shadow: 2px 2px #C7FCB9;">PUSKESMAS SUNGAI BESAR</b>
    <br><b style="color: #000000;">Alamat Kantor : Jl.Banua Praja Utara RT. 039 RW. 07 Kel. Sungai Besar Kec. Banjarbaru Selatan</b>
</div><br>

<div class="card shadow mb-2" style="margin-left: -12px; margin-right: -12px;">
    <div class="card-header py-3" style="background-color: #2DD76E;">
      <a href="daftarantrian.php" target="_blank" style="background-color:#378457; border-color:#378457;" class="btn btn-secondary float-right"><i class="fa fa-users"></i>Daftar Baru</a>
      <!-- <?php $tanggalhariini=date('Y-m-d'); date_default_timezone_set('Asia/Jakarta'); $ttp='<h3 class="float-right" style="color:#FF0000;">TUTUP (buka 07:00 - 15:00)</h3>'; $jamini='07:00';
      if($jamini >= '07:00'){if($jamini <= '15:00'){echo '';}else{echo $ttp;}} else{echo $ttp;}
      ?> -->
      <h4 style="color: #000000; text-shadow: 2px 2px #B9B9B9;">Loket Antrian Pendaftaran Online</h4>
    </div>
</div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Antrian</h3>
            <a href="login.php" class="btn btn-app float-right">
              <i class="fas fa-sign"></i>Login Admin
            </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <a href="tambah_antrian.php" class="btn btn-app">
              <i class="fas fa-plus"></i>Daftar Antrian
            </a>
            <h5>LIST ANTRIAN</h5>
            <hr />
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th>No Antrian</th>
                  <th>Nama Pasien</th>
                  <th>Jenis Kelamin</th>
                  <th>Jam Datang</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM antrian 
                INNER JOIN pasien ON antrian.id_pasien = pasien.id_pasien 
                WHERE antrian.tgl_antrian = curdate()
                ");
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {

                ?>
                  <tr>
                    <td><?= $data['no_antrian'] ?></td>
                    <td><?= $data['nama_pasien'] ?></td>
                    <td><?= $data['jk_pasien'] ?></td>
                    <td><?= $data['jam_datang'] ?></td>
                    <td><?php
                        if ($data['status_antrian'] == 0) {
                          echo " <span class='badge badge-warning'>Menunggu</span>";
                        } elseif ($data['status_antrian']  == 1) {
                          echo "<span class='badge badge-success'>Sudah Di Konfirmasi</span>";
                        } ?></td>
                  </tr>
                <?php
                }
                ?>

              </tbody>
             
            </table>
<hr/>   
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->

</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
