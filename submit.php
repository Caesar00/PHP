<!-- email submission when button pressed. 
<form action="" method="post">
    <input type="submit" value="Submit" />
</form>
-->

<?php
    require("class.phpmailer.php");
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
	$emailadd=$_SESSION['emailadd'];
	$firstname=$_SESSION['firstname'];
	$lastname=$_SESSION['lastname'];
	$fullname = $firstname." ".$lastname; 
	date_default_timezone_set('Asia/Singapore'); // set to singapore time
	$date= date("d-m-Y H:i:s");
	$eoi_id=$_SESSION['eoi_id'];
	
	
    $mail = new PHPMailer();

    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->SMTPAuth   = true; // SMTP authentication
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com"; // SMTP server
    $mail->Port       = 465; // SMTP Port
    $mail->Username   = "crsolutions333@gmail.com"; // SMTP account username
    $mail->Password   = "CrS_333++";        // SMTP account password

    $mail->SetFrom('crsolution333@gmail.com', 'Graduate Research Office'); // FROM
    //$mail->AddReplyTo('dogpoo1989@gmail.com', 'okok'); // Reply TO

    $mail->AddAddress($emailadd,$firstname); // recipient email

    $mail->Subject    = "Meeting Log Notification from Higher Degree of Research at Murdoch University"; // email subject
	
	$mail->Body       .= "<html><body>Dear ".$fullname.",<br><br>";
    $mail->Body       .= "Thank you for applying with Murdoch University. Your application number is ".$eoi_id.". We are glad to inform you that your application has been received on ".$date.". The outcome of the application will be sent to you within a month. ";
	$mail->Body       .= "<br><br>Regards,<br><br>";
	$mail->Body       .= "<br><br>Graduate Research Office<br><br>";
	$mail->Body       .= "<br><br>Murdoch University<br><br>";
	$mail->Body       .= "<br><br>This is computer-generated message. Please do not reply to this e-mail<br><br></body></html>";

    if(!$mail->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message has been sent.';
	  //include page that redirects into thankyou for applicaton.
	  echo "Page will be redirected in 5 seconds.";
	header( "refresh:10;url=logout.php" );
    }


?>
