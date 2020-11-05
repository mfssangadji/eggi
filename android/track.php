<?php
	include '../config/db.php';
	$ins = $db->pdo->prepare("update tbl_pendaki
							  set lintang = '".substr($_POST['lintang'],1)."',
							  bujur = '".substr($_POST['bujur'],1)."'
							  where id_pendaki = '".$_POST['id']."'
							  AND status_pendakian = '1'");
	$ins->execute();


	if($_POST['idx'] !== NULL){
		$c = $db->pdo->prepare("select * from tbl_pendakian where id_kelompok = '".$_POST['idx']."'");
		$c->execute();
		if($c->rowCount()<1){
			$insx = $db->pdo->prepare("insert into tbl_pendakian set id_kelompok = '".$_POST['idx']."',
									   tanggal_pendakian = '".date("Y-m-d")."',
									   status_pendakian = '1'");
			$insx->execute();
		}
	}
?>