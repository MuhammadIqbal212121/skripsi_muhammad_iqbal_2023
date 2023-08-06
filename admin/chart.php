<?php
session_start();
if (!isset($_SESSION['id_login'])) {
  echo "<script>
    alert('Silakan Login Kembali !');
    window.location = '../index.php';
    </script>";
} else {
  $page = 'Chart';
  $list = 'Chart Dokumen';
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
  if(isset($_POST['filter'])){
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
  }
}
?>
<script>
  var areaChartData = {
    labels: ['Poli Umum', 'Poli Infeksius', 'Poli MTBS', 'Poli Gizi', 'Poli Gigi'],
    datasets: [{
      label: 'Pasien',
      backgroundColor: 'rgba(47, 239, 145, 0.8)',
      borderColor: 'rgba(60,141,188,0.8)',
      pointRadius: false,
      pointColor: '#3b8bba',
      pointStrokeColor: 'rgba(60,141,188,1)',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data: [<?= $data_umum['jumlah']?>, <?= $data_infeksius['jumlah']?>,
      <?= $data_mtbs['jumlah']?>,  <?= $data_gizi['jumlah']?>, <?= $data_gigi['jumlah']?>]
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
        labelString: 'Pasien'
      },
        ticks: {

          stepSize: 1,
          min: 0,

        },
      }],
      xAxes: [{
        scaleLabel: {
        display: true,
        labelString: 'Poli'
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