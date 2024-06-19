<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
ob_start();
session_start();
require_once("config.php");
// $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null;
function createZipAndDownload($files, $filesPath, $zipFileName)
{
    // Create instance of ZipArchive. and open the zip folder.
    $zip = new \ZipArchive();
    if ($zip->open($zipFileName, \ZipArchive::CREATE) !== TRUE) {
        exit("cannot open <$zipFileName>\n");
    }

    // Adding every attachments files into the ZIP.
    foreach ($files as $file) {
        $zip->addFile($filesPath . $file, $file);
    }
    $zip->close();

    // Download the created zip file
    header("Content-type: application/zip");
    header("Content-Disposition: attachment; filename = $zipFileName");
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile("$zipFileName");
    // echo '<script>window.location.href="manage-task.php";</script>';
    exit;
    // header("Location: manage-task.php");
}
function generateCSV($conn,$task_id)
{
    $sel_task_details=mysqli_query($conn,"SELECT * from vsz_task WHERE id='".$task_id."' ");
    $fetch=mysqli_fetch_assoc($sel_task_details);
    
    // Get Cust Name
    $customer_name_id = $fetch['customer_id'];
    $customer_name_query = "SELECT first_name FROM vsz_customer WHERE id='$customer_name_id'";
    $customer_name_result = mysqli_query($conn, $customer_name_query);
    $customer_name_data = mysqli_fetch_assoc($customer_name_result);
    $customer_name=$customer_name_data['first_name'];
    // Get EMployee name
    $employee_name_id = $fetch['advisor'];
    $employee_name_query = "SELECT first_name FROM vsz_employees WHERE id='$employee_name_id'";
    $employee_name_result = mysqli_query($conn, $employee_name_query);
    $employee_name_data = mysqli_fetch_assoc($employee_name_result);
    $employee_name= $employee_name_data['first_name'];

    if($fetch['status']==1)
    {
        $status_name="Active";
    }else
    {
        $status_name="Inactive";   
    }

    // Start CSV Data
    $report_data_csv=array();
	$cs_line=0;
    $report_data_csv[$cs_line]=array('Task Details');
    $cs_line++;
    
    $report_data_csv[$cs_line]=array('Customer',$customer_name,'Task Title',$fetch['task_title']);
    $cs_line++;

    $report_data_csv[$cs_line]=array('Start Date',$fetch['start_date'],'End Date',$fetch['end_date']);
    $cs_line++;

    $report_data_csv[$cs_line]=array('Advisor',$employee_name,'Status',$status_name);
    $cs_line++;

    $report_data_csv[$cs_line]=array('Description',$fetch['description']);
    $cs_line++; 

    
    $report_data_csv[$cs_line]=array(' ');
    $cs_line++;
    $report_data_csv[$cs_line]=array('Personal Information');
    $cs_line++;
   
    $report_data_csv[$cs_line]=array('First Name',$fetch['personal_first_name'],'Last Name',$fetch['personal_last_name']);
    $cs_line++;

    $report_data_csv[$cs_line]=array('Email Address',$fetch['personal_email'],'Phone Number',$fetch['personal_phone_number']);
    $cs_line++;

    $report_data_csv[$cs_line]=array('Address',$fetch['personal_address']);
    $cs_line++;

    $report_data_csv[$cs_line]=array(' ');
    $cs_line++;
    $report_data_csv[$cs_line]=array('Duration Of The Task');
    $cs_line++;


    $report_data_csv[$cs_line]=array('Date','Time','Decription');
    $cs_line++;
    $sel_task_duration=mysqli_query($conn,"SELECT * from vsz_task_duration WHERE task_id='".$task_id."' ");
                                                
    while($fetch_duration=mysqli_fetch_assoc($sel_task_duration))
    {

         // Fetch start time and end time from the database
         $start_time = $fetch_duration['start_time'];
         $end_time = $fetch_duration['end_time'];
         
         // Format start time and end time with AM/PM
         $formatted_start_time = date("h:i A", strtotime($start_time));
         $formatted_end_time = date("h:i A", strtotime($end_time));
         
         // Output formatted start time and end time
         $duration_time= $formatted_start_time . " to " . $formatted_end_time;

        $report_data_csv[$cs_line]=array($fetch_duration['date'],$duration_time,$fetch_duration['duration_description']);
        $cs_line++;

    }
    $report_data_csv[$cs_line]=array(' ');
    $cs_line++;
    $report_data_csv[$cs_line]=array('Themes');
    $cs_line++;

    $fetch['theme_categories']=json_decode($fetch['theme_categories'],true);
    $fetch['theme_sub_categories']=json_decode($fetch['theme_sub_categories'],true);

    $sel_parent_menus = "SELECT * FROM vsz_theam_category WHERE pmenu = 0 AND is_deleted = 0";
    $que_parent_menus = mysqli_query($conn, $sel_parent_menus);
    while ($parent_menu = mysqli_fetch_array($que_parent_menus)) 
    {
        if(isset($fetch['theme_categories']) && in_array($parent_menu['id'],$fetch['theme_categories']) )
        {
            $report_data_csv[$cs_line]=array($parent_menu['mname']);
            $cs_line++;

            $child_arr=array();
            $child_arr[0]="";
            // Fetch child menu items for the current parent menu item
            $sel_child_menus = "SELECT * FROM vsz_theam_category WHERE pmenu = " . $parent_menu['id'] . " AND is_deleted = 0";
            $que_child_menus = mysqli_query($conn, $sel_child_menus);
            while ($child_menu = mysqli_fetch_array($que_child_menus)) 
            {
                if(isset($fetch['theme_sub_categories']) && in_array($child_menu['id'],$fetch['theme_sub_categories']) )
                {
                    
                    array_push($child_arr,$child_menu['mname']);
                }
            }
            $report_data_csv[$cs_line]=$child_arr;
            $cs_line++;
        }
    }

    
    $report_data_csv[$cs_line]=array(' ');
    $cs_line++;
    $report_data_csv[$cs_line]=array('Type of processing');
    $cs_line++;

    $fetch['processing_type_categories']=json_decode($fetch['processing_type_categories'],true);
    $fetch['processing_type_sub_categories']=json_decode($fetch['processing_type_sub_categories'],true);

    $sel_parent_menus = "SELECT * FROM vsz_type_of_processing WHERE pmenu = 0 AND is_deleted = 0";
    $que_parent_menus = mysqli_query($conn, $sel_parent_menus);
    while ($parent_menu = mysqli_fetch_array($que_parent_menus)) 
    {
        if(isset($fetch['processing_type_categories']) && in_array($parent_menu['id'],$fetch['processing_type_categories']) )
        {
            $report_data_csv[$cs_line]=array($parent_menu['mname']);
            $cs_line++;

            $child_arr=array();
            $child_arr[0]="";
            // Fetch child menu items for the current parent menu item
            $sel_child_menus = "SELECT * FROM vsz_type_of_processing WHERE pmenu = " . $parent_menu['id'] . " AND is_deleted = 0";
            $que_child_menus = mysqli_query($conn, $sel_child_menus);
            while ($child_menu = mysqli_fetch_array($que_child_menus)) 
            {
                if(isset($fetch['processing_type_sub_categories']) && in_array($child_menu['id'],$fetch['processing_type_sub_categories']) )
                {
                    
                    array_push($child_arr,$child_menu['mname']);
                }
            }
            $report_data_csv[$cs_line]=$child_arr;
            $cs_line++;
        }
    }

    $cs_line++;
    $report_data_csv[$cs_line]=array(' ');
    $cs_line++;
    $report_data_csv[$cs_line]=array('Comments');
    $cs_line++;

    $report_data_csv[$cs_line]=array('#','Date','Comment Text');
    $cs_line++;

    $task_comment_query = "SELECT * FROM vsz_task_comment WHERE task_id = '$task_id'";
    $result_comment = mysqli_query($conn, $task_comment_query);
    // $upload_path = 'uploads/';

    $ccic=0;
    while ($comment = mysqli_fetch_assoc($result_comment)) 
    {
        $ccic++;
        $report_data_csv[$cs_line]=array($ccic, date('m/d/Y', strtotime($comment['created_at'])),$comment['comment']);
        $cs_line++;
    }
    $file_path=$_SERVER['DOCUMENT_ROOT'].'/uploads/';
	$file_name='ExportTask-'.uniqid().'.csv';
	$file_name=str_replace(" ", "_", $file_name);
	$file_name=str_replace("/", "-", $file_name);
	
	$f = fopen('uploads/'.$file_name, 'a');
		// Write to the csv
	foreach ($report_data_csv as $new_data) {
		fputcsv($f, $new_data);
	}
	// Close the file
	fclose($f);
    return $file_name;
}

if(isset($_REQUEST['id']) && $_REQUEST['id']!="" && base64_decode($_REQUEST['id'])!="")
{
    $enc_ids=base64_decode($_REQUEST['id']);
    $task_id_arr=array();
    if(strpos($enc_ids,",")!==false)
    {
        $task_id_arr=explode(",",$enc_ids);
    }else
    {
        $task_id_arr[0]=$enc_ids;
    }
    
    if(count($task_id_arr)==1)
    {
        $task_id=$task_id_arr[0];
        $file_name=generateCSV($conn,$task_id);
        $file_link= "uploads/".$file_name;
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <a download="download" href="<?php echo $file_link; ?>" id="download_link" style="display: none;">download</a>
        <script>
            $(document).ready(function (e) {
                // $("#download_link").trigger();
                document.getElementById("download_link").click();
                setTimeout(function(){ 
                    window.location.href="manage-task.php";
                }, 2000);    
            });
            
        </script>
    <?php
    }else
    {
        $file_name_arr=array();
        for ($i=0; $i < count($task_id_arr); $i++) 
        { 
            $task_id=$task_id_arr[$i];
            $file_name=generateCSV($conn,$task_id);
            $file_name_arr[]=$file_name;
        }
        $zipfile_name='task_export_'.uniqid().'.zip';
        createZipAndDownload($file_name_arr, 'uploads/', 'task_export_'.uniqid().'.zip'); 
        $file_link= 'uploads/'.$zipfile_name;
        
    }
}else
{
    ?><script> window.location.href='manage-task.php';</script><?php
}

?>