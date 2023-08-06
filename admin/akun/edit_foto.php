<?php

$select = mysqli_query($koneksi, "SELECT * FROM login WHERE id_login = ".$_SESSION['id_login']);
$d = mysqli_fetch_array($select);
?>
<?php

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $target_dir = "../uploads/akun/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
   
     
      $query = mysqli_query($koneksi, "UPDATE login SET foto = '$target_file'
      WHERE id_login = ".$_SESSION['id_login']);
      if ($query) {
        ?>
   <script>
     window.location = "akun.php?msg=success";
        </script>
        <?php
      }else {
        $e = "Mysql Error ".mysqli_errno($koneksi);
        ?>
        <script>
           Toast.fire({
          icon: 'error',
          title: '<?= $e ?>'
        });
        </script>
        <?php
  ?>
  <?php
      }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Data <?= $page ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
   
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="fileToUpload" class="form-control" required>
            </div>
            
           
      <input type="submit" value="Submit" name="submit" class="btn btn-primary float-right">
                              </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
   
  </div>
 
</section>
<!-- /.content -->