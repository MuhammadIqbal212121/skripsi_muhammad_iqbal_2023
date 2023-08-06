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
                <th>Tanggal Jadwal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Umur</th>
                <th>HPHT</th>
                <th>Usia Kehamilan</th>
                <th>Opsi</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM jadwal_hamil
                INNER JOIN hamil ON jadwal_hamil.id_hamil = hamil.id_hamil");
                $no = 1;
while ($data = mysqli_fetch_array($query)) {
  
                ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['tgl_jadwal'] ?></td>
                <td><?= $data['nik_hamil'] ?></td>
                <td><?= $data['nama_hamil'] ?></td>
                <td><?= $data['tgl_lahir_hamil'] ?></td>
                <td><?= hitung_umur($data['tgl_lahir_hamil']) ?></td>
                <td><?= $data['hpht'] ?></td>
                <td><?= $data['usia_kehamilan']." Minggu" ?></td>
                <td class="project-actions text-right">
                          <a class="btn btn-danger btn-sm" href="#" onClick="confirm_modal('?page=hapus_data&&id=<?= $data['id_jadwal_hamil'] ?>');">
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
                <th>Tanggal Jadwal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Umur</th>
                <th>HPHT</th>
                <th>Usia Kehamilan</th>
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