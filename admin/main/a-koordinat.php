<?php
	include '../../config/db.php';
	$l = $db->pdo->prepare("select * from tbl_pendaki 
                            where id_kelompok = '".$_GET['id']."'
                            order by 1 asc");
  	$l->execute();
  	while($rl = $l->fetch()){
  		$arr[$rl['id_pendaki']] = array("lintang"=>$rl['lintang'],
  										"bujur"=>$rl['bujur'],
  										"status_pendakian"=>$rl['status_pendakian']); 
	}

	echo json_encode(array_values($arr));