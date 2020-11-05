<?php
	include '../config/db.php';
	$ins = $db->pdo->prepare("insert into tbl_kelompok set nama_kelompok = '".$_POST['nama_kelompok']."',
							  tanggal_registrasi = '".date("Y-m-d")."'");
	$ins->execute();
	if($ins){
		echo 'Registrasi Kelompok bekkkrhasil!';
	}else{
		echo 'Ada kesalahan!';
	}
?>