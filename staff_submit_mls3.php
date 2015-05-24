<?php
    include "library.php";
    session_start();
    if(isset($_POST['param_new']))
    {
        $date = $_POST['date'];
        $ctime = $_POST['ctime'];
        $atime = $_POST['atime'];
        $location = $_POST['location'];
        $minutes = $_POST['minutes'];
        $attendees  = $staff_id;
        if(isset($_POST['staffs']))
        {
            foreach($_POST['staffs'] as $staff) 
            {
                $attendees .= ','.$staff;
            }
        }
        $duration = strtotime($date.' '.$atime) - strtotime($date.' '.$ctime);
        $meeting_query = "INSERT INTO mls_meeting VALUES(NULL,'$date', '$location', '$ctime', '$atime', '$minutes', '$attendees', 'confirmed', '', 0, 'panel', '', $duration);";
        $meeting_result = mysqli_query($con, $meeting_query) or die(mysqli_error($con));

        if ($meeting_result)
        {
            $new_meeting_id = mysqli_insert_id($con);
            $s_ids = explode(',', $attendees);
            foreach($s_ids as $index=>$s_id)
            {
                $attendee_type = 'supervisor';
                $attendee_query = "INSERT INTO mls_attendee VALUES($new_meeting_id, $s_id, '$attendee_type')";
                mysqli_query($con, $attendee_query) or die(mysql_error($con));
                echo "<pre>$attendee_query</pre>";
            }
            $_SESSION['new_id'] = $new_meeting_id;
            session_commit();
        }
        header('Location:staff_index3.php?cont=MLS&act=submit&page=confirm_new');
    }
    session_commit();
?>
<?php
    if(isset($_GET['page']))
    {
        if($_GET['page']=='pre_time')
        {
            include "MLS_confirm3.php";
        }
        elseif($_GET['page']=='confirm_new') 
        {
            include "confirm_panel_ml_submission.php";
        }
        elseif($_GET['page']=='new') 
        {
            include "mls_panel_detail3.php";
        }
        elseif($_GET['page']=='reject_comments')
        {
            include "MLS_reject3.php";
        }
        else {
            include "MLS_submit3.php";
        }
    }
    else
    {
        include "view_ml3.php";
    }
    session_commit();
?>
