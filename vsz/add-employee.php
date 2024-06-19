<?php 
require_once("config.php");
 ?>


<!DOCTYPE html>
<html lang="en">
<!-- header.php -->
<?php include 'includes/header.php'; ?>
<!-- end header  -->

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Main Sidebar Container -->
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
    <!-- Breadcrumb Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
        <!-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Employees</li>
                        <?php if(isset($_REQUEST['id'])): ?>
                            <li class="breadcrumb-item active">Edit Employee</li>
                        <?php else: ?>
                            <li class="breadcrumb-item active">Add Employee</li>
                            <?php endif; ?>
                    </ol>
                </div>
            </div>
        </div>
        </div> -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="col-md-12">

                    <div class="card card-secondary">

                        <div class="card-header">

                            <!-- <h3 class="card-title">Add Employees</h3> -->

                            <?php if(isset($_REQUEST['id'])): ?>

                            <h3 class="card-title">Edit Employees</h3>

                            <?php else: ?>  

                            <h3 class="card-title">Add Employees</h3>

                            <?php endif; ?>

                         </div>

                        <!-- /.card-header -->

                        <!-- form start -->

                        <form id="addemployeesForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="post" action="action_employees.php" style="padding:15px; margin-bottom:0;">



                            <?php

                                if(isset($_REQUEST['id']))

                                {

                                $employees=mysqli_query($conn,"SELECT * from vsz_employees WHERE id='".$_REQUEST['id']."' ");

                                $fetch=mysqli_fetch_assoc($employees);

                                                    

                                    echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';

                                } ?>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4">

                                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>

                                            <input type="text" class="form-control" data-is_validate="1" id="first_name" name="first_name" placeholder="First Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['first_name'])){ echo $fetch['first_name']; } ?>" data-error_msg="First Name field is required">

                                            <span class="help text-danger" id="first_name_msg"></span>

                                    </div>

                                    <div class="col-md-4">

                                            <label for="middle_name" class="form-label">Middle Name</label>

                                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['middle_name'])){ echo $fetch['middle_name']; } ?>" >

                                            <span class="help text-danger" id="middle_name_msg"></span>

                                    </div>

                                    <div class="col-md-4">

                                            <label for="last_name" class="form-label">Last Name</label>

                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['last_name'])){ echo $fetch['last_name']; } ?>" >

                                            <span class="help text-danger" id="last_name_msg"></span>

                                    </div>

                                    <div class="col-md-4">

                                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>

                                            <input type="email" class="form-control"  data-is_validate="1"  id="email" name="email" placeholder="Email" value="<?php if(isset($_REQUEST['id']) && isset($fetch['email'])){ echo $fetch['email']; } ?>">

                                            <span class="help text-danger" id="email_msg"></span>

                                    </div>

                                        <!-- <div class=" col-lg-4 col-md-6">

                                            <label for="phone">Phone Number</label>

                                            <input type="telephone" class="form-control" id="phone" placeholder="Enter phone">

                                        </div> -->

                                        <div class="col-md-4">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone_number" id="phone_number" placeholder="Enter phone number (10 digits)" 
                                            pattern="[0-9]{10}" 
                                            title="Please enter a 10-digit phone number" 
                                            value="<?php if(isset($_REQUEST['id']) && isset($fetch['phone_number'])){ echo $fetch['phone_number']; } ?>" 
                                            required>
                                    </div>

                                    

                                    <div class="col-md-4">

                                        <label for="Status">Status</label>

                                        <select class="form-select static"  data-is_validate="1" id="status" name="status">

                                            <option>Select Status</option>

                                            <option value="1" <?php echo (isset($fetch['status']) && $fetch['status'] == "1") ? 'selected' : ''; ?>>Active</option>

                                            <option value="0" <?php echo (isset($fetch['status']) && $fetch['status'] == "0") ? 'selected' : ''; ?>>In Active</option>

                                        </select>

                                    </div>

                                            <!-- /.card-body -->



                                        <div class="col-md-12 text-center">

                                            <button type="submit" class="btn btn-secondary">Submit</button>

                                        </div>

                                    </form>

                                </div>

                                <!-- /.card -->



                        <!-- /.card -->



                    </div>

                </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
   <?php include 'includes/footer.php'; ?>
</body>
</html>


