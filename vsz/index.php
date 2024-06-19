<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Check if the user is already logged in
if(isset($_SESSION['vsz_admin']['vsz_admin_id'])) {
    // Redirect the user to the dashboard or any other page
    // header("Location: dashboard.php");
    // exit();
    ?><script> window.location.href='dashboard.php';</script><?php
}

?>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>VSZ | Log in</title>



  <!-- Google Font: Source Sans Pro -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- icheck bootstrap -->

  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="assets/css/custom.css">

</head>



<body class="hold-transition login-page">

<div class="login-box">

<div class="position-relative">
  <img src="assets/img/top-right-shape.svg" alt="VSZ" class="top-login-svg">
</div>

  <?php 
 
    if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {

        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg'] . '</div>';

        $_SESSION['msg'] = ''; // Clear the session message after displaying it

    }

    ?>

  <!-- /.login-logo -->

  <div class="card">

    <div class="card-body login-card-body">

    <a href="#" class="brand-link">
      <img src="assets/img/logo.png" alt="VSZ logo" class="brand-image">
    </a>

      <p class="login-box-msg">Welcome To Vsz Case Management</p>

        <?php 

            

            if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {

                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg'] . '</div>';

                $_SESSION['msg'] = ''; // Clear the session message after displaying it

            }

         ?>



      <form id="loginForm" class="form-horizontal" action="check_login.php" method="post">

          <?php include "message.php"; ?>

          <div class="px-25 position-relative">
            <label for="Username" class="form-label">Username</label>
            <input type="text" name="login_username" placeholder="Username Or Email" class="form-control" >
            <!-- <span class="help" id="usernameError"></span> -->
          </div>

          <span class="error-message" id="usernameError"></span>
          <div class="px-25 position-relative">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="login_password" placeholder="Password" class="form-control" >
            <!-- <span class="help" id="passwordError"></span> -->
          </div>

          <span class="error-message" id="passwordError"></span>

          <!-- <a href="forgot-password.php"><p class="forgot_password_text">Forgot Password?</p></a> -->

          <button class="login_btn" type="submit">Login</button>

        </form>



      <!-- <p class="mb-1">

        <a href="forgot-password.php">I forgot my password</a>

      </p> -->

    

    <!-- /.login-card-body -->

  </div>

<div class="position-relative">
  <img src="assets/img/bottom-left-shape.svg" alt="VSZ" class="bottom-login-svg">
</div>

</div>

<!-- /.login-box -->



<!-- jQuery -->

<script src="plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->

<script src="dist/js/adminlte.min.js"></script>



<!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

  <!-- <script src="assets/vendor/simple-datatables/simple-datatables.js"></script> -->



  <!-- Custom JS for form validation -->

  <script>

    document.getElementById('loginForm').addEventListener('submit', function(event) {

      var username = document.getElementsByName('login_username')[0].value.trim();

      var password = document.getElementsByName('login_password')[0].value.trim();

      var usernameError = document.getElementById('usernameError');

      var passwordError = document.getElementById('passwordError');

      

      usernameError.textContent = '';

      passwordError.textContent = '';

      

      if (username === '') {

        usernameError.textContent = 'Please enter username or email';

        event.preventDefault();

      }

      if (password === '') {

        passwordError.textContent = 'Please enter password';

        event.preventDefault();

      }

    });

  </script>

</body>

</html>

