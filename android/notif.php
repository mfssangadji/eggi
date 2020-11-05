<?php
	include '../config/db.php';
	$ins = $db->pdo->prepare("insert into tbl_notif set id_pendaki = '".$_POST['id']."',
							  lintang = '".substr($_POST['lintang'],1)."', bujur = '".substr($_POST['bujur'],1)."'");
	$ins->execute();
?>