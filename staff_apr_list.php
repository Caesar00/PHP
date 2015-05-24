<?php
session_start();
if(isset($_GET['page']))
{
	$page = $_GET['page']*10;
       
}
else
{
	$page = 0;
}
$query = "SELECT COUNT(*) FROM apr_a;";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$pages = mysqli_fetch_array($result);
$pages = ceil($pages[0]/10);
if(isset($_GET['cont'])&&$_GET['cont'] == "submitted")
{
     $query="SELECT apr_a.APR_NO,Std_NO,thesis_title,date_format(".($_SESSION['status']=="Sup" ? "apr_b." : "apr_c.")."date_submitted,'%d-%m-%Y %k:%i:%s') as date_submittedd,status FROM apr_a".($_SESSION['status']=="Sup" ? ",apr_b WHERE apr_a.APR_NO IN(SELECT APR_NO FROM apr_b)" : ",apr_b,apr_c WHERE apr_b.APR_NO IN(SELECT APR_NO FROM apr_c) AND apr_c.APR_NO=apr_b.APR_NO") ." AND apr_a.APR_NO=apr_b.APR_NO LIMIT $page,10;";
}
else
{
     $query = "SELECT apr_a.APR_NO,Std_NO,thesis_title,date_format(".($_SESSION['status']=="Sup" ? "apr_a." : "apr_b.")."date_submitted,'%d-%m-%Y %k:%i:%s') as date_submittedd,status FROM apr_a".($_SESSION['status']=="Sup" ? " WHERE APR_NO NOT IN(SELECT APR_NO FROM apr_b)" : ",apr_b WHERE apr_b.APR_NO NOT IN(SELECT APR_NO FROM apr_c) AND apr_a.APR_NO=apr_b.APR_NO") ." LIMIT $page,10;";
}

$result = mysqli_query($con,$query) or die(mysqli_error($con));
$apr_exist = mysqli_num_rows($result) > 0;
if($apr_exist)
{
	while($row = mysqli_fetch_array($result))
	{
		$query = "SELECT a.firstname as firstname, a.surname as surname FROM applicant a,hdr_student h WHERE h.Stud_NO = '$row[Std_NO]' and a.App_NO = h.App_NO";
		$result2 = mysqli_query($con,$query) or die(mysqli_error($con));
		$name = mysqli_fetch_array($result2);
		$fullname = $name['firstname'].' '.$name['surname'];
		$row['name'] = $fullname;
		$aprs[] = $row;
	}
}
if(isset($_POST['param']))
{
	if(isset($_SESSION['apr_a']))unset($_SESSION['apr_a']);
	$APR_NO = $_POST['param'];
	$query = "SELECT * FROM apr_a WHERE APR_NO = $APR_NO";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	if(mysqli_num_rows($result)==1)
	{
		$apr_a = mysqli_fetch_array($result);
		$query = "SELECT * FROM apr_milestone_c WHERE APR_NO = $APR_NO";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$apr_a['milestone_c'][] = $row;
			}
		}
		$query = "SELECT * FROM apr_milestone_n WHERE APR_NO = $APR_NO";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$apr_a['milestone_n'][] = $row;
			}
		}
		$query = "SELECT * FROM apr_publication WHERE APR_NO = $APR_NO";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$apr_a['publication'][] = $row;
			}
		}
		$query = "SELECT * FROM applicant a,hdr_student h WHERE h.Stud_NO = $apr_a[Std_NO] and a.App_NO = h.App_NO";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		$stud = mysqli_fetch_array($result);
		$apr_a['stud'] = $stud;
		$_SESSION['apr_a'] = $apr_a;
		if($apr['stud']['Sc_NO']==6)
		{
			if(isset($_SESSION['apr_d_a']))unset($_SESSION['apr_d_a']);
			if(isset($_SESSION['apr_d_b']))unset($_SESSION['apr_d_b']);
			$query = "SELECT * FROM apr_d_a WHERE APR_NO = $APR_NO";
			$result = mysqli_query($con,$query) or die(mysqli_error($con));
			if(mysqli_num_rows($result)==1)
			{
				$apr_d_a = mysqli_fetch_array($result);
				$_SESSION['apr_d_a'] = $apr_d_a;
			}
			$query = "SELECT * FROM apr_d_b WHERE APR_NO = $APR_NO";
			$result = mysqli_query($con,$query) or die(mysqli_error($con));
			if(mysqli_num_rows($result)==1)
			{
				$apr_d_a = mysqli_fetch_array($result);
				$_SESSION['apr_d_b'] = $apr_d_b;
			}
		}
		$query = "SELECT * FROM apr_b WHERE APR_NO = $APR_NO";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		if(mysqli_num_rows($result)>0)
		{
			$apr_b = mysqli_fetch_array($result);
			$_SESSION['apr_b'] = $apr_b;
		}
		$query = "SELECT * FROM apr_c WHERE APR_NO = $APR_NO";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		if(mysqli_num_rows($result)>0)
		{
			$apr_c = mysqli_fetch_array($result);
			$_SESSION['apr_c'] = $apr_c;
		}
		session_commit();
		if(isset($_GET['cont'])&&$_GET['cont'] == "submitted")
		{
			if($_SESSION['status']=="Sup")
				header("Location: staff_APR.php?cont=APR&act=view");
			else if($_SESSION['status']=="Dean")
				header("Location: dean_APR.php?cont=APR&act=view");
		}
		else
		{
			if($_SESSION['status']=="Sup")
				header("Location: staff_APR.php?cont=APR&act=submit");
			else if($_SESSION['status']=="Dean")
				header("Location: dean_APR.php?cont=APR&act=submit");
		}
	}
}
session_commit();
    ?>
    <script language="javascript" type='text/javascript'>
function submitform1(str)
{
	document.form1.param.value = str;
	document.form1.submit();
}
</script>
<div id="right_window" class="container2">
<div class="title"> Annual Progress Reports List</div>
<div class="content">
<div class="formflow_h" style="width:80%;">
<?php
if($apr_exist)
{
	echo("
<table cellspacing='3' cellpadding='5' class='list' style='width:100%;'>
  <tr class='dark'>
    <td>APR Number</td>
	<td>Student Number</td>
	<td>Student Name</td>
    <td>Thesis Title</td>
    <td>Date Submitted</td>
    <td width='10%'>Status</td>
    <td>&nbsp;</td>
  </tr>");

	foreach($aprs as $apr)
	{
		echo '<tr class="light">';
		echo '<td>'.$apr['APR_NO'].'</td>';
		echo '<td>'.$apr['Std_NO'].'</td>';
		echo '<td>'.$apr['name'].'</td>';
		echo '<td>'.$apr['thesis_title'].'</td>';
		echo '<td>'.$apr['date_submittedd'].'</td>';
		echo '<td>'.$apr['status'].'</td>';
		echo '<td><a href="#" onclick="submitform1('.$apr['APR_NO'].')">Detail</a></td>';
		echo '</tr>';
	}
	echo '</table>';
	if($pages>1)
	echo '<p class="buttons"><a>First</a></p>';
}
else
{
	echo ('<p style="margin:20px">No APR history.</p>');
}
?>
</div>
<form name="form1" method="post">
<input name="param" type="hidden" value="" />
</form>
</div>
<div style="height:1px"> </div>
</div>

