<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("config.php");
function CalculateTaskPropTotalCount($type,$mid,$param_type)
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
    
    $sel_all_tasks=mysqli_query($conn,"SELECT * FROM vsz_task WHERE is_deleted='0' ".$additional_condition);
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
    
    $sel_all_tasks=mysqli_query($conn,"SELECT * FROM vsz_task WHERE is_deleted='0' ".$additional_condition);
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
    
    $sel_all_tasks=mysqli_query($conn,"SELECT * FROM vsz_task WHERE is_deleted='0' ".$additional_condition);
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

  
 
  // Count total task
  $total_task_sql = "SELECT COUNT(*) AS total_task FROM vsz_task WHERE is_deleted = '0'";
  $total_task_result = $conn->query($total_task_sql);
  $total_task = ($total_task_result && $total_task_result->num_rows > 0) ? $total_task_result->fetch_assoc()['total_task'] : 0;

  // Count total active task 
  $total_task_active_sql = "SELECT COUNT(*) AS total_active_task FROM vsz_task WHERE  status = '1' AND is_deleted = '0'";
  $total_task_active_result = $conn->query($total_task_active_sql);
  $total_task_active = ($total_task_active_result && $total_task_active_result->num_rows > 0) ? $total_task_active_result->fetch_assoc()['total_active_task'] : 0;
  

  // Count total complete task 
  $total_task_complete_sql = "SELECT COUNT(*) AS total_complete_task FROM vsz_task WHERE  status = '0' AND is_deleted = '0'";
  $total_task_complete_result = $conn->query($total_task_complete_sql);
  $total_task_complete = ($total_task_complete_result && $total_task_complete_result->num_rows > 0) ? $total_task_complete_result->fetch_assoc()['total_complete_task'] : 0;
 
  // Count total customers
  $total_customer_sql = "SELECT COUNT(*) AS total_customer FROM vsz_customer WHERE is_deleted = '0'";
  $total_customer_result = $conn->query($total_customer_sql);
  $total_customer = ($total_customer_result && $total_customer_result->num_rows > 0) ? $total_customer_result->fetch_assoc()['total_customer'] : 0;
  
   // Count total employee
   $total_employee_sql = "SELECT COUNT(*) AS total_employee FROM vsz_employees WHERE is_deleted = '0'";
   $total_employee_result = $conn->query($total_employee_sql);
   $total_employee = ($total_employee_result && $total_employee_result->num_rows > 0) ? $total_employee_result->fetch_assoc()['total_employee'] : 0;
  

?>


<!DOCTYPE html>
<html lang="en">
<!-- header.php -->
<?php include 'includes/header.php'; ?>
<!-- end header  -->

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Main Sidebar Container -->
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

  <!-- Breadcrumb Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div> -->
    <!-- /. Breadcrumb content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col_dash col-md-6">
            <!-- small box -->
            <a href="manage-customer.php">
              <div class="small-box">
                <i class="fas fa-users nav-icon" style="--icon-color: #71DD37"></i>
                <div class="inner">
                  <h3><?php echo $total_customer; ?></h3>
                  <p>Total Customers</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col_dash col-md-6">
            <!-- small box -->
            <a href="manage-employee.php">
              <div class="small-box">
                <i class="nav-icon fas fa-user-alt" style="--icon-color: #57CAEB"></i>
                <div class="inner">
                  <h3><?php echo $total_employee; ?></h3>
                  <p>Total Employee</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col_dash col-md-6">
            <!-- small box -->
            <a href="manage-task.php">
              <div class="small-box">
                <i class="fas fa-tasks nav-icon" style="--icon-color: #5DDAB4"></i>
                <div class="inner">
                  <h3><?php echo $total_task; ?></h3>
                  <p>Total Task</p>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col_dash col-md-6">
            <!-- small box -->
            <a href="manage-task.php">
              <div class="small-box">
                <i class="ion ion-person-add" style="--icon-color: #FF7976"></i>
                <div class="inner">
                  <h3><?php echo $total_task_active; ?></h3>
                  <p>Total Active Task</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col_dash col-md-6">
            <!-- small box -->
            <a href="manage-task.php">
              <div class="small-box">
                <i class="ion ion-pie-graph" style="--icon-color: #696CFF"></i>
                <div class="inner">
                  <h3><?php echo $total_task_complete; ?></h3>
                  <p>Completed Task</p>
                </div>
              </div>
            </a>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>



<section class="content1">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Antragsteller</h3>
            <!-- <a href="add-employee.php"><button class="btn btn-secondary add_btn">Add Employee</button></a> -->
          </div>
          <div class="card-body card-body1">
            <?php
              $sql = "SELECT * FROM vsz_task_antragsteller WHERE is_deleted = 0 AND pmenu = 1";
              $result = mysqli_query($conn, $sql);
              $totalNet = 0; // Initialize total net count

              // Check if there are any records
              if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $current_count = CalculateTaskPropTotalCount("antragsteller", $row['id'], $row['pmenu']);
                    $totalNet += $current_count; // Accumulate total net count
                }
               }
            ?>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Antragsteller</th>
                <th class="text-end">Net (Total: <?php echo htmlspecialchars($totalNet); ?>)</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // Reset result pointer and display each antragsteller category with its count
                if ($result && mysqli_num_rows($result) > 0) {
                    mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
                    while($row = mysqli_fetch_assoc($result)) {
                        $current_count = CalculateTaskPropTotalCount("antragsteller", $row['id'], $row['pmenu']);
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["mname"]) . "</td>";
                        echo "<td class='text-end'>" . htmlspecialchars($current_count) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No antragsteller found</td></tr>";
                }
              ?>
            </tbody>
            <!-- <tfoot>
              <tr>
                <th>Total</th>
                <th class="text-end"><?php echo htmlspecialchars($totalNet); ?></th>
              </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- MEDIUM -->

<section class="content1">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Medium</h3>
            <!-- <a href="add-employee.php"><button class="btn btn-secondary add_btn">Add Employee</button></a> -->
          </div>
          <div class="card-body card-body1">
            <?php
              // Fetch data from the vsz_task_antragsteller table
              $sql = "SELECT * FROM vsz_task_antragsteller WHERE is_deleted = 0 AND pmenu = 2";
              $result = mysqli_query($conn, $sql);
              $totalNetmedium = 0; // Initialize total net count

              // Check if there are any records
              if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $current_count = CalculateTaskPropTotalCount("antragsteller", $row['id'], $row['pmenu']);
                    $totalNetmedium += $current_count; // Accumulate total net count
                }
            }
            ?>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Medium</th>
                <th class="text-end">Net (Total: <?php echo htmlspecialchars($totalNetmedium); ?>)</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // Reset result pointer and display each medium category with its count
                if ($result && mysqli_num_rows($result) > 0) {
                    mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
                    while($row = mysqli_fetch_assoc($result)) {
                        $current_count = CalculateTaskPropTotalCount("antragsteller", $row['id'], $row['pmenu']);
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["mname"]) . "</td>";
                        echo "<td class='text-end'>" . htmlspecialchars($current_count) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No Employees found</td></tr>";
                }
              ?>
            </tbody>
            <!-- <tfoot>
              <tr>
                <th>Total</th>
                <th class="text-end"><?php echo htmlspecialchars($totalNetmedium); ?></th>
              </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- theme -->

<section class="content1">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Theme</h3>
            <!-- <a href="add-employee.php"><button class="btn btn-secondary add_btn">Add Employee</button></a> -->
          </div>
          <div class="card-body card-body1">
            <?php
              $sql = "SELECT * FROM vsz_theam_category WHERE is_deleted = 0";
              $result = mysqli_query($conn, $sql);
              $totalNettheme = 0; // Initialize total net count

              // Calculate the total net count
              if ($result && mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      $current_count = CalculateTaskPropTotalCount("theme", $row['id'], $row['pmenu']);
                      $totalNettheme += $current_count; // Accumulate total net count
                  }
              }
            ?>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Theme</th>
                  <th class="text-end">Net (Total: <?php echo htmlspecialchars($totalNettheme); ?>)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  // Reset result pointer and display each theme category with its count
                  if ($result && mysqli_num_rows($result) > 0) {
                      mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
                      while($row = mysqli_fetch_assoc($result)) {
                          $current_count = CalculateTaskPropTotalCount("theme", $row['id'], $row['pmenu']);
                          echo "<tr>";
                          echo "<td>" . htmlspecialchars($row["mname"]) . "</td>";
                          echo "<td class='text-end'>" . htmlspecialchars($current_count) . "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='2'>No Details found</td></tr>";
                  }
                ?>
              </tbody>
              <!-- Uncomment this if you want to show total in the footer -->
              <!-- 
              <tfoot>
                <tr>
                  <th>Total</th>
                  <th class="text-end"><?php echo htmlspecialchars($totalNettheme); ?></th>
                </tr>
              </tfoot> 
              -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end theme -->

<!-- type of processing -->
<section class="content1">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Type Of Processing</h3>
            <!-- <a href="add-employee.php"><button class="btn btn-secondary add_btn">Add Employee</button></a> -->
          </div>
          <div class="card-body card-body1">
            <?php
              $sql = "SELECT * FROM vsz_type_of_processing where is_deleted = 0";
              $result = mysqli_query($conn, $sql);
              $totalNet = 0; // Initialize total net count

              if (mysqli_num_rows($result) > 0) {
                  // Calculate total net count
                  while($row = mysqli_fetch_assoc($result)) {
                      $current_count = 0;
                      $current_count = CalculateTaskPropTotalCount("processing", $row['id'], $row['pmenu']);
                      $totalNet += $current_count; // Add current count to total net
                  }
              }
            ?>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Type Of Processing</th>
                  <th class="text-end">Net (Total: <?php echo $totalNet; ?>)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (mysqli_num_rows($result) > 0) {
                      // Output data of each row again to populate the table
                      mysqli_data_seek($result, 0); // Reset result pointer to the beginning
                      while($row = mysqli_fetch_assoc($result)) {
                          $current_count = CalculateTaskPropTotalCount("processing", $row['id'], $row['pmenu']);
                          echo "<tr>";
                          echo "<td>" . $row["mname"] . "</td>";
                          echo "<td class='text-end'>" . $current_count . "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='2'>No Details found</td></tr>";
                  }
                ?>
              </tbody>
              <!-- <tfoot>
                <tr>
                  <th>Total</th>
                  <th class="text-end"><?php echo $totalNet; ?></th>
                </tr>
              </tfoot> -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end type of processing -->
</div>
  <!-- /.content-wrapper -->
   <?php include 'includes/footer.php'; ?>

</div>
</body>
</html>
