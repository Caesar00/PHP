<?php
session_start();
$inactive = 900; // Set timeout period in seconds

if (isset($_SESSION['timeout'])) 
{
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive)
	{
        session_destroy();
        header("Location: index.php?timedOut");
    }
}
$_SESSION['timeout'] = time();

include "connection.php";
date_default_timezone_set('Australia/Perth');
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'stu')
{
	header("Location: index.php");
}
else
{
	if(isset($_SESSION['id']))
	{
		$query = "SELECT * FROM applicant WHERE App_NO = $_SESSION[id]";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		$user = mysqli_fetch_array( $result );
		$id = $user['App_NO'];
		$query = "SELECT * FROM hdr_student WHERE App_NO = $id";
		$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result)==1)
		{
			$stud = mysqli_fetch_array($result);
			$user = array_merge($user, $stud);
            $hasAccepted = True;
		}
	}
	session_commit();
}
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
        ?>
        <div class="navigator" > 
        <a <?php if(!isset($_GET['cont']))echo("class = 'selected'"); ?>href="student_index.php">My Profile</a><span>|</span> 
        <?php
            if(!$hasAccepted) 
            {
                echo '<a href="EOI_Page1.php">Expression of Interest</a><span>|</span>';
            }
        ?>
        <a <?php if(isset($_GET['cont']))if($_GET['cont']=='APR')echo("class = 'selected'"); ?>href="student_index.php?cont=APR">Annual Progress Report</a><span>|</span> 
        <a <?php if(isset($_GET['cont']))if($_GET['cont']=='MLS')echo("class = 'selected'"); ?>href="student_index.php?cont=MLS">Meeting Log System</a> 
        </div>
        <div style="height:100%">
        <?php
        include "user_info.php";
        if(isset($_GET['cont']))
        {
            if($_GET['cont'] == 'APR')
            {
                include "student_apr.php";
            }
            
            if($_GET['cont'] == 'MLS')
            {
                include "student_mls.php";
            }
            if($_GET['cont'] == 'RPM')
            {
                include "student_rpm.php";
            }
        }
        else
        {
            include "student_profile.php";
        }
        ?>
        </div>
        <?php include 'footer.php';?>
    </body>
</html>
