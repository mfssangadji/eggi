<?php
	include '../config/db.php';
	$ins = $db->pdo->prepare("select * from tbl_pendaki, tbl_kelompok where 
							  tbl_pendaki.id_kelompok = tbl_kelompok.id_kelompok
							  AND tbl_pendaki.nik = '".$_POST['nik']."'
							  AND tbl_pendaki.password = '".$_POST['password']."'");
	$ins->execute();
	if($ins->rowCount() > 0){
		$r = $ins->fetch();
		$arr = array("mac"=>array("id"=>$r['id_pendaki'], "idx"=>$r['id_kelompok'], "status"=>$r['status_pendaki'], "nama"=>$r['nama_lengkap'], "login"=>"success"));
		echo json_encode($arr);
	}else{
		echo false;
	}
?>