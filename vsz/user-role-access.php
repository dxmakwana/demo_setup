<?php

  $title="Add User Role";$active_menu="add_user_role";

  include "includes/header.php"; 

  require_once("config.php");

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



      <div class="content-wrapper">
        <section class="content">
        <body class="hold-transition sidebar-mini layout-fixed">
          <div class="wrapper">

              <div class="col-md-12">

                  <div class="card card-secondary">

                      <div class="card-header">

                      <?php if(isset($_REQUEST['id'])): ?>

                          <h3 class="card-title">Edit User Role</h3>

                      <?php else: ?>  

                          <h3 class="card-title">Add User Role</h3>

                      <?php endif; ?>

                      </div>

                      <!-- /.card-header -->

                      <!-- form start -->

                      <div class="card-body card-body1">
                        <form id="addFileTypeForm" class="g-3 validate-form" data-err_msg_ele="help"  method="post" action="action_role_access.php">

                          <?php include 'message.php'; ?>

                          <?php

                          if(isset($_REQUEST['id']))

                          {

                            $sel_file_details=mysqli_query($conn,"SELECT * from vsz_user_type WHERE id='".$_REQUEST['id']."' ");

                            $fetch=mysqli_fetch_assoc($sel_file_details);

                                              

                              echo '<input type="hidden" name="utype" value="'.$_REQUEST['id'].'">';

                          } ?>

                          <table class="table table-bordered table-striped">

                            <thead>

                              <tr>

                                <th>Permission</th>

                                <th class="text-center">Create</th>

                                <th class="text-center">View</th>

                                <th class="text-center">Update</th>

                                <th class="text-center">Delete</th>

                              </tr>

                            </thead>

                            <tbody>

                              <?php

                                $sel_pmenu = "SELECT * from vsz_admin_menu where pmenu='0' AND is_deleted='0' ";

                                $que_pmenu = mysqli_query($conn,$sel_pmenu);

                                while($fet_pmenu = mysqli_fetch_array($que_pmenu))

                                {

                                    $mname=$fet_pmenu['mname'];

                                    $is_access=check_is_access($mname,$_REQUEST['id']);

                                    ?>

                                      <tr>

                                        <td><input type="checkbox" onclick="select_child_checkbox(this)"  <?php if($is_access==1){echo "checked";} ?>  name="<?php echo $fet_pmenu['mname'];?>" id="chk_<?php echo $fet_pmenu['mname'];?>" value="1"> <label for="chk_<?php echo $fet_pmenu['mname'];?>"><?php echo $fet_pmenu['mtitle'];?></label></td>

                                        <?php

                                          $sel_smenu = "SELECT * from vsz_admin_menu where pmenu='".$fet_pmenu['mid']."' AND is_deleted='0' LIMIT 4";

                                          $que_smenu = mysqli_query($conn,$sel_smenu);

                                          if(mysqli_num_rows($que_smenu)>0)

                                          {

                                            // while($fet_smenu = mysqli_fetch_array($que_smenu))

                                            // {

                                              $mname="add_".$fet_pmenu['mname'];

                                              $is_access_add=check_is_access($mname,$_REQUEST['id']);



                                              $mname="update_".$fet_pmenu['mname'];

                                              $is_access_update=check_is_access($mname,$_REQUEST['id']);



                                              $mname="view_".$fet_pmenu['mname'];

                                              $is_access_view=check_is_access($mname,$_REQUEST['id']);



                                              $mname="delete_".$fet_pmenu['mname'];

                                              $is_access_delete=check_is_access($mname,$_REQUEST['id']);

                                            ?>

                                              <td class="text-center"><input onclick="select_parent_checkbox(this)" data-parent="<?php echo $fet_pmenu['mname'];?>" <?php if($is_access_add==1){echo "checked";} ?> type="checkbox" name="add_<?php echo $fet_pmenu['mname'];?>" id="chk_add_<?php echo $fet_pmenu['mname'];?>" value="1"></td>

                                              <td class="text-center"><input onclick="select_parent_checkbox(this)" data-parent="<?php echo $fet_pmenu['mname'];?>"  <?php if($is_access_update==1){echo "checked";} ?> type="checkbox" name="update_<?php echo $fet_pmenu['mname'];?>" id="chk_update_<?php echo $fet_pmenu['mname'];?>" value="1"></td>

                                              <td class="text-center"><input onclick="select_parent_checkbox(this)" data-parent="<?php echo $fet_pmenu['mname'];?>"  <?php if($is_access_view==1){echo "checked";} ?> type="checkbox" name="view_<?php echo $fet_pmenu['mname'];?>" id="chk_view_<?php echo $fet_pmenu['mname'];?>" value="1"></td>

                                              <td class="text-center"><input onclick="select_parent_checkbox(this)" data-parent="<?php echo $fet_pmenu['mname'];?>"  <?php if($is_access_delete==1){echo "checked";} ?> type="checkbox" name="delete_<?php echo $fet_pmenu['mname'];?>" id="chk_delete_<?php echo $fet_pmenu['mname'];?>" value="1"></td>

                                            <?php

                                            // }

                                          }else

                                          {

                                            ?>

                                              <td>&nbsp;</td>

                                              <td>&nbsp;</td>

                                              <td>&nbsp;</td>

                                              <td>&nbsp;</td>

                                            <?php

                                          }

                                          

                                        ?>

                                        

                                      </tr>

                                    <?php

                                }

                              ?>

                              

                            </tbody>

                          </table>

                        

                          <div class="col-lg-12 text-center">

                            <button class="save_btn" type="submit" id="add_task_submit">Save</button>

                            <a class="cance_btn" href="manage-user-role.php">Cancel</a>

                          </div>

                        </form>
                      </div>

                  </div>

                      <!-- /.card -->



                      <!-- /.card -->



              </div>

          </div>
        </section>
      </div>
      <!-- /.content-wrapper -->
      <?php include 'includes/footer.php'; ?>
      <script>

  function select_child_checkbox(e)

  {

   var name= $(e)[0]['name'];

  //  console.log(name);

  var add_checked_id= "chk_add_"+ name;

  var update_checked_id= "chk_update_"+ name;

  var view_checked_id= "chk_view_"+ name;

  var delete_checked_id= "chk_delete_"+ name;



   if($('input[name='+name+']:checked').length>0){

    // console.log('yes');

    $("#"+add_checked_id).prop("checked",true);

    $("#"+update_checked_id).prop("checked",true);

    $("#"+view_checked_id).prop("checked",true);

    $("#"+delete_checked_id).prop("checked",true);



   }else{

    // console.log('no');

    $("#"+add_checked_id).prop("checked",false);

    $("#"+update_checked_id).prop("checked",false);

    $("#"+view_checked_id).prop("checked",false);

    $("#"+delete_checked_id).prop("checked",false);

   }



  }

  function select_parent_checkbox(e){

    var parent_id = "chk_"+$(e).data('parent');

    var parent_id_check = $(e).data('parent');



    var name= $(e)[0]['name'];



    if($('input[name='+name+']:checked').length>0){

      $("#"+parent_id).prop("checked",true);



    }else{

      var add_checked_id= "chk_add_"+ parent_id_check;

      var update_checked_id= "chk_update_"+ parent_id_check;

      var view_checked_id= "chk_view_"+ parent_id_check;

      var delete_checked_id= "chk_delete_"+ parent_id_check;

     

      if($("#"+add_checked_id).is(':checked') ||$("#"+update_checked_id).is(':checked')||$("#"+view_checked_id).is(':checked')||$("#"+delete_checked_id).is(':checked') )



      {

      

      }else

      {

        $("#"+parent_id).prop("checked",false);



      }

    }

    



  }

  </script>

  