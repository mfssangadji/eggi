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
            $ins = $db->pdo->prepare("insert into tbl_kelompok set username = '".$_POST['username']."',
                                      password = '".md5($_POST['password'])."',
                                      nama_lengkap = '".$_POST['nama_lengkap']."'");
            $ins->execute();
            echo "<script>location.href='./?page=pendaki'</script>";
        }
    }elseif(isset($_GET['hapus'])){
        $e = $db->pdo->prepare("delete from tbl_pendaki where id_kelompok = '".$_GET['hapus']."'");
        $e->execute();
        $e = $db->pdo->prepare("delete from tbl_kelompok where id_kelompok = '".$_GET['hapus']."'");
        $e->execute();
        echo "<script>location.href='./?page=pendaki'</script>";
    }elseif(isset($_GET['cat'])){
        if(isset($_GET['idp'])){
            $del = $db->pdo->prepare("delete from tbl_pendaki where id_pendaki = '".$_GET['idp']."'");
            $del->execute();
            echo "<script>location.href='?page=pendaki&cat=".$_GET['cat']."'</script>";
        }
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
            <tr><th>No</th><th>Identitas Pendaki</th><th>Status Keanggotaan</th><th>No. Telp</th><th>Aksi</th></tr>
            <?php
                $l = $db->pdo->prepare("select * from tbl_pendaki where id_kelompok = '".$_GET['cat']."' order by 1 asc");
                $l->execute();
                $no=1;
                while($rl = $l->fetch()){
                    echo "<tr><td>".$no."</td><td><small>NIK: ".$rl['nik']."</small><br />";
                    echo $rl['nama_lengkap']." (".$rl['umur'].")<br />";
                    echo $rl['jenis_kelamin']."</td>";
                    echo "<td>".($rl['status_pendaki'] == 1 ? "Ketua" : "Anggota")."</td><td>".$rl['no_telp']."</td>";
                    echo "<td><a href='?page=pendaki&cat=".$_GET['cat']."&idp=".$rl['id_pendaki']."'>Hapus</a></td></tr>";
                    $no++;
                }
            ?>
            <tr><td colspan="100"><button class="btn btn-primary" onclick="self.history.back()">Kembali</button></a></td></tr>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <?php
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
            <tr><th>No</th><th>Nama Kelompok</th><th>Jumlah Anggota</th><th>Tanggal Registrasi</th><th>Aksi</th></tr>
            <?php
                $l = $db->pdo->prepare("select * from tbl_kelompok order by 1 asc");
                $l->execute();
                $no=1;
                while($rl = $l->fetch()){
                    echo "<tr><td>".$no."</td><td>".$rl['nama_kelompok']."</td>";
                    $a = $db->pdo->prepare("select * from tbl_pendaki where id_kelompok = '".$rl['id_kelompok']."'");
                    $a->execute();
                    echo "<td>".$a->rowCount()." Org (<a href='?page=pendaki&cat=".$rl['id_kelompok']."'>Lihat</a>)</td><td>".$rl['tanggal_registrasi']."</td>";
                    echo "<td><a href='?page=pendaki&hapus=".$rl['id_kelompok']."'>Hapus</a></td></tr>";
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
