<?php
include "library.php";
session_start();
if(isset($_SESSION['ml']))
{
	if(isset($_SESSION['ml']['confirmation_status'])&&$_SESSION['ml']['confirmation_status']!='rejected')
	{
		unset($_SESSION['ml']);
		unset($ml);
	}
    else {
        $ml = $_SESSION['ml'];
        $isResubmit = True;
    }
}

if(isset($_POST['param']))
{
    $date = $_POST['date'];
    $ctime = $_POST['ctime'];
    $atime = $_POST['atime'];
    $location = $_POST['location'];
    $minutes = $_POST['minutes'];
    $attendees = $stud['App_NO'];
    $others = $_POST['others'];

    $duration = strtotime($date.' '.$atime) - strtotime($date.' '.$ctime);

    if(isset($_POST['psup'])) 
    {
        $attendees .= ','.$stud['p_supervisor']; 
    }

    if (isset($_POST['csup']))
    {
        $attendees .= ','.$stud['c_supervisor']; 
    }

    if($others != '') {
        $attendees .= ','.rtrim($others, ',');
    }

    if($isResubmit) 
    {
        $meeting_query = "UPDATE mls_meeting SET date = '$date', location = '$location', commenced_time = '$ctime', adjourned_time = '$atime', meeting_minutes = '$minutes', attendees = '$attendees', confirmation_status = 'pending', duration= '$duration' WHERE meeting_id = ".$ml['meeting_id'].";";
        unset($_SESSION['ml']);
        session_commit();
    }
    else
    {
        $meeting_query = "INSERT INTO mls_meeting VALUES(NULL,'$date', '$location', '$ctime', '$atime', '$minutes', '$attendees', 'pending', '', 0, 'candidate', '', $duration);";
    }

    $meeting_result = mysqli_query($con, $meeting_query) or die(mysqli_error($con));

    if ($meeting_result)
    {
        if(!$isResubmit) {
            $new_meeting_id =  mysqli_insert_id($con);
            $a_ids = explode(',', $attendees);
            foreach($a_ids as $index=>$a_id)
            {
                $attendee_type = 'supervisor';
                if ($index == 0)
                {
                    $attendee_type = 'candidate';
                }
                $attendee_query = "INSERT INTO mls_attendee VALUES($new_meeting_id, $a_id, '$attendee_type')";
                mysqli_query($con, $attendee_query) or die(mysql_error($con));
             }
        }
        header('Location:student_index3.php?cont=MLS&act=submit&page=confirm');
    }
    session_commit();
}
?>
<?php
if(isset($_GET['page']) && $_GET['page']=='confirm')
{
    include "confirm_ml_submission.php";
}
else 
{
    include "mls_detail3.php";
}
?>
