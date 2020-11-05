<?php
    if(isset($_GET['s'])){
        $c = $db->pdo->prepare("select * from tbl_pendakian where id_kelompok = '".$_GET['s']."'");
        $c->execute();
        if($c->rowCount()>0){
            $del = $db->pdo->prepare("delete from tbl_pendakian where id_kelompok = '".$_GET['s']."'");
            $del->execute();
        }else{
            $ins = $db->pdo->prepare("insert into tbl_pendakian set id_kelompok = '".$_GET['s']."', 
                                      tanggal_pendakian = '".date("Y-m-d")."',
                                      status_pendakian = '1'");
            $ins->execute();
        }
        echo "<script>location.href='?page=pendakian'</script>";
    }elseif(isset($_GET['conf'])){
        $c = $db->pdo->prepare("select * from tbl_pendakian where id_kelompok = '".$_GET['conf']."'");
        $c->execute();
        $counts = $c->rowCount();
        if($counts < 1){
            $ins = $db->pdo->prepare("insert into tbl_pendakian set id_kelompok = '".$_GET['conf']."',
                                      tanggal_pendakian = '".date("Y-m-d")."',
                                      status_pendakian = '1'");
            $ins->execute();
        }else{
            $rc = $c->fetch();
            if($rc['status_pendakian'] == 1){
                $ins = $db->pdo->prepare("update tbl_pendakian set status_pendakian = '2',
                                          tanggal_selesai = '".date("Y-d-m")."'
                                          WHERE id_kelompok = '".$_GET['conf']."'");
                $ins->execute();
            }elseif($rc['status_pendakian'] == 0){
                $ins = $db->pdo->prepare("update tbl_pendakian set status_pendakian = '1',
                                          tanggal_pendakian = '".date("Y-d-m")."'
                                          WHERE id_kelompok = '".$_GET['conf']."'");
                $ins->execute();
            }else{
                 $ins = $db->pdo->prepare("update tbl_pendakian set status_pendakian = '0',
                                          tanggal_pendakian = '',
                                          tanggal_selesai = ''
                                          WHERE id_kelompok = '".$_GET['conf']."'");
                 $ins->execute();
            }
        }
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
  <?php
    if(isset($_GET['h'])){
        if(isset($_GET['id'])){
            $del = $db->pdo->prepare("delete from tbl_temp where id_temp = '".$_GET['id']."'");
            $del->execute();
            echo "<script>location.href='?page=pendakian&h=".$_GET['h']."'</script>";
        }
        ?>
        <div class="card-body table-responsive p-0">
        <form method="post" action="">
        <table class="table table-hover" id="myTable">
          <tr><th>No</th><th>Tanggal Pendakian</th><th>Aksi</th></tr>
          <?php
              $l = $db->pdo->prepare("select * from tbl_kelompok, tbl_temp
                                      where tbl_kelompok.id_kelompok = tbl_temp.id_kelompok
                                      order by 1 asc");
              $l->execute();
              $no=1;
              while($rl = $l->fetch()){
                  echo "<tr><td>".$no."</td><td>".$rl['tanggal_pendakian']."<br />";
                  $a = $db->pdo->prepare("select * from tbl_pendaki where id_kelompok = '".$rl['id_kelompok']."'");
                  $a->execute();
                  echo "<small>Jumlah Anggota: ".$a->rowCount()." Org</small></td>";
                  echo "<td><a href='?page=pendakian&h=".$_GET['h']."&id=".$rl['id_temp']."'>Hapus</a></td></tr>";
                  $no++;
              }
          ?>
          <tr><th colspan="100"><a href='./?page=pendakian' class="btn btn-primary">Kembali</a></th></tr>
        </table>
      </form>
      </div>
        <?php
    }elseif(isset($_GET['d'])){
        ?>
        <div class="card-body table-responsive p-0">
        <form method="post" action="">
        <table class="table table-hover" id="myTable">
          <tr><th>No</th><th>NIK</th><th>Nama Lengkap</th><th>Umur</th><th>No. Telp</th></tr>
          <?php
              $l = $db->pdo->prepare("select * from tbl_pendaki 
                                      where id_kelompok = '".$_GET['d']."'
                                      order by 1 asc");
              $l->execute();
              $no=1;
              $i=0;
              while($rl = $l->fetch()){
                  echo "<tr><td>".$no."</td><td>".$rl['nik']."</td>";
                  echo "<td>".$rl['nama_lengkap']." (".$rl['jenis_kelamin'].")</td>";
                  echo "<td>".$rl['umur']."</td><td>".$rl['no_telp']."</td></tr>";
                  $no++;
              }
          ?>
          <tr><th colspan="100"><a href='./?page=pendakian' class="btn btn-primary">Kembali</a></th></tr>
        </table>
      </form>
      </div>
        <?php
    }else{
        ?>
          <div class="card-body table-responsive p-0">
          <form method="post" action="">
          <table class="table table-hover" id="myTable">
            <tr><th>No</th><th>Nama Kelompok</th><th>Tanggal Pendakian</th><th>Tanggal Selesai</th><th>Status Pendakian</th><th>Proses</th></tr>
            <?php
                $l = $db->pdo->prepare("select * from tbl_kelompok order by 1 asc");
                $l->execute();
                $no=1;
                while($rl = $l->fetch()){
                    echo "<tr><td>".$no."</td><td>".$rl['nama_kelompok']." (<a href='./?page=pendakian&d=".$rl['id_kelompok']."'>Lihat Daftar Pendaki</a>)<br />";
                    $a = $db->pdo->prepare("select * from tbl_pendaki where id_kelompok = '".$rl['id_kelompok']."'");
                    $a->execute();
                    echo "<small>Jumlah Anggota: ".$a->rowCount()." Org</small></td>";
                    $pa = $db->pdo->prepare("select * from tbl_pendakian where id_kelompok = '".$rl['id_kelompok']."'");
                    $pa->execute();
                    $rpa = $pa->fetch();
                    echo "<td>".$rpa['tanggal_pendakian']."</td>";
                    echo "<td>".$rpa['tanggal_selesai']."</td>";
                    $c = $db->pdo->prepare("select * from tbl_pendakian where id_kelompok = '".$rl['id_kelompok']."'");
                    $c->execute();
                    $rc = $c->fetch();
                    if($rc['status_pendakian'] == 1){
                        echo "<td><span class='badge badge-info'>Sedang Mendaki</span></td>";
                    }elseif($rc['status_pendakian'] == 2){
                        echo "<td><span class='badge badge-success'>Selesai</span></td>";
                    }else{
                        echo "<td><span class='badge badge-warning'>Pending..</span></td>";
                    }
                    echo "<td><span class='badge badge-danger'><a href='./?page=pendakian&conf=".$rl['id_kelompok']."' style='color:#FFF'>Ubah Status</a></span></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
          </table>
        </form>
        </div>
        <?php
    }
  ?>
</div>
  <!-- /.card-body -->