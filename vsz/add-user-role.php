<?php

  $title="Add User Role";$active_menu="add_user_role";

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

$fetch = array();



if (isset($_REQUEST['id'])) {

    $customer_details = mysqli_query($conn, "SELECT * from vsz_customer WHERE id='" . $_REQUEST['id'] . "'");

    $fetch = mysqli_fetch_assoc($customer_details);



    echo '<input type="hidden" name="id" value="' . $_REQUEST['id'] . '">';

}

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
                    <h1 class="m-0">All Customers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                        <?php if(isset($_REQUEST['id'])): ?>
                            <li class="breadcrumb-item active">Edit Customers</li>
                        <?php else: ?>
                            <li class="breadcrumb-item active">Add Customers</li>
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

                    <?php if(isset($_REQUEST['id'])): ?>

                        <h3 class="card-title">Edit User Role</h3>

                        <?php else: ?>  

                        <h3 class="card-title">Add User Role</h3>

                        <?php endif; ?>

                    </div>

                    <!-- /.card-header -->

                    <!-- form start -->

                    <form id="adduserroleForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="post" action="action_user_role.php" style="padding:15px;">

                    <?php include 'message.php'; ?>

                    <?php

                        if (isset($_REQUEST['id'])) {

                            $sel_file_details = mysqli_query($conn, "SELECT * from vsz_user_type WHERE id='" . $_REQUEST['id'] . "' ");

                            $fetch = mysqli_fetch_assoc($sel_file_details);



                            echo '<input type="hidden" name="id" value="' . $_REQUEST['id'] . '">';

                        } ?>

                        <div class="col-md-12">

                            <label for="name" class="form-label"> Name <span class="text-danger">*</span></label>

                            <input type="text" class="form-control" data-is_validate="1" id="name" name="name" placeholder="Name" value="<?php if (isset($_REQUEST['id']) && isset($fetch['name'])) {

                                                                                                                                                                echo $fetch['name'];

                                                                                                                                                            } ?>">

                            <span class="help text-danger" id="msg2"></span>

                        </div>



                        <div class="col-lg-12 text-center">

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