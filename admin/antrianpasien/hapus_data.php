<?php
$query = mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien = ".$_GET['id']);
if ($query) {
    ?>
<script>
    window.location = 'pasien.php?msg=success';
    </script>
    <?php
}else {
    echo mysqli_errno($koneksi);
}
?>