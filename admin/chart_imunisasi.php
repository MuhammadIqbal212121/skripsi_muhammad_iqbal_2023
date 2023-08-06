<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    echo "<script>
    alert('Silakan Login Kembali !');
    window.location = '../index.php';
    </script>";
} else {
    $page = 'Chart';
    $list = 'Chart Imunisasi';
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $list ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-md-4">
                                <form method="POST" action="">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Bulan</label>
                                            <select name="bulan" class="js-example-basic-single form-control" required>
                                                <option value="">---</option>
                                                <?php error_reporting(0) ?>
                                                <option <?php echo select($_POST['bulan'], '01'); ?> value="01">Januari</option>
                                                <option <?php echo select($_POST['bulan'], '02'); ?> value="02">Februari</option>
                                                <option <?php echo select($_POST['bulan'], '03'); ?> value="03">Maret</option>
                                                <option <?php echo select($_POST['bulan'], '04'); ?> value="04">April</option>
                                                <option <?php echo select($_POST['bulan'], '05'); ?> value="05">Mei</option>
                                                <option <?php echo select($_POST['bulan'], '06'); ?> value="06">Juni</option>
                                                <option <?php echo select($_POST['bulan'], '07'); ?> value="07">Juli</option>
                                                <option <?php echo select($_POST['bulan'], '08'); ?> value="08">Agustus</option>
                                                <option <?php echo select($_POST['bulan'], '09'); ?> value="09">September</option>
                                                <option <?php echo select($_POST['bulan'], '10'); ?> value="10">Oktober</option>
                                                <option <?php echo select($_POST['bulan'], '11'); ?> value="11">November</option>
                                                <option <?php echo select($_POST['bulan'], '12'); ?> value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Tahun</label>
                                            <select name="tahun" class="form-control">
                                                <option value="">- Pilih -</option>
                                                <?php
                                                $y = date('Y');
                                                for ($i = 2017; $i <= $y + 1; $i++) {
                                                ?>
                                                    <option value='<?= $i ?>' <?php isset($_POST['tahun']) && $_POST['tahun'] == $i ? print("selected") : "" ?>><?= $i ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="filter">Submit</button>

                                </form>
                            </div>
                            <hr />
                            <!-- BAR CHART -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Diagram</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                   
                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
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

<?php include '../config/footer.php';
    error_reporting(0);
    $jumlah = array();
    $month = mysqli_query($koneksi, "SELECT *, COUNT(id_imunisasi) AS jumlah FROM imunisasi
    GROUP BY kategori");
    if(isset($_POST['filter'])){
      $tahun = $_POST['tahun'];
      $bulan = $_POST['bulan'];
      $month = mysqli_query($koneksi, "SELECT *, COUNT(id_imunisasi) AS jumlah FROM imunisasi
      WHERE YEAR(tgl_imunisasi) = '$tahun' AND MONTH(tgl_imunisasi) = '$bulan'
      GROUP BY kategori");
    }
}
?>
<script>
    var areaChartData = {
        labels: [<?php while ($d = mysqli_fetch_array($month)) {
                        echo "'" . $d['kategori']. "',";
                        $jumlah[] = $d['jumlah'];
                    } ?>],
        datasets: [{
            label: 'Anak',
            backgroundColor: 'rgba(47, 239, 145, 0.8)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [<?php for ($i = 0; $i < count($jumlah); $i++) {
                        echo $jumlah[$i] . ",";
                    }
                    ?>]
        }, ]
    }
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)


    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: true,
        scales: {
            y: {
                beginAtZero: true,

            },
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Jumlah Anak',
                },
                ticks: {
                    stepSize: 1,
                    min: 0,
                },
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Kategori Imunisasi',
                },

            }]
        }

    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
</script>