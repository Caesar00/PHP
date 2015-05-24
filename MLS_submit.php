<?php
    session_start();
    if(!isset($_SESSION) || !isset($_SESSION['status']))
        header("Location: staff_login.php");
    else if($_SESSION['status']!="Sup")
        header("Location: 403error.php");

    if(isset($_SESSION['ml']))
    {
        $ml = $_SESSION['ml'];
        $meeting_id = $ml['meeting_id'];
        $mls = $_SESSION['mls'];
    }
    $cstatus = "pending";
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
        if($page =='confirm')
        {
            $cstatus = 'confirmed';
        }
        elseif ($page == 'reject')
        {
            $cstatus = 'rejected';
        }
        else {
            break;
        }
    }
    $comments = '';
    if (isset($_POST['comments'])) {
        $comments = $_POST['comments'];
    }
    $ptime = 0;
    if (isset($_POST['ptime'])) {
        $ptime = $_POST['ptime'];
    }
    $query = "UPDATE mls_meeting SET confirmation_status = '$cstatus', comments = '$comments', preparation_time = '$ptime' WHERE meeting_id = $meeting_id";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
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
        
        //send email to the student
        $std_no = $mls[$meeting_id]['candidate_id'];
        $query="SELECT applicant.firstname as firstname, applicant.surname as surname, applicant.email FROM applicant,hdr_student WHERE Stud_NO = $std_no AND applicant.App_NO = hdr_student.App_NO;";

        $result=mysqli_query($con,$query) or die(mysqli_error($con));
        if($result)
        {
            $student=mysqli_fetch_array($result);
        }
        $mail->ClearAddresses();
        $mail->AddAddress($student['email'],$student['firstname'].' '.$student['surname']);
        // if(!isset($ml['reject_comment']) || $ml['reject_comment']=='')
        if($cstatus=='confirmed')
        {
            $mail->Subject = "Your new meeting log has been confirmed - HDR Murdoch University";
            $body = "<html><body><h2>Your new meeting log has been confirmed. </h2>";
            $body .= "<br><font>Dear ".$student['firstname'].",</font>";
            $body .= "<br><p>We are glad to inform you that supervisor <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just confirmed one of the meeting log.<br>You can log into the HDR system to view the detail.<br>Thank you for your cooperation.<br><br>";
        }
        else
        {
            $mail->Subject = "Your new meeting log has been rejected - HDR Murdoch University";
            $body = "<html><body><h2>Your Meeting Log has been rejected. </h2>";
            $body .= "<br><font>Dear ".$student['firstname'].",</font>";
            $body .= "<br><p>We are sorry to inform you that supervisor <strong>".$user['salutation']." ".$user['firstname']." ".$user['surname']."</strong> has just rejected one of your meeting log.<br>You can log into the HDR system to view the detail.<br>Thank you for your cooperation.<br><br>";
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
    }
    session_commit();
?>
<div class="formflow_h"  style="width:80%;">
<div class="container1">
    <div class="text"> Meeting Log has been updated successfully. </div>
  </div>
  <p class="buttons"> <a href="staff_MLS.php">Back to Meeting Logs</a> </p>
</div>
