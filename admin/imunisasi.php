<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    echo "<script>
    alert('Silakan Login Kembali !');
    window.location = '../index.php';
    </script>";
}else {
$page = "Master Data";
$list = "Imunisasi";
include '../config/header.php';
if (isset($_GET['page']) && $_GET['page'] == 'tambah_data') {
    include 'imunisasi/tambah_data.php';
}elseif(isset($_GET['page']) && $_GET['page'] == 'edit_data') {
    include 'imunisasi/edit_data.php';
}elseif(isset($_GET['page']) && $_GET['page'] == 'hapus_data')  {
    include 'imunisasi/hapus_data.php';
}else{
    include 'imunisasi/data.php';
}
include '../config/footer.php';

}
?>
