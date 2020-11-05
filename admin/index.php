<?php
    session_start();
	if(empty($_SESSION['authid'])){
		echo "<script>location.href='login.php'</script>";
	}
    include "../config/db.php";
    $st = $_SESSION['status'];
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Panel</title>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.js"></script>
  <script src="plugins/locales/datepicker/bootstrap-datepicker.js"></script>
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Beranda</a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Cpanel</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
             <a href="./index.php" class="nav-link">
               <i class="nav-icon fa fa-edit"></i>
               <p>Beranda</p>
             </a>
           </li>
           <li class="nav-item has-treeview">
            <a href="./?page=persyaratan" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>Persyaratan</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="./?page=admin" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>Data Administrator</p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="./?page=notif" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <script type="text/javascript">
                    setInterval(function loaderx(){
                      var ajaxRequest; 
                        try {
                            ajaxRequest = new XMLHttpRequest();
                         }catch (e) {
                            try {
                               ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                            }catch (e) {
                               try{
                                  ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                               }catch (e){
                                  alert("Your browser broke!");
                                  return false;
                               }
                            }
                         }
                        
                         ajaxRequest.onreadystatechange = function(){
                            if(ajaxRequest.readyState == 4){
                               var part = ajaxRequest.responseText;
                               if(part > 0){
                                  document.getElementById('notif').innerHTML = "<span style='background-color: red; border-radius: 100px; color: #FFF; padding: 5px; font-weight: bold'>" + part + "</span>";
                               }
                            }
                         }
                   
                        ajaxRequest.open("GET", "main/notif.php", true);
                        ajaxRequest.send(null); 
                      },1000)
                  </script>
              <p>Notifikasi Pendaki <span id="notif"></span>
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="./?page=pendaki" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>Data Kelompok Pendaki</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="./?page=pendakian" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>Data Pendakian</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="./?page=logout" onclick="return confirm('Apakah anda yakin?')" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <?php
        if(isset($_GET['page']) && ($_GET['page'] == "admin")){
            include "./main/admin.php";
        }elseif(isset($_GET['page']) && ($_GET['page'] == "persyaratan")){
            include "./main/persyaratan.php";
        }elseif(isset($_GET['page']) && ($_GET['page'] == "pendaki")){
            include "./main/pendaki.php";
        }elseif(isset($_GET['page']) && ($_GET['page'] == "pendakian")){
            include "./main/pendakian.php";
        }elseif(isset($_GET['page']) && ($_GET['page'] == "m-panel")){
            include "./main/m-panel.php";
        }elseif(isset($_GET['page']) && ($_GET['page'] == "lokasi")){
            include "./main/lokasi.php";
        }elseif(isset($_GET['page']) && ($_GET['page'] == "notif")){
            include "./main/notif-p.php";
        }elseif(isset($_GET['page']) && ($_GET['page'] == "logout")){
            unset($_SESSION['authid']);
			      echo "<script>location.href='./index.php'</script>";
        }else{
            include "welcome.php";
        }
    ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> </strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
