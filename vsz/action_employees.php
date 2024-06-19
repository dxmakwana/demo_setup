<?php
ob_start();
session_start();

require_once("config.php");

$first_name = mysqli_real_escape_string($conn, $_REQUEST['first_name']);
$middle_name = mysqli_real_escape_string($conn, $_REQUEST['middle_name']);
$last_name = mysqli_real_escape_string($conn, $_REQUEST['last_name']);
$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
$phone_number = mysqli_real_escape_string($conn, $_REQUEST['phone_number']);
$status = mysqli_real_escape_string($conn, $_REQUEST['status']);
$is_deleted = "0";
$created_at = date('Y-m-d H:i:s');
$created_by = $_SESSION['vsz_admin']['vsz_admin_id'];

$updated_at = $created_at;
$updated_by = $created_by;

$upload_path = "../uploads/";

$date_added = date('Y-m-d H:i:s');

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $update = "UPDATE vsz_employees SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', email='$email', phone_number='$phone_number', status='$status' WHERE id='$id'";
    $query = mysqli_query($conn, $update) or die(mysqli_error($conn));
    if ($query) {
        $msg_type = "success";
        $err_msg_title = "Success";   
        $err_msg = "Employee details updated successfully";
    } else {
        $msg_type = "error";
        $err_msg_title = "Failure";   
        $err_msg = "Error in updating employee details";
    }
} else {
    $insert = "INSERT INTO vsz_employees (first_name, middle_name, last_name, email, phone_number, status, is_deleted, created_at, created_by) VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$phone_number', '$status', '$is_deleted', '$created_at', '$created_by')";
    $query = mysqli_query($conn, $insert) or die(mysqli_error($conn));
    $id = mysqli_insert_id($conn);
	if ($query) {
        $msg_type = "success";
        $err_msg_title = "Success";   
        $err_msg = "Employee details added successfully";
    } else {
        $msg_type = "error";
        $err_msg_title = "Failure";   
        $err_msg = "Error in adding employee details";
    }
}
$_SESSION['vsz_custom_error'] = array();
$_SESSION['vsz_custom_error']['msg_type'] = $msg_type;
$_SESSION['vsz_custom_error']['err_msg_title'] = $err_msg_title;
$_SESSION['vsz_custom_error']['err_msg'] = $err_msg;

header("location:manage-employee.php");
?>
