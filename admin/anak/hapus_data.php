<?php
$query = mysqli_query($koneksi, "DELETE FROM anak WHERE id_anak = ".$_GET['id']);
if ($query) {
    ?>
<script>
    window.location = 'anak.php?msg=success';
    </script>
    <?php
}else {
    echo mysqli_errno($koneksi);
}
?>