<?php
    require("class.phpmailer.php");
	session_start();
	include 'connection.php';
	//force to go to previous page if mandatory field is not set first
	$eoi_id=$_SESSION['eoiid'];
	$fullname=$_SESSION['fullname'];
	
	
    //$mail = new PHPMailer();
/*
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
*/	
	//if there is a need to add CC
	//$mail->AddCC('person1@domain.com', 'Person One');
	$mail2 = clone $mail;
    $mail2->Subject    = "Application for Higher Degree of Research at Murdoch University"; // email subject
	
	$body2 = "<html><body><h2>Supervisor Matched for Expression Of Interest (EOI)</h2>";
	$body2 .= "<br>Dear Associate Dean of Research,";
	$body2 .= "<br><p>This email is to inform you that the following Academic Staff(s) has/have been identified as available supervisor for prospect HDR student, ".$fullname." with the EOI ID".$eoi_id."<br><br>";
	
	//extract all the selected supervisor
	$sup_matched = "SELECT * FROM academic_staff WHERE staff_id='$_SESSION[sup_matched1]' or staff_id='$_SESSION[sup_matched2]' or staff_id ='$_SESSION[sup_matched3]' ";
	$sup_matched_res= mysql_query($sup_matched) or die (mysql_error());
	while ($supermatched = mysql_fetch_array($sup_matched_res))
	{
		$body2 .= " - ".$supermatched['salutation'].$supermatched['firstname']." ".$supermatched['lastname']."<br>";
	}
	
	$body2 .= "<br>Please vet through the document and provide an outcome. <br><br>";
	
	$body2 .= "Yours sincerely,<br>";
	$body2 .= "Graduate Research Office<br>";
	$body2 .= "Murdoch University</p>";
	$body2 .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

	$mail2->MsgHTML($body2);

    if(!$mail2->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail2->ErrorInfo;
    } 
	

?>