
<?php

require_once("config.php");
  if (isset($_SESSION['vsz_admin']['vsz_admin_id'])) 
  {
    // Get user ID from the session
    $login_user_id = $_SESSION['vsz_admin']['vsz_admin_id'];

    // Execute database query to fetch user details
    $sel_user_details = mysqli_query($conn, "SELECT * FROM vsz_admin_users WHERE id='$login_user_id'");

    // Check for query execution error
    if (!$sel_user_details) {
        die("Error: " . mysqli_error($conn));
    }

    // Fetch user details into $fetch array
    $login_user_data = mysqli_fetch_assoc($sel_user_details);
    // print_r($login_user_data);
  }
?>

    <a href="dashboard.php" class="brand-link">
      <img src="assets/img/logo.png" alt="VSZ logo" class="brand-image">
    </a>

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo ($active_menu == "home") ? "active" : ""; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Dashboard </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link <?php echo ($active_menu == "add_user_role" || $active_menu == "user_role_list") ? "" : "collapsed"; ?>" data-bs-toggle="collapse" data-bs-target="#manage-role">
                <i class="fas fa-shield-alt nav-icon"></i>
                <p> Manage Role <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul id="manage-role" class="nav nav-treeview <?php echo ($active_menu == "add_user_role" || $active_menu == "user_role_list") ? "show" : ""; ?>">
                <li class="nav-item">
                    <a href="manage-user-role.php" class="nav-link <?php echo ($active_menu == "user_role_list") ? "active" : ""; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>View All Role </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add-user-role.php" class="nav-link <?php echo ($active_menu == "add_user_role") ? "active" : ""; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Role</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" class="nav-link <?php echo ($active_menu == "add_customer" || $active_menu == "customer_list") ? "" : "collapsed"; ?>" data-bs-toggle="collapse" data-bs-target="#manage-customer">
                <i class="fas fa-users nav-icon"></i>
                <p> Customer <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul id="manage-customer" class="nav nav-treeview <?php echo ($active_menu == "add_customer" || $active_menu == "customer_list") ? "show" : ""; ?>">
                <li class="nav-item">
                    <a href="manage-customer.php" class="nav-link <?php echo ($active_menu == "customer_list") ? "active" : ""; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage Customer </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="add-customer.php" class="nav-link <?php echo ($active_menu == "add_customer") ? "active" : ""; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Customer </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link <?php echo ($active_menu == "add_task" || $active_menu == "task_list") ? "" : "collapsed"; ?>" data-bs-toggle="collapse" data-bs-target="#manage-task">
              <i class="fas fa-tasks nav-icon"></i>
              <p> Task <i class="right fas fa-angle-left"></i> </p>
          </a>
          <ul id="manage-task" class="nav nav-treeview <?php echo ($active_menu == "add_task" || $active_menu == "task_list") ? "show" : ""; ?>">
              <li class="nav-item">
                  <a href="manage-task.php" class="nav-link <?php echo ($active_menu == "task_list") ? "active" : ""; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Task </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="add-task.php" class="nav-link <?php echo ($active_menu == "add_task") ? "active" : ""; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Task </p>
                  </a>
              </li>
          </ul>
      </li>
      <li class="nav-item">
          <a href="" class="nav-link <?php echo ($active_menu == "add_employees" || $active_menu == "employees_list") ? "" : "collapsed"; ?>" data-bs-toggle="collapse" data-bs-target="#manage-employees">
              <i class="nav-icon fas fa-user-alt"></i>
              <p> Employees <i class="right fas fa-angle-left"></i> </p>
          </a>
          <ul id="manage-employees" class="nav nav-treeview <?php echo ($active_menu == "add_employees" || $active_menu == "employees_list") ? "show" : ""; ?>">
              <li class="nav-item">
                  <a href="manage-employee.php" class="nav-link <?php echo ($active_menu == "employees_list") ? "active" : ""; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Employees </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="add-employee.php" class="nav-link <?php echo ($active_menu == "add_employees") ? "active" : ""; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Employees </p>
                  </a>
              </li>
          </ul>
      </li>

        <!-- Add other menu items similarly -->
        <li class="nav-item">

          <a href="logout.php" class="nav-link">

            <i class="nav-icon fas fa-th"></i>

            <p>

              Logout

            

            </p>

          </a>

        </li>

    </ul>
</nav>













































