<?php
    if(isset($_GET['add'])){
        ?>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Input Data Admin</h3>
          </div>
          <form role="form" method="post" action="">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="username" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo rand(111111,999999); ?>" name="password" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nama_lengkap" required>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="btn_add">Tambah</button>
                <button type="button" class="btn btn-primary" onclick="self.history.back()">Batal</button>
              </div>
            </div>
          </div>
            <!-- /.card-body -->
        <?php
        if(isset($_POST['btn_add'])){
            $ins = $db->pdo->prepare("insert into tbl_admin set username = '".$_POST['username']."',
                                      password = '".md5($_POST['password'])."',
                                      nama_lengkap = '".$_POST['nama_lengkap']."'");
            $ins->execute();
            echo "<script>location.href='./?page=admin'</script>";
        }
    }elseif(isset($_GET['edit'])){
        $e = $db->pdo->prepare("select * from tbl_admin where id_admin = '".$_GET['edit']."'");
        $e->execute();
        $re = $e->fetch();
        ?>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Data Admin</h3>
          </div>
          <form role="form" method="post" action="">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $re['username']; ?>" name="username" required>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="password">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $re['nama_lengkap']; ?>" name="nama_lengkap" required>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="btn_add">Ubah</button>
                <button type="button" class="btn btn-primary" onclick="self.history.back()">Batal</button>
              </div>
            </div>
          </div>
            <!-- /.card-body -->
        <?php
        $pass = (empty($_POST['password']) ? "" : "password = '".md5($_POST['password'])."',");
        if(isset($_POST['btn_add'])){
            $ins = $db->pdo->prepare("update tbl_admin set username = '".$_POST['username']."',
                                      ".$pass." nama_lengkap = '".$_POST['nama_lengkap']."'
                                      where id_admin = '".$_GET['edit']."'");
            $ins->execute();
            echo "<script>location.href='./?page=admin'</script>";
        }
    }elseif(isset($_GET['hapus'])){
        $del = $db->pdo->prepare("delete from tbl_admin where id_admin = '".$_GET['hapus']."'");
        $del->execute();
        echo "<script>location.href='./?page=admin'</script>";
    }else{
      ?>
      <script>
      function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
      </script>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Admin | <a href="?page=admin&add">Tambah Admin</a></h3>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" onkeyup="myFunction()" id="myInput" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover" id="myTable">
            <tr><th>No</th><th>Username</th><th>Nama Lengkap</th><th>Aksi</th></tr>
            <?php
                $l = $db->pdo->prepare("select * from tbl_admin order by 1 asc");
                $l->execute();
                $no=1;
                while($rl = $l->fetch()){
                    echo "<tr><td>".$no."</td><td>".$rl['username']."</td>";
                    echo "<td>".$rl['nama_lengkap']."</td>";
                    echo "<td><a href='?page=admin&edit=".$rl['id_admin']."'>Edit</a> | <a href='?page=admin&hapus=".$rl['id_admin']."'>Hapus</a></td></tr>";
                    $no++;
                }
            ?>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <?php
    }
?>
