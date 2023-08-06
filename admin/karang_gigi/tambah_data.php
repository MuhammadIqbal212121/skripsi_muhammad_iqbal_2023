<?php
if (isset($_POST['save'])) {
  foreach ($_POST as $key => $value) {
    ${$key} = $value;
  }
  $cek = mysqli_query($koneksi, "SELECT * FROM jadwal_gigi WHERE tgl_jadwal = '$tgl_jadwal'");
  $day = date('D', strtotime($tgl_jadwal));
  if ($dayList[$day] != "Selasa") {
?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Hari Yang Anda Input Bukan Hari Selasa, Silakan Inputkan Dengan Hari Selasa'
      });
    </script>
  <?php
  } elseif (mysqli_num_rows($cek) > 0) {
  ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Data Pada Tanggal Tersebut Sudah Ada'
      });
    </script>
    <?php
  } else {
    $query = mysqli_query($koneksi, "INSERT INTO jadwal_gigi SET id_pasien = '$id_pasien', tgl_jadwal = '$tgl_jadwal'");
    if ($query) {
    ?>
      <script>
        window.location = "karang_gigi.php?msg=success";
      </script>
    <?php
    } else {
      $e = "Mysql Error " . mysqli_errno($koneksi);
    ?>
      <script>
        Toast.fire({
          icon: 'error',
          title: '<?= $e ?>'
        });
      </script>
      <?php
      ?>
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
          <h3 class="card-title">Tambah Data <?= $page ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nama Pasien</label>
              <select name="id_pasien" class="form-control select2">
                <option value=""> --Pilih -- </option>
                <?php
                $q = mysqli_query($koneksi, "SELECT * FROM pasien");
                while ($data = mysqli_fetch_array($q)) {
                ?>
                  <option value="<?= $data['id_pasien'] ?>"><?= $data['nik_pasien'] . ' / ' . $data['nama_pasien'] ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Tanggal Jadwal</label>
              <input type="date" name="tgl_jadwal" class="form-control" required>
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