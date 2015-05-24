<?php
    require("class.phpmailer.php");
	session_start();
	include 'connection.php';
	$systememail = "crsolutions333@gmail.com";	//system email address
	$systempassword = "CrS_333++";
	
	if(!isset($_SESSION['eoiid'])){
	header("Location: GRO_ViewEOI.php");}
	
	$eoi_id=$_SESSION['eoiid'];
	$status_rej_query="UPDATE eoi SET status='REJECTED' WHERE eoi_No='$eoi_id'";
	$uploadrej = mysqli_query($con,$status_rej_query) or die (mysql_error($con));
	
	
	$eoiquery ="SELECT * FROM eoi WHERE eoi_id ='$eoi_id'";
	$result =mysqli_query($con,$eoiquery) or die(mysql_error($con));
	while($row = mysqli_fetch_array($result))
	{ 
		$email=$row['email'];
		$firstname=$row['student_firstname'];
		$lastname=$row['student_lastname'];
	}
	$fullname = $firstname." ".$lastname; 
	date_default_timezone_set('Australia/Perth'); // set to Perth time
	$date= date("d-m-Y H:i:s");
	
	
    $mail = new PHPMailer();

    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->SMTPAuth   = true; // SMTP authentication
    $mail->SMTPSecure = "ssl";
    $mail->Host       = "smtp.gmail.com"; // SMTP server
    $mail->Port       = 465; // SMTP Port
    $mail->Username   = $systememail; // SMTP account username
    $mail->Password   = $systempassword;        // SMTP account password

    $mail->SetFrom($systememail, 'Graduate Research Office'); // FROM
    //$mail->AddReplyTo('dogpoo1989@gmail.com', 'okok'); // Reply TO

    $mail->AddAddress($email,$firstname); // recipient email

    $mail->Subject    = "Application for Higher Degree of Research at Murdoch University"; // email subject
	
	$body = "<html><body><h2>Application for Higher Degree of Research at Murdoch University </h2><br>Dear ".$fullname.",<br>";
	$body .= "<p>We would like to thank you for your interest in Murdoch University. While your education qualifications are very impressive, we are unable to accept your application for Higher Degree Research at Murdoch University. <br>On behalf of Murdoch University, I thank you for your time, interest and effort. <br><br>";
	$body .= "Yours sincerely,<br>";
	$body .= "Graduate Research Office<br>";
	$body .= "Murdoch University</p>";
	$body .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

	$mail->MsgHTML($body);

    if(!$mail->Send()) {
		$_SESSION['mail'] = 'Mailer error: ' . $mail->ErrorInfo;
		header( "Location: GRO_ListOfEOI.php" );
    } else {
		unset($_SESSION['eoiid']);
		unset($_SESSION['groreason']);
		header( "Location: GRO_ListOfEOI.php" );
    }


?>