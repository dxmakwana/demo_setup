<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');




$title = "Add users";
$active_menu = "add_user";
include "includes/header.php";
require_once("config.php");



$user_type= array();
  $sql = "SELECT id , name FROM vsz_user_type";
$result = $conn->query($sql);


// Check if user is logged in
if (isset($_SESSION['vsz_admin']['vsz_admin_id'])) {
    // Get user ID from the session
    $user_id = $_SESSION['vsz_admin']['vsz_admin_id'];

    // Execute database query to fetch user details
    $sel_user_details = mysqli_query($conn, "SELECT * FROM vsz_admin_users WHERE id='$user_id'");

    // Check for query execution error
    if (!$sel_user_details) {
        die("Error: " . mysqli_error($conn));
    }

    // Fetch user details into $fetch array
    $fetch = mysqli_fetch_assoc($sel_user_details);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Store user_type values in the $company array
        $user_type[] = $row;
        if(isset($fetch['access_role']) && $row['id']==$fetch['access_role'])
        {
            $fetch['access_role_name']=$row['name'];
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $password = mysqli_real_escape_string($conn, $_POST['password']);
    // $role = mysqli_real_escape_string($conn, $_POST['role']);
    // $department = mysqli_real_escape_string($conn, $_POST['department']);

    // Update user profile in the database
    $update_query = "UPDATE vsz_admin_users SET name='$name', surname='$surname', user_name='$user_name', email='$email' WHERE id='$user_id'";
    $result = mysqli_query($conn, $update_query);

    if ($result) {
        echo "Profile updated successfully!";
        // Redirect the user to a different page after successful update
        // header("Location: profile.php");
        // exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

?>

<style>
.error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}

.position-relative {
    position: relative;
}
</style>

<!DOCTYPE html>
<html lang="en">
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
            
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Details</h3>
                            </div>
                            <input type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>"/>
                            <form id="UpdateForm" class="row g-3" method="POST" novalidate="novalidate" style="padding: 0px 15px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label"> Name </label>
                                            <input type="text" class="form-control" data-is_validate="1" id="name" name="name" placeholder="Name" value="<?php echo isset($fetch['name']) ? $fetch['name'] : ''; ?>">
                                            <span class="help text-danger" id="msg2"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="surname" class="form-label">Last Name</label>
                                            <input type="text" class="form-control" data-is_validate="1" id="surname" name="surname" placeholder="Surname" value="<?php echo isset($fetch['surname']) ? $fetch['surname'] : ''; ?>">
                                            <span class="help text-danger" id="msg2"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="user_name" class="form-label">User Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" data-is_validate="1" id="user_name" name="user_name" placeholder="User Name" value="<?php echo isset($fetch['user_name']) ? $fetch['user_name'] : ''; ?>">
                                            <span class="help text-danger" id="msg2"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" data-is_validate="1" placeholder="E-Email" id="email" name="email" value="<?php echo isset($fetch['email']) ? $fetch['email'] : ''; ?>">
                                            <span class="help text-danger" id="msg2"></span>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="save_btn" type="submit" id="add_task_submit">Save</button>
                                            <!-- <a class="cance_btn" href="user-profile.php">Cancel</a> -->
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="password-edit">
                                <!-- Profile Edit Form -->
                                <form id="passwordChangeForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="post" action="process/action_change_password.php" style="padding: 0px 15px; margin-bottom: 0;">
                                    <?php include 'message.php'; ?>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="current_password" class="col-form-label">Current Password <span class="text-danger">*</span></label>
                                                <input name="current_password" data-is_validate="1" type="password" class="form-control" id="current_password"  data-error_msg="Current Password field is required" required>
                                                <!-- <div id="currentPasswordError" class="error-msg" style="color: red;"></div>  -->
                                                <span class="help text-danger" id="current_password_msg"></span>
                                                <!-- Error container for current password -->
                                            </div>
                                            <div class="col-md-6">
                                                <label for="new_password" class="col-form-label">New Password  <span class="text-danger">*</span></label>
                                                <input name="new_password" type="password" class="form-control" id="new_password" required>
                                                <div id="newPasswordError" class="error-msg" style="color: red;"></div> <!-- Error container for new password -->
                                            </div>
                                            <div class="col-md-6">
                                                <label for="confirm_password" class="col-form-label">Confirm Password  <span class="text-danger">*</span></label>
                                                <input name="confirm_password" type="password" class="form-control" id="confirm_password" required>
                                                <div id="confirmPasswordError" class="error-msg" style="color: red;"></div> <!-- Error container for confirm password -->
                                            </div>
                                            <div class="col-12 text-center">
                                                <button class="save_btn" type="submit" id="submitPassBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>         
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
