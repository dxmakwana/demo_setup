<?php
  $title="Add Comments";$active_menu="add_comments";
  include "includes/header.php"; 
  require_once("config.php");
$id='id';
  $sel_comment_details=mysqli_query($conn,"SELECT * from vsz_task_comment WHERE id='".$_REQUEST['id']."' ");
  $fetch=mysqli_fetch_assoc($sel_comment_details);
  
 
?>
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

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="content-wrapper">
            <section class="content">
                <div class="wrapper">
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Add Comments</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?php $task_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0; ?>
                            <form id="addtaskForm" class="row g-3 validate-form" data-err_msg_ele="help" method="post" action="action_comment.php" style="padding:15px;">
                                <!-- Add hidden input field for task_id -->
                                <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="comment">Enter A Comment:</label>
                                            <textarea class="form-control" name="comment" id="comment" rows="2" placeholder="Enter comment"></textarea>
                                        </div>
                                        <div class="col-12 text-center mt-3">
                                            <button class="save_btn" type="submit" id="add_comment_submit">Save</button>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- Include your list documents table code here -->
                                            <div class="row">
                                            <?php
                                            // Fetch and display comments and associated documents
                                            $task_comment_query = "SELECT * FROM vsz_task_comment WHERE task_id = '$task_id'";
                                            $result_comment = mysqli_query($conn, $task_comment_query);
                                            // $upload_path = 'uploads/';

                                            while ($comment = mysqli_fetch_assoc($result_comment)) {
                                                // Display comment
                                                $comment_date = date('m/d/Y', strtotime($comment['created_at']));
                                                echo '<div class="col-md-12">';
                                                echo '<p class="comment_add_date">' . $comment_date . '</p>';
                                                echo '<div class="form-control" readonly>' . $comment['comment'] . '</div>';
                                                echo '</div>';

                                                // Display associated documents
                                            }
                                            ?>
                                        </div>          
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                        <?php include "content_task_documents.php"; ?>             
                      
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <?php include 'includes/footer.php'; ?>
    <body>
    