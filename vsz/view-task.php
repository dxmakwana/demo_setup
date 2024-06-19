<?php
  $title="task Details";$active_menu="task_list";
  include "includes/header.php"; 
  require_once("config.php");

  if(isset($_REQUEST['id']) && $_REQUEST['id']!="")
  {
    $sel_task_details=mysqli_query($conn,"SELECT * from vsz_task WHERE id='".$_REQUEST['id']."' ");
    $fetch=mysqli_fetch_assoc($sel_task_details);
  }else
  {
    ?><script> window.location.href='manage-task.php';</script><?php
  }

 
    

?>
 


<!-- <style>
      .select2-container--bootstrap4 .select2-selection
      {
        height: 50px!important;
        border-radius: 20px!important;
        padding: 4px 10px;
      }
      </style> -->
      
  <main id="main" class="main">
  <aside class="main-sidebar sidebar-dark-secondary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <?php include 'includes/sidebar.php'; ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <div class="content-wrapper">
    <section class="content-header">

<div class="container-fluid">

  <div class="row mb-2">

    <div class="col-sm-6">

      <h1>Task</h1>

    </div>

    <div class="col-sm-6">

      <ol class="breadcrumb float-sm-right">

        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>

        <li class="breadcrumb-item"><a href="manage-task.php">Tasks</a></li>

        <li class="breadcrumb-item active">View All Task</li>

      </ol>

    </div>

  </div>

</div>

</section>
    <section class="section content">
        <body class="hold-transition sidebar-mini layout-fixed">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="card-title">View Task</h3>
                                        </div>    
                                        <div class="col-md-6 text-right print-none">
                                            <button type="button" onclick="print();" style="margin-top: 0;padding: 5px 20px;font-size: 15px;" class="btn btn-sm btn-secondary">Print</button>
                                        </div>    
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>"/>
                                    <div class="row pad_12">                                     
                                        <div class="col-md-6">
                                            <table class="table table-bordered table-striped">                                                    
                                                <tr class="de_bg">
                                                    <td>Customer :</td>
                                                    <td id="label_first_name">
                                                    <?php
                                                        $customer_name_id = $fetch['customer_id'];
                                                        $customer_name_query = "SELECT first_name FROM vsz_customer WHERE id='$customer_name_id'";
                                                        $customer_name_result = mysqli_query($conn, $customer_name_query);
                                                        $customer_name_data = mysqli_fetch_assoc($customer_name_result);
                                                        echo $customer_name_data['first_name'];
                                                        ?>
                                                   </td>
                                                </tr>
                                                <tr class="de_bg">
                                                    <td>Task Title :</td>
                                                    <td id="label_task_title"><?php echo $fetch['task_title']; ?></td>
                                                </tr>
                                                <tr  class="de_bg">
                                                    <td>Start Date :</td>
                                                    <td id="label_start_date"><?php echo $fetch['start_date']; ?></td>
                                                </tr>
                                                <tr class="de_bg">
                                                    <td>End Date :</td>
                                                    <td id="label_end_date"><?php echo $fetch['end_date']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered table-striped">
                                                <tr class="de_bg">
                                                    <td>Description :</td>
                                                    <td id="label_description"><?php echo $fetch['description']; ?></td>
                                                </tr>                                     
                                                <tr class="de_bg">
                                                    <td>Advisor :</td>
                                                    <td id="label_first_name">
                                                    <?php
                                                        $employee_name_id = $fetch['advisor'];
                                                        $employee_name_query = "SELECT first_name FROM vsz_employees WHERE id='$employee_name_id'";
                                                        $employee_name_result = mysqli_query($conn, $employee_name_query);
                                                        $employee_name_data = mysqli_fetch_assoc($employee_name_result);
                                                        if(isset($employee_name_data['first_name']))
                                                        {
                                                            echo $employee_name_data['first_name'];
                                                        }
                                                        
                                                        ?>
                                                   </td>
                                                </tr>
                                                <tr class="de_bg">
                                                    <td>Status :</td>
                                                    <td id="label_status"><?php echo ($fetch['status'] == 1) ? 'Active' : 'Inactive'; ?></td>
                                                </tr>
                                            </table> 
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header1">
                                    <h3 class="card-title">Personal Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row pad_12">                                     
                                        <div class="col-md-6">
                                            <table class="table table-bordered table-striped">                                                    
                                                <tr class="de_bg">
                                                    <td>First Name :</td>
                                                    <td id="label_personal_first_name"><?php echo $fetch['personal_first_name']; ?></td>
                                                </tr>
                                                <tr class="de_bg">
                                                    <td>Last Name :</td>
                                                    <td id="label_personal_last_name"><?php echo $fetch['personal_last_name']; ?></td>
                                                </tr>
                                                <tr  class="de_bg">
                                                    <td>Address :</td>
                                                    <td id="label_personal_address"><?php echo $fetch['personal_address']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-bordered table-striped">
                                                <tr class="de_bg">
                                                    <td>Email Address :</td>
                                                    <td id="label_personal_email"><?php echo $fetch['personal_email']; ?></td>
                                                </tr>
                                                
                                                <tr class="de_bg">
                                                    <td>Phone Number:</td>
                                                    <td id="label_personal_phone_number"><?php echo $fetch['personal_phone_number']; ?></td>
                                                </tr>
                                            </table> 
                                        </div>
                                    </div>
                                </div>

                                <div class="card-header1">
                                    <h3 class="card-title">Duration Of The Task</h3>
                                </div>
                                
                                <div class="card-body">
                                    <div class="row pad_12">                                     
                                        <div class="col-md-12">
                                            <?php
                                                $sel_task_duration=mysqli_query($conn,"SELECT * from vsz_task_duration WHERE task_id='".$_REQUEST['id']."' ");
                                                
                                                while($fetch_duration=mysqli_fetch_assoc($sel_task_duration))
                                                {
                                            ?>
                                    
                                            <table class="table table-bordered table-striped">                                                    
                                                <tr class="de_bg">
                                                    <td style="width:50%">Date :</td>
                                                    <td style="border-right:1px solid #000;" id="label_date"><?php echo $fetch_duration['date']; ?></td>
                                                </tr>
                                                <tr class="de_bg">
                                                    <td style="width:50%">Time :</td>
                                                    <!-- <td style="border-right:1px solid #000;" id="label_start_time"><?php echo $fetch_duration['start_time']; ?></td> -->
                                                    <td style="border-right:1px solid #000;" id="label_start_time">
                                                        <?php 
                                                            // Fetch start time and end time from the database
                                                            $start_time = $fetch_duration['start_time'];
                                                            $end_time = $fetch_duration['end_time'];
                                                            
                                                            // Format start time and end time with AM/PM
                                                            $formatted_start_time = date("h:i A", strtotime($start_time));
                                                            $formatted_end_time = date("h:i A", strtotime($end_time));
                                                            
                                                            // Output formatted start time and end time
                                                            echo $formatted_start_time . " to " . $formatted_end_time;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr class="de_bg">
                                                    <td style="width:50%">Description :</td>
                                                    <td style="border-right:1px solid #000;" id="duration_description"><?php echo $fetch_duration['duration_description']; ?></td>
                                                </tr>
                                            </table>
                                        
                                            <?php }?>
                                        </div>
                                    </div>    
                                </div>

                                <div class="card-header1">
                                    <h3 class="card-title">Checkbox View</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row pad_10">
                                        <div class="task_br_box">                                     
                                            <div class="card-header1">
                                                <h3 class="card-title">Theme</h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- <form id="addFileTypeForm" class="row g-3 validate-form" data-err_msg_ele="help" method="post" action="action_role_access.php"> -->
                                                    <?php
                                                        if (isset($_REQUEST['id'])) {
                                                            
                                                            $fetch['theme_categories']=json_decode($fetch['theme_categories'],true);
                                                            $fetch['theme_sub_categories']=json_decode($fetch['theme_sub_categories'],true);
                                                        }
                                                            ?>
                                                        <div style="display: flex; flex-wrap: wrap;">
                                                            <?php
                                                                // Fetch all parent menu items
                                                                $sel_parent_menus = "SELECT * FROM vsz_theam_category WHERE pmenu = 0 AND is_deleted = 0";
                                                                $que_parent_menus = mysqli_query($conn, $sel_parent_menus);
                                                                while ($parent_menu = mysqli_fetch_array($que_parent_menus)) {
                                                                    ?>
                                                                <div style="margin-right: 20px;">
                                                                    <strong  style="text-decoration: underline;"> 
                                                                    <!-- <input type="checkbox" name="mname[]" value="<?php echo $child_menu['id']; ?>"><?php echo $parent_menu['mname']; ?> -->


                                                                    <input type="checkbox" <?php  if(isset($_REQUEST['id']) && isset($fetch['theme_categories']) && in_array($parent_menu['id'],$fetch['theme_categories']) ){echo " checked ";} ?> name="theme_categories[]"  id="theme_categories<?php echo $parent_menu['id']; ?>" value="<?php echo $parent_menu['id']; ?>">
                                                                        <label for="theme_categories<?php echo $parent_menu['id']; ?>" style ="padding-left:10px;text-decoration: underline;"> <?php echo $parent_menu['mname']; ?></label>
                                                                </strong>
                                                                    <br>
                                                                    <?php
                                                                        // Fetch child menu items for the current parent menu item
                                                                        $sel_child_menus = "SELECT * FROM vsz_theam_category WHERE pmenu = " . $parent_menu['id'] . " AND is_deleted = 0";
                                                                        $que_child_menus = mysqli_query($conn, $sel_child_menus);
                                                                        while ($child_menu = mysqli_fetch_array($que_child_menus)) {
                                                                            ?>
                                                                        <!-- <input type="checkbox" name="mname[]" value="<?php echo $child_menu['id']; ?>">
                                                                        <?php echo $child_menu['mname']; ?> -->

                                                                        <input type="checkbox"  <?php  if(isset($_REQUEST['id']) && isset($fetch['theme_sub_categories']) && in_array($child_menu['id'],$fetch['theme_sub_categories']) ){echo " checked ";} ?>  name="theme_sub_categories[]" id="theme_sub_categories<?php echo $child_menu['id']; ?>" value="<?php echo $child_menu['id']; ?>">
                                                                        <label for="theme_sub_categories<?php echo $child_menu['id']; ?>" style ="padding-left:10px;font-weight:500!important;">
                                                                    <?php echo $child_menu['mname']; ?></label>


                                                                            <br>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                        </div>
                                                <!-- </form> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body card_body_2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="problem">Problem:</label>
                                                <textarea class="form-control" name="problem" id="problem" rows="4" placeholder="Enter problem"><?php if(isset($_REQUEST['id']) && isset($fetch['problem'])){ echo htmlspecialchars($fetch['problem']); } ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sugge_solution">Suggested Solution:</label>
                                                <textarea class="form-control" name="sugge_solution" id="sugge_solution" rows="4" placeholder="Enter suggested solution"><?php if(isset($_REQUEST['id']) && isset($fetch['sugge_solution'])){ echo htmlspecialchars($fetch['sugge_solution']); } ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card_body_2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="task_br_box">
                                                <div class="card-header1">
                                                <h3 class="card-title">Type of processing</h3>
                                                </div>
                                                <div class="card-body">
                                                    <!-- <form id="addFileTypeForm" class="row g-3 validate-form" data-err_msg_ele="help" method="post" action="action_role_access.php"> -->
                                                        <?php include 'message.php'; ?>
                                                            <?php
                                                                    if (isset($_REQUEST['id'])) {
                                                                    
                                                                        $fetch['processing_type_categories']=json_decode($fetch['processing_type_categories'],true);
                                                                        $fetch['processing_type_sub_categories']=json_decode($fetch['processing_type_sub_categories'],true);
                                                                    }
                                                                    ?>
                                                                    <div style="display: flex; flex-wrap: wrap;">
                                                                        <?php
                                                                                        // Fetch all parent menu items
                                                                        $sel_parent_menus = "SELECT * FROM vsz_type_of_processing WHERE pmenu = 0 AND is_deleted = 0";
                                                                        $que_parent_menus = mysqli_query($conn, $sel_parent_menus);
                                                                        while ($parent_menu = mysqli_fetch_array($que_parent_menus)) {
                                                                        ?>
                                                                        <div style="margin-right: 20px;">
                                                                            <strong style="text-decoration: underline;"> 
                                                                            <!-- <input type="checkbox" name="mname[]" value="<?php echo $child_menu['id']; ?>"><?php echo $parent_menu['mname']; ?> -->
                                                                            <input type="checkbox" <?php  if(isset($_REQUEST['id']) && isset($fetch['processing_type_categories']) && in_array($parent_menu['id'],$fetch['processing_type_categories']) ){echo " checked ";} ?> name="processing_type_categories[]"  id="processing_type_categories<?php echo $parent_menu['id']; ?>" value="<?php echo $parent_menu['id']; ?>">
                                                                                <label for="processing_type_categories<?php echo $parent_menu['id']; ?>" style ="padding-left:10px;text-decoration: underline;"> <?php echo $parent_menu['mname']; ?></label>
                                                                        </strong>
                                                                            <br>
                                                                        <?php
                                                                                // Fetch child menu items for the current parent menu item
                                                                                $sel_child_menus = "SELECT * FROM vsz_type_of_processing WHERE pmenu = " . $parent_menu['id'] . " AND is_deleted = 0";
                                                                                $que_child_menus = mysqli_query($conn, $sel_child_menus);
                                                                                while ($child_menu = mysqli_fetch_array($que_child_menus)) {
                                                                        ?>
                                                                            <!-- <input type="checkbox" name="mname[]" value="<?php echo $child_menu['id']; ?>"> -->
                                                                            <input type="checkbox"  <?php  if(isset($_REQUEST['id']) && isset($fetch['processing_type_sub_categories']) && in_array($child_menu['id'],$fetch['processing_type_sub_categories']) ){echo " checked ";} ?>  name="processing_type_sub_categories[]" id="processing_type_sub_categories<?php echo $child_menu['id']; ?>" value="<?php echo $child_menu['id']; ?>">
                                                                                <label for="processing_type_sub_categories<?php echo $child_menu['id']; ?>" style ="padding-left:10px;font-weight:500!important;">
                                                                            <?php echo $child_menu['mname']; ?></label>
                                                                            <br>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                    </div>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                      <!-- removed by me -->

                                <div class="card-header1">
                                    <h3 class="card-title">Comments</h3>
                                </div>
                                <div class="card-body card_body_2">
                                    <?php $task_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0; ?>
                                    <form id="addtaskForm" class="row g-3 validate-form" data-err_msg_ele="help" method="post" action="action_comment.php">
                                        <!-- Add hidden input field for task_id -->
                                        <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12" style="display:none;">
                                                    <label for="comment">Enter A Comment:</label>
                                                    <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Enter comment"></textarea>
                                                </div>
                                                <div class="col-12 text-center mt-3" style="display:none;">
                                                    <button class="save_btn" type="submit" id="add_comment_submit">Save</button>
                                                </div>
                                                <div class="col-md-12">
                                                    <!-- Include your list documents table code here -->
                                                    <div class="row">
                                                    <?php
                                                    // Fetch and display comments and associated documents
                                                    $task_comment_query = "SELECT * FROM vsz_task_comment WHERE task_id = '$task_id'";
                                                    $result_comment = mysqli_query($conn, $task_comment_query);
                                                    // $upload_path = 'uploads/';

                                                    while ($comment = mysqli_fetch_assoc($result_comment)) {
                                                        // Display comment
                                                        $comment_date = date('m/d/Y', strtotime($comment['created_at']));
                                                        echo '<div class="col-md-12">';
                                                        echo '<p class="comment_add_date">' . $comment_date . '</p>';
                                                        echo '<div class="form-control" readonly>' . $comment['comment'] . '</div>';
                                                        echo '</div>';

                                                        // Display associated documents
                                                    }
                                                    ?>
                                                </div>          
                                            </div>
                                        </div>
                                    </form>
                                </div>                       
                                         

                            </div>
                            <?php 
                            $is_view_only=1;
                            include "content_task_documents.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </section>
    </div>

  </main><!-- End #main -->
  <?php include 'includes/footer.php'; ?>
  <!-- <script src="assets/js/customers/detail.js?v=<?php echo $php_version;?>"></script> -->