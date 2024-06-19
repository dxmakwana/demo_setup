<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
ob_start();
session_start();
require_once("config.php");
// $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null;

function CalculateTaskPropTotalCount($type,$mid,$param_type,$filter_condition="")
{
  global $conn;
  $count=0;
  if($type=="theme")
  {
    if($param_type=="0")
    {
      $additional_condition=" AND theme_categories!='' AND theme_categories!='[]'";
    }else
    {
      $additional_condition=" AND theme_sub_categories!='' AND theme_sub_categories!='[]'";
    }
    
    $sel_all_tasks=mysqli_query($conn,"SELECT * FROM vsz_task WHERE is_deleted='0' ".$additional_condition." ".$filter_condition);
    while ($fet_all_tasks=mysqli_fetch_assoc($sel_all_tasks)) 
    {
      $check_arr=array();
      if($param_type=="0")
      {
        $theme_categories=$fet_all_tasks['theme_categories'];
        $check_arr=json_decode($theme_categories,true);
      }else
      {
        $theme_sub_categories=$fet_all_tasks['theme_sub_categories'];
        $check_arr=json_decode($theme_sub_categories,true);
      } 
      if(in_array($mid,$check_arr))
      {
        $count++;
      }
    }
  }
  
  if($type=="processing")
  {
    $count=0;
    if($param_type=="0")
    {
      $additional_condition=" AND processing_type_categories!='' AND processing_type_categories!='[]'";
    }else
    {
      $additional_condition=" AND processing_type_sub_categories!='' AND processing_type_sub_categories!='[]'";
    }
    
    $sel_all_tasks=mysqli_query($conn,"SELECT * FROM vsz_task WHERE is_deleted='0' ".$additional_condition." ".$filter_condition);
    while ($fet_all_tasks=mysqli_fetch_assoc($sel_all_tasks)) 
    {
      $check_arr=array();
      if($param_type=="0")
      {
        $processing_type_categories=$fet_all_tasks['processing_type_categories'];
        $check_arr=json_decode($processing_type_categories,true);
      }else
      {
        $processing_type_sub_categories=$fet_all_tasks['processing_type_sub_categories'];
        $check_arr=json_decode($processing_type_sub_categories,true);
      } 
      if(in_array($mid,$check_arr))
      {
        $count++;
      }
    }
  }
  if($type=="antragsteller")
  {
    $count=0;
    if($param_type=="0")
    {
      $additional_condition=" AND antragsteller_categories!='' AND antragsteller_categories!='[]'";
    }else
    {
      $additional_condition=" AND antragsteller_sub_categories!='' AND antragsteller_sub_categories!='[]'";
    }
    
    $sel_all_tasks=mysqli_query($conn,"SELECT * FROM vsz_task WHERE is_deleted='0' ".$additional_condition." ".$filter_condition);
    while ($fet_all_tasks=mysqli_fetch_assoc($sel_all_tasks)) 
    {
      $check_arr=array();
      if($param_type=="0")
      {
        $antragsteller_categories=$fet_all_tasks['antragsteller_categories'];
        $check_arr=json_decode($antragsteller_categories,true);
      }else
      {
        $antragsteller_sub_categories=$fet_all_tasks['antragsteller_sub_categories'];
        $check_arr=json_decode($antragsteller_sub_categories,true);
      } 
      if(in_array($mid,$check_arr))
      {
        $count++;
      }
    }
  }
  return $count;
}

function generateCSV($conn,$filter_date_from,$filter_date_to,$filter_status)
{
    $filter_condition="";
    if(isset($filter_date_from) && $filter_date_from!="")
    {
        $filter_condition.=" AND end_date>= '".$filter_date_from."'";
    }
    if(isset($filter_date_to) && $filter_date_to!="")
    {
        $filter_condition.=" AND end_date<= '".$filter_date_to."'";
    }
    if(isset($filter_status) && $filter_status!="")
    {
        $filter_condition.=" AND status= '".$filter_status."'";
    }

    
    
    

    

    // Start CSV Data
    $report_data_csv=array();
	$cs_line=0;
    $report_data_csv[$cs_line]=array('Task Report Details');
    $cs_line++;
    
    
    $report_data_csv[$cs_line]=array('');
    $cs_line++;$cs_line++;

    $report_data_csv[$cs_line]=array('Antragsteller');
    $cs_line++;
    $sel_antragsteller_parent_menus = "SELECT * FROM vsz_task_antragsteller WHERE pmenu = 0 AND is_deleted = 0";
    $que_antragsteller_parent_menus = mysqli_query($conn, $sel_antragsteller_parent_menus);
    while ($antragsteller_parent_menu = mysqli_fetch_array($que_antragsteller_parent_menus)) 
    {
        $current_count = CalculateTaskPropTotalCount("antragsteller", $antragsteller_parent_menu['id'], $antragsteller_parent_menu['pmenu']);

        if($antragsteller_parent_menu["mname"]!="")
        {
            $report_data_csv[$cs_line]=array($antragsteller_parent_menu["mname"],$current_count);
            $cs_line++;    
        }
        
        
        // Fetch child menu items for the current parent menu item
        $sel_antragsteller_child_menus = "SELECT * FROM vsz_task_antragsteller WHERE pmenu = " . $antragsteller_parent_menu['id'] . " AND is_deleted = 0";
        $que_antragsteller_child_menus = mysqli_query($conn, $sel_antragsteller_child_menus);
        while ($antragsteller_child_menu = mysqli_fetch_array($que_antragsteller_child_menus)) 
        {
            $current_count = CalculateTaskPropTotalCount("antragsteller", $antragsteller_child_menu['id'], $antragsteller_child_menu['pmenu']);
            if($antragsteller_child_menu["mname"]!="")
            {
                $report_data_csv[$cs_line]=array("  - ".$antragsteller_child_menu["mname"],$current_count);
                $cs_line++;
            }
            
        }
    }

    $report_data_csv[$cs_line]=array('');
    $cs_line++;$cs_line++;

    $report_data_csv[$cs_line]=array('Themes');
    $cs_line++;
    $sel_theam_category_parent_menus = "SELECT * FROM vsz_theam_category WHERE pmenu = 0 AND is_deleted = 0";
    $que_theam_category_parent_menus = mysqli_query($conn, $sel_theam_category_parent_menus);
    while ($theam_category_parent_menu = mysqli_fetch_array($que_theam_category_parent_menus)) 
    {
        $current_count = CalculateTaskPropTotalCount("theme", $theam_category_parent_menu['id'], $theam_category_parent_menu['pmenu']);

        if($theam_category_parent_menu["mname"]!="")
        {
            $report_data_csv[$cs_line]=array($theam_category_parent_menu["mname"],$current_count);
            $cs_line++;
        }
        
        
        // Fetch child menu items for the current parent menu item
        $sel_theam_category_child_menus = "SELECT * FROM vsz_theam_category WHERE pmenu = " . $theam_category_parent_menu['id'] . " AND is_deleted = 0";
        $que_theam_category_child_menus = mysqli_query($conn, $sel_theam_category_child_menus);
        while ($theam_category_child_menu = mysqli_fetch_array($que_theam_category_child_menus)) 
        {
            $current_count = CalculateTaskPropTotalCount("theme", $theam_category_child_menu['id'], $theam_category_child_menu['pmenu']);

            if($theam_category_child_menu["mname"]!="")
            {
                $report_data_csv[$cs_line]=array("  - ".$theam_category_child_menu["mname"],$current_count);
                $cs_line++;
            }
            
        }
    }
    $report_data_csv[$cs_line]=array('');
    $cs_line++;$cs_line++;

    $report_data_csv[$cs_line]=array('Processing Type');
    $cs_line++;
    $sel_processing_parent_menus = "SELECT * FROM vsz_type_of_processing WHERE pmenu = 0 AND is_deleted = 0";
    $que_processing_parent_menus = mysqli_query($conn, $sel_processing_parent_menus);
    while ($processing_parent_menu = mysqli_fetch_array($que_processing_parent_menus)) 
    {
        $current_count = CalculateTaskPropTotalCount("processing", $processing_parent_menu['id'], $processing_parent_menu['pmenu']);

        if($processing_parent_menu["mname"]!="")
        {
            $report_data_csv[$cs_line]=array($processing_parent_menu["mname"],$current_count);
            $cs_line++;
        }
        
        
        // Fetch child menu items for the current parent menu item
        $sel_processing_child_menus = "SELECT * FROM vsz_type_of_processing WHERE pmenu = " . $processing_parent_menu['id'] . " AND is_deleted = 0";
        $que_processing_child_menus = mysqli_query($conn, $sel_processing_child_menus);
        while ($processing_child_menu = mysqli_fetch_array($que_processing_child_menus)) 
        {
            $current_count = CalculateTaskPropTotalCount("processing", $processing_child_menu['id'], $processing_child_menu['pmenu']);

            if($processing_child_menu!="")
            {
                $report_data_csv[$cs_line]=array("  - ".$processing_child_menu["mname"],$current_count);
                $cs_line++;
            }
            
        }
    }

    $file_path=$_SERVER['DOCUMENT_ROOT'].'/uploads/';
	$file_name='ExportTaskRePort-'.uniqid().'.csv';
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

if(isset($_REQUEST['export_request']) )
{
    $filter_date_from=$_REQUEST['filter_date_from'];
    $filter_date_to=$_REQUEST['filter_date_to'];
    $filter_status=$_REQUEST['filter_status'];
        
        $file_name=generateCSV($conn,$filter_date_from,$filter_date_to,$filter_status);
        $file_link= "uploads/".$file_name;
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <a download href="<?php echo $file_link; ?>" id="download_link" style="display: none;">Download <?php echo $file_name;?></a>
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
    ?><script> window.location.href='manage-task.php';</script><?php
}

?>