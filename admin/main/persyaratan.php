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
      <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Persyaratan Pendakian</h3>
          </div>
          <?php
              $p = $db->pdo->prepare("select * from tbl_persyaratan order by 1 desc limit 1");
              $p->execute();
              $rp = $p->fetch();
          ?>
          
          <form role="form" method="post" action="">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Isi Persyaratan</label>
                <textarea class="form-control" name="persyaratan" rows="10"><?php echo $rp['persyaratan']; ?></textarea>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="btn_add">Update</button>
              </div>
            </div>
          </div>
            <!-- /.card-body -->
        <?php
        if(isset($_POST['btn_add'])){
            $c = $db->pdo->prepare("select * from tbl_persyaratan");
            $c->execute();
            $counts = $c->rowCount();
            if($counts < 1){
                $ins = $db->pdo->prepare("insert into tbl_persyaratan
                                          set persyaratan = '".$_POST['persyaratan']."'");
                $ins->execute();
            }else{
                $rc = $c->fetch();
                $ins = $db->pdo->prepare("update tbl_persyaratan
                                          set persyaratan = '".$_POST['persyaratan']."'
                                          where id_persyaratan = '".$rc['id_persyaratan']."'");
                $ins->execute();
            }
            
            echo "<script>location.href='./?page=persyaratan'</script>";
        }
    }
?>
