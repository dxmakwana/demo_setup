<?php

error_reporting(E_ALL);

ini_set('display_errors', '1');

ob_start();
session_start();

require_once("config.php");

$first_name = mysqli_real_escape_string($conn, $_REQUEST['first_name']);
$middle_name = mysqli_real_escape_string($conn, $_REQUEST['middle_name']);
$last_name = mysqli_real_escape_string($conn, $_REQUEST['last_name']);
$address = mysqli_real_escape_string($conn, $_REQUEST['address']);
$country = mysqli_real_escape_string($conn, $_REQUEST['country']);
$state = mysqli_real_escape_string($conn, $_REQUEST['state']);
$city = mysqli_real_escape_string($conn, $_REQUEST['city']);
$zip_code = mysqli_real_escape_string($conn, $_REQUEST['zip_code']);
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
    $update = "UPDATE vsz_customer SET first_name='$first_name', middle_name='$middle_name', address='$address', last_name='$last_name', country='$country', state='$state', city='$city', zip_code='$zip_code', email='$email', phone_number='$phone_number', status='$status' WHERE id='$id'";
    $query = mysqli_query($conn, $update) or die(mysqli_error($conn));
    if ($query) {
        $msg_type = "success";
        $err_msg_title = "Success";   
        $err_msg = "Customer details updated successfully";
    } else {
        $msg_type = "error";
        $err_msg_title = "Failure";   
        $err_msg = "Error in updating customer details";
    }
} else {
    $insert = "INSERT INTO vsz_customer (first_name, address, middle_name, last_name, country, state, city, zip_code, email, phone_number, status, is_deleted, created_at, created_by) VALUES ('$first_name', '$address', '$middle_name', '$last_name', '$country', '$state', '$city', '$zip_code', '$email', '$phone_number', '$status', '$is_deleted', '$created_at', '$created_by')";
    $query = mysqli_query($conn, $insert) or die(mysqli_error($conn));
    $id = mysqli_insert_id($conn);
    if ($query) {
        $msg_type = "success";
        $err_msg_title = "Success";   
        $err_msg = "Customer details added successfully";
    } else {
        $msg_type = "error";
        $err_msg_title = "Failure";   
        $err_msg = "Error in adding customer details";
    }
}

$_SESSION['vsz_custom_error'] = array();
$_SESSION['vsz_custom_error']['msg_type'] = $msg_type;
$_SESSION['vsz_custom_error']['err_msg_title'] = $err_msg_title;
$_SESSION['vsz_custom_error']['err_msg'] = $err_msg;
header("location:manage-customer.php");
?>









