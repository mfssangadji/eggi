<?php 
	include '../config/db.php';
	$sql = "SELECT * FROM tbl_pendaki, tbl_kelompok
			WHERE tbl_pendaki.id_kelompok = tbl_kelompok.id_kelompok
			ORDER BY 1 DESC LIMIT 1";
	$r = $db->pdo->prepare($sql);
	$r->execute();
	$result = array();
	while($row = $r->fetch()){
		$result = array(
				'id_kelompok'=>$row['id_kelompok'],
				'nama_kelompok'=>$row['nama_kelompok'],
				'nik'=>$row['nik'],
				'nama_lengkap'=>$row['nama_lengkap'],
				'jenis_kelamin'=>$row['jenis_kelamin'],
				'umur'=>$row['umur'],
				'no_telp'=>$row['no_telp']
			);
	
	}
	echo json_encode($result);
?>