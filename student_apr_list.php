<?php
session_start();
$id = $user['App_NO'];
$query = "SELECT APR_NO,thesis_title,date_format(date_submitted,'%d-%m-%Y %k:%i:%s') as date_submitted,status FROM apr_a WHERE Std_NO = $id";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$apr_exist = mysqli_num_rows($result) > 0;
if($apr_exist)
{
	while($row = mysqli_fetch_array($result))
	{
		$aprs[] = $row;
	}
}
if(isset($_POST['param']))
{
	if(isset($_SESSION['apr_a']))unset($_SESSION['apr_a']);
	$APR_NO = $_POST['param'];
	$query = "SELECT * FROM apr_a WHERE Std_NO = $id AND APR_NO = $APR_NO";
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
		$_SESSION['apr_a'] = $apr_a;
		if($user['Sc_NO']==6)
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
		header("Location: student_index.php?cont=APR&act=view");
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
<div class="title"> Your Annual Progress Reports </div>
<div class="content">
<div style="width:80%;">
<?php
if($apr_exist)
{
	echo("
<table cellspacing='3' cellpadding='5' class='list' style='width:100%;'>
  <tr class='dark'>
    <td>APR Number</td>
    <td>Thesis Title</td>
    <td>Date Submitted</td>
    <td>Status</td>
    <td>&nbsp;</td>
  </tr>");

	foreach($aprs as $apr)
	{
		echo '<tr class="light">';
		echo '<td>'.$apr['APR_NO'].'</td>';
		echo '<td>'.$apr['thesis_title'].'</td>';
		echo '<td>'.$apr['date_submitted'].'</td>';
		echo '<td>'.$apr['status'].'</td>';
		echo '<td><a href="#" onclick="submitform1('.$apr['APR_NO'].')">Detail</a></td>';
		echo '</tr>';
	}
	echo '</table>';
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
