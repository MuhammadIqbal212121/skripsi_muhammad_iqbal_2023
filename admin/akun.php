<?php
session_start();
if (!isset($_SESSION['id_login'])) {
    echo "<script>
    alert('Silakan Login Kembali !');
    window.location = '../index.php';
    </script>";
}else {
    
$page = "iAkun";
include '../config/header.php';
if (isset($_GET['page']) && $_GET['page'] == 'tambah_data') {
    include 'akun/tambah_data.php';
}elseif(isset($_GET['page']) && $_GET['page'] == 'edit_username') {
    include 'akun/edit_username.php';
}elseif(isset($_GET['page']) && $_GET['page'] == 'edit_password') {
    include 'akun/edit_password.php';
}elseif(isset($_GET['page']) && $_GET['page'] == 'edit_foto') {
    include 'akun/edit_foto.php';
}elseif(isset($_GET['page']) && $_GET['page'] == 'hapus_data')  {
    include 'akun/hapus_data.php';
}else {
    include 'akun/data.php';
}
include '../config/footer.php';

}
?>
