<?php 
function hitung_umur($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) { 
	    exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y." tahun ".$m." bulan ".$d." hari";
}
function jml_minggu($tgl_awal, $tgl_akhir){
	$detik = 24 * 3600;
	$tgl_awal = strtotime($tgl_awal);
	$tgl_akhir = strtotime($tgl_akhir);
	
	$minggu = 0;
	for ($i=$tgl_awal; $i < $tgl_akhir; $i += $detik)
	{
	if (date('w', $i) == '0'){
	$minggu++;
	}
	}
	return $minggu;
	}
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => 'Jumat',
    'Sat' => 'Sabtu'
);
function select($data, $value)
{

  if ($data == $value) {
    $hasil = "selected";
  } else {
    $hasil = "";
  }
  return $hasil;
}
	$koneksi = mysqli_connect("localhost","root","","puskesmas");
 ?>