<?php
$query = mysqli_query($koneksi, "DELETE FROM jadwal_hamil WHERE id_jadwal_hamil = ".$_GET['id']);
if ($query) {
    ?>
<script>
    window.location = 'jadwal_hamil.php?msg=success';
    </script>
    <?php
}else {
    echo mysqli_errno($koneksi);
}
?>