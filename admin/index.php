<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['id_login'])) {
    echo "<script>
    alert('Silakan Login Kembali !');
    window.location = '../index.php';
    </script>";
}else {
$page = "Dashboard";
include '../config/header.php';

?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] == "success") {
  ?>
   <script>
   Swal.fire({
     icon: 'success',
     title: 'Berhasil Di Proses'
   });
      </script>
  <?php
}
?>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <!-- Default box -->
        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Antrian</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th>No Antrian</th>
                  <th>Nama Pasien</th>
                  <th>Jenis Kelamin</th>
                  <th>Jam Datang</th>
                  <th>Status</th>
                  <th>Opsi</th>
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
                        <td class="project-actions text-right">
                          <?php 
 if ($data['status_antrian'] == 0) {
                          ?>
                          <a class="btn btn-info btn-sm" href="proses.php?id=<?= $data['id_antrian'] ?>">
                              <i class="fas fa-spinner">
                              </i>
                             Proses
                          </a>
                          <?php }
                          ?>
            </td>
                  </tr>
                <?php
                }
                ?>

              </tbody>
             
            </table>
<hr/>   
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <?php
include '../config/footer.php';
}
?>
