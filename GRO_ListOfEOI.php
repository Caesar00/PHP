<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Graduate Research Office (View individual Expression of Intesrest)</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<?php
session_start();
include "connection.php";

if(!isset($_SESSION['staff_id']))
{
	header("Location: staff_login.php?page=GRO_ListOfEOI.php");//force to login first
}
if(isset($_SESSION['staff_id'])&&$_SESSION['status']!="GRO")
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
$_SESSION['eoiid']="";
session_write_close();

if(!isset($_POST['new'])&&!isset($_POST['acc'])&&!isset($_POST['pend'])&&!isset($_POST['rej']))
{
	$order = "NULL";
}
if(isset($_POST['new']))
{
	$order = "NULL";
}
if(isset($_POST['acc']))
{
	$order = "APPROVED";
}
if(isset($_POST['pend']))
{
	$order = "PENDING";
}
if(isset($_POST['rej']))
{
	$order = "REJECTED";
}


$eoi_id="";
$firstname="";
$lastname="";
$status="";
$datesubmit="";

//page number setup
$pageno = (!isset($_GET['pageno']))? 1 : $_GET['pageno']; 
$prev = ($pageno - 1);
$next = ($pageno + 1);

$max_results = 10; // max result per page
$from = (($pageno * $max_results) - $max_results);
// maximum result
$newresult = mysqli_query($con,"SELECT * FROM eoi WHERE status='$order'");
$total_results = mysqli_num_rows($newresult);
$total_pages = ceil($total_results / $max_results);//rounds up remainder of result
$pagination = '';
if($pageno > 1)
{
	if ($pageno > 2)
	{
		$pagination .= '<a href="GRO_ListOfEOI.php?pageno=1">First</a> ';
	}
		
	$pagination .= '<a href="GRO_ListOfEOI.php?pageno='.$prev.'">Previous</a> ';
}
else if ($pageno==1)
{
	$pagination = '<a href="GRO_ListOfEOI.php?pageno=1">1</a>';
}

/* Loop through the total pages */
for($i = max(1, $pageno - 3); $i <= min($pageno + 3, $total_pages); $i++)
{
if(($pageno) == $i)
{
	$pagination .= " <strong>".$i."</strong>";
}
else
{
	$pagination .= ' <a href="GRO_ListOfEOI.php?pageno='.$i.'">'.$i.'</a>';
}
}
/* Print NEXT link if there is one */
if($pageno < $total_pages)
{	
	$pagination .= ' <a href="GRO_ListOfEOI.php?pageno='.$next.'">Next</a>';
	if ($pageno < $total_pages - 1)
	{
		$pagination .= ' <a href="GRO_ListOfEOI.php?pageno='.$total_pages.'">Last</a>';
	}
}


?>
<body>
<div>
  <?php
  include "header.php"
  ?>
</div>
  <div>
  <?php
  include "GROnav.php"
  ?>
  </div>
 
 <div class="container1">
<div class="title" style="margin-left:auto; margin-right:auto;width:100%;" >
			<h2 align="center">List of New Expression of Interest</h2>
			</div>
            <div align="center">
<table align="center" class="list">
            <tr class="dark">
				<td align="center"><strong>EOI Number</strong></td>
				<td align="center"><strong>Applicant Name</strong></td>
				<td align="center"><strong>Date Submitted</strong></td>
				<!--<td width="200"><strong>Status</strong></td>-->
				<td border="0" align="center"></td>
            </tr>
			 <!-------------------------------------------------------------->
			<?php
			$result = "SELECT * FROM eoi,applicant WHERE applicant.app_no=eoi.app_no AND status ".($order=="NULL" ? "IS NULL" : "= '$order'")." ORDER BY eoi_no LIMIT $from, $max_results ";
			$result_res = mysqli_query($con,$result) or die(mysqli_error($con));
			while($row = mysqli_fetch_array($result_res))
			{ 
				$eoi_id =$row['EOI_NO'];
				
				$firstname = $row['firstname'];
				$lastname = $row['surname'];
				//$status = $row['status'];
				$datesubmit = $row['submit_date'];
				echo '<tr class="light">';
				echo '<td>'.$eoi_id.'</td>';
				echo '<td>'.$firstname.' '.$lastname.'</td>';
				echo '<td>'.$datesubmit.'</td>';
				//echo '<td width="200">'.$status.'</td>';
				echo '<td align="center" >';
				echo '<form method="post" action="GRO_ViewEOI.php">';
				echo '<button id="submit" type="submit" onClick="submit_btn(this)" class="btn1" name="eoi_id" value="'.$eoi_id.'" >View Details</button>';
				echo '</form>';
				echo '</td>';
				echo '</tr>';
			}

			if(empty($eoi_id))
			{
				$noeoi = "No pending EOI records";
				// to change if no pending eoi
				echo '<tr>';
				echo '<td align="center" colspan="4"><h3>'.$noeoi.'</h3></td></tr>';
				
			}
			?>
			
<!-------------------------------------------------------------->
            </table>
            </div>
            <div align="center" class="title">Page <?php echo $pagination; ?> </div>            
    <?php
	include ("footer.php");
	?>
  
</body>
</html>
