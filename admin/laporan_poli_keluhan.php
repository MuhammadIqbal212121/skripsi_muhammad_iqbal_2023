<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    echo "<script>alert('Silakan Login Dahulu ! '); 
  window.location = '../index.php';
  </script>";
} else {
    $page = 'Laporan';
    $list = 'Rekapitulasi / Poli / Keluhan';
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
                    if (isset($_POST['submit'])) {
                        $poli = $_POST['poli'];
                        $bulan = $_POST['bulan'];
                        $tahun = $_POST['tahun'];
                        $query = mysqli_query($koneksi, "SELECT *, COUNT(pasien.id_pasien) AS jumlah FROM $poli 
                        INNER JOIN antrian ON $poli.id_antrian = antrian.id_antrian
                        INNER JOIN pasien ON antrian.id_pasien = pasien.id_pasien
                        WHERE MONTH(antrian.tgl_antrian) = '$bulan' AND YEAR(antrian.tgl_antrian) = '$tahun'
                        GROUP BY $poli.keluhan");
                    ?>
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> *:</h5>
                            Halaman Ini Telah Di Optimalkan Untuk Pencetakan. Silakan Click tombol print.
                            <a href="../print/print_poli_rekapitulasi_keluhan.php?tahun=<?= $tahun ?>&&bulan=<?= $bulan ?>&&poli=<?= $poli ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        </div>
                        <?php
                    }?>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $page . " " . $list ?></h3>
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
                                        <div class="col-md-6">
                                            <label>Poli</label>
                                            <select name="poli" class="form-control">
                                                <option value="">- Pilih -</option>
                                                <option value='poli_umum' <?php isset($_POST['poli']) && $_POST['poli'] == "poli_umum" ? print("selected") : "" ?>>Poli Umum</option>
                                                <option value='poli_infeksius' <?php isset($_POST['poli']) && $_POST['poli'] == "poli_infeksius" ? print("selected") : "" ?>>Poli infeksius</option>
                                                <option value='poli_mtbs' <?php isset($_POST['poli']) && $_POST['poli'] == "poli_mtbs" ? print("selected") : "" ?>>Poli mtbs</option>
                                                <option value='poli_gizi' <?php isset($_POST['poli']) && $_POST['poli'] == "poli_gizi" ? print("selected") : "" ?>>Poli gizi</option>
                                                <option value='poli_gigi' <?php isset($_POST['poli']) && $_POST['poli'] == "poli_gigi" ? print("selected") : "" ?>>Poli gigi</option>
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
                                    <?php
                                    if (isset($_POST['submit'])) {
                                    ?>
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Keluhan</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $no = 1;
                                                while ($data = mysqli_fetch_array($query)) {

                                                ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $data['keluhan'] ?></td>
                                                        <td><?= $data['jumlah'] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                        </table>
                                    <?php
                                    }
                                    ?>
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