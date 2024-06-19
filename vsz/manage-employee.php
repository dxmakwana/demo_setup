<?php

  $title="Add Employees";$active_menu="add_employee";

  include "includes/header.php"; 

  require_once("config.php");
  
?>

<body class="hold-transition sidebar-mini layout-fixed">

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

  <!-- Content Wrapper. Contains page content -->
  <?php
  session_start();

// Check if there is a success or error message to display
if (isset($_SESSION['msg_type']) && isset($_SESSION['err_msg_title']) && isset($_SESSION['err_msg'])) {
    $msg_type = $_SESSION['msg_type'];
    $err_msg_title = $_SESSION['err_msg_title'];
    $err_msg = $_SESSION['err_msg'];

    // Display the message
    echo "<div class='alert alert-$msg_type'>";
    echo "<strong>$err_msg_title!</strong> $err_msg";
    echo "</div>";

    // Unset session variables after displaying the message
    unset($_SESSION['msg_type']);
    unset($_SESSION['err_msg_title']);
    unset($_SESSION['err_msg']);
}
?>
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <!-- <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Employees</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>

              <li class="breadcrumb-item"><a href="manage-employee.php">Employees</a></li>

              <li class="breadcrumb-item active">View All Employee</li>

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
                <h3 class="card-title">All Employees</h3>
                <a href="add-employee.php"><button class="btn btn-secondary add_btn">Add Employee</button></a>
              </div>

              <div class="card-body card-body1">

                <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Status</th>

                    <th style="width:100px;" data-orderable="false">Action</th>

                  </tr>

                  </thead>

                       <tbody>

                           <?php

                                // Fetch data from the vsz_employee table

                                $sql = "SELECT * FROM vsz_employees where is_deleted = 0";

                                $result = mysqli_query($conn, $sql);



                                // Check if there are any records

                                if (mysqli_num_rows($result) > 0) {

                                    // Output data of each row

                                    while($row = mysqli_fetch_assoc($result)) {

                                    echo "<tr>";

                                    echo "<td>" . $row["first_name"] . "</td>";

                                    echo "<td>" . $row["email"] . "</td>";

                                    echo "<td>" . $row["phone_number"] . "</td>";

                                    echo "<td>" . getStatusName($row["status"]) .  "</td>";

                                    echo "<td>";

                                    echo "<a href='view-employee.php?id=" . $row["id"] . "'><i class='bi bi-eye eye_icon'></i></a>";

                                    echo "<a href='add-employee.php?id=" . $row["id"] . "'><i class='bi bi-pencil-square edit_icon'></i></a>";

                                    echo "<a href='delete-employee.php?id=" . $row["id"] . "'onclick='return confirm(\"Are you sure you want to delete this employee?\")'><i class='bi bi-trash delete_icon'></i></a>";

                                    echo "</td>";

                                    echo "</tr>";

                                    }

                                        } else {

                                            echo "<tr><td colspan='5'>No Employees found</td></tr>";

                                        }

                                        function getStatusName($status) {

                                            if ($status == 1) {

                                                return "Active";

                                            } else {

                                                return "Inactive";

                                            }

                                        }

                                // Close the database connection

                                // mysqli_close($conn);

                                ?>



<!-- Rest of your HTML code remains the same -->

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

  <!-- <?php include $_SERVER['DOCUMENT_ROOT'] . '/vsz/includes/footer.php'; ?> -->
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

</script>

</body>

</html>

