<?php
$query = mysqli_query($koneksi, "DELETE FROM cuti_tahun WHERE id_cuti_tahun = ".$_GET['id']);
if ($query) {
    ?>
<script>
    window.location = 'cuti_tahun.php?msg=success';
    </script>
    <?php
}else {
    echo mysqli_errno($koneksi);
}
?>