<?php
if (isset($_POST['save'])) {
  foreach ($_POST as $key => $value) {
    ${$key} = $value;
  }
    $query = mysqli_query($koneksi, "INSERT INTO poliklinik SET nama = '$nama'");
    if ($query) {
      ?>
      <script>
        window.location = "poli.php?msg=success";
      </script>
      <?php
    } else {
      $e = "Mysql Error " . mysqli_errno($koneksi);
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
          <h3 class="card-title">Tambah Data
            <?= $page ?>
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nama Poli</label>
              <input type="text" name="nama" maxlength="16" class="form-control" required>
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