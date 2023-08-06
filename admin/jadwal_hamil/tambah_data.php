<?php
if (isset($_POST['save'])) {
    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    $cek = mysqli_query($koneksi, "SELECT hpht FROM hamil WHERE id_hamil = '$id_hamil'");
    $d = mysqli_fetch_array($cek);
    $usia_kehamilan = jml_minggu($d['hpht'], $tgl_jadwal);

    $day = date('D', strtotime($tgl_jadwal));
    if($dayList[$day] == "Senin" || $dayList[$day] == "Kamis"){
      $query = mysqli_query($koneksi, "INSERT INTO jadwal_hamil SET id_hamil = '$id_hamil', 
      tgl_jadwal = '$tgl_jadwal', usia_kehamilan = '$usia_kehamilan'");
      if ($query) {
        ?>
   <script>
     window.location = "jadwal_hamil.php?msg=success";
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
        title: 'Hari Yang Anda Input Salah, Silakan Inputkan Dengan Hari Senin / Kamis'
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
                        <label>Nama Ibu Hamil</label>
                        <select name="id_hamil" class="form-control select2">
                                <option value=""> --Pilih -- </option>
                                <?php 
$q = mysqli_query($koneksi, "SELECT * FROM hamil");
while($data = mysqli_fetch_array($q)){
                                ?>
                                <option value="<?= $data['id_hamil'] ?>"><?= $data['nik_hamil'].' / '.$data['nama_hamil'] ?></option>
                       <?php } ?>        
                            </select>
                        </div>
                       
            <div class="form-group">
              <label>Tanggal Jadwal</label>
              <input type="date" name="tgl_jadwal" class="form-control"  required>
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