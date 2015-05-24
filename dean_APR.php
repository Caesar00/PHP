<?php 
session_start();
include "connection.php";
date_default_timezone_set('Australia/Perth');

if(!isset($_SESSION['staff_id']))
{
header("Location: staff_login.php?page=dean_index.php");
}//force to login first
if(isset($_SESSION['staff_id'])&&$_SESSION['status']!="Dean")
{
header("Location: 403error.php");//for non GRO accessing
}
$staff_id=$_SESSION['staff_id'];
$get_user = "SELECT * FROM staff_account WHERE S_NO = '$staff_id'";
$get_user_res = mysqli_query($con,$get_user) or die(mysqli_error($con));
while($user = mysqli_fetch_array( $get_user_res )) 
{
	$title=$user['salutation'];
	$firstname=$user['firstname'];
	$lastname=$user['surname'];
}
$fullname = $title." ".$firstname." ".$lastname; // show supervisor full name at top right with welcome message
session_commit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDR | Murdoch</title>
<link href="css/jquery-ui.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/libs.js"></script>
<title>HDR | Murdoch</title>
<?php include ('header.php');?>
</head>
<body>
<?php
        include ("dean_nav.php");
        ?>
<div class="leftmenu">
  <div class="box"> <a href="dean_APR.php">List of Pending APRs</a>
    <div class="line"></div>
    <a href="dean_APR.php?cont=submitted">List of Submitted APRs</a> </div>
</div>
<div style="float:right; width:80%;">
  <?php
  if(isset($_GET['act']))
  {
	  if($_GET['act']=="view")
	  {
		  include "dean_view_APR.php";
	  }
	  else if($_GET['act']=="submit")
	  {
		  include "dean_submit_APR.php";
	  }
  }
  else
  {
	  include "staff_apr_list.php";
  }
  ?>
</div>
<?php include ("footer.php");?>
</body>
</html>
