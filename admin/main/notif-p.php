<div class="card">
<!-- /.card-header -->
<div class="card-body table-responsive p-0">
  <table class="table table-hover" id="myTable">
    <tr><th>No</th><th>Pendaki</th><th>Kelompok</th><th>Lintang</th><th>Bujur</th><th>Aksi</th></tr>
    <?php
        $l = $db->pdo->prepare("select * from tbl_notif, tbl_pendaki, tbl_kelompok
                                where tbl_notif.id_pendaki = tbl_pendaki.id_pendaki
                                AND tbl_pendaki.id_kelompok = tbl_kelompok.id_kelompok
                                order by 1 asc");
        $l->execute();
        $no=1;
        while($rl = $l->fetch()){
            echo "<tr><td>".$no."</td>";
            echo "<td>".$rl['nama_lengkap']."</td><td>".$rl['nama_kelompok']."</td>";
            echo "<td>".$rl['lintang']."</td><td>".$rl['bujur']."</td>";
            echo "<td><a href='?page=lokasi&id=".$rl['id_notif']."'>Liat Lokasi</a> | ";
            echo "<a href='?page=notif&hapus=".$rl['id_notif']."'>Hapus</a></td></tr>";
            $no++;
        }
    ?>
  </table>
</div>
</div>
<?php
    $up = $db->pdo->prepare("update tbl_notif set status = '1'");
    $up->execute();

    if(isset($_GET['hapus'])){
        $del = $db->pdo->prepare("delete from tbl_notif where id_notif = '".$_GET['hapus']."'");
        $del->execute();
        echo "<script>location.href='?page=notif'</script>";
    }
?>