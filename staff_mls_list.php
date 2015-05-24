<?php
session_start();

// base query for listing out mls of current supervisor
$list_query = "SELECT * from mls_meeting WHERE meeting_id IN (SELECT meeting_id FROM mls_attendee WHERE account_id = $staff_id AND attendee_type = 'supervisor')";
if(isset($_GET['cont']))
{
    if ($_GET['cont'] == 'submitted') {
        $query = $list_query."AND confirmation_status = 'confirmed';";
    }
    else {
    $query = $list_query."AND confirmation_status <> 'confirmed';";
    }
}
else
{
    $query = $list_query.";";
}

$result = mysqli_query($con,$query) or die(mysqli_error($con));
$mls_exist = mysqli_num_rows($result) > 0;
if($mls_exist)
{
	while($row = mysqli_fetch_array($result))
	{
        $meeting_id = $row['meeting_id'];
        $query = "SELECT App_NO, applicant.firstname, applicant.surname, applicant.email FROM applicant, mls_attendee WHERE attendee_type = 'candidate' AND applicant.App_NO = mls_attendee.account_id AND meeting_id = $meeting_id;";
        $candidate_result = mysqli_query($con,$query) or die(mysqli_error($con));
        $candidate = mysqli_fetch_array($candidate_result);

        # save candiate full names
        $row['candidate'] = $candidate['firstname'].' '.$candidate["surname"];
        $row['candidate_email'] = $candidate['email'];
        $row['candidate_id'] = $candidate['App_NO'];
        $mls[$meeting_id] = $row;
	}
    $_SESSION['mls'] = $mls;
}

if(isset($_POST['param']))
{
    if(isset($_SESSION['ml']))unset($_SESSION['ml']);
    $meeting_id = $_POST['param'];
    $query = "SELECT * FROM mls_meeting WHERE meeting_id = $meeting_id";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    if(mysqli_num_rows($result)==1)
    {
        $ml = mysqli_fetch_array($result);
        $_SESSION['ml'] = $ml;
        session_commit();

        if(isset($_GET['cont'])&&$_GET['cont'] == "submitted")
        {
            if($_SESSION['status']=="Sup")
                header("Location: staff_MLS.php?cont=MLS&act=view");
            // else if($_SESSION['status']=="Dean")
                // header("Location: dean_MLS.php?cont=APR&act=view");
        }
        else
        {
            if($_SESSION['status']=="Sup")
                header("Location: staff_MLS.php?cont=MLS&act=submit");
            // else if($_SESSION['status']=="Dean")
                // header("Location: dean_APR.php?cont=APR&act=submit");
        }
    }
}
session_commit();
?>
    <script language="javascript" type='text/javascript'>
function submitform1(str)
{
	document.form1.param.value = str;
	document.form1.submit();
}
</script>
<div id="right_window" class="container2">
<div class="title"> Meeting Log List</div>
<div class="content">
<div class="formflow_h" style="width:80%;">
<?php
if($mls_exist)
{
	echo("
<table cellspacing='3' cellpadding='5' class='list' style='width:100%;'>
  <tr class='dark'>
    <td>Candidate</td>
    <td>Meeting Date</td>
    <td>Time</td>
    <td>Location</td>
    <td width='10%'>Confirmation Status</td>
    <td>&nbsp;</td>
  </tr>");

    foreach($mls as $ml)
    {
        echo '<tr class="light">';
        echo '<td>'.$ml['candidate'].'</td>';
        echo '<td>'.$ml['date'].'</td>';
        echo '<td>'.$ml['commenced_time'].' -  '.$ml['commenced_time'].'</td>';
        echo '<td>'.$ml['location'].'</td>';
        echo '<td>'.$ml['confirmation_status'].'</td>';
        echo '<td><a href="#" onclick="submitform1('.$ml['meeting_id'].')">Detail</a></td>';
        echo '</tr>';
    }
	echo '</table>';
}
else
{
	echo ('<p style="margin:20px">No Meeting Log.</p>');
}
?>
</div>
<form name="form1" method="post">
<input name="param" type="hidden" value="" />
</form>
</div>
<div style="height:1px"> </div>
</div>
