<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

ob_start();
require_once("config.php");

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

$customer_id = mysqli_real_escape_string($conn, $_REQUEST['customer_id']);
$end_date = mysqli_real_escape_string($conn, $_REQUEST['end_date']);
$advisor = mysqli_real_escape_string($conn, $_REQUEST['advisor']);
$task_title = mysqli_real_escape_string($conn, $_REQUEST['task_title']);
$description = mysqli_real_escape_string($conn, $_REQUEST['description']);
$start_date = mysqli_real_escape_string($conn, $_REQUEST['start_date']);
$status = mysqli_real_escape_string($conn, $_REQUEST['status']);
$personal_first_name = mysqli_real_escape_string($conn, $_REQUEST['personal_first_name']);
$personal_email = mysqli_real_escape_string($conn, $_REQUEST['personal_email']);
$personal_phone_number = mysqli_real_escape_string($conn, $_REQUEST['personal_phone_number']);
$personal_last_name = mysqli_real_escape_string($conn, $_REQUEST['personal_last_name']);
$personal_address = mysqli_real_escape_string($conn, $_REQUEST['personal_address']);
$problem = mysqli_real_escape_string($conn, $_REQUEST['problem']);
$sugge_solution = mysqli_real_escape_string($conn, $_REQUEST['sugge_solution']);

// $date = mysqli_real_escape_string($conn, $_REQUEST['date']);
// $start_time = mysqli_real_escape_string($conn, $_REQUEST['start_time']);
// $end_time = mysqli_real_escape_string($conn, $_REQUEST['end_time']);
// $duration_description = mysqli_real_escape_string($conn, $_REQUEST['duration_description']);

$antragsteller_categories = array();
if (isset($_REQUEST['antragsteller_categories']) && count($_REQUEST['antragsteller_categories']) > 0) {
    $antragsteller_categories = $_REQUEST['antragsteller_categories'];
}
$antragsteller_categories_json = json_encode($antragsteller_categories);

$antragsteller_sub_categories = array();
if (isset($_REQUEST['antragsteller_sub_categories']) && count($_REQUEST['antragsteller_sub_categories']) > 0) {
    $antragsteller_sub_categories = $_REQUEST['antragsteller_sub_categories'];
}
$antragsteller_sub_categories_json = json_encode($antragsteller_sub_categories);

$processing_type_categories = array();
if (isset($_REQUEST['processing_type_categories']) && count($_REQUEST['processing_type_categories']) > 0) {
    $processing_type_categories = $_REQUEST['processing_type_categories'];
}
$processing_type_categories_json = json_encode($processing_type_categories);

$processing_type_sub_categories = array();
if (isset($_REQUEST['processing_type_sub_categories']) && count($_REQUEST['processing_type_sub_categories']) > 0) {
    $processing_type_sub_categories = $_REQUEST['processing_type_sub_categories'];
}
$processing_type_sub_categories_json = json_encode($processing_type_sub_categories);

$theme_categories = array();
if (isset($_REQUEST['theme_categories']) && count($_REQUEST['theme_categories']) > 0) {
    $theme_categories = $_REQUEST['theme_categories'];
}
$theme_categories_json = json_encode($theme_categories);

$theme_sub_categories = array();
if (isset($_REQUEST['theme_sub_categories']) && count($_REQUEST['theme_sub_categories']) > 0) {
    $theme_sub_categories = $_REQUEST['theme_sub_categories'];
}
$theme_sub_categories_json = json_encode($theme_sub_categories);

$is_deleted = "0";
$created_at = date('Y-m-d H:i:s');
$created_by = '';

// Check if $_SESSION['vsz_admin']['vsz_admin_id'] is set
if (isset($_SESSION['vsz_admin']['vsz_admin_id'])) {
    $created_by = $_SESSION['vsz_admin']['vsz_admin_id'];
}

$upload_path = "../uploads/";

$date_added = date('d-m-Y');

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $update = "UPDATE vsz_task SET customer_id='$customer_id', end_date='$end_date', task_title='$task_title', advisor='$advisor', description='$description', start_date='$start_date', status='$status', personal_first_name='$personal_first_name', personal_email='$personal_email', personal_phone_number='$personal_phone_number', personal_last_name='$personal_last_name', personal_address='$personal_address', problem='$problem', sugge_solution='$sugge_solution', antragsteller_categories='$antragsteller_categories_json', antragsteller_sub_categories='$antragsteller_sub_categories_json', processing_type_categories='$processing_type_categories_json', processing_type_sub_categories='$processing_type_sub_categories_json', theme_categories='$theme_categories_json', theme_sub_categories='$theme_sub_categories_json' WHERE id='$id'";
    $query = mysqli_query($conn, $update) or die(mysqli_error($conn));
    if ($query) {
        // Update task_duration table here
        // $update_duration = "UPDATE vsz_task_duration SET date='$date', start_time='$start_time', end_time='$end_time', duration_description='$duration_description' WHERE task_id='$id'";
        // mysqli_query($conn, $update_duration) or die(mysqli_error($conn));

        if(isset($_REQUEST['task_duration_date']) && $_REQUEST['task_duration_date']>0)
        {
            $task_duration_date_arr=$_REQUEST['task_duration_date'];
            $task_duration_start_time_arr=$_REQUEST['task_duration_start_time'];
            $task_duration_end_time_arr=$_REQUEST['task_duration_end_time'];
            $task_duration_duration_description_arr=$_REQUEST['task_duration_duration_description'];

            // Remove Old Entries
            mysqli_query($conn,"DELETE FROM vsz_task_duration WHERE task_id='$id' ");
            for ($tdc=0; $tdc < count($task_duration_date_arr); $tdc++) 
            { 
                $date=$task_duration_date_arr[$tdc];
                $start_time=$task_duration_start_time_arr[$tdc];
                $end_time=$task_duration_end_time_arr[$tdc];
                $duration_description=$task_duration_duration_description_arr[$tdc];
                
                $insert_duration = "INSERT INTO vsz_task_duration (task_id, date, start_time, end_time, duration_description) VALUES ('$id', '$date', '$start_time', '$end_time', '$duration_description')";
                mysqli_query($conn, $insert_duration) or die(mysqli_error($conn));
            }
        }
        // print_r($update_duration);
        $msg_type = "success";
        $err_msg_title = "Success";
        $err_msg = "Task details updated successfully";
    } else {
        $msg_type = "error";
        $err_msg_title = "Failure";
        $err_msg = "Error in updating task details";
    }
} else {
    $insert = "INSERT INTO vsz_task (customer_id, task_title, end_date, advisor, description, start_date, status, personal_first_name, personal_email, personal_phone_number, personal_last_name, personal_address, problem, sugge_solution, is_deleted, created_at, created_by, antragsteller_categories, antragsteller_sub_categories, processing_type_categories, processing_type_sub_categories, theme_categories, theme_sub_categories) VALUES ('$customer_id', '$task_title', '$end_date', '$advisor', '$description', '$start_date', '$status', '$personal_first_name', '$personal_email', '$personal_phone_number', '$personal_last_name', '$personal_address', '$problem', '$sugge_solution', '$is_deleted', '$created_at', '$created_by', '$antragsteller_categories_json', '$antragsteller_sub_categories_json', '$processing_type_categories_json', '$processing_type_sub_categories_json', '$theme_categories_json', '$theme_sub_categories_json')";
    $query = mysqli_query($conn, $insert) or die(mysqli_error($conn));
    $id = mysqli_insert_id($conn);

    // Insert into task_duration table
    // $insert_duration = "INSERT INTO vsz_task_duration (task_id, date, start_time, end_time, duration_description) VALUES ('$id', '$date', '$start_time', '$end_time', '$duration_description')";
    // mysqli_query($conn, $insert_duration) or die(mysqli_error($conn));
// print_r($insert_duration );
    if ($query) 
    {
        if(isset($_REQUEST['task_duration_date']) && $_REQUEST['task_duration_date']>0)
        {
            $task_duration_date_arr=$_REQUEST['task_duration_date'];
            $task_duration_start_time_arr=$_REQUEST['task_duration_start_time'];
            $task_duration_end_time_arr=$_REQUEST['task_duration_end_time'];
            $task_duration_duration_description_arr=$_REQUEST['task_duration_duration_description'];

            // Remove Old Entries
            mysqli_query($conn,"DELETE FROM vsz_task_duration WHERE task_id='$id' ");
            for ($tdc=0; $tdc < count($task_duration_date_arr); $tdc++) 
            { 
                $date=$task_duration_date_arr[$tdc];
                $start_time=$task_duration_start_time_arr[$tdc];
                $end_time=$task_duration_end_time_arr[$tdc];
                $duration_description=$task_duration_duration_description_arr[$tdc];
                
                $insert_duration = "INSERT INTO vsz_task_duration (task_id, date, start_time, end_time, duration_description) VALUES ('$id', '$date', '$start_time', '$end_time', '$duration_description')";
                mysqli_query($conn, $insert_duration) or die(mysqli_error($conn));
            }
        }
        $msg_type = "success";
        $err_msg_title = "Success";
        $err_msg = "Task details added successfully";
    } else {
        $msg_type = "error";
        $err_msg_title = "Failure";
        $err_msg = "Error in adding task details";
    }
}

$_SESSION['vsz_custom_error'] = array();
$_SESSION['vsz_custom_error']['msg_type'] = $msg_type;
$_SESSION['vsz_custom_error']['err_msg_title'] = $err_msg_title;
$_SESSION['vsz_custom_error']['err_msg'] = $err_msg;
header("location:manage-task.php");
?>
