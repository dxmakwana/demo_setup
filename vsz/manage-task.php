<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
  $title="Add tasks";$active_menu="task_list";

  include "includes/header.php"; 

  require_once("config.php");
 
  $is_update_access=check_is_access("update_task");

  $is_view_access=check_is_access("view_task");

  $is_delete_access=check_is_access("add_task");

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_SESSION['msg_type']) && isset($_SESSION['err_msg_title']) && isset($_SESSION['err_msg'])) {
      $msg_type = $_SESSION['msg_type'];
      $err_msg_title = $_SESSION['err_msg_title'];
      $err_msg = $_SESSION['err_msg'];
      
      echo "<div class='alert alert-$msg_type'>";
      echo "<strong>$err_msg_title!</strong> $err_msg";
      echo "</div>";
  
      // Unset session variables after displaying the message
      unset($_SESSION['msg_type']);
      unset($_SESSION['err_msg_title']);
      unset($_SESSION['err_msg']);
  }
  function get_words($string, $wordsreturned)
  {
      $retval = $string;  //  Just in case of a problem
      $array = explode(" ", $string);
      /*  Already short enough, return the whole thing*/
      if (count($array)<=$wordsreturned)
      {
          $retval = $string;
      }
      /*  Need to chop of some words*/
      else
      {
          array_splice($array, $wordsreturned);
          $retval = implode(" ", $array)." ...";
      }
      return $retval;
  }
?>

<body class="hold-transition sidebar-mini layout-fixed">

<input type="hidden" id="is_update_access" value="<?php echo $is_update_access; ?>"/>

<input type="hidden" id="is_view_access" value="<?php echo $is_view_access; ?>"/>

<input type="hidden" id="is_delete_access" value="<?php echo $is_delete_access; ?>"/>



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

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <!-- <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Tasks</h1>

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

    </section> -->



    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

          <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">All Tasks</h3>
              <a href="add-task.php"><button class="btn btn-secondary add_btn">Add Task</button></a>
            </div>

            <div class="card-body card-body1">
              <form id="addcustomerForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="get" action="manage-task.php" style="padding:15px;">
                <div class="col-sm-12">
                  <div class="row">

                    <div class="col-md-4">
                        <label for="start_date">From Date </label>
                        <input type="date" class="form-control" name="filter_date_from" data-is_validate="0" id="filter_date_from" placeholder="Start Date" value="<?php if(isset($_REQUEST['filter_date_from'])){ echo $_REQUEST['filter_date_from']; } ?>">
                        <span class="help text-danger" id="start_date_msg"></span>
                    </div>
                    <div class="col-md-4">
                        <label for="start_date">To Date </label>
                        <input type="date" class="form-control" name="filter_date_to" data-is_validate="0" id="filter_date_to" placeholder="Start Date" value="<?php if(isset($_REQUEST['filter_date_to'])){ echo $_REQUEST['filter_date_to']; } ?>">
                        <span class="help text-danger" id="start_date_msg"></span>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="Status">Status</label>
                        <select class="form-select static" data-is_validate="0" id="filter_status" name="filter_status">
                            <option value="">select</option>
                            <option value="1" <?php echo (isset($_REQUEST['filter_status']) && $_REQUEST['filter_status'] == "1") ? 'selected' : ''; ?>>Active</option>
                            <option value="0" <?php echo (isset($_REQUEST['filter_status']) && $_REQUEST['filter_status'] == "0") ? 'selected' : ''; ?>>Complete</option>
                        </select>
                        <span class="help text-danger" id="status_msg"></span>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-secondary">Apply Filter</button>
                      <a href="manage-task.php" class="btn btn-secondary">Reset Filter</a>
                      <a href="export_task_report.php?export_request=1&filter_date_from=<?php if(isset($_REQUEST['filter_date_from'])){ echo $_REQUEST['filter_date_from']; } ?>&filter_date_to=<?php if(isset($_REQUEST['filter_date_to'])){ echo $_REQUEST['filter_date_to']; } ?>&filter_status=<?php if(isset($_REQUEST['filter_status'])){ echo $_REQUEST['filter_status']; } ?>" class="btn btn-secondary">Export Data</a>
                    </div>
                  </div>
                </div>
            </div>
          </div>

            <div class="card">

              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">All Tasks</h3>
                <!-- <a href="add-task.php"><button class="btn btn-secondary add_btn">Add Task</button></a> -->
              </div>

              <div class="card-body card-body1">

              <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>
                              <input type="checkbox" id="select_all_task" name="select_all_task" />
                          <!-- <span style="cursor: pointer;" class="badge badge-danger" id="task_delete"><i class="bi bi-trash delete_icon"></i> </span> -->
                          <a href="#" id="task_export"><i class='bi bi-cloud-download upload_icon_all'></i> </a>
                          
                              </th>
                              <th>Task Title</th>
                              <th>Description</th>
                              <th>Customer</th>
                              <th>End Date</th>
                              <th>Status</th>
                              <th style='width:140px;' data-orderable="false">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          $filter_condition="";
                          if(isset($_REQUEST['filter_date_from']) && $_REQUEST['filter_date_from']!="")
                          {
                            $filter_condition.=" AND end_date>= '".$_REQUEST['filter_date_from']."'";
                          }
                          if(isset($_REQUEST['filter_date_to']) && $_REQUEST['filter_date_to']!="")
                          {
                            $filter_condition.=" AND end_date<= '".$_REQUEST['filter_date_to']."'";
                          }
                          if(isset($_REQUEST['filter_status']) && $_REQUEST['filter_status']!="")
                          {
                            $filter_condition.=" AND status= '".$_REQUEST['filter_status']."'";
                          }
                          // echo $filter_condition;
                          // Fetch data from the vsz_task table
                          $sql = "SELECT * FROM vsz_task WHERE is_deleted = 0 $filter_condition ORDER BY created_at ASC ";
                          $result = mysqli_query($conn, $sql);

                          // Check if there are any records
                          if (mysqli_num_rows($result) > 0) {
                              // Output data of each row
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>";
                                  echo "<td style='width:10%!important;'><input type='checkbox' class='task_selected' name='task_selected' onclick='taskselected()'value='".$row["id"]."' /></td>";
                                  echo "<td style='width:15%!important;'><a href='view-all-comments.php?id=" . $row["id"] . "'>" . get_words($row["task_title"],2) . "</a></td>";

                                  echo "<td>" . get_words($row["description"],4) . "</td>";
                                  echo "<td>" . getCustomerNameById($conn, $row["customer_id"]) . "</td>"; // Fetch customer name using customer_id
                                  echo "<td>" . $row["end_date"] . "</td>";
                                  echo "<td>" . getStatusName($row["status"]) .  "</td>";
                                  echo "<td>";
                                  echo "<a href='view-task.php?id=" . $row["id"] . "'><i class='bi bi-eye eye_icon'></i></a>";
                                  echo "<a href='export_task_details.php?id=" . base64_encode($row["id"]) . "'><i class='bi bi-cloud-download upload_icon'></i></a>";
                                  // echo "<a href='view-all-comments.php?id=" . $row["id"] . "'><i class='bi bi-cloud-upload upload_icon'></i></a>";
                                  echo "<a href='add-task.php?id=" . $row["id"] . "'><i class='bi bi-pencil-square edit_icon'></i></a>";
                                  echo "<a href='delete-task.php?id=" . $row["id"] . "'onclick='return confirm(\"Are you sure you want to delete this task?\")'><i class='bi bi-trash delete_icon'></i></a>";
                                  echo "</td>";
                                  echo "</tr>";
                              }
                          } else {
                              echo "<tr><td colspan='6'>No tasks found</td></tr>";
                          }

                          function getStatusName($status) {
                              if ($status == 1) {
                                  return "Active";
                              } else {
                                  return "Complete";
                              }
                          }

                          function getCustomerNameById($conn, $customer_id) {
  
                            $sql = "SELECT first_name FROM vsz_customer WHERE id = $customer_id";
                            $result = $conn->query($sql);
                            $first_name="";
                            if ($result) { 
                                if ($result->num_rows > 0) {
                                  
                                    $row = $result->fetch_assoc();
                                    $first_name = $row["first_name"];
                               
                            }
                          }
                            return $first_name;
                        }
                          ?>
                      </tbody>
                  </table>

              </div>

              <!-- /.card-body -->

            </div>

            <!-- /.card -->

          </div>

          <!-- /.col -->

        </div>

        <!-- /.row -->

      </div>

      <!-- /.container-fluid -->

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

  <?php include 'includes/footer.php'; ?>

</div>

<!-- ./wrapper -->



<!-- jQuery -->

<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->

<script src="plugins/datatables/jquery.dataTables.min.js"></script>

<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>

<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="plugins/jszip/jszip.min.js"></script>

<script src="plugins/pdfmake/pdfmake.min.js"></script>

<script src="plugins/pdfmake/vfs_fonts.js"></script>

<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>

<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->


<script>

  $(function () {

    $("#example1").DataTable({

      // "responsive": true, "lengthChange": false, "autoWidth": false,

      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({

      "paging": true,

      "lengthChange": false,

      "searching": false,

      "ordering": true,

      "info": true,

      "autoWidth": false,

      "responsive": true,

    });

  });

  
$('#select_all_task').on('click', function(){
  var status = $(this).is(":checked") ? true : false;
    $(".task_selected").prop("checked",status);
});

function taskselected(){
  if ($('.task_selected:checked').length == $('.task_selected').length) {
        $("#select_all_task").prop("checked", true);
    }else{
      $("#select_all_task").prop("checked", false);
    }
}

$('#task_export').on('click', function(){
  var ids = [];
  $('input[class="task_selected"]:checked').each(function() {
     ids.push(this.value); 
  });
  export_all_tasks(ids);
  
});
function export_all_tasks(ids)
{
  

  if(ids.length)
  {
    var id_list=ids.join(",");
    var enc_id=btoa(id_list);
    console.log(id_list);
    console.log(enc_id);
    // export_task_details.php?id=" . base64_encode(id_list) . "
    swal({
      title: "Are you sure to export this task?",
      
      type: "warning",
      showCancelButton: true,
      // cancelButtonColor: "#DD6B55",
      confirmButtonText: "Yes"
      // cancelButtonText: "No"
    },
    function(){
    var url="export_task_details.php?id="+enc_id;
    window.open(url, '_blank').focus();
    }); 
        
      
  }else{
    
    swal("Failure!", "Please select at least one row.", "error");
  }
}

</script>

</body>

</html>

