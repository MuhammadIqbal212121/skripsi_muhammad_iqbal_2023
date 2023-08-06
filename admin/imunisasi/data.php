<?php
if (isset($_GET['msg']) && $_GET['msg'] == "success") {
  ?>
   <script>
   Toast.fire({
     icon: 'success',
     title: 'Berhasil'
   });
      </script>
  <?php
}
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data <?= $page ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <a href="?page=tambah_data" class="btn btn-app">
                  <i class="fas fa-plus"></i> Tambah Data
                </a>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No.</th>
                <th>TGL Imunisasi</th>
                <th>Jenis Imunisasi</th>
                <th>Umur Saat Imunisasi</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Nama Anak</th>
                <th>Jk Anak</th>
                <th>Tgl Lahir</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Opsi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM imunisasi 
                INNER JOIN anak ON imunisasi.id_anak = anak.id_anak");
                $no = 1;
while ($data = mysqli_fetch_array($query)) {
  
                ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['tgl_imunisasi'] ?></td>
                <td><?= $data['kategori'] ?></td>
                <td><?= $data['umur_imunisasi'] ?></td>
                <td><?= $data['nama_ayah'] ?></td>
                <td><?= $data['nama_ibu'] ?></td>
                <td><?= $data['nama_anak'] ?></td>
                <td><?= $data['jk_anak'] ?></td>
                <td><?= $data['tgl_lahir_anak'] ?></td>
                <td><?= hitung_umur($data['tgl_lahir_anak']) ?></td>
                <td><?= $data['alamat_anak'] ?></td>
                <td class="project-actions text-right">
              
                          <a class="btn btn-danger btn-sm" href="#" onClick="confirm_modal('?page=hapus_data&&id=<?= $data['id_imunisasi'] ?>');">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
            </td>
              </tr>
              <?php
}
?>
            
              </tbody>
              <tfoot>
              <tr>
              <th>No.</th>
                <th>TGL Imunisasi</th>
                <th>Jenis Imunisasi</th>
                <th>Umur Saat Imunisasi</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>Nama Anak</th>
                <th>JK Anak</th>
                <th>Tgl Lahir</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Opsi</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->