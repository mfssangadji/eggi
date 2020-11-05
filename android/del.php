<?php
	include '../config/db.php';
	$ins = $db->pdo->prepare("insert into tbl_temp set id_kelompok = '".$_POST['idx']."',
							  tanggal_pendakian = '".date("Y-m-d")."'");
	$ins->execute();
	if($ins){
		$c = $db->pdo->prepare("delete from tbl_pendakian where id_kelompok = '".$_POST['idx']."'");
		$c->execute();

		$c = $db->pdo->prepare("update tbl_pendaki set status_pendakian = '0'
								where id_pendaki = '".$_POST['id']."'");
		$c->execute();
	}
?>