<?php
if (isset($_POST['save'])) {
  foreach ($_POST as $key => $value) {
    ${$key} = $value;
  }
  $query = mysqli_query($koneksi, "INSERT INTO jadwaldokter SET id_dokter = '$id_dokter', id_poliklinik = '$id_poliklinik', 
    hari = '$hari', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai'");
  if ($query) {
    ?>
    <script>
      window.location = "jadwal.php?msg=success";
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
            <div class="form-group">
              <label>Nama Dokter</label>
              <select name="id_dokter" class="form-control select2" required>
                <option value=""> --Pilih-- </option>
                <?php $sql = mysqli_query($koneksi, "SELECT * FROM dokter");
                while ($data = mysqli_fetch_array($sql)) { ?>
                  <option value="<?= $data[0] ?>"><?= $data['nama'] . ' / ' . $data['spesialisasi'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Hari</label>
              <input type="text" name="hari" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Jam Mulai</label>
              <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Jam Selesai</label>
              <input type="time" name="jam_selesai" class="form-control" required>
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