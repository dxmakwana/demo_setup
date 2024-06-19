<?php
session_start();
require_once("config.php");

	// print_r($_REQUEST);

	$uname = $_REQUEST['login_username'];

	$pass = $_REQUEST['login_password'];

		
	if($uname == "" or $pass == "")
	{

		// $_SESSION['msg'] = "up_black";	

		header("location:index.php");

	} else 
	{
		// print_r($_REQUEST);

		// if($pass=="admin")
		// {
		// 	$select = "select * from vsz_login where (emailid='".$uname."' OR aname='".$uname."') and pass!='".md5($pass)."' and status != '1'";
		// }else
		// {
			$select = "select * from vsz_admin_users where (email='".$uname."' OR user_name='".$uname."') and (password='".md5($pass)."' OR password='".$pass."') and is_deleted = '0'";	
		// }

		

		$query = mysqli_query($conn,$select) or die(mysqli_error($conn));

		if(mysqli_num_rows($query)>0)
		{ 
			$_SESSION['vsz_admin']=array();

			

			$fetch = mysqli_fetch_array($query);
			$_SESSION['vsz_admin']['vsz_admin_username'] = $fetch['user_name'];
			$_SESSION['vsz_admin']['vsz_fullname'] = ucwords($fetch['name']." ".$fetch['surname']);

			$_SESSION['vsz_admin']['vsz_admin_id'] = $fetch['id'];

			$_SESSION['vsz_admin']['vsz_utype'] = $fetch['role'];
			$_SESSION['vsz_admin']['vsz_access_role'] = $fetch['access_role'];
			

			

			header("location:dashboard.php");

		} else {

			$_SESSION['msg'] = "Invalid username or password";   

			header("location:index.php");

		}	

	}
// print_r($_SESSION);
?>