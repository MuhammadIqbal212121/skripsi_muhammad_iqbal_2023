<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    echo "<script>alert('Silakan Login Dahulu ! '); 
  window.location = '../index.php';
  </script>";
} else {
    $page = 'Laporan';
    $list = 'Poli';
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
                $umum = mysqli_query($koneksi, "SELECT COUNT(id_poli_umum) AS jumlah FROM poli_umum");
                $data_umum = mysqli_fetch_array($umum);
                $infeksius = mysqli_query($koneksi, "SELECT COUNT(id_poli_infeksius) AS jumlah FROM poli_infeksius");
                $data_infeksius = mysqli_fetch_array($infeksius);
                $mtbs = mysqli_query($koneksi, "SELECT COUNT(id_poli_mtbs) AS jumlah FROM poli_mtbs");
                $data_mtbs = mysqli_fetch_array($mtbs);
                $gizi = mysqli_query($koneksi, "SELECT COUNT(id_poli_gizi) AS jumlah FROM poli_gizi");
                $data_gizi = mysqli_fetch_array($gizi);
                $gigi = mysqli_query($koneksi, "SELECT COUNT(id_poli_gigi) AS jumlah FROM poli_gigi");
                $data_gigi = mysqli_fetch_array($gigi);
                    if (isset($_POST['submit'])) {
                        $tahun = $_POST['tahun'];
                        $bulan = $_POST['bulan'];
                        $umum = mysqli_query($koneksi, "SELECT antrian.*, COUNT(poli_umum.id_poli_umum) AS jumlah FROM antrian 
                        INNER JOIN poli_umum ON antrian.id_antrian = poli_umum.id_antrian 
                        WHERE MONTH(antrian.tgl_antrian) = '$bulan' AND YEAR(antrian.tgl_antrian) = '$tahun'");
                        $data_umum = mysqli_fetch_array($umum);
                        $infeksius = mysqli_query($koneksi, "SELECT antrian.*, COUNT(poli_infeksius.id_poli_infeksius) AS jumlah FROM antrian
                        INNER JOIN poli_infeksius ON antrian.id_antrian = poli_infeksius.id_antrian 
                        WHERE MONTH(antrian.tgl_antrian) = '$bulan' AND YEAR(antrian.tgl_antrian) = '$tahun'");
                        $data_infeksius = mysqli_fetch_array($infeksius);
                        $mtbs = mysqli_query($koneksi, "SELECT antrian.*, COUNT(poli_mtbs.id_poli_mtbs) AS jumlah FROM antrian
                        INNER JOIN poli_mtbs ON antrian.id_antrian = poli_mtbs.id_antrian 
                        WHERE MONTH(antrian.tgl_antrian) = '$bulan' AND YEAR(antrian.tgl_antrian) = '$tahun'");
                        $data_mtbs = mysqli_fetch_array($mtbs);
                        $gizi = mysqli_query($koneksi, "SELECT antrian.*, COUNT(poli_gizi.id_poli_gizi) AS jumlah FROM antrian
                        INNER JOIN poli_gizi ON antrian.id_antrian = poli_gizi.id_antrian 
                        WHERE MONTH(antrian.tgl_antrian) = '$bulan' AND YEAR(antrian.tgl_antrian) = '$tahun'");
                        $data_gizi = mysqli_fetch_array($gizi);
                        $gigi = mysqli_query($koneksi, "SELECT antrian.*, COUNT(poli_gigi.id_poli_gigi) AS jumlah FROM antrian
                        INNER JOIN poli_gigi ON antrian.id_antrian = poli_gigi.id_antrian 
                        WHERE MONTH(antrian.tgl_antrian) = '$bulan' AND YEAR(antrian.tgl_antrian) = '$tahun'");
                        $data_gigi = mysqli_fetch_array($gigi);
                    ?>
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> *:</h5>
                            Halaman Ini Telah Di Optimalkan Untuk Pencetakan. Silakan Click tombol print.
                            <a href="../print/print_poli_rekapitulasi.php?tahun=<?= $tahun ?>&&bulan=<?= $bulan ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        </div>
                        <?php
                    }else {
                        ?>
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> *:</h5>
                                Halaman Ini Telah Di Optimalkan Untuk Pencetakan. Silakan Click tombol print.
                                <a href="../print/print_poli_rekapitulasi.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
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
                                            <label>Tahun</label>
                                            <select name="tahun" class="form-control">
                                                <option value="">- Pilih -</option>
                                                <?php
                                                error_reporting(0);
                                                $y = date('Y');
                                                for ($i = 2021; $i <= $y; $i++) {
                                                ?>
                                                    <option value='<?= $i ?>' <?php isset($_POST['tahun']) && $_POST['tahun'] == $i ? print("selected") : "" ?>><?= $i ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>bulan</label>
                                            <select name="bulan" class="form-control">
                                                <option value="">- Pilih -</option>
                                                <option value='01' <?php isset($_POST['bulan']) && $_POST['bulan'] == "01" ? print("selected") : "" ?>>Januari</option>
                                                <option value='02' <?php isset($_POST['bulan']) && $_POST['bulan'] == "02" ? print("selected") : "" ?>>Februari</option>
                                                <option value='03' <?php isset($_POST['bulan']) && $_POST['bulan'] == "03" ? print("selected") : "" ?>>Maret</option>
                                                <option value='04' <?php isset($_POST['bulan']) && $_POST['bulan'] == "04" ? print("selected") : "" ?>>April</option>
                                                <option value='05' <?php isset($_POST['bulan']) && $_POST['bulan'] == "05" ? print("selected") : "" ?>>Mei</option>
                                                <option value='06' <?php isset($_POST['bulan']) && $_POST['bulan'] == "06" ? print("selected") : "" ?>>Juni</option>
                                                <option value='07' <?php isset($_POST['bulan']) && $_POST['bulan'] == "07" ? print("selected") : "" ?>>Juli</option>
                                                <option value='08' <?php isset($_POST['bulan']) && $_POST['bulan'] == "08" ? print("selected") : "" ?>>Agustus</option>
                                                <option value='09' <?php isset($_POST['bulan']) && $_POST['bulan'] == "09" ? print("selected") : "" ?>>September</option>
                                                <option value='10' <?php isset($_POST['bulan']) && $_POST['bulan'] == "10" ? print("selected") : "" ?>>Oktober</option>
                                                <option value='11' <?php isset($_POST['bulan']) && $_POST['bulan'] == "11" ? print("selected") : "" ?>>November</option>
                                                <option value='12' <?php isset($_POST['bulan']) && $_POST['bulan'] == "12" ? print("selected") : "" ?>>Desember</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                                </form>

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
                                                <th>No</th>
                                                <th>Nama Poli</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;

                                            ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>Poli Umum</td>
                                                    <td><?= $data_umum['jumlah'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>Poli Infeksius</td>
                                                    <td><?= $data_infeksius['jumlah'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>Poli MTBS</td>
                                                    <td><?= $data_mtbs['jumlah'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>Poli Gizi</td>
                                                    <td><?= $data_gizi['jumlah'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>Poli Gigi</td>
                                                    <td><?= $data_gigi['jumlah'] ?></td>
                                                </tr>
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
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