<?php

ob_start();
session_start();
require_once("config.php");

$utype=mysqli_real_escape_string($conn,$_REQUEST['utype']);
$is_deleted="0";
$created_at=date('Y-m-d H:i:s');
$created_by=isset($_SESSION['vsz_admin']['vsz_admin_id']) ? $_SESSION['vsz_admin']['vsz_admin_id'] : null; // Check if session data exists

$updated_at=$created_at;
$updated_by=$created_by;
// $exname=$_SESSION['vsz_admin']['vsz_admin_id'];


if ($created_by !== null) { // Check if $created_by is not null
    mysqli_query($conn, "DELETE from vsz_user_access where utype='" . $utype . "'");

    $sel = "SELECT * from vsz_admin_menu WHERE is_deleted='0' ";
    $qry = mysqli_query($conn, $sel);
    while ($fet = mysqli_fetch_array($qry)) {
        $mname = $fet['mname'];
        $mtitle = $fet['mtitle'];
        $mid = $fet['mid'];
        $is_access = 0;
        if (isset($_REQUEST[$mname])) {
            $is_access = 1;
        }
        $query = mysqli_query($conn, "INSERT into vsz_user_access (utype,mid,mtitle,mname,is_access) values('" . $utype . "','" . $mid . "','" . $mtitle . "','" . $mname . "','" . $is_access . "')");
    }

    if ($query) {
        $msg_type = "success";
        $err_msg_title = "Success";
        $err_msg = "User access updated successfully";
    } else {
        $msg_type = "error";
        $err_msg_title = "Failure";
        $err_msg = "Error in updating user access details";
    }
    $_SESSION['msg'] = "done";

    // print_r($query);

    $_SESSION['vsz_custom_error'] = array();
    $_SESSION['vsz_custom_error']['msg_type'] = $msg_type;
    $_SESSION['vsz_custom_error']['err_msg_title'] = $err_msg_title;
    $_SESSION['vsz_custom_error']['err_msg'] = $err_msg;
    header("location:manage-user-role.php?id=".$utype);

} else {
    // Handle the case where session data is not available
}
?>