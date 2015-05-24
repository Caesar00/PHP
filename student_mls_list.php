<?php
    session_start();
    $id = $user['App_NO'];
    $query = "SELECT meeting_id,date,location,confirmation_status FROM mls_meeting WHERE meeting_id in (SELECT meeting_id FROM mls_attendee WHERE attendee_type = 'candidate' AND account_id = $id)";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $ml_exist = mysqli_num_rows($result) > 0;
    if($ml_exist)
    {
        while($row = mysqli_fetch_array($result))
        {
            $mls[] = $row;
        }
    }
    if(isset($_POST['param']))
    {
        // fectch selected meeting details
        $meeting_id = $_POST['param'];
        $meeting_query = "SELECT * FROM mls_meeting WHERE meeting_id = $meeting_id";
        $meeting_result = mysqli_query($con,$meeting_query) or die(mysqli_error($con));

        if(mysqli_num_rows($meeting_result)==1)
        {
            $ml = mysqli_fetch_array($meeting_result);
            $_SESSION['ml'] = $ml;
        }
        // fetch selected meeting attendees who are supervisors
        $sups_query = "SELECT S_NO, type, salutation, firstname, surname, email FROM staff_account WHERE S_NO IN (SELECT account_id FROM mls_attendee WHERE attendee_type = 'supervisor' AND meeting_id = $meeting_id)";
        $sups_result = mysqli_query($con,$sups_query) or die(mysqli_error($con));
        while ($sup = mysqli_fetch_assoc($sups_result)) {
            $sups[] = $sup;
        }
        $_SESSION['sups'] = $sups;
        session_commit();
        header("Location: student_index.php?cont=MLS&act=view");
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
<div class="title"> Your Meeting Logs </div>
<div class="content">
<div style="width:80%;">
<?php
if($ml_exist)
{
	echo("
<table cellspacing='3' cellpadding='5' class='list' style='width:100%;'>
  <tr class='dark'>
    <td>Meeting ID</td>
    <td>Date</td>
    <td>Location</td>
    <td>Confirmation Status</td>
    <td>&nbsp;</td>
  </tr>");

	foreach($mls as $ml)
	{
		echo '<tr class="light">';
		echo '<td>'.$ml['meeting_id'].'</td>';
		echo '<td>'.$ml['date'].'</td>';
		echo "<td><a href=http://maps.murdoch.edu.au/location/14601014 target=\"_blank\">".$ml['location']."</a></td>";
		// echo "<td><a href=http://maps.murdoch.edu.au/call/autocomplete/?term=".$ml['location'].">".$ml['location']."</a></td>";
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
