<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature</title>
</head>
<link href="css/header.css" rel="stylesheet" type="text/css" />

<?php 

include 'connection.php';
session_start();
/* this shows the error message when the page goes white
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if ($_SESSION['is_admin'])
{
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}
ini_set('html_errors', 'On');*/
$eoinumber="";
$eoiemail="";
$eoitel="";
$err="";
$errcheck ="";
$errnorecord="";

if(isset($_POST['loginpage']))
{
	header("Location: Login Page.php");
}

if(isset($_POST['checkstatus']))
{
	if((isset($_POST['eoinumber'])&&$_POST['eoinumber']=="")||(isset($_POST['eoiemail'])&&$_POST['eoiemail']=="")||(isset($_POST['eoitel'])&&$_POST['eoitel']==""))
	{
		$err="Yes";
		$errcheck ="Please enter all the relevant details to check status";
	}
	if(isset($_POST['eoinumber']))
	{
		$eoinumber = $_POST['eoinumber'];
	}
	if(isset($_POST['eoiemail']))
	{
		$eoiemail = $_POST['eoiemail'];
	}
	if(isset($_POST['eoitel']))
	{
		$eoitel = $_POST['eoitel'];
	}
	if((isset($_POST['eoinumber'])&&$_POST['eoinumber']!="")&&(isset($_POST['eoiemail'])&&$_POST['eoiemail']!="")&&(isset($_POST['eoitel'])&&$_POST['eoitel']!=""))
	{
		$findeoi="SELECT eoi_id, email, telephone, status, groreason FROM eoi WHERE eoi_id='$eoinumber' AND email='$eoiemail' AND telephone='$eoitel'";
		$findeoi_res = mysql_query($findeoi) or die(mysql_error());
		$total_results = mysql_num_rows($findeoi_res);
		while($eoi = mysql_fetch_array( $findeoi_res )) 
		{
			$status=$eoi['status'];
			$reason=$eoi['groreason'];
		}
		if($total_results < 1) //checks for wrong inputs
		{
			$err="Yes";
			$errnorecord="Details do not match";
		}
		if($status=="NULL")
		{
			$status="AWAIT VIEWING";
		}
	}
	
	
	
}
?>
<body>
<form action ="" method="post"> 
<table border="0" align="center" >
	<tr>
		<td width="1000">
			<div id="header"><div id="logo"></div></div>
			<div id="navbarhmpage"><?php include "Homepagenav.php"; ?></div>
		</td>
	</tr>
	
	<tr align="center">
		<td style="padding:5px 40px; font-size: 16px;" >
			<h2>Status of Expression of Interest (EOI)</h2>
			<font color="#FF0000"><?php echo $errcheck;echo $errnorecord; ?></font><br /><br />
			<table border="0" cellpadding="2" >
				<col width="25%">
				<col width="25%">
				<col width="50%">
				<tr align="center">
					<td>&nbsp;</td>
					<td><strong>EOI Application No: </strong></td>
					<td align="left">
						<input type="text" name="eoinumber" value="<?php if(isset($_POST['checkstatus'])) echo $eoinumber; ?>" />
					</td>
				</tr>
				<tr align="center">
					<td>&nbsp;</td>
					<td><strong>Email Address:</strong></td>
					<td align="left">
						<input type="text" name="eoiemail" value="<?php if(isset($_POST['checkstatus'])) echo $eoiemail; ?>"/></td>
				</tr>
				<tr align="center">
					<td>&nbsp;</td>
					<td><strong>Telephone:</strong></td>
					<td align="left">
						<input type="text" name="eoitel" value="<?php if(isset($_POST['checkstatus'])) echo $eoitel; ?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<br>
						<input type="submit" name="checkstatus"  class="btn1" id="button" value="Check Status" />
						<br>
					</td>
				</tr>

				<?php if(isset($_POST['checkstatus'])&&$err==""){?>
					<tr align="center">
						<td>&nbsp;</td>
						<td scope="row"><div align="center"><strong>Status:</strong></div></td>
						<td align="left">
							<?php echo $status; ?>
						</td>
					</tr>
					<?php if($status!="NULL"){?>
					<tr align="center">
						<td>&nbsp;</td>
						<td scope="row"><div align="center"><strong>Reason:</strong></div></td>
						<td align="left">
							<?php echo $reason;?>
						</td>
					</tr>
					<?php }?>
				<?php } ?>
				
				<tr>
					<td colspan="3">
						<p align="center"><input type="submit" name="loginpage" class="btn1" value="Return To Login Page" /></p>
					</td>
				</tr>
			</table>
			<p>&nbsp;</p>  
			
		</td>		
	</tr>
	<tr>
		<td>
		<?php include ("footer.php"); ?>
		</td>
	</tr>
</table>
</form>
<p>&nbsp;</p>
</body>
</html>
