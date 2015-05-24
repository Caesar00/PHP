<?php
    session_start();
    $id = $user['App_NO'];
    $query = "SELECT meeting_id,date,location,confirmation_status, duration, comments FROM mls_meeting WHERE meeting_id in (SELECT meeting_id FROM mls_attendee WHERE attendee_type = 'candidate' AND account_id = $id)";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $ml_exist = mysqli_num_rows($result) > 0;
    if(isset($_SESSION['ml'])) {
        unset($_SESSION['ml']);
        session_commit();
    }
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
        header("Location: student_index3.php?cont=MLS&act=view");
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
<div class="row" style="margin-bottom:25px;">
    <div class="col-xs-6 col-sm-6">
        <form class="horizontal-form" action="student_index3.php?cont=MLS&act=search" method="post">
            <div class="input-group">
                <input id="q" name="q" class="form-control" type="text">
                <div class="input-group-addon">
                    <button type="submit" class="btn btn-block btn-default" value="Search">
                        <i class="fa fa-search fa-lg"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="param" />
        </form>
    </div>
    <div class="col-xs-6 col-sm-6">
        <div class="input-group pull-right">
            <a href="student_index3.php?cont=MLS&act=submit" class="btn btn-primary btn-lg">
                <i class="fa fa-plus-circle"><span class="hidden-xs"> New</span></i>
            </a>&nbsp;
            <a href="student_index3.php?cont=MLS&act=report" class="btn btn-primary btn-lg dropdown-toggle">
                <i class="fa fa-pie-chart"><span class="hidden-xs"> Report</span></i>
            </a>
        </div>
    </div>
</div>
<?php
if($ml_exist)
{
	echo("
        <table class='table table-hover'>
        <thead>
            <th>
                <td>Date</td>
                <td>Location</td>
                <td>Status</td>
                <td class='text-right'>Detail</td>
            </th>
        </thead>
        <tbody>
        ");

	foreach($mls as $ml)
	{
		echo '<tr class="lead">
                <td>'.$ml['meeting_id'].'</td>
                <td>'.$ml['date'].'</td>
                <td><i class="fa fa-map-marker fa-fw fa-lg"></i> '.$ml['location'].'</td>';

        $status_icon = "";
        if ($ml['confirmation_status'] == 'confirmed') {
            $status_color = 'text-success';
            $status_icon = 'fa fa-check-circle-o fa-fw fa-lg';
        }
        elseif ($ml['confirmation_status'] == 'rejected') {
            $status_color = 'text-danger';
            $status_icon = 'fa fa-minus-circle fa-fw fa-lg';
        }
        else {
            $status_color = 'text-default';
            $status_icon = 'fa fa-spinner fa-spin fa-fw fa-lg';
        }
        echo '<td><i class="'.$status_icon.' '.$status_color.'"></i> '.$ml['confirmation_status'].'</td>';
        echo '<td style="color:inhreit;" class="text-right">
                <a href="#" onclick="submitform1('.$ml['meeting_id'].')" class="btn btn-default btn-lg" style="color:inherit;" ><i class="fa fa-list-alt fa-lg"></i></a>
               </td>
              </tr>';
	}
	echo '</tbody></table>';
}
else
{
	echo ('<div class="jumbotron"><h1>No Meeting Log.</h1></div>');
}
?>
</div>
<form name="form1" method="post">
    <input name="param" type="hidden" value="" />
</form>
</div>
<div style="height:1px"> </div>
</div>
