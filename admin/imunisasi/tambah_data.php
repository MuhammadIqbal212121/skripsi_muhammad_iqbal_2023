<?php
if (isset($_POST['save'])) {
    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    $cek = mysqli_query($koneksi, "SELECT tgl_lahir_anak FROM anak WHERE id_anak = '$id_anak'");
    $d = mysqli_fetch_array($cek);
    $usia_anak = hitung_umur($d['tgl_lahir_anak'], $tgl_jadwal);

    $day = date('D', strtotime($tgl_jadwal));
    if($dayList[$day] == "Selasa" || $dayList[$day] == "Rabu"){
      $query = mysqli_query($koneksi, "INSERT INTO imunisasi SET id_anak = '$id_anak', 
      tgl_imunisasi = '$tgl_jadwal', umur_imunisasi = '$usia_anak', kategori = '$kategori'");
      if ($query) {
        ?>
   <script>
     window.location = "imunisasi.php?msg=success";
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
    }else{
      ?>
       <script>
         Swal.fire({
        icon: 'error',
        title: 'Hari Yang Anda Input Salah, Silakan Inputkan Dengan Hari Selasa / Rabu'
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
          <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
                        <label>Nama Anak</label>
                        <select name="id_anak" class="form-control select2" required>
                                <option value=""> --Pilih -- </option>
                                <?php 
$q = mysqli_query($koneksi, "SELECT * FROM anak");
while($data = mysqli_fetch_array($q)){
                                ?>
                                <option value="<?= $data['id_anak'] ?>">Nama Ayah / Nama Ibu : <?= $data['nama_ayah'].' / '.$data['nama_ibu'] ?> Nama Anak : <?= $data['nama_anak'] ?></option>
                       <?php } ?>        
                            </select>
                        </div>
          <div class="form-group">
              <label>tgl imunisasi</label>
              <input type="date" name="tgl_jadwal" class="form-control" required>
            </div>
              <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control select2">
                                <option value=""> --Pilih -- </option>
                                <option value="pentabio">pentabio</option>
                                <option value="polio">polio</option>
                                <option value="IPU">IPU</option>
                                <option value="BCG">BCG</option>
                                <option value="MR">MR</option>
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