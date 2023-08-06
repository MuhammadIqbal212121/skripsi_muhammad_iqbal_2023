<style>
    table {
        font-size: 14px;

    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    thead {
        font-size: 16px;
    }

    .judul h3,
    h2,
    p {
        text-align: center;
        margin: 5px 0 5px 0;
    }

    .form-inline img {

        display: inline-block;
    }

    h2 {
        font-size: 30px;
    }

    .kop tr td {
        text-align: center;
        border: 2px solid white;
        border-collapse: collapse;
    }

    .gambar {
        margin-right: 10px;
    }

    .isi tr td {
        text-align: center;
        padding-left: 5px;
        padding-right: 5px;
    }

    .ttd {
        text-align: center;
        display: inline-block;
        float: right;
    }
</style>

<!-- Page specific script -->
<script>
    window.addEventListener("load", window.print());
</script>

<title>Laporan Data</title>

<div class="container-fluid">
    <center>
        <table width="100%" class="kop">
            <tr>
                <td width="15%" rowspan="3" align="center" valign="bottom"><img src="../img/kopbjb.png" width="40%"></td>
                <td align="center"><b style="font-size:18px;">PEMERINTAH KOTA BANJARBARU<br>
                        DINAS KESEHATAN</b></td>
                <td width="15%" rowspan="3" align="center" valign="bottom"><img src="../img/kopdinas.png" width="45%"></td>
            </tr>
            <tr>
                <td align="center"><b style="font-size:28px;">PUSKESMAS SUNGAI BESAR</b></td>
            </tr>
            <tr>
                <td align="center"><b style="font-size:13px;">Alamat Kantor : Jl.Banua Praja Utara RT. 039 RW. 07 Kel. Sungai Besar Kec. Banjarbaru Selatan </b></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr style="height:3px ; background-color: #000000; border-color: #000000;">
                    <hr style="margin-top: -4px; ">
                </td>
            </tr>
        </table>
    </center>
    <center>
        <table class="kop">
            <td style="font-size: 30px; font-weight: bold;">Laporan Jadwal Ibu Hamil</td>
        </table>
    </center>
    <hr size="2px" color="black" style="margin-top: 1px;">

    &nbsp;
    <div>
        <table class="isi" style="width:100%;">
            <thead style="line-height: 40px;">
                <tr>
                <th>No.</th>
                <th>Tanggal Jadwal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Umur</th>
                <th>HPHT</th>
                <th>Usia Kehamilan</th>
                </tr>
            </thead>
            <tbody style="line-height: 30px;">
                <?php
                include '../config/koneksi.php';
                $no     = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM jadwal_hamil
                INNER JOIN hamil ON jadwal_hamil.id_hamil = hamil.id_hamil");
                if (isset($_GET['tgl'])) {
                    # code...
                $tgl = $_GET['tgl'];
                $query = mysqli_query($koneksi, "SELECT * FROM jadwal_hamil
                INNER JOIN hamil ON jadwal_hamil.id_hamil = hamil.id_hamil
                WHERE jadwal_hamil.tgl_jadwal = '$tgl'");
                }
                while ($data = mysqli_fetch_array($query)) { ?>
                    <tr>
                    <td><?= $no++ ?></td>
                <td><?= $data['tgl_jadwal'] ?></td>
                <td><?= $data['nik_hamil'] ?></td>
                <td><?= $data['nama_hamil'] ?></td>
                <td><?= $data['tgl_lahir_hamil'] ?></td>
                <td><?= hitung_umur($data['tgl_lahir_hamil']) ?></td>
                <td><?= $data['hpht'] ?></td>
                <td><?= $data['usia_kehamilan']." Minggu" ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
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
    ?>

    <div class="ttd" style="display: inline-block;">
        <h4>Banjarbaru, <?= tanggal_indo(date('Y-m-d')) ?></h4>
        <h4></h4>

        <br>
        <br>
        <h4 style="margin-bottom: 1px;">HJ. Masjudah S. ST</h4>
        <hr size="2px" color="black" style="margin-top: 1px;">
        <h4 style="margin-top: 1px;">NIP.196901201989032006</h4>
    </div>

</div>