<?php
	include '../../config/db.php';
  	$c = $db->pdo->prepare("select * from tbl_notif where status = '0'");
  	$c->execute();
  	echo $c->rowCount();
?>
