<?php

// error_reporting(E_ALL);

// ini_set('display_errors', '1');
session_start();
require_once "config.php";

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    $id = $_GET["id"];

    // Delete query

    $sql = "DELETE FROM vsz_customer WHERE id = $id";

    if(mysqli_query($conn, $sql)) {
        $_SESSION['msg_type'] = "success";
        $_SESSION['err_msg_title'] = "Success";
        $_SESSION['err_msg'] = "Customer deleted successfully";
        header("location: manage-customer.php");
        exit();
    } else {
        $_SESSION['msg_type'] = "error";
        $_SESSION['err_msg_title'] = "Failure";
        $_SESSION['err_msg'] = "Oops! Something went wrong. Please try again later.";
        header("location: manage-customer.php");
        exit();
    }

}


$_SESSION['vsz_custom_error'] = array();
$_SESSION['vsz_custom_error']['msg_type'] = $msg_type;
$_SESSION['vsz_custom_error']['err_msg_title'] = $err_msg_title;
$_SESSION['vsz_custom_error']['err_msg'] = $err_msg;
mysqli_close($conn);

?>

