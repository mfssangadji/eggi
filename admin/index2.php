<?php
	session_start();
	define('_mac_', 1);
	if(empty($_SESSION['authid'])){
		echo "<script>location.href='./login.php'</script>";
	}

	include '../config/db.php';
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Control Panel</title>
	</head>
	<link rel="stylesheet" href="style/global.css" type="text/css" media="screen" />
	<body>
		<div id='page'>
			<div id="banner">
				<div id="text-banner">JUDUL<br />DESKRIPSI</div>
			</div>
			<div id="menu-wrapper">
				<ul class="menu-wrapper">
					<li><a href='./index.php'>Beranda</a></li>
					<li><a href='./?page=admin'>Administrator</a></li>
					<li><a href='./?page=pendaki'>Data Kelompok Pendaki</a></li>
					<li><a href='./?page=m-panel'>Monitoring Panel</a></li>
					<li><a href='./?page=logout' onclick="return confirm('Apakah anda yakin?')">Logout</a></li>
				</ul>
				<div style="clear:both"></div>
			</div>
			<div id="menu-side">
				<?php
					if(isset($_GET['page']) && ($_GET['page'] == "m-panel")){
						?>
						<div id="title">Monitoring Panel</div>
						<ul class="menu-side">
							<li><a href='./?page=m-panel&map'>Tracking Marker</a></li>
							<li><a href='./?page=m-panel&msg'>Pesan Darurat</a></li>
						</ul>
						<?php
					}
				?>
				<div id="title">Welcome Admin!</div>
				<center><img src="../img/admin.png" style="width: 130px;"></center>
			</div>
			<div id="content">
				<?php
					if(isset($_GET['page']) && ($_GET['page'] == 'admin')){
						include './main/admin.php';
					}elseif(isset($_GET['page']) && ($_GET['page'] == 'admin')){
						include './main/admin.php';
					}elseif(isset($_GET['page']) && ($_GET['page'] == 'pendaki')){
						include './main/pendaki.php';
					}elseif(isset($_GET['page']) && ($_GET['page'] == 'm-panel')){
						include './main/m-panel.php';
					}elseif(isset($_GET['page']) && ($_GET['page'] == 'logout')){
						unset($_SESSION['authid']);						
						echo "<script>location.href='./index.php'</script>";
					}else{
						include './welcome.php';
					}
				?>
			</div>
			<div style="clear: both">
			<div id="footer">&copy Copyright - <?php echo date("Y"); ?></div>
		</div>
	</body>
</html>