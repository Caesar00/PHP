<?php
session_start();
require("class.phpmailer.php");
$systememail = "crsolutions333@gmail.com";	//system email address
$systempassword = "CrS_333++";

$new_id = $_SESSION['new_id'];
$query="SELECT S_NO, email, CONCAT_WS(' ', salutation, firstname, surname) AS 'name' FROM staff_account WHERE S_NO in (SELECT account_id from mls_attendee where attendee_type = 'supervisor' and account_id <> '$staff_id' and meeting_id ='$new_id');";
$result=mysqli_query($con,$query) or mysqli_error($con);
$sup_exist = mysqli_num_rows($result) > 0;
if($sup_exist) 
{
    while($row = mysqli_fetch_array($result))
    {
        $sups[] = $row;
    }
}
foreach($sups as $sup) 
{
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

    $mail->AddAddress($sup['email'],$sup['name']); // recipient email

    //if there is a need to add CC
    //$mail->AddCC('person1@domain.com', 'Person One');

    $mail->Subject = "New Panel Meeting Log Created - HDR Murdoch University"; // email subject

    $body = "<html><body><h2 color='000000'>New Panel Meeting Log #$new_id Has Been Created.</h2>";
    $body .= "<br><font  color='000000'>Dear ".$sup['name'].",</font>";
    $body .= "<br><p color='000000'>We are glad to inform you that a panel meeting you attended has been created.<br>Please login to the Murdoch HDR System and view the meeting log.<br>Thank you for your cooperation.<br><br>";
    $body .= "Yours sincerely,<br>";
    $body .= "Graduate Research Office<br>";
    $body .= "Murdoch University</p>";
    $body .= "<p color='000000'><em>*This is a computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

    $mail->MsgHTML($body);

    if(!$mail->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    } 
}
?>
<div class="row text-center">
    <div class="col-md-offset-3 col-md-6">
        <h4 class="well">
            The attendees have been notified.<br/>Thank you.
        </h4>
        <p><a class="btn btn-success btn-block" href="staff_index3.php?cont=MLS">OK</a></p>
    </div>
    </div>
</div>
