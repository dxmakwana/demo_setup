<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
  $title="Add Task";$active_menu="add_task";
  include "includes/header.php"; 
  require_once("config.php");


  $country = array();
  $sql = "SELECT id , name FROM vsz_country";
   $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $country[] = $row;
    }
}
$state= array();
  $sql = "SELECT id , name FROM vsz_states";
   $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $state[] = $row;
    }
}

// city...
$city= array();
  $sql = "SELECT id , name FROM vsz_cities where state_id = 12";
   $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $city[] = $row;
    }
}
// Initialize $fetch as an empty array
// $fetch = array();

// if (isset($_REQUEST['id'])) {
//     $customer_details = mysqli_query($conn, "SELECT * from vsz_customer WHERE id='" . $_REQUEST['id'] . "'");
//     $fetch = mysqli_fetch_assoc($customer_details);

//     echo '<input type="hidden" name="id" value="' . $_REQUEST['id'] . '">';
// }
// customer...
$customer_id= array();
  $sql = "SELECT id , first_name FROM vsz_customer where is_deleted=0";
   $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customer_id[] = $row;
    }
}

// advisor...
$advisor= array();
  $sql = "SELECT id , first_name FROM vsz_employees where is_deleted=0";
   $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $advisor[] = $row;
    }
}
// Initialize $fetch as an empty arrayvsz_customer
$fetch = array();

if (isset($_REQUEST['id'])) {
    $task_details = mysqli_query($conn, "SELECT * from vsz_task WHERE id='" . $_REQUEST['id'] . "'");
    $fetch = mysqli_fetch_assoc($task_details);

    echo '<input type="hidden" name="id" value="' . $_REQUEST['id'] . '">';
}
?>

    <aside class="main-sidebar sidebar-dark-secondary elevation-4">
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
        <body class="hold-transition sidebar-mini layout-fixed">
            <div class="wrapper content">
                <div class="col-md-12">
                    <div class="card card-secondary">

                        <div class="card-header d-flex justify-content-between align-items-center">
                        <?php if(isset($_REQUEST['id'])): ?>

                            <h3 class="card-title">Edit Task</h3>

                            <?php else: ?>  

                            <h3 class="card-title">Add Task</h3>

                            <?php endif; ?>
                             <?php if (isset($_REQUEST['id'])) {}else{?>   
                            <button type="button" class="btn btn-secondary add_btn" data-toggle="modal" data-target="#addCustomerModal">Add Customer</button>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->

                        <!-- form start -->

                        <section class="content">
                            <div class="container-fluid">
                                <!-- SELECT2 EXAMPLE -->
                                    <!-- /.card-header -->
                                <div class="card-body card_body_2">
                                    <!-- <form id="addTaskForm" data-err_msg_ele="help" method="post" action="action_task.php"> -->
                                    <form id="addTaskForm" class="g-3 validate-form" data-err_msg_ele="help"  method="post" action="action_task.php" style="margin-bottom: 0;">
                                        <?php

                                                if(isset($_REQUEST['id']))

                                                {

                                                $employees=mysqli_query($conn,"SELECT * from vsz_task WHERE id='".$_REQUEST['id']."' ");

                                                $fetch=mysqli_fetch_assoc($employees);

                                                                    

                                                    echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';

                                                } ?>

                                        <div class="row justify-content-between">
                                            <div class="col-md-4">
                                                <label for="customer_id" class="form-label"> Select a customer <span class="text-danger">*</span></label>
                                                <select class="form-select static" data-is_validate="1" id="customer_id" name="customer_id" class="form-control" data-error_msg="Customer field is required">
                                                <option value="">select</option>
                                                <?php foreach ($customer_id as $opt) : ?>
                                                    <option value="<?php echo $opt['id']; ?>" <?php  if(isset($fetch['customer_id'])){echo ($fetch['customer_id'] == $opt['id']) ? 'selected' : '';} ?>><?php echo $opt['first_name']; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                                <span class="help text-danger" id="customer_msg"></span>
                                            </div> 
                                            <div class="col-md-4">
                                                <label for="task_title">Task Title</label>
                                                <input type="text" class="form-control" name="task_title"  id="task_title" placeholder="Task Title" value="<?php if(isset($_REQUEST['id']) && isset($fetch['task_title'])){ echo $fetch['task_title']; } ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="start_date" data-is_validate="1" id="start_date" placeholder="Start Date" value="<?php if(isset($_REQUEST['id']) && isset($fetch['start_date'])){ echo $fetch['start_date']; } ?>" data-error_msg="Start date field is required">
                                                <span class="help text-danger" id="start_date_msg"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="end_date" data-is_validate="1" id="end_date" placeholder="End Date" value="<?php if(isset($_REQUEST['id']) && isset($fetch['end_date'])){ echo $fetch['end_date']; } ?>" data-error_msg="End date field is required" >
                                                <span class="help text-danger" id="end_date_msg"></span>
                                            </div>
                                            <div class="col-md-8">
                                                <label for="description">Description <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="description" data-is_validate="1" id="description" placeholder="Description" value="<?php if(isset($_REQUEST['id']) && isset($fetch['description'])){ echo $fetch['description']; } ?>" data-error_msg="Description field is required">
                                                <span class="help text-danger" id="description_msg"></span>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="last_name">Advisor</label>
                                                <select class="form-select static" id="advisor" name="advisor" class="form-control" >
                                                <option value="">select</option>
                                                <?php foreach ($advisor as $opt) : ?>
                                                    <option value="<?php echo $opt['id']; ?>" <?php if(isset($fetch['advisor'])) {echo ($fetch['advisor'] == $opt['id']) ? 'selected' : '';} ?>><?php echo $opt['first_name']; ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="Status">Status</label>
                                                <select class="form-select static" data-is_validate="1" id="status" name="status">
                                                    <option>select</option>
                                                    <option value="1" <?php if(isset($fetch['status'])){echo (isset($fetch['status']) && $fetch['status'] == "1") ? 'selected' : '';} ?>>Active</option>
                                                    <!-- <option value="2" <?php echo (isset($fetch['status']) && $fetch['status'] == "2") ? 'selected' : ''; ?>>Complete</option> -->
                                                    <option value="0" <?php echo (isset($fetch['status']) && $fetch['status'] == "0") ? 'selected' : ''; ?>>Complete</option>
                                                </select>
                                                <span class="help text-danger" id="status_msg"></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="task_br_box">
                                                    <div class="card-body">
                                                        <!-- <form id="addFileTypeForm" class="row g-3 validate-form" data-err_msg_ele="help" method="post" action="action_role_access.php"> -->
                                                        <?php
                                                            if (isset($_REQUEST['id'])) {
                                                                
                                                                $fetch['antragsteller_categories']=json_decode($fetch['antragsteller_categories'],true);
                                                                $fetch['antragsteller_sub_categories']=json_decode($fetch['antragsteller_sub_categories'],true);
                                                            }
                                                        ?>
                                                        <div style="display: flex; flex-wrap: wrap;">
                                                            <?php
                                                            // print_r($fetch);

                                                            // Fetch all parent menu items
                                                            $sel_parent_menus = "SELECT * FROM vsz_task_antragsteller WHERE pmenu = 0 AND is_deleted = 0";
                                                            $que_parent_menus = mysqli_query($conn, $sel_parent_menus);
                                                            while ($parent_menu = mysqli_fetch_array($que_parent_menus)) {
                                                            
                                                                ?>
                                                                <div style="margin-right: 20px;">
                                                                    <strong style="text-decoration: underline;"> <!-- Add underline style here -->
                                                                        <input type="checkbox" <?php  if(isset($_REQUEST['id']) && isset($fetch['antragsteller_categories']) && in_array($parent_menu['id'],$fetch['antragsteller_categories']) ){echo " checked ";} ?> name="antragsteller_categories[]"  id="antragsteller_categories<?php echo $parent_menu['id']; ?>" value="<?php echo $parent_menu['id']; ?>">
                                                                        <label for="antragsteller_categories<?php echo $parent_menu['id']; ?>" style ="padding-left:10px;text-decoration: underline;"> <?php echo $parent_menu['mname']; ?></label>
                                                                    </strong>
                                                                    <br>
                                                                    <?php
                                                                    // Fetch child menu items for the current parent menu item
                                                                    $sel_child_menus = "SELECT * FROM vsz_task_antragsteller WHERE pmenu = " . $parent_menu['id'] . " AND is_deleted = 0";
                                                                    $que_child_menus = mysqli_query($conn, $sel_child_menus);
                                                                    while ($child_menu = mysqli_fetch_array($que_child_menus)) {
                                                                        ?>
                                                                        <input type="checkbox"  <?php  if(isset($_REQUEST['id']) && isset($fetch['antragsteller_sub_categories']) && in_array($child_menu['id'],$fetch['antragsteller_sub_categories']) ){echo " checked ";} ?>  name="antragsteller_sub_categories[]" id="antragsteller_sub_categories<?php echo $child_menu['id']; ?>" value="<?php echo $child_menu['id']; ?>">
                                                                        <label for="antragsteller_sub_categories<?php echo $child_menu['id']; ?>" style ="padding-left:10px;font-weight:500!important;">
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
                                            <div class="col-md-6">
                                                <div class="task_br_box">
                                                    <div class="card-header1">
                                                        <!-- <h3 class="card-title">Personal Information</h3> -->
                                                        <h3 class="card-title">PERSÖNLICHE ANGABEN</h3>

                                                    </div>
                                                    <div class="card-body">
                                                        <!-- Date -->
                                                        <div class="row">
                                                            <!-- <div class="col-md-6">      
                                                                <label>First name</label>
                                                                <select class="form-select static" id="personal_first_name" name="personal_first_name" class="form-control" data-is_validate="1">
                                                                    <option value="">select</option>
                                                                    <?php foreach ($customer_id as $opt) : ?>
                                                                        <option value="<?php echo $opt['id']; ?>" <?php echo ($fetch['personal_first_name'] == $opt['id']) ? 'selected' : ''; ?>><?php echo $opt['first_name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div> -->
                                                            <div class="col-md-6">
                                                                <label for="personal_first_name">Name</label>
                                                                <input type="text" class="form-control"  name="personal_first_name" id="personal_first_name" placeholder="Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['personal_first_name'])){ echo $fetch['personal_first_name']; } ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="personal_last_name">Last name</label>
                                                                <input type="text" class="form-control"  name="personal_last_name" id="personal_last_name" placeholder="Last Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['personal_last_name'])){ echo $fetch['personal_last_name']; } ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="personal_email">E-Mail</label>
                                                                <input type="email" class="form-control" name="personal_email" id="personal_email" placeholder="Enter Your E-Mail" value="<?php if(isset($_REQUEST['id']) && isset($fetch['personal_email'])){ echo $fetch['personal_email']; } ?>">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="personal_phone_number">Telefon</label>
                                                                <input type="tel" class="form-control" name="personal_phone_number" id="personal_phone_number" placeholder="Enter Telefon (10 digits)" 
                                                                    pattern="[0-9]{10}" 
                                                                    title="Please enter a 10-digit phone number" 
                                                                    value="<?php if(isset($_REQUEST['id']) && isset($fetch['personal_phone_number'])){ echo $fetch['personal_phone_number']; } ?>" 
                                                                    required>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label for="personal_address">Adresse</label>
                                                                <input type="text" class="form-control"  name="personal_address"  id="personal_address" placeholder="Enter Your Adresse"  value="<?php if(isset($_REQUEST['id']) && isset($fetch['personal_address'])){ echo $fetch['personal_address']; } ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Theam  -->
                                            <div class="row">
                                                <div class="wrapper">

                                                    <div class="col-md-12">

                                                        <div class="task_br_box">

                                                            <div class="card-header1">
                                                                <!-- <h3 class="card-title">Theme</h3> -->
                                                                <h3 class="card-title">THEMA</h3>

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
                                            </div>
                                        <!-- end theam -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="problem">PROBLEM:</label>
                                                <textarea class="form-control" name="problem" id="problem" rows="4" placeholder="Enter PROBLEM"><?php if(isset($_REQUEST['id']) && isset($fetch['problem'])){ echo htmlspecialchars($fetch['problem']); } ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="sugge_solution">Vorgeschlagene Lösung:</label>
                                                <textarea class="form-control" name="sugge_solution" id="sugge_solution" rows="4" placeholder="Enter Vorgeschlagene Lösung"><?php if(isset($_REQUEST['id']) && isset($fetch['sugge_solution'])){ echo htmlspecialchars($fetch['sugge_solution']); } ?></textarea>
                                            </div>
                                        </div>

                                        <!-- Type of processing -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="task_br_box">
                                                    <div class="card-header1">
                                                        <!-- <h3 class="card-title">Type of processing</h3> -->
                                                        <h3 class="card-title">Art der Verarbeitung</h3>

                                                    </div>
                                                    <div class="card-body">
                                                        <!-- Date -->
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
                                        <!-- Type of processing -->

                                        <div class="row">
                                            <div class="col-md-12">
                                            <div class="task_br_box">
                                                <div class="card-header1">
                                                    <h3 class="card-title">Dauer der Aufgabe</h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body" id="task_duration_container">
                                                    <?php
                                                    if(isset($_REQUEST['id']))
                                                    {

                                                        $duration=mysqli_query($conn,"SELECT * from vsz_task_duration WHERE task_id='".$_REQUEST['id']."' ");

                                                        // echo mysqli_num_rows($duration);
                                                        if(mysqli_num_rows($duration)>0)
                                                        {
                                                            $ctdc=0;
                                                            while ($fetch_duration=mysqli_fetch_assoc($duration)) 
                                                            {
                                                                $ctdc++;
                                                                include "content_add_more_task_duration.php";    
                                                            }
                                                            $total_task_duration=$ctdc;
                                                        }else
                                                        {
                                                            $total_task_duration=1;
                                                            include "content_add_more_task_duration.php";
                                                        }
                                                    }else
                                                    {
                                                        $total_task_duration=1;
                                                        include "content_add_more_task_duration.php";
                                                    } 
                                                    
                                                    ?>
                                                    <input type="hidden" id="total_task_duration" name="total_task_duration" value="<?php echo $total_task_duration; ?>" />
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-secondary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </body>
        <div class="modal" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addtaskForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="post" action="action_customer.php" style="padding:15px;">
                            <?php include 'message.php'; ?>
                            <!-- <?php
                            if(isset($_REQUEST['id']))
                            {
                            $customer=mysqli_query($conn,"SELECT * from vsz_customer WHERE id='".$_REQUEST['id']."' ");
                            $fetch=mysqli_fetch_assoc($customer);
                                                
                                echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';
                            } 
                            ?> -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" data-is_validate="1" id="first_name" name="first_name" placeholder="First Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['first_name'])){ echo $fetch['first_name']; } ?>" data-error_msg="First Name field is required">
                                        <span class="help text-danger" id="first_name_msg"></span>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="middle_name" class="form-label">Middle Name </label>
                                            <input type="text" class="form-control"  id="middle_name" name="middle_name" placeholder="middle Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['middle_name'])){ echo $fetch['middle_name']; } ?>" data-error_msg="middle Name field is required">
                                            <span class="help text-danger" id="middle_name_msg"></span>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="last_name" class="form-label">Last Name </label>
                                            <input type="text" class="form-control"  id="last_name" name="last_name" placeholder="Last Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['last_name'])){ echo $fetch['last_name']; } ?>" data-error_msg="last Name field is required">
                                            <span class="help text-danger" id="last_name_msg"></span>
                                    </div>
                                    <div class="col-md-4">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" data-is_validate="1" id="email" name="email" placeholder="Email" value="<?php if(isset($_REQUEST['id']) && isset($fetch['email'])){ echo $fetch['email']; } ?>" data-error_msg="Email field is required">
                                            <span class="help text-danger" id="email_msg"></span>
                                    </div>
                                    <!-- <div class=" col-lg-4 col-md-6">
                                        <label for="phone">Phone Number</label>
                                        <input type="telephone" class="form-control" id="phone" placeholder="Enter phone">
                                    </div> -->
                                    <div class="col-md-4">
                                        <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input type="telephone" class="form-control" data-is_validate="1" id="phone_number" name="phone_number" placeholder="Phone Number" value="<?php if(isset($_REQUEST['id']) && isset($fetch['phone_number'])){ echo $fetch['phone_number']; } ?>" data-error_msg=" Phone Number field is required">
                                        <span class="help text-danger" id="phone_number_msg"></span>
                                        </div>
                                    <div class="col-md-4">
                                        <label for="Status">Status</label>
                                        <select class="form-select static" id="status" name="status">
                                            <option value="1" <?php echo (isset($fetch['status']) && $fetch['status'] == "1") ? 'selected' : ''; ?>>Active</option>
                                            <option value="0" <?php echo (isset($fetch['status']) && $fetch['status'] == "0") ? 'selected' : ''; ?>>In Active</option>
                                        </select>
                                    </div>
                                    <div class=" col-md-4">
                                        <label for="Address">Address</label>
                                        <input type="text" class="form-control" name="address"  id="Address" placeholder="Enter Address"value="<?php if(isset($_REQUEST['id']) && isset($fetch['address'])){ echo $fetch['address']; } ?>">
                                    </div>
                                    <!-- <div class=" col-lg-4 col-md-6">
                                        <label for="country">Country</label>
                                        <input type="country" class="form-control" id="country" placeholder="Enter country">
                                    </div> -->
                                    <div class="col-md-4">
                                        <label for="country" class="form-label"> Country</label>
                                        <select class="form-select static" id="country" name="country" class="form-control" data-is_validate="1">
                                        <option value="">select</option>
                                        <?php foreach ($country as $opt) : ?>
                                            <option value="<?php echo $opt['id']; ?>" <?php echo ($fetch['country'] == $opt['id']) ? 'selected' : ''; ?>><?php echo $opt['name']; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div> 
                                    <div class="col-md-4">
                                        <label for="state" class="form-label"> State</label>
                                        <select class="form-select static" id="state" name="state" class="form-control" data-is_validate="1">
                                        <option value="">select</option>
                                        <?php foreach ($state as $opt) : ?>
                                            <option value="<?php echo $opt['id']; ?>" <?php echo ($fetch['state'] == $opt['id']) ? 'selected' : ''; ?>><?php echo $opt['name']; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div> 
                                    <div class="col-md-4">
                                        <label for="city" class="form-label"> City</label>
                                        <select class="form-select static" id="city" name="city" class="form-control" data-is_validate="1">
                                        <option value="">select</option>
                                        <?php foreach ($city as $opt) : ?>
                                            <option value="<?php echo $opt['id']; ?>" <?php echo ($fetch['city'] == $opt['id']) ? 'selected' : ''; ?>><?php echo $opt['name']; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div> 
                                    <!-- <div class="col-md-4">
                                        <label for="city" class="form-label">City </label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php if(isset($_REQUEST['id']) && isset($fetch['city'])){ echo $fetch['city']; } ?>" data-error_msg="City field is required">
                                        <span class="help text-danger" id="city_msg"></span>
                                    </div> -->
                                    <div class="col-md-4">
                                            <label for="zip_code" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" 
                                                value="<?php if(isset($_REQUEST['id']) && isset($fetch['zip_code'])){ echo $fetch['zip_code']; } ?>" 
                                                oninput="validateZipCode(this)" pattern="\d{5}" title="Zip code must be exactly 5 digits" required>
                                            <div id="zip_code_error" style="color: red; display: none;">Zip code must be exactly 5 digits</div>
                                        </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-secondary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
        <!-- jQuery -->
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
        <script>
    function validateZipCode(input) {
        // Remove any non-digit characters and limit to 5 digits
        input.value = input.value.replace(/[^0-9]/g, '').slice(0, 5);

        // Check if the input has exactly 5 digits
        if (input.value.length !== 5) {
            document.getElementById('zip_code_error').style.display = 'block';
        } else {
            document.getElementById('zip_code_error').style.display = 'none';
        }
    }
</script>
