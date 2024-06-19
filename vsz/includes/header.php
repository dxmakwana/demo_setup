<?php
session_start();

if(!isset($_SESSION['vsz_admin']['vsz_admin_id'])) {
  
  ?>
  <script> window.location.href='index.php';</script>
  <?php
}
// print_r($_SESSION);
?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Dashboard | VSZ </title>



  

  <!-- Font Awesome -->

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Tempusdominus Bootstrap 4 -->

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- JQVMap -->

  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="assets/css/adminlte.min.css">

  <!-- overlayScrollbars -->

  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Daterange picker -->

  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

  <!-- summernote -->

  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- DataTables -->

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/custom.css?v=<?php echo uniqid();?>">

</head>

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="assets/img/logo.png" alt="VSZ logo">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light justify-content-between">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="user-profile.php">
        <!-- <img src="assets/img/logo.png" alt="Profile" class="rounded-circle"> -->
        <span>My Profile</span>
        <!-- <a href="index.php" class="nav-link">Profile</a> -->
      </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Logout</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

<!-- <body class="hold-transition sidebar-mini"> -->

<?php

  function check_is_access($mname,$utype="")

	{

		global $conn;

    if($utype=="" && isset($_SESSION['vsz_admin']['vsz_access_role']))

    {

      $utype = $_SESSION['vsz_admin']['vsz_access_role'];

    }

		

		$sel = "SELECT * from vsz_user_access where utype='$utype' and mname='$mname'";

		$qry = mysqli_query($conn,$sel);

		$fet = mysqli_fetch_array($qry);

		if(isset($fet['is_access']))

		{

			return $fet['is_access'];	

		}else

		{

			return 0;

		}

		

	}

?>





