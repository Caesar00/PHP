<?php
session_start();
$inactive = 900; // Set timeout period in seconds

if (isset($_SESSION['timeout'])) 
{
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive)
	{
        session_destroy();
        session_start();
        $_SESSION['info'] = "<strong>To continue, please login into your staff account.</strong>";
        header("Location: login.php");
    }
}
$_SESSION['timeout'] = time();

include "connection.php";
date_default_timezone_set('Australia/Perth');
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'sta')
{
    $_SESSION['info'] = "<strong>To continue, please login into your staff account.</strong>";
    header("Location: login.php");
}
else
{
	// if(isset($_SESSION['id']))
	// {
		// $query = "SELECT * FROM applicant WHERE App_NO = $_SESSION[id]";
		// $result = mysqli_query($con,$query) or die(mysqli_error($con));
		// $user = mysqli_fetch_array( $result );
		// $id = $user['App_NO'];
		// $query = "SELECT * FROM hdr_student WHERE App_NO = $id";
		// $result = mysqli_query($con,$query);
		// if(mysqli_num_rows($result)==1)
		// {
			// $stud = mysqli_fetch_array($result);
			// $user = array_merge($user, $stud);
            // $hasAccepted = True;
		// }
        // $_SESSION['user'] = $user;
	// }
}
session_commit();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>HDR+</title>
        <?php include "resources.php" ?>
    </head>
    <body>
        <?php
            include "header3.php";
        ?>
        <?php
        if(isset($_GET['cont']))
        {
            if($_GET['cont'] == 'APR')
            {
                include "staff_APR3.php";
            }
            
            if($_GET['cont'] == 'MLS')
            {
                include "staff_MLS3.php";
            }
        }
        else
        {
            include "staff_ProfilePage3.php";
        }
        ?>
    </body>
</html>
