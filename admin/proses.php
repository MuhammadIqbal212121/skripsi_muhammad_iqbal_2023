<?php
session_start();
if (!isset($_SESSION['id_login'])) {
  echo "<script>
    alert('Silakan Login Kembali !');
    window.location = '../index.php';
    </script>";
} else {
  $page = "Karyawan";
  include '../config/header.php';
  if (isset($_POST['save'])) {
    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    $id = $_GET['id'];
    $cek = mysqli_query($koneksi, "SELECT COUNT(id_antrian) AS jumlah FROM antrianpasien WHERE DATE(waktu) = NOW()");
    $nomer = mysqli_fetch_array($cek);
    $nomor_antrian = $nomer['jumlah'] + 1;
    $query = mysqli_query($koneksi, "INSERT INTO antrianpasien SET antrian_id = '$id', id_poliklinik = '$id_poliklinik', waktu = NOW(), nomor_antrian = '$nomor_antrian'");
    if ($query) {
      $update = mysqli_query($koneksi, "UPDATE antrian SET status_antrian = 1 WHERE id_antrian = '$id'");
      if ($update) {
        ?>
        <script>
          window.location = "index.php?msg=success";
        </script>
        <?php
      } else {
        $e = "Mysql Error " . mysqli_errno($koneksi);
        ?>
        <script>
          Swal.fire({
            icon: 'error',
            title: '<?= $e ?>'
          });
        </script>
        <?php
      }
    }
  }
  ?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data
              <?= $page ?>
            </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="form-group">
                <label>Nama Poli</label>
                <select name="id_poliklinik" class="form-control select2" required>
                  <option value=""> --Pilih-- </option>
                  <?php $sql = mysqli_query($koneksi, "SELECT * FROM poliklinik");
                  while ($data = mysqli_fetch_array($sql)) { ?>
                    <option value="<?= $data[0] ?>"><?= $data['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <input type="submit" value="Submit" name="save" class="btn btn-primary float-right">
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
  <!-- /.content -->
  <?php
  include '../config/footer.php';
}
?>