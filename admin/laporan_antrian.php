<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    echo "<script>alert('Silakan Login Dahulu ! '); 
  window.location = '../index.php';
  </script>";
} else {
    $page = 'Laporan';
    $list = 'Antrian';
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
                    $query = mysqli_query($koneksi, "SELECT * FROM antrian
                    INNER JOIN pasien ON antrian.id_pasien = pasien.id_pasien");
                    if (isset($_POST['submit'])) {
                        $tgl = $_POST['tgl'];
                        $query = mysqli_query($koneksi, "SELECT * FROM antrian
                        INNER JOIN pasien ON antrian.id_pasien = pasien.id_pasien
                        WHERE antrian.tgl_antrian = '$tgl'");
                    ?>
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> *:</h5>
                            Halaman Ini Telah Di Optimalkan Untuk Pencetakan. Silakan Click tombol print.
                            <a href="../print/print_antrian.php?tgl=<?= $tgl ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> *:</h5>
                            Halaman Ini Telah Di Optimalkan Untuk Pencetakan. Silakan Click tombol print.
                            <a href="../print/print_antrian.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
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
                                            <input type="date" name="tgl" class="form-control" required>
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
                                            <th>No</th>
                                            <th>Nama Pasien</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Umur</th>
                                            <th>Tanggal Kunjungan</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $no = 1;
                                        while ($data = mysqli_fetch_array($query)) {

                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['nama_pasien'] ?></td>
                                                <td><?= $data['jk_pasien'] ?></td>
                                                <td><?= hitung_umur($data['tgl_lahir_pasien']) ?></td>
                                                <td><?= $data['tgl_antrian'] ?></td>

                                            </tr>
                                        <?php
                                        }
                                        ?>

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