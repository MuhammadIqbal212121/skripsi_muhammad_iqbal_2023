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
            <h3 class="card-title">Data
              Penjadwalan Pasien / Poli
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="" method="POST">
            <div class="form-group">
                <label>Nama Poli</label>
                <select name="id" class="form-control select2" required>
                  <option value=""> --Pilih-- </option>
                  <?php $sql = mysqli_query($koneksi, "SELECT * FROM poliklinik");
                  while ($data = mysqli_fetch_array($sql)) { ?>
                    <option value="<?= $data[0] ?>"><?= $data['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal</label>
               <input type="date" name="tgl" class="form-control">
              </div>
              <input type="submit" value="Submit" name="filter" class="btn btn-primary">
            </form>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Pasien</th>
                  <th>Kategori Pasien</th>
                  <th>Poli</th>
                  <th>Tanggal-Jam</th>
                  <th>Nomor Antrian</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST['filter'])) {
                  $tgl = $_POST['tgl'];
                  $id = $_POST['id'];
                $query = mysqli_query($koneksi, "SELECT * FROM 
                antrianpasien INNER JOIN antrian ON antrianpasien.antrian_id = antrian.id_antrian
                INNER JOIN pasien ON antrian.id_pasien = pasien.id_pasien 
                INNER JOIN poliklinik ON antrianpasien.id_poliklinik = poliklinik.id_poliklinik
                WHERE poliklinik.id_poliklinik = '$id' AND antrian.tgl_antrian = '$tgl'
                GROUP BY antrianpasien.id_antrian DESC");
                }else {
                  $query = mysqli_query($koneksi, "SELECT * FROM 
                  antrianpasien INNER JOIN antrian ON antrianpasien.antrian_id = antrian.id_antrian
                  INNER JOIN pasien ON antrian.id_pasien = pasien.id_pasien 
                  INNER JOIN poliklinik ON antrianpasien.id_poliklinik = poliklinik.id_poliklinik
                  GROUP BY antrianpasien.id_antrian DESC");
                }
                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                  ?>
                  <tr>
                    <td>
                      <?= $no++ ?>
                    </td>
                    <td>
                      <?= $data['nama_pasien'] ?>
                    </td>
                    <td>
                      <?= $data['kategori_pasien'] ?>
                    </td>
                    <td>
                      <?= $data['nama'] ?>
                    </td>
                    <td>
                      <?= $data['waktu'] ?>
                    </td>
                    <td>
                      <?= $data[4] ?>
                    </td>
                    <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm" href="?page=edit_data&&id=<?= $data[0] ?>">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                      </a>
                      <a class="btn btn-danger btn-sm" href="#"
                        onClick="confirm_modal('?page=hapus_data&&id=<?= $data[0] ?>');">
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
                  <th>Nama Pasien</th>
                  <th>Kategori Pasien</th>
                  <th>Poli</th>
                  <th>Tanggal-Jam</th>
                  <th>Nomor Antrian</th>
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