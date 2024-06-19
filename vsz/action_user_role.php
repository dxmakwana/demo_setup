<?php

ob_start();
session_start();

require_once("config.php");



// Escape and sanitize input

$name = mysqli_real_escape_string($conn, $_REQUEST['name']);



// Set default values

$is_deleted = "0";

$created_at = date('Y-m-d H:i:s');

$created_by = $_SESSION['vsz']['vsz_'];

$updated_at = $created_at;

$updated_by = $created_by;



// Define upload path

$upload_path = "../uploads/";



// Set default message values

$msg_type = "error";

$err_msg_title = "Failure";

$err_msg = "Unknown error occurred";



// Check if ID is provided for updating

if (isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];



    $update_query = "UPDATE vsz_user_type SET name='$name' WHERE id='$id'";

    $query_result = mysqli_query($conn, $update_query);



    if ($query_result) {

        $msg_type = "success";

        $err_msg_title = "Success";

        $err_msg = "User role details updated successfully";

    } else {

        $err_msg = "Error in updating user role details: " . mysqli_error($conn);

    }

} else {

    // Insert new record

    $insert_query = "INSERT INTO vsz_user_type (name, is_deleted, created_at, created_by) VALUES ('$name', '$is_deleted', '$created_at', '$created_by')";

    $query_result = mysqli_query($conn, $insert_query);



    if ($query_result) {

        $msg_type = "success";

        $err_msg_title = "Success";

        $err_msg = "User role added successfully";

    } else {

        $err_msg = "Error in adding user role details: " . mysqli_error($conn);

    }

}



// Store message in session

$_SESSION['vsz_custom_error'] = array(

    'msg_type' => $msg_type,

    'err_msg_title' => $err_msg_title,

    'err_msg' => $err_msg

);



// Redirect to the appropriate page

header("location:manage-user-role.php");

