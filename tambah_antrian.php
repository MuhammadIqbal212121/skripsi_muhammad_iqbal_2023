<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puskesmas Sungai Besar</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper bg-light">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <div class="container-fluid mt-4">

                    <div class="col-12 text-center">
                        <b style="color: #000000; font-size: 20px; text-shadow: 2px 2px #D1D1D1;">Pendaftaran Antrian Online</b>
                        <br><b style="color: rgba(0, 143, 55,0.7); font-size: 30px; text-shadow: 2px 2px #C7FCB9;">PUSKESMAS SUNGAI BESAR</b>
                        <br><b style="color: #000000;">Alamat Kantor : Jl.Banua Praja Utara RT. 039 RW. 07 Kel. Sungai Besar Kec. Banjarbaru Selatan</b>
                    </div><br>

                    <form action="" method="post">
                        <div class="row justify-content-center">
                            <div class="card card-body shadow mb-1 col-6" style="margin-left:-3px; margin-right: 3px;">
                                <label>NIK :</label>
                                <input type="text" name="nik" id="nik" onkeyup="cekantrian()" class="form-control" placeholder="Harus Diisi">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" placeholder="Harus Diisi">
                                <button type="submit" name="simpan" class="btn btn-info" style="height:50px; margin-top:10px; width: 150px; margin-left: 10px;">Simpan</button>
                            </div>
                    </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery/dist/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="vendor/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/plus/script.js"></script>

</body>

</html>
<script type="text/javascript">
    var serverClock = jQuery("#jamServer");
    if (serverClock.length > 0) {
        showServerTime(serverClock, serverClock.text());
    }

    function showServerTime(obj, time) {
        var parts = time.split(":"),
            newTime = new Date();

        newTime.setHours(parseInt(parts[0], 10));
        newTime.setMinutes(parseInt(parts[1], 10));
        newTime.setSeconds(parseInt(parts[2], 10));

        var timeDifference = new Date().getTime() - newTime.getTime();

        var methods = {
            displayTime: function() {
                var now = new Date(new Date().getTime() - timeDifference);
                obj.text([
                    methods.leadZeros(now.getHours(), 2),
                    methods.leadZeros(now.getMinutes(), 2),
                    methods.leadZeros(now.getSeconds(), 2)
                ].join(":"));
                setTimeout(methods.displayTime, 500);
            },

            leadZeros: function(time, width) {
                while (String(time).length < width) {
                    time = "0" + time;
                }
                return time;
            }
        }
        methods.displayTime();
    }

    function umurnya() {
        var umur1 = document.getElementById("umur").value;
        var today = new Date();
        var birthday = new Date(umur1);
        var year = 0;
        if (today.getMonth() < birthday.getMonth()) {
            year = 1;
        } else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
            year = 1;
        }
        var age = today.getFullYear() - birthday.getFullYear() - year;
        if (age < 0) {
            age = 0;
        }
        if (!isNaN(age)) {
            document.getElementById('tahunumur').innerHTML = age;
        } else {
            document.getElementById('tahunumur').innerHTML = '';
        }
    }
</script>
<?php
include 'config/koneksi.php';
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['simpan'])) {
    foreach ($_POST as $key => $value) {
        ${$key} = $value;
    }
    $tgl = date('Y-m-d');
    $jam = date('h:i:s');
    $pass = md5($password);
    $cek = mysqli_query($koneksi, "SELECT * FROM pasien WHERE nik_pasien = '$nik' AND password = '$pass'");
    if (mysqli_num_rows($cek) == 0) {
        echo "<script>
        alert('Nik Dan Password Salah');</script>";
    } else {
        $data = mysqli_fetch_array($cek);
        $id = $data['id_pasien'];
        $cek = mysqli_query($koneksi, "SELECT MAX(no_antrian) AS no_antrian FROM antrian WHERE tgl_antrian = '$tgl'");
        if (mysqli_num_rows($cek) > 0) {
            $no = mysqli_fetch_array($cek);
            $no_antrian = $no['no_antrian'] + 1;
        } else {
            $no_antrian = 1;
        }
        $query_a = mysqli_query($koneksi, "INSERT INTO antrian SET no_antrian = '$no_antrian', 
    id_pasien = '$id', tgl_antrian = '$tgl', jam_datang = '$jam'");
        if ($query_a) {
            echo "<script>
       alert('Data Berhasil Di Simpan , Silakan Tunggu...');</script>";
            echo "<meta http-equiv='refresh' content='3; url=index.php'>";
        }
    }
}
?>