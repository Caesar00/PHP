<?php
    require("class.phpmailer.php");
	session_start();
	$systememail = "crsolutions333@gmail.com";	//system email address
	$systempassword = "CrS_333++";
	
	if(($_SESSION['firstname']=="")||!isset($_SESSION['scholarqn1'])||!isset($_SESSION['eng'])){
	header("Location: EOI_Page1.php");}//force to go to previous page if mandatory field is not set first
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
    $mail->Username   = $systememail; // SMTP account username
    $mail->Password   = $systempassword;        // SMTP account password

    $mail->SetFrom($systememail, 'Graduate Research Office'); 
	// sent from this address
	

    $mail->AddAddress($emailadd,$firstname); // recipient email
	
	//if there is a need to add CC
	//$mail->AddCC('person1@domain.com', 'Person One');

    $mail->Subject    = "Application for Higher Degree of Research at Murdoch University"; // email subject
	
	$body = "<html><body><h2 color='000000'>Application for Higher Degree of Research at Murdoch University </h2>";
	$body .= "<br><font  color='000000'>Dear ".$fullname.",</font>";
	$body .= "<br><p color='000000'>Thank you for applying with Murdoch University.<br> Your Express of Interest(EOI) application number is <strong>".$eoi_id."</strong>. <br>We are glad to inform you that your application has been received on ".$date.". <br>The outcome of the application will be sent to you within a month. <br><br>";
	$body .= "Yours sincerely,<br>";
	$body .= "Graduate Research Office<br>";
	$body .= "Murdoch University</p>";
	$body .= "<p color='000000'><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

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