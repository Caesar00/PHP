<?php
    require("class.phpmailer.php");
	session_start();
	include_once 'connection.php';
	$systememail = "crsolutions333@gmail.com";	//system email address
	//$systememail = "testergro2013ict333@gmail.com";	//system email address
	$systempassword = "CrS_333++";
	$SDemail = "hdrschooldean@gmail.com";		//sd email address
	$ADRemail = "hdrassociatedeanresearch@gmail.com"; //adr email address
	
	
	//force to go to previous page if mandatory field is not set first
	if(!isset($_SESSION['eoiid']))
	{
	header("Location: GRO_ListOfEOI.php");
	}
	$eoi_id=$_SESSION['eoiid'];
	$student_fullname=$_SESSION['student_fullname'];
	$student_email=$_SESSION['student_email'];
	
	
	$mail3 = new PHPMailer();

    $mail3->IsSMTP();  // telling the class to use SMTP
    $mail3->SMTPAuth   = true; // SMTP authentication
    $mail3->SMTPSecure = "ssl";
    $mail3->Host       = "smtp.gmail.com"; // SMTP server
    $mail3->Port       = 465; // SMTP Port
    $mail3->Username   = $systememail; // SMTP account username
    $mail3->Password   = $systempassword;        // SMTP account password

    $mail3->SetFrom($systememail, 'Graduate Research Office'); 
	// sent from this address
	
	//$mail->AddReplyTo('dogpoo1989@gmail.com', 'okok'); // Reply TO

	
	/*			to send email to school dean*/
	
	
    $mail3->AddAddress($student_email, $student_fullname ); // student email
	
	//if there is a need to add CC
	//$mail->AddCC('person1@domain.com', 'Person One');

    $mail3->Subject    = "Result for Supervisor Identification in your EOI Application"; // email subject
	
	$body3 = "<html><body><h2 color='000000'>Result for Supervisor Identification in your EOI Application</h2>";
	$body3 .= "<br><font  color='000000'>Dear ".$student_fullname.",</font>";
	$body3 .= "<br><p color='000000'>This email is to inform you that your application is approved and is currently awaiting for available supervisor to supervise your research. <br><br>";
	
	
	$body3 .= "Yours sincerely,<br>";
	$body3 .= "Graduate Research Office<br>";
	$body3 .= "Murdoch University</p>";
	$body3 .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

	$mail3->MsgHTML($body3);

    if(!$mail3->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail3->ErrorInfo;
    }

	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	
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
	
	//$mail->AddReplyTo('dogpoo1989@gmail.com', 'okok'); // Reply TO

	
	/*			to send email to school dean*/
	
	
    $mail->AddAddress($SDemail, "School Dean" ); // SD email
	
	//if there is a need to add CC
	//$mail->AddCC('person1@domain.com', 'Person One');

    $mail->Subject    = "Application for Higher Degree of Research at Murdoch University"; // email subject
	
	$body = "<html><body><h2 color='000000'>Supervisor Matched for Expression Of Interest (EOI)</h2>";
	$body .= "<br><font  color='000000'>Dear School Dean,</font>";
	$body .= "<br><p color='000000'>This email is to inform you that the following Academic Staff(s) has/have been identified as available supervisor for prospect HDR student, ".$student_fullname." with the EOI ID ".$eoi_id."<br><br>";
	
	//extract all the selected supervisor
	$sup_matched = "SELECT * FROM supervisor INNER JOIN staff_account ON staff_account.S_No=supervisor.Sup_No WHERE Sup_No='$_SESSION[sup_matched1]' or Sup_No='$_SESSION[sup_matched2]' or Sup_No ='$_SESSION[sup_matched3]' ";
	$sup_matched_res= mysqli_query($con,$sup_matched) or die (mysqli_error($con));
	while ($supermatched = mysqli_fetch_array($sup_matched_res))
	{
		$body .= " - ".$supermatched['salutation']." ".$supermatched['firstname']." ".$supermatched['lastname']."<br>";
	}
	
	$body .= "<br>Please vet through the document and provide an outcome. <br><br>";
	
	$body .= "Yours sincerely,<br>";
	$body .= "Graduate Research Office<br>";
	$body .= "Murdoch University</p>";
	$body .= "<p><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

	$mail->MsgHTML($body);

    if(!$mail->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    }
	
	/*			to send email to Associate Dean of Research				*/
	$mail2 = new PHPMailer();

    $mail2->IsSMTP();  // telling the class to use SMTP
    $mail2->SMTPAuth   = true; // SMTP authentication
    $mail2->SMTPSecure = "ssl";
    $mail2->Host       = "smtp.gmail.com"; // SMTP server
    $mail2->Port       = 465; // SMTP Port
    $mail2->Username   = $systememail; // SMTP account username
    $mail2->Password   = $systempassword;        // SMTP account password

    $mail2->SetFrom($systememail, 'Graduate Research Office'); 
	
	$mail2->AddAddress($ADRemail, "Associate Dean of Research" ); // ADR email
    $mail2->Subject    = "Application for Higher Degree of Research at Murdoch University"; // email subject
	
	$body2 = "<html><body><h2 color='000000'>Supervisor Matched for Expression Of Interest (EOI)</h2>";
	$body2 .= "<br>Dear Associate Dean of Research,";
	$body2 .= "<br><p color='000000'>This email is to inform you that the following Academic Staff(s) has/have been identified as available supervisor for prospect HDR student, ".$student_fullname." with the EOI ID".$eoi_id."<br><br>";
	
	//extract all the selected supervisor
	$sup_matched = "SELECT * FROM supervisor INNER JOIN staff_account ON staff_account.S_No=supervisor.Sup_No WHERE Sup_No='$_SESSION[sup_matched1]' or Sup_No='$_SESSION[sup_matched2]' or Sup_No ='$_SESSION[sup_matched3]' ";
	$sup_matched_res= mysqli_query($con,$sup_matched) or die (mysqli_error($con));
	while ($supermatched = mysqli_fetch_array($sup_matched_res))
	{
		$body2 .= " - ".$supermatched['salutation']." ".$supermatched['firstname']." ".$supermatched['lastname']."<br>";
	}
	
	$body2 .= "<br>Please vet through the document and provide an outcome. <br><br>";
	
	$body2 .= "Yours sincerely,<br>";
	$body2 .= "Graduate Research Office<br>";
	$body2 .= "Murdoch University</p>";
	$body2 .= "<p color='000000'><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";

	$mail2->MsgHTML($body2);

    if(!$mail2->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail2->ErrorInfo;
    }



	/*		this portion is to send email to all sup*/
	//this will loop all the selected eoi base on the number of results shown
	$selectemail_query = "SELECT DISTINCT * FROM supervisor INNER JOIN staff_account ON staff_account.S_No=supervisor.Sup_No WHERE  ";
	for($i=1 ;$i <= $_SESSION['supcount']; $i++)
	{
		$selectemail_query .="Sup_No ='".$_SESSION['sup_matched'.$i]."' ";
		if($i < $_SESSION['supcount'])
		{
			$selectemail_query .="OR ";
		}
	}
	
	$selectemail = mysqli_query($con,$selectemail_query) or die (mysqli_error($con));
	
	while ($selectemail_res = mysqli_fetch_array($selectemail)) 
	{
		$supersalu= $selectemail_res['salutation'];
		$superfirstname= $selectemail_res['firstname'];
		$superlastname= $selectemail_res['lastname'];	
		$superemail= $selectemail_res['email'];
		$superfullname = ($superfirstname)." ".($superlastname);
		
		$mail = new PHPMailer();
		
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->SMTPAuth   = true; // SMTP authentication
		$mail->SMTPSecure = "ssl";
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->Port       = 465; // SMTP Port
		$mail->Username   = $systememail; // SMTP account username
		$mail->Password   = $systempassword;        // SMTP account password

		$mail->SetFrom($systememail, 'Graduate Research Office'); 
	
		$mail->AddAddress($superemail, $superfullname ); // supervisor email
		
		//if there is a need to add CC
		//$mail->AddCC('person1@domain.com', 'Person One');

		$mail->Subject    = "Supervision Appointment for the coming PhD Research Project"; // email subject
		
		$body= "<html><body><h2 color='000000'>Supervisor Matched for Expression Of Interest (EOI)</h2>";
		$body .= "<br color='000000'>Dear ".($supersalu)." ".($superfullname).",";
		$body .= "<br><p color='000000'>Based on your Field of Research and Research Keyword, a new applicant has been identified. Please sign in to HDR Supervisor Register System to review the application. <br><br>";
		
		$body .= "Yours sincerely,<br>";
		$body .= "Graduate Research Office<br>";
		$body .= "Murdoch University</p>";
		$body .= "<p color='000000'><em>*This is computer-generated message. Please do not reply to this e-mail</em></p><br><br></body></html>";
		
		$mail->MsgHTML($body);
		if(!$mail->Send()) 
		{
			echo 'Message was not sent.';
			echo 'Mailer error: ' . $mail->ErrorInfo;
		} 
	}
	
	
?>
<?php //coding is credited by Chen Jia Wei & Wong Hui Bing ?>