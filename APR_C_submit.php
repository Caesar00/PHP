<?php 
session_start();
if(!isset($_SESSION) || !isset($_SESSION['status']))
    header("Location: staff_login.php");
else if($_SESSION['status']!="Dean")
    header("Location: 403error.php");
if(isset($_SESSION['apr_c']))
{
	$apr_c = $_SESSION['apr_c'];
	$apr_no = $_SESSION['apr_a']['APR_NO'];
}
$query = "UPDATE apr_a SET status = 'dean submitted' WHERE APR_NO = $apr_c[APR_NO]";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$result = mysqli_query($con, "INSERT INTO apr_c VALUES('$apr_no',".(empty($apr_c[discontinue_reason]) ? "NULL" : "'$apr_c[discontinue_reason]'").",'$staff_id',now())") or die(mysqli_error($con));
if($result)
{
	require("class.phpmailer.php");
	$systememail = "crsolutions333@gmail.com";	//system email address
	$systempassword = "CrS_333++";
	
	$staff_id=$_SESSION['staff_id'];
	$result = mysqli_query($con,"SELECT * FROM staff_account WHERE S_No = $staff_id") or die (mysqli_error($con));
	$user = mysqli_fetch_array($result);
	$query="SELECT staff_account.firstname as firstname, staff_account.surname as surname, staff_account.email as email FROM staff_account WHERE type = 'GRO' LIMIT 1;";
	$result=mysqli_query($con,$query) or die(mysqli_error($con));
	if($result)
	{
		$GRO=mysqli_fetch_array($result);
	}
	$date= date("d-m-Y H:i:s");
	
	
	$mail = new PHPMailer();
	
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->SMTPAuth   = true; // SMTP authentication
	$mail->SMTPSecure = "ssl";
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Port       = 465; // SMTP Port
	$mail->Username   = $systememail; // SMTP account username
	$mail->Password   = $systempassword;        // SMTP account password
	
	$mail->SetFrom($systememail, 'Graduate Research Office'); 
	// sent from this address
	
	
	$mail->AddAddress($GRO['email'],$GRO['firstname'].' '.$GRO['surname']); // recipient email
	
	//if there is a need to add CC
	//$mail->AddCC('person1@domain.com', 'Person One');
	
	$mail->Subject = "New APR received from dean - HDR Murdoch University"; // email subject
	
	$body = "<html><body><h2>New APR received from a Dean </h2>";
	$body .= "<br><font>Dear ".$GRO['firstname'].",</font>";
	$body .= "<br><p>We are glad to inform you that dean <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just submitted an APR.<br>Would you please login to Muroch HDR System and process the APR.<br>Thank you for your cooperation.<br><br>";
	$body .= "Yours sincerely,<br>";
	$body .= "Graduate Research Office<br>";
	$body .= "Murdoch University</p>";
	$body .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";
	
	$mail->MsgHTML($body);
	
	if(!$mail->Send()) {
	  echo 'Message was not sent.';
	  echo 'Mailer error: ' . $mail->ErrorInfo;
	} 
	//send email to the student
	$std_no = $_SESSION['apr_a']['Std_NO'];
	$query="SELECT applicant.firstname as firstname, applicant.surname as surname, applicant.email as email FROM applicant,hdr_student WHERE Stud_NO = $std_no AND applicant.App_NO = hdr_student.App_NO;";
	$result=mysqli_query($con,$query) or die(mysqli_error($con));
	if($result)
	{
		$student=mysqli_fetch_array($result);
	}
	$mail->ClearAddresses();
	$mail->AddAddress($student['email'],$student['firstname'].' '.$student['surname']);
	if(!isset($apr_c['discontinue_reason']) || $apr_c['discontinue_reason']=='')
	{
		$mail->Subject = "APR has been continued - HDR Murdoch University";
		$body = "<html><body><h2>Your APR has been continued. </h2>";
		$body .= "<br><font>Dear ".$student['firstname'].",</font>";
		$body .= "<br><p>We are glad to inform you that dean <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just accepted and continued your APR.<br>You can log into the HDR system to view the detail.<br>Thank you for your cooperation.<br><br>";
	}
	else
	{
		$mail->Subject = "APR has been discontinued - HDR Murdoch University";
		$body = "<html><body><h2>Your APR has been continued. </h2>";
		$body .= "<br><font>Dear ".$student['firstname'].",</font>";
		$body .= "<br><p>We are sorry to inform you that dean <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just discontinued your APR.<br>You can log into the HDR system to view the detail.<br>Thank you for your cooperation.<br><br>";
	}
	$body .= "Yours sincerely,<br>";
	$body .= "Graduate Research Office<br>";
	$body .= "Murdoch University</p>";
	$body .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";
	$mail->MsgHTML($body);
	
	if(!$mail->Send()) {
	  echo 'Message was not sent.';
	  echo 'Mailer error: ' . $mail->ErrorInfo;
	} 
	unset($_SESSION['apr_c'],$_SESSION['apr_b'],$_SESSION['apr_a']);
}
session_commit();
?>
<div class="formflow_h"  style="width:80%;">
  <div class="container1">
    <div class="text"> APR has been submitted successfully. </div>
  </div>
  <p class="buttons"> <a href="dean_APR.php">Back to APR List</a> </p>
</div>