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
	//force to go to previous page if mandatory field is not set first
	$eoi_id=$_SESSION['eoi_id'];
	$emailadd=$_SESSION['emailadd'];
	$fullname=$_SESSION['fullname'];
	date_default_timezone_set('Asia/Singapore'); // set to singapore time
	$date= date("d-m-Y H:i:s");
	
	
    $mail = new PHPMailer();

    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->SMTPAuth   = true; // SMTP authentication
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com"; // SMTP server
    $mail->Port       = 465; // SMTP Port
    $mail->Username   = "testergro333@gmail.com"; // SMTP account username
    $mail->Password   = "monkeyface12345";        // SMTP account password

    $mail->SetFrom('testergro333@gmail.com', 'Graduate Research Office'); 
	// sent from this address
	
	//$mail->AddReplyTo('dogpoo1989@gmail.com', 'okok'); // Reply TO

    $mail->AddAddress('bsfan89@hotmail.com'); // ADR email
	
	//if there is a need to add CC
	//$mail->AddCC('person1@domain.com', 'Person One');

    $mail->Subject    = "Application for Higher Degree of Research at Murdoch University"; // email subject
	
	$body = "<html><body><h2>Supervisor Matched for Expression Of Interest (EOI)</h2>";
	$body .= "<br>Dear School Dean,";
	$body .= "<br><p>This email is to inform you that the following Academic Staff(s) has/have been identified as available supervisor for prospect HDR student, ".$fullname." with the EOI ID".$eoi_id."<br><br>";
	$body .= "";
	$body .= "<br><br>Please vet through the document and provide an outcome. <br><br>";
	
	$body .= "Yours sincerely,<br>";
	$body .= "Graduate Research Office<br>";
	$body .= "Murdoch University</p>";
	$body .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

	$mail->MsgHTML($body);

    if(!$mail->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
		session_start();
		unset($_SESSION);
		session_destroy();
		session_write_close();
      include 'Thankyou.php';
	header( "refresh:5;url=Login Page.php" );
	die;
	exit;
	}
	

?>