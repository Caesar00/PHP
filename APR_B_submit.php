<?php
session_start();
if(!isset($_SESSION) || !isset($_SESSION['status']))
    header("Location: staff_login.php");
else if($_SESSION['status']!="Sup")
    header("Location: 403error.php");
if(isset($_SESSION['apr_b']))
{
	$apr_b = $_SESSION['apr_b'];
	$apr_no = $_SESSION['apr_a']['APR_NO'];
}
$query = "UPDATE apr_a SET status = 'supervisor submitted' WHERE APR_NO = $apr_b[APR_NO]";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$insQuery = "INSERT INTO apr_b VALUES('$apr_no','$_SESSION[staff_id]',";
$values=array($apr_b['progressRate'],$apr_b['informGRO'],$apr_b['submissionDetail'],$apr_b['lateSubmits'],$apr_b['avoidContact'],$apr_b['supChanged'],$apr_b['lowInterest'],$apr_b['comment1'],$apr_b['milestoneComp'],$apr_b['sufficientDetail'],$apr_b['paperProduce'],$apr_b['draftStandard'],$apr_b['comment2'],$apr_b['studLeave'],$apr_b['overall'],$apr_b['altSupArea'],$apr_b['discontinueStatement']);
foreach($values as $value)
{
	$insQuery.="'$value',";
}
$insQuery.="now())";
$result = mysqli_query($con, $insQuery) or die(mysqli_error($con));
if($result)
{
	require("class.phpmailer.php");
	$systememail = "crsolutions333@gmail.com";	//system email address
	$systempassword = "CrS_333++";
	
	$staff_id=$_SESSION['staff_id'];
	$result = mysqli_query($con,"SELECT * FROM staff_account WHERE S_No = $staff_id") or die (mysqli_error($con));
	$user = mysqli_fetch_array($result);
	$query="SELECT staff_account.firstname as firstname, staff_account.surname as surname, staff_account.email as email FROM staff_account, supervisor, school WHERE supervisor.Sup_NO = $staff_id AND school.Sc_NO = supervisor.Sc_NO AND staff_account.S_NO = school.dean;";
	$result=mysqli_query($con,$query) or die(mysqli_error($con));
	if($result)
	{
		$dean=mysqli_fetch_array($result);
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
	
	
	$mail->AddAddress($dean['email'],$dean['firstname'].' '.$dean['surname']); // recipient email
	
	//if there is a need to add CC
	//$mail->AddCC('person1@domain.com', 'Person One');
	
	$mail->Subject = "New APR received from supervisor - HDR Murdoch University"; // email subject
	
	$body = "<html><body><h2>New APR received from a Supervisor </h2>";
	$body .= "<br><font>Dear ".$dean['firstname'].",</font>";
	$body .= "<br><p>We are glad to inform you that supervisor <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just submitted an APR.<br>Would you please login to Muroch HDR System and process the APR.<br>Thank you for your cooperation.<br><br>";
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
		$body .= "<br><p>We are glad to inform you that supervisor <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just accepted and continued your APR.<br>You can log into the HDR system to view the detail.<br>Thank you for your cooperation.<br><br>";
	}
	else
	{
		$mail->Subject = "APR has been discontinued - HDR Murdoch University";
		$body = "<html><body><h2>Your APR has been continued. </h2>";
		$body .= "<br><font>Dear ".$student['firstname'].",</font>";
		$body .= "<br><p>We are sorry to inform you that supervisor <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just discontinued your APR.<br>You can log into the HDR system to view the detail.<br>Thank you for your cooperation.<br><br>";
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
	// unset($_SESSION['apr_b'],$_SESSION['apr_a']);
}
session_commit();
?>

<div class="formflow_b" style="width:80%">
  <table cellspacing="3" cellpadding="4" style="width:100%" >
    <tr>
      <td class="unselected">Student Progress ></td>
      <td class="unselected">Recommendations ></td>
      <td>Submission ></td>
    </tr>
  </table>
</div>
<div class="formflow_h"  style="width:80%;">
<div class="container1">
    <div class="text"> APR has been submitted successfully. </div>
  </div>
  <p class="buttons"> <a href="staff_APR.php">Back to APR List</a> </p>
</div>
