<?php
	include '../config/db.php';
	$k = $db->pdo->prepare("select * from tbl_kelompok order by 1 desc limit 1");
	$k->execute();
	$rk = $k->fetch();
	$idk = $rk['id_kelompok'];

	$ins = $db->pdo->prepare("insert into tbl_pendaki set id_kelompok = '".$idk."', nik = '".$_POST['nik']."',
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