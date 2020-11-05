<?php 
	include '../config/db.php';
	$sql = "SELECT * FROM tbl_kelompok";
	$r = $db->pdo->prepare($sql);
	$r->execute();
	$result = array();
	while($row = $r->fetch()){
		array_push($result,array('id_kelompok'=>$row['id_kelompok'], 'nama_kelompok'=>$row['nama_kelompok']));
	}
	echo json_encode(array('result'=>$result));
?>