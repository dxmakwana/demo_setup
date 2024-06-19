<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

ob_start();
session_start();
require_once("config.php");
$task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null;
// $task_id = mysqli_real_escape_string($conn, $_REQUEST['id']); // Add task_id
$comment = mysqli_real_escape_string($conn, $_REQUEST['comment']);
$is_deleted = "0";
$created_at = date('Y-m-d H:i:s');

// if(isset($_REQUEST['id'])) {
//     $id = $_REQUEST['id'];
//     $update = "UPDATE vsz_task_comment SET comment='$comment' WHERE id='".$id."'";
//     $query = mysqli_query($conn, $update) or die(mysqli_error($conn));
// } else {
    $insert = "INSERT INTO vsz_task_comment (task_id, comment, is_deleted, created_at) VALUES ('$task_id', '$comment', '$is_deleted', '$created_at')";
    $query = mysqli_query($conn, $insert) or die(mysqli_error($conn));
    $id = mysqli_insert_id($conn);
// }

if($query) {
    $msg_type = "success";
    $err_msg_title = "Success";
    $err_msg = "Comment added successfully";
} else {
    $msg_type = "error";
    $err_msg_title = "Failure";
    $err_msg = "Error in adding comment";
}

$_SESSION['vsz_custom_error'] = array();
$_SESSION['vsz_custom_error']['msg_type'] = $msg_type;
$_SESSION['vsz_custom_error']['err_msg_title'] = $err_msg_title;
$_SESSION['vsz_custom_error']['err_msg'] = $err_msg;

// Redirect to the manage-task.php page
header("location: manage-task.php");
?>
