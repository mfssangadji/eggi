<?php
error_reporting(0);
include '../config/db.php';
$k = $db->pdo->prepare("select * from tbl_pendaki, tbl_kelompok, tbl_pendakian
                        where tbl_pendaki.id_kelompok = tbl_kelompok.id_kelompok
                        AND tbl_kelompok.id_kelompok = tbl_pendakian.id_kelompok
                        AND tbl_pendaki.status_pendakian = '1' order by 1 desc");
$k->execute();
while($rk = $k->fetch()){
    $arrx[] = array("<span style='font-size:20px; font-weight:bold'>KETUA </span>".$rk['nama_kelompok']."<br /><small>NIP: ".$rk['nip']."</small><br />".$rk['nama_lengkap']."<br />Lintang: ".$rk['lintang']."<br />Bujur: ".$rk['bujur'], $rk['lintang'], $rk['bujur']);
    $arrz[] = "new google.maps.LatLng(".$rk['lintang'].", ".$rk['bujur'].")";
}
$arrz = json_encode($arrz);
$mac = str_replace('"', "", $arrz);
$userCoor = json_encode(array_values($arrx));
$userCoorPath = $mac;
echo $userCoor."|".$userCoorPath;
?>