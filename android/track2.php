<?php
	include '../config/db.php';
	$ins = $db->pdo->prepare("update tbl_pendaki
							  set lintang = '".substr($_POST['lintang'],1)."',
							  bujur = '".substr($_POST['bujur'],1)."', status_pendakian = '1'
							  where id_pendaki = '".$_POST['id']."'");
	$ins->execute();
?>