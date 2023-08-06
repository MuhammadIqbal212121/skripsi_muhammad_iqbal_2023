<?php
if (isset($_GET['msg']) && $_GET['msg'] == "success") {
  ?>
   <script>
   Toast.fire({
     icon: 'success',
     title: 'Berhasil'
   });
      </script>
  <?php
}
?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data <?= $page ?></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
         
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Password</th>
                <th>Foto</th>
               
              </tr>
              </thead>
              <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM login WHERE id_login = ".$_SESSION['id_login']);
                $no = 1;
while ($data = mysqli_fetch_array($query)) {
  
                ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><a href="?page=edit_username"> <?= $data['username'] ?> </a></td>
                <td><a href="?page=edit_password"> <?= "Password" ?> </a></td>
                <td><a href="?page=edit_foto">Edit<a href="<?= $data['foto'] ?>" ><img class="img-thumbnail" width="50" src="<?= $data['foto'] ?>"/></a></a></td>
                
              </tr>
              <?php
}
?>
            
              </tbody>
             
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->