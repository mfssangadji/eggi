<?php
error_reporting(0);
include '../config/db.php';
$k = $db->pdo->prepare("select * from tbl_pendaki, tbl_kelompok, tbl_pendakian, tbl_notif
                        where tbl_pendaki.id_kelompok = tbl_kelompok.id_kelompok
                        AND tbl_kelompok.id_kelompok = tbl_pendakian.id_kelompok
                        AND tbl_pendaki.status_pendakian = '1'
                        AND tbl_pendaki.id_pendaki = tbl_notif.id_pendaki
                        AND tbl_notif.id_notif = '".$_GET['id']."' order by 1 desc");
$k->execute();
while($rk = $k->fetch()){
	$statusx = $rk['status_pendaki'] == 1 ? "KETUA" : "ANGGOTA";
    $arrx[] = array("<span style='font-size:20px; font-weight:bold'>".$statusx." </span>".$rk['nama_kelompok']."<br /><small>NIP: ".$rk['nik']."</small><br />".$rk['nama_lengkap']."<br />Lintang: ".$rk['lintang']."<br />Bujur: ".$rk['bujur'], $rk['lintang'], $rk['bujur']);
    $arrz[] = "new google.maps.LatLng(".$rk['lintang'].", ".$rk['bujur'].")";
}
$arrz = json_encode($arrz);
$mac = str_replace('"', "", $arrz);
$userCoor = json_encode(array_values($arrx));
$userCoorPath = $mac;
echo $userCoor."|".$userCoorPath;
?>