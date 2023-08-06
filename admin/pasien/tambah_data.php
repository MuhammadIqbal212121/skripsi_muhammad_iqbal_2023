<?php
if (isset($_POST['save'])) {
    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    $jumlah_nik = strlen($nik_pasien);
    if ($jumlah_nik != 16) {
      echo "<script>
      alert('Jumlah Huruf NIK tidak Sesuai');
      window.location = '?page=tambah_data';
      </script>";
    }else {
      
    $query = mysqli_query($koneksi, "INSERT INTO pasien SET nik_pasien = '$nik_pasien', nama_pasien = '$nama_pasien', 
    jk_pasien = '$jk_pasien', tgl_lahir_pasien = '$tgl_lahir_pasien', alamat_pasien = '$alamat_pasien', tgl_daftar = NOW()");
    if ($query) {
      ?>
 <script>
   window.location = "pasien.php?msg=success";
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
              <label>NIK</label>
              <input type="text" name="nik_pasien" maxlength="16" class="form-control" required>
            </div>
          <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama_pasien" class="form-control" required>
            </div>
                        <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jk_pasien" class="form-control select2">
                                <option value=""> --Pilih -- </option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                       
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="tgl_lahir_pasien" class="form-control"  required>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea name="alamat_pasien" class="form-control" required></textarea>
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