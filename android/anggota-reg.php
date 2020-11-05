<?php
	include '../config/db.php';
	$c = $db->pdo->prepare("select * from tbl_kelompok where nama_kelompok LIKE '%".$_POST['id_kelompok']."%'");
	$c->execute();
	$rc = $c->fetch();
	$ins = $db->pdo->prepare("insert into tbl_pendaki set id_kelompok = '".$rc['id_kelompok']."', nik = '".$_POST['nik']."',
							  nama_lengkap = '".$_POST['nama_lengkap']."',
							  jenis_kelamin = '".$_POST['jenis_kelamin']."',
							  umur = '".$_POST['umur']."',
							  no_telp = '".$_POST['no_telp']."'");
	$ins->execute();
	if($ins){
		echo 'Registrasi berhasil.';
	}else{
		echo 'Ada kesalahan!';
	}
?>