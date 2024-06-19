<?php
ob_start();
include '../config.php';


$code=0;
    $task_id = isset($_POST['task_id']) ? $_POST['task_id'] : null;
    
    $upload_directory = "../uploads/";
    $deleted_at = "0";
    $created_at=date('Y-m-d H:i:s');

    $created_by = $_SESSION['vsz_admin']['vsz_admin_id'];

    

    // Handle document upload
    if (isset($_FILES['document']) && $_FILES['document']['name'][0] != "") 
    {
        for($dc=0 ; $dc<count($_FILES["document"]["name"]) ; $dc++)
        {
            
            if($_FILES["document"]["name"][$dc]!="")
            {

            
                $file_name = uniqid().basename($_FILES["document"]["name"][$dc]);
                $upload_path = $upload_directory . $file_name;

                if (move_uploaded_file($_FILES["document"]["tmp_name"][$dc], $upload_path)) {
                    // Update the existing damage case record with document details
                    $update_query = "INSERT INTO vsz_task_document (task_id, document, deleted_at, created_at, created_by) VALUES ('$task_id', '$file_name', '$deleted_at', '$created_at', '$created_by')";
                    $stmt_update = mysqli_query($conn, $update_query);
        
                    if ($stmt_update) 
                    {
                        $current_doc_id=mysqli_insert_id($conn);
                        $code=1;
                        $msg="Document uploaded successfully";
                        if($task_id==0)
                        {
                            if(!isset($_REQUEST['upload_request_doc'])){$_REQUEST['upload_request_doc']=array();}
                            $_REQUEST['upload_request_doc'][]=$current_doc_id;
                        }
                        
                    } else {
                        
                        $msg="Error while uploading document.";
                    }

                    // mysqli_stmt_close($stmt_update);
                }
            }
        } 
    } else {
        
        $msg="Document not avail to upload.";
    }
    
    
    if($code==1)
    {
        $msg_type="success";
        $msg_title="Success";
    }else
    {
        $msg_type="error";
        $msg_title="Failure";
    }
    $_SESSION['vsz_custom_error']['msg_type']=$msg_type;
    $_SESSION['vsz_custom_error']['err_msg_title']=$msg_title;
    $_SESSION['vsz_custom_error']['err_msg']=$msg;


    header("Location: {$_SERVER['HTTP_REFERER']}");

?>
