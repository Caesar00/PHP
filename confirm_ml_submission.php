<?php
require("class.phpmailer.php");
$systememail = "crsolutions333@gmail.com";	//system email address
$systempassword = "CrS_333++";

$query="SELECT email,firstname FROM staff_account WHERE S_NO = $user[p_supervisor] OR S_NO = $user[c_supervisor];";
$result=mysqli_query($con,$query) or mysqli_error($con);
while($row = mysqli_fetch_array($result))
{
    $sups[] = $row;
}
if($result)$supervisor=mysqli_fetch_array($result);
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

foreach($sups as $sup) 
{
    $mail->AddAddress($sup['email'],$sup['firstname']); // recipient email
}

//if there is a need to add CC
//$mail->AddCC('person1@domain.com', 'Person One');

$mail->Subject = "New Meeting Log received from student - HDR Murdoch University"; // email subject

$body = "<html><body><h2 color='000000'>New Meeting Log received from a student under your supervision </h2>";
$body .= "<br><font  color='000000'>Dear supervisors of ".$user['firstname']." ".$user['surname'].",</font>";
$body .= "<br><p color='000000'>We are glad to inform you that student <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just submitted a meeting log.<br>Would you please login to the Murdoch HDR System and process the meeting log.<br>Thank you for your cooperation.<br><br>";
$body .= "Yours sincerely,<br>";
$body .= "Graduate Research Office<br>";
$body .= "Murdoch University</p>";
$body .= "<p color='000000'><em>*This is a computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

$mail->MsgHTML($body);

if(!$mail->Send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} 
?>
<div class="row text-center">
    <div class="col-md-offset-3 col-md-6">
        <h4 class="well">
            Your supervisors have been notified.<br/>Thank you.
        </h4>
        <p><a class="btn btn-success btn-block" href="student_index3.php?cont=MLS">OK</a></p>
    </div>
    </div>
</div>
