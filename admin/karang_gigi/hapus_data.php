<?php
$query = mysqli_query($koneksi, "DELETE FROM jadwal_gigi WHERE id_jadwal_gigi = ".$_GET['id']);
if ($query) {
    ?>
<script>
    window.location = 'karang_gigi.php?msg=success';
    </script>
    <?php
}else {
    echo mysqli_errno($koneksi);
}
?>