<?php

$select = mysqli_query($koneksi, "SELECT * FROM login WHERE id_login = ".$_SESSION['id_login']);
$d = mysqli_fetch_array($select);

if (isset($_POST['save'])) {

    foreach ($_POST as $key => $value) {
      ${$key} = $value;
    }
    
    $query = mysqli_query($koneksi, "UPDATE login SET username = '$username'
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
          <form method="POST">
   
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" value="<?= $d['username'] ?>" class="form-control" required>
            </div>
            
           
      <input type="submit" value="Submit" name="save" class="btn btn-primary float-right">
                              </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
   
  </div>
 
</section>
<!-- /.content -->