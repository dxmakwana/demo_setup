<footer class="main-footer print-none">

    <strong>Copyright &copy; 2024 Made With By <a href="#">VSZ</a>.</strong>

    All rights reserved.

    <div class="float-right d-none d-sm-inline-block">

    </div>

  </footer>



  <!-- Control Sidebar -->

  <aside class="control-sidebar control-sidebar-dark">

    <!-- Control sidebar content goes here -->

  </aside>

  <!-- /.control-sidebar -->

</div>

<!-- ./wrapper -->



<!-- jQuery -->

<script src="plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->

<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>

  $.widget.bridge('uibutton', $.ui.button)

</script>

<!-- Bootstrap 4 -->

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- ChartJS -->

<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->

<!-- Sparkline -->

<!-- <script src="plugins/sparklines/sparkline.js"></script> -->

<!-- JQVMap -->

<!-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script>

<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->

<!-- jQuery Knob Chart -->

<!-- <script src="plugins/jquery-knob/jquery.knob.min.js"></script> -->

<!-- daterangepicker -->

<script src="plugins/moment/moment.min.js"></script>

<script src="plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->

<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Summernote -->

<script src="plugins/summernote/summernote-bs4.min.js"></script>

<!-- overlayScrollbars -->

<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App -->

<script src="assets/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->

<!--<script src="assets/js/demo.js"></script>-->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- <script src="assets/js/pages/dashboard.js"></script> -->
<script src="assets/js/custom_jquery_functions.js?v=<?php echo uniqid();?>"></script>  
  <link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.min.css">
  <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>
    <?php
    if(isset($_SESSION['vsz_custom_error']))
    {

    
      if($_SESSION['vsz_custom_error']['msg_type']=="success"){$_SESSION['vsz_custom_error']['err_msg_title']="Success!";}
      if($_SESSION['vsz_custom_error']['msg_type']=="error"){$_SESSION['vsz_custom_error']['err_msg_title']="Error";}
      $msg_type=$_SESSION['vsz_custom_error']['msg_type'];
      $msg_title=$_SESSION['vsz_custom_error']['err_msg_title'];
      $msg_description=$_SESSION['vsz_custom_error']['err_msg'];
      
      if($msg_type!="" && $msg_description!="")
      {
        echo "<script>swal('".$msg_title."', '".$msg_description."', '".$msg_type."');</script>";
      }
      
      unset($_SESSION['vsz_custom_error']);
    }  
      ?>