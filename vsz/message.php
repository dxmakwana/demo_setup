<?php



if(isset($_SESSION['vsz_custom_error']) && $_SESSION['vsz_custom_error'] != "")

{

  if(isset($_SESSION['vsz_custom_error']['msg_type']) && $_SESSION['vsz_custom_error']['msg_type']=="error" && isset($_SESSION['vsz_custom_error']['err_msg']))

  {

      ?>

      <div class="alert alert-danger">

        <button data-dismiss="alert" class="close close-sm" type="button">x</button>

        <strong> Error!</strong> <?php echo $_SESSION['vsz_custom_error']['err_msg']; ?>

      </div>

      <?php 

  }else

  {

    if(isset($_SESSION['vsz_custom_error']['msg_type']) && $_SESSION['vsz_custom_error']['msg_type']!="error" && isset($_SESSION['vsz_custom_error']['err_msg']))

    {

      ?>

        <div class="alert alert-success">

          <button data-dismiss="alert" class="close close-sm" type="button">x</button>

          <strong> Success!</strong> <?php echo $_SESSION['vsz_custom_error']['err_msg']; ?>

        </div>

      <?php

    }

  }

}

unset($_SESSION['msg']);

unset($_SESSION['print']);

unset($_SESSION['print1']);

unset($_SESSION['vsz_custom_error']);

?>











