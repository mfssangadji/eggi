<?php
	include '../config/db.php';
	$c = $db->pdo->prepare("update tbl_pendaki set status_pendakian = '0'
							where id_pendaki = '".$_POST['id']."'");
	$c->execute();
?>