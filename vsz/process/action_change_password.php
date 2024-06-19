<?php
ob_start();

session_start(); // Start the session

// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include '../config.php';

$code = 0;
$data = array();
$status_code = 200;
$errors = [];

// print_r($_REQUEST);
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_REQUEST['current_password']) && isset($_REQUEST['new_password']) && isset($_REQUEST['confirm_password'])) {
    if ($_REQUEST['new_password'] == $_REQUEST['confirm_password']) {

        $currentPassword = $_REQUEST['current_password'];
        $newPassword = $_REQUEST['new_password'];

        // Fetch user data 
        $userId = $_SESSION['vsz_admin']['vsz_admin_id'];
        $userQuery = "SELECT * FROM vsz_admin_users WHERE id='$userId' and (password='" . md5($currentPassword) . "' OR password='" . $currentPassword . "')";
        $userResult = mysqli_query($conn, $userQuery);

        // print_r($userResult);
        if ($userResult) {
            if (mysqli_num_rows($userResult) > 0) {
                $userData = mysqli_fetch_assoc($userResult);


                $updateQuery = "UPDATE vsz_admin_users SET password='$newPassword' WHERE id=$userId";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    $code = 1;
                    $message = "Password changed successfully.";

                } else {
                    $message = "Error updating password";
                }

            } else {
                $message = "User not found.";
            }
        } else {
            $message = "Error fetching user data: " . mysqli_error($conn);
        }
    } else {
        $message = "Current password is not valid.";
    }
} else {
    $message = "Invalid request.";
}
// } else {
//     $message = "Invalid request method.";
// }

if ($code == 1) {
    $_SESSION['vsz_custom_error']['msg_type'] = "success";
} else {
    $_SESSION['vsz_custom_error']['msg_type'] = "error";
}
$_SESSION['vsz_custom_error']['err_msg'] = $message;

$_SESSION['vsz_custom_error'] = array();
$_SESSION['vsz_custom_error']['msg_type'] = $msg_type;
$_SESSION['vsz_custom_error']['err_msg_title'] = $err_msg_title;
$_SESSION['vsz_custom_error']['err_msg'] = $err_msg;
// print_r($_SESSION['vsz_custom_error']);
header("location:../user-profile.php");
?>
