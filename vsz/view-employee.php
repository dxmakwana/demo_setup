<?php

  $title="Employee Details";$active_menu="Employee_list";

  include "includes/header.php"; 

  require_once("config.php");



  if(isset($_REQUEST['id']) && $_REQUEST['id']!="")

  {

    $sel_Employee_details=mysqli_query($conn,"SELECT * from vsz_employees WHERE id='".$_REQUEST['id']."' ");

    $fetch=mysqli_fetch_assoc($sel_Employee_details);

  }else

  {

    ?><script> window.location.href='manage-employee.php';</script><?php

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

      <h1>Employee</h1>

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

</section>
    <section class="section content">
      <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
          <div class="container-fluid">
            <div class="row">

              <div class="col-lg-12">



                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">View Employee</h3>
                  </div>

                  <div class="card-body">
                    <!-- <div class="add_title_box">Employee Details</div> -->
                    <input type="hidden" id="id" value="<?php echo $_REQUEST['id']; ?>"/>

                      <div class="row pad_12">

                        

                          <table class="table table-bordered table-striped">



                            <tr class="de_bg">

                                <td style="width:10%;">First Name :</td>

                                <td id="label_first_name"><?php echo $fetch['first_name']; ?></td>

                            </tr>

                            <tr class="de_bg">

                                <td style="width:10%;">Middle Name :</td>

                                <td id="label_middle_name"><?php echo $fetch['middle_name']; ?></td>

                            </tr>

                            <tr class="de_bg">

                                <td style="width:10%;">Last Name :</td>

                                <td id="label_last_name"><?php echo $fetch['last_name']; ?></td>

                            </tr>

                          

                            <tr class="de_bg">

                                <td style="width:10%;">Email Address :</td>

                                <td id="label_email"><?php echo $fetch['email']; ?></td>

                            </tr>

                            

                            <tr class="de_bg">

                                <td style="width:10%;">Phone Number :</td>

                                <td id="label_phone_number"><?php echo $fetch['phone_number']; ?></td>

                            </tr>

                          

                            <!-- <tr>

                                <td style="width:10%;">Address :</td>

                                <td id="label_address"><?php echo $fetch['address']; ?></td>

                            </tr> -->

                            <tr class="de_bg">

                                <td style="width:45%;">Status :</td>

                                <td id="label_status"><?php echo ($fetch['status'] == 1) ? 'Active' : 'Inactive'; ?></td>

                            </tr>

                            

                          </table> 

                  

                      

                        

                        

                      </div>
                  </div>

                </div>

                

                



              </div>

            </div>
            </div>
        </div>
      </body>
    </section>
  </div>





  </main><!-- End #main -->

  <?php include 'includes/footer.php'; ?>

  <!-- <script src="assets/js/Employees/detail.js?v=<?php echo $php_version;?>"></script> -->