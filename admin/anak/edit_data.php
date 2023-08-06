<?php
$id = $_GET['id'];
$select = mysqli_query($koneksi, "SELECT * FROM anak WHERE id_anak = '$id'");
$d = mysqli_fetch_array($select);
if (isset($_POST['save'])) {
    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    $query = mysqli_query($koneksi, "UPDATE anak SET nama_anak = '$nama_anak', nama_ayah= '$nama_ayah', 
    jk_anak= '$jk_anak', nama_ibu = '$nama_ibu', tgl_lahir_anak= '$tgl_lahir_anak', alamat_anak= '$alamat_anak'
    WHERE id_anak = '$id'");
    if ($query) {
      ?>
 <script>
   window.location = "anak.php?msg=success";
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
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Data <?= $page ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <label>Nama Ayah</label>
              <input type="text" name="nama_ayah" value="<?= $d['nama_ayah'] ?>" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Nama Ibu</label>
              <input type="text" name="nama_ibu" value="<?= $d['nama_ibu'] ?>" class="form-control" required>
            </div>
          <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama_anak" value="<?= $d['nama_anak'] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jk_anak" class="form-control select2">
                                <option value=""> --Pilih -- </option>
                                <option <?= select($d['jk_anak'], "Laki-laki") ?> value="Laki-laki">Laki-laki</option>
                                <option <?= select($d['jk_anak'], "Perempuan") ?> value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                       
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="tgl_lahir_anak" value="<?= $d['tgl_lahir_anak'] ?>" class="form-control"  required>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea name="alamat_anak" class="form-control" required><?= $d['alamat_anak'] ?></textarea>
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