<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDR | Murdoch</title>
<link href="css/jquery-ui.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/libs.js"></script>
</head>
<?php 

    session_start();
    include 'connection.php';

    if($_SESSION['status']!="Sup"){	//if not supervisor, redirect to GRO
        header( "Location: 403error.php" );
    }
    if(!isset($_SESSION['staff_id'])){
        header("Location: staff_login.php?page=Staff_CurrentStudent.php");//force to login first
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
<body>
<?php
        include ("header.php");
        include ("Staffnav.php");
        ?>
<div class="leftmenu">
    <div class="box"> 
        <a href="staff_MLS.php?cont=MLS">List of Pending MLS</a>
        <div class="line"></div>
        <a href="staff_MLS.php?cont=submitted">List of Confirmed MLS</a> 
        <div class="line"></div>
        <a href="staff_MLS.php?cont=MLS&act=search">Log Search</a>
        <div class="line"></div>
        <a href="staff_MLS.php?cont=MLS&act=report">Log Report</a> 
    </div>
</div>
<div style="float:right; width:80%;">
  <?php
  if(isset($_GET['act']))
  {
	  if($_GET['act']=="view")
	  {
		  include "staff_view_MLS.php";
	  }
	  else if($_GET['act']=="submit")
	  {
		  include "staff_submit_mls.php";
	  }
	  else if($_GET['act']=="search")
      {
		  include "staff_mls_search.php";
      }
	  else if($_GET['act']=="report")
      {
		  // include "staff_mls_report.php";
      }
  }
  else
  {
	  include "staff_mls_list.php";
  }
  ?>
</div>
<?php
        include ("footer.php");
        ?>
</body>
</html>
