<?php
$query = mysqli_query($koneksi, "DELETE FROM poliklinik WHERE id_poliklinik = ".$_GET['id']);
if ($query) {
    ?>
<script>
    window.location = 'poliklinik.php?msg=success';
    </script>
    <?php
}else {
    echo mysqli_errno($koneksi);
}
?>