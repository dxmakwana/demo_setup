<?php

  $title="Add Customers";$active_menu="add_customer";
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
            
           

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <?php if(isset($_REQUEST['id'])): ?>
                                <h3 class="card-title">Edit Customer</h3>
                            <?php else: ?>  
                                <h3 class="card-title">Add Customer</h3>
                            <?php endif; ?>
                        </div>

                        <!-- /.card-header -->

                        <!-- form start -->

                            <form id="addcustomerForm" class="row g-3 validate-form" data-err_msg_ele="help"  method="post" action="action_customer.php" style="padding:15px; margin-bottom: 0;">

                                <?php include 'message.php'; ?>

                                <?php

                                    if(isset($_REQUEST['id']))

                                    {

                                    $customer=mysqli_query($conn,"SELECT * from vsz_customer WHERE id='".$_REQUEST['id']."' ");

                                    $fetch=mysqli_fetch_assoc($customer);

                                                        

                                        echo '<input type="hidden" name="id" value="'.$_REQUEST['id'].'">';

                                    } 

                                    ?>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4">

                                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>

                                            <input type="text" class="form-control" data-is_validate="1" id="first_name" name="first_name" placeholder="First Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['first_name'])){ echo $fetch['first_name']; } ?>" data-error_msg="First Name field is required">

                                            <span class="help text-danger" id="first_name_msg"></span>

                                    </div>

                                    <div class="col-md-4">

                                            <label for="middle_name" class="form-label">Middle Name </label>

                                            <input type="text" class="form-control"  id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php if(isset($_REQUEST['id']) && isset($fetch['middle_name'])){ echo $fetch['middle_name']; } ?>" data-error_msg="middle Name field is required">

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
                                            <label for="phone_number">Phone Number </label>
                                            <input type="tel" class="form-control" name="phone_number" id="phone_number"  data-is_validate="1" placeholder="Enter phone number (10 digits)" 
                                                pattern="[0-9]{10}" 
                                                title="Please enter a 10-digit phone number" 
                                                value="<?php if(isset($_REQUEST['id']) && isset($fetch['phone_number'])){ echo $fetch['phone_number']; } ?>" data-error_msg="Phone Number field is required" 
                                                required>
                                                <span class="help text-danger" id="phone_number_msg"></span>
                                        </div>

                                        <div class="col-md-4">

                                            <label for="Status">Status </label>

                                            <select class="form-select static" id="status"  data-is_validate="1" name="status" data-error_msg="Status field is required" required>

                                                <option value="1" <?php echo (isset($fetch['status']) && $fetch['status'] == "1") ? 'selected' : ''; ?>>Active</option>

                                                <option value="0" <?php echo (isset($fetch['status']) && $fetch['status'] == "0") ? 'selected' : ''; ?>>In Active</option>

                                            </select>
                                            <span class="help text-danger" id="status_msg"></span>
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

                                            <select class="form-select static" id="country" name="country" class="form-control">

                                            <option value="">select</option>

                                            <?php foreach ($country as $opt) : ?>

                                                <option value="<?php echo $opt['id']; ?>" <?php echo ($fetch['country'] == $opt['id']) ? 'selected' : ''; ?>><?php echo $opt['name']; ?></option>

                                            <?php endforeach; ?>

                                            </select>

                                        </div> 

                                        <div class="col-md-4">

                                            <label for="state" class="form-label"> State</label>

                                            <select class="form-select static" id="state" name="state" class="form-control" >

                                            <option value="">select</option>

                                            <?php foreach ($state as $opt) : ?>

                                                <option value="<?php echo $opt['id']; ?>" <?php echo ($fetch['state'] == $opt['id']) ? 'selected' : ''; ?>><?php echo $opt['name']; ?></option>

                                            <?php endforeach; ?>

                                            </select>

                                        </div> 

                                        <div class="col-md-4">

                                            <label for="city" class="form-label"> City</label>

                                            <select class="form-select static" id="city" name="city" class="form-control" >

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
                                    <!-- /.card-body -->
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                </div>
                            </form>

                    </div>
                    <!-- /.card -->
                </div>
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include 'includes/footer.php'; ?>
    </body>
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
</html>

