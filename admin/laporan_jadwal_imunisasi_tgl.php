<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    echo "<script>alert('Silakan Login Dahulu ! '); 
  window.location = '../index.php';
  </script>";
} else {
    $page = 'Laporan';
    $list = 'Imunisasi';
    include '../config/header.php';
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

                    <?php
                     $query = mysqli_query($koneksi, "SELECT * FROM imunisasi 
                     INNER JOIN anak ON imunisasi.id_anak = anak.id_anak");
                    if (isset($_POST['submit'])) {
                        $tgl = $_POST['tgl'];
                      
                        $query = mysqli_query($koneksi, "SELECT * FROM imunisasi 
                        INNER JOIN anak ON imunisasi.id_anak = anak.id_anak
                        WHERE imunisasi.tgl_imunisasi = '$tgl'");
                    ?>
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> *:</h5>
                            Halaman Ini Telah Di Optimalkan Untuk Pencetakan. Silakan Click tombol print.
                            <a href="../print/print_jadwal_imunisasi_tgl.php?tgl=<?= $tgl ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        </div>
                        <?php
                    }else {
                        ?>
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> *:</h5>
                                Halaman Ini Telah Di Optimalkan Untuk Pencetakan. Silakan Click tombol print.
                                <a href="../print/print_jadwal_imunisasi_tgl.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            </div>
                        <?php
                        }
                        ?>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $page ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-md-4">
                            <form method="POST" action="">
                                    <div class="form-group row">

                                        <div class="col-md-6">
                                            <label>Tanggal</label>
                                            <select name="tgl" class="form-control select2">
                                                <option value="">- Pilih -</option>
                                                <?php
                                                   function tanggal_indo($tanggal, $cetak_hari = true)
                                                   {
                                                       $hari = array(
                                                           1 =>    'Senin',
                                                           'Selasa',
                                                           'Rabu',
                                                           'Kamis',
                                                           'Jumat',
                                                           'Sabtu',
                                                           'Minggu'
                                                       );
                                                       $bulan = array(
                                                        1 =>   'Januari',
                                                        'Februari',
                                                        'Maret',
                                                        'April',
                                                        'Mei',
                                                        'Juni',
                                                        'Juli',
                                                        'Agustus',
                                                        'September',
                                                        'Oktober',
                                                        'November',
                                                        'Desember'
                                                    );
                                                    $split       = explode('-', $tanggal);
                                                    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
                                            
                                                    if ($cetak_hari) {
                                                        $num = date('N', strtotime($tanggal));
                                                        return $hari[$num] . ' ' . $tgl_indo;
                                                    }
                                                    return $tgl_indo;
                                                    } 
                                                $q = mysqli_query($koneksi, "SELECT DISTINCT tgl_imunisasi FROM imunisasi");
                                                while($d = mysqli_fetch_array($q)) {
                                                ?>
                                                    <option value='<?= $d['tgl_imunisasi'] ?>'><?= tanggal_indo($d['tgl_imunisasi']) ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                  
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                                </form>
                </div>
                            </div>
                            <hr />
                            <!-- STACKED BAR CHART -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><?= $page . ' ' . $list ?></h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                    </div>
                                </div>
                                <div class="card-body">
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
                
              </tr>
              </thead>
              <tbody>
                <?php
               
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
                
              </tr>
              <?php
}
?>
            
              </tbody>
             
            </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

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
<?php
    include '../config/footer.php';
} ?>