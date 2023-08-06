<?php
if (isset($_POST['save'])) {
  foreach ($_POST as $key => $value) {
    ${$key} = $value;
  }
  $pass = md5($password);
  $query = mysqli_query($koneksi, "INSERT INTO kabid SET id_karyawan = '$id_karyawan', nama_bidang = '$nama_bidang',
  username = '$username', password = '$pass'");
    if ($query) {
      ?>
 <script>
   window.location = "kabid.php?msg=success";
      </script>
      <?php
    }else {
      $e = "Mysql Error ".mysqli_errno($koneksi);
      ?>
      <script>
         Toast.fire({
        icon: 'error',
        title: '<?= $e ?>'
      });
      </script>
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
          <h3 class="card-title">Tambah Data <?= $page ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="POST">
          <div class="form-group">
                        <label>Nama Karyawan</label>
                        <select name="id_karyawan" class="form-control select2" required>
                                <option value=""> --Pilih karyawan -- </option>
                                <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM karyawan");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <option value="<?= $data['id_karyawan'] ?>"><?= $data['nip'].' - '.$data['nama_karyawan'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
          <div class="form-group">
              <label>Nama Bidang</label>
              <input type="text" name="nama_bidang" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label>password</label>
              <input type="text" name="password" class="form-control" required>
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