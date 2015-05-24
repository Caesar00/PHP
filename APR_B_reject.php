<?php
session_start();
if(!isset($_SESSION) || !isset($_SESSION['status']))
    header("Location: staff_login.php");
else if($_SESSION['status']!="Sup" && $_SESSION['status']!="Dean")
    header("Location: 403error.php");
if(isset($_SESSION['apr_a']))
{
	$apr_a = $_SESSION['apr_a'];
}
if (isset($_POST['param'])) 
{
    $rejected_comment = $_POST['text1'];
	$query = "UPDATE apr_a SET status = 'supervisor rejected', rejected_comment = '$rejected_comment' WHERE APR_NO = $apr_a[APR_NO];";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	if($result)
	{
		$submitted=true;
	}
	
	require("class.phpmailer.php");
	$systememail = "crsolutions333@gmail.com";	//system email address
	$systempassword = "CrS_333++";
	
	$staff_id=$_SESSION['staff_id'];
	$result = mysqli_query($con,"SELECT * FROM staff_account WHERE S_No = $staff_id") or die (mysqli_error($con));
	$user = mysqli_fetch_array($result);
	$std_no = $_SESSION['apr_a']['Std_NO'];
	$query="SELECT applicant.firstname as firstname, applicant.surname as surname, applicant.email as email FROM applicant,hdr_student WHERE Stud_NO = $std_no AND applicant.App_NO = hdr_student.App_NO;";
	$result=mysqli_query($con,$query) or die(mysqli_error($con));
	if($result)
	{
		$student=mysqli_fetch_array($result);
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
	
	$mail->AddAddress($student['email'],$student['firstname'].' '.$student['surname']); // recipient email

	$mail->Subject = "APR has been rejected - HDR Murdoch University";
	$body = "<html><body><h2>Your APR has been rejected. </h2>";
	$body .= "<br><font>Dear ".$student['firstname'].",</font>";
	$body .= "<br><p>We are sorry to inform you that supervisor <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just rejected your APR.<br>You can log into the HDR system to view the detail and resubmit your APR.<br>Thank you for your cooperation.<br><br>";
	$body .= "Yours sincerely,<br>";
	$body .= "Graduate Research Office<br>";
	$body .= "Murdoch University</p>";
	$body .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";
	
	$mail->MsgHTML($body);
	
	if(!$mail->Send()) {
	  echo 'Message was not sent.';
	  echo 'Mailer error: ' . $mail->ErrorInfo;
	}
}
?>
<script language="javascript" type="text/javascript">
function submitform1()
{
	if($("[name='text1']").val()=='')
	{
		$("#text1_w").show();
	}
	else
	{
		document.form1.param.value='ok';
		document.form1.submit();
	}
}
</script>

<div class="formflow_h" style="width:80%">
  <?php
if(!isset($submitted))
{
	?>
  <form name="form1" id="form1" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Please give your reason and comment about why you reject this APR, it will be sent to the student:</td>
      </tr>
      <tr>
        <td><p>
            <textarea name="text1" maxlength='2000' style="width: 99%; height: 200px;"></textarea>
          </p></td>
      </tr>
      <tr id="text1_w" class="none">
        <td><p class="warning">*Please give a reason</p></td>
      </tr>
    </table>
    <p class="buttons"><a href="#" onclick="submitform1()">OK</a>
      <input type="hidden" name="param" value=""/>
    </p>
  </form>
  <?php
}
else if($submitted)
{
?>
  <p>Comment has been sent.</p>
  <p class="buttons"><a href="staff_APR.php">OK</a></p>
  <?php
}
?>
</div>
