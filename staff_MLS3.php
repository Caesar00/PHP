<?php 
    session_start();
    include 'connection.php';

    if($_SESSION['status']!="Sup"){	//if not supervisor, redirect to GRO
        header( "Location: 403error.php" );
    }
    if(!isset($_SESSION['staff_id'])){
        header("Location: login.php");//force to login first
    }
    $staff_id=$_SESSION['staff_id'];
    $get_user_res = mysqli_query($con,"SELECT * FROM staff_account WHERE S_No = '$staff_id'") or die (mysqli_error($con));
    while($user = mysqli_fetch_array($get_user_res))
    {
            $title=$user['salutation'];
            $firstname=$user['firstname'];
            $lastname=$user['surname'];
    }
    $fullname = $title." ".$firstname." ".$lastname; // show supervisor full name at top right with welcome message
	session_commit();
?>
<div class="container">
    <?php
      if(isset($_GET['act']))
      {
          if($_GET['act']=="view")
          {
              include "staff_view_MLS3.php";
          }
          else if($_GET['act']=="submit")
          {
              include "staff_submit_mls3.php";
          }
          else if($_GET['act']=="report")
          {
              include "staff_report_mls3.php";
          }
          else if($_GET['act']=="search")
          {
              include "staff_search_mls3.php";
          }
      }
      else
      {
          include "staff_mls_list3.php";
      }
      ?>
</div>
