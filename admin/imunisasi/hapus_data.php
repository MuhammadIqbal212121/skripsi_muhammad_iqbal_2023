<?php
$query = mysqli_query($koneksi, "DELETE FROM imunisasi WHERE id_imunisasi = ".$_GET['id']);
if ($query) {
    ?>
<script>
    window.location = 'imunisasi.php?msg=success';
    </script>
    <?php
}else {
    echo mysqli_errno($koneksi);
}
?>