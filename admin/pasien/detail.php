<?php
$query = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id_karyawan = ".$_GET['id']);
$data = mysqli_fetch_array($query);
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Detail</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong>NIP</strong>
            <p class="text-muted">
             <?= $data['nip'] ?>
            </p>
            <hr>
            <strong>Nama</strong>
            <p class="text-muted">
             <?= $data['nama'] ?>
            </p>
            <hr>
            <strong>Tempat Lahir / TGL-Lahir</strong>
            <p class="text-muted">
             <?= $data['tempat_lahir'].'/'.$data['tgl_lahir'] ?>
            </p>
            <hr>
            <strong>Alamat</strong>
            <p class="text-muted"><?= $data['alamat'] ?></p>
            <hr>
            <strong>jabatan</strong>
            <p class="text-muted"><?= $data['jabatan'] ?></p>
            <hr>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-4">
        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Foto</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong>Foto</strong>
            <p class="text-muted">
             <img src="<?= $data['foto'] ?>" width="200" height="200"/>
            </p>
            <hr>
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
     
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->