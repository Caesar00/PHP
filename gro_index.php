<?php
session_start();
include "connection.php";
date_default_timezone_set('Australia/Perth');

if(!isset($_SESSION['staff_id']))
{
header("Location: staff_login.php?page=gro_index.php");
}//force to login first
if(isset($_SESSION['staff_id'])&&$_SESSION['status']!="GRO")
{
header("Location: 403error.php");//for non GRO accessing
}
$staff_id=$_SESSION['staff_id'];
$get_user = "SELECT * FROM staff_account WHERE S_NO = '$staff_id'";
$get_user_res = mysqli_query($con,$get_user) or die(mysqli_error($con));
$user = mysqli_fetch_array( $get_user_res );
session_commit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDR | Murdoch</title>
<link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/libs.js"></script>
</head>
<body>
<?php
include "header.php";
include "GROnav.php";
include "user_info.php";
?>
<?php
//include "user_info.php";
if(isset($_GET['cont']))
{
	if($_GET['cont'] == 'APR')
	{
		include "gro_apr.php";
	}
}
else
{
	include "gro_profile.php";
}
include "footer.php";
?>
</body>
</html>