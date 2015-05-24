<?php
session_start();

// base query for listing out mls of current supervisor
$list_query = "SELECT * from mls_meeting WHERE meeting_id IN (SELECT meeting_id FROM mls_attendee WHERE account_id = $staff_id AND attendee_type = 'supervisor')";
// if(isset($_GET['cont']))
// {
    // if ($_GET['cont'] == 'submitted') {
        // $query = $list_query."AND confirmation_status = 'confirmed';";
    // }
    // else {
    // $query = $list_query."AND confirmation_status <> 'confirmed';";
    // }
// }
// else
// {
$query = $list_query.";";
// }

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
                header("Location: staff_index3.php?cont=MLS&act=view");
            // else if($_SESSION['status']=="Dean")
                // header("Location: dean_MLS.php?cont=APR&act=view");
        }
        else
        {
            if($_SESSION['status']=="Sup")
                header("Location: staff_index3.php?cont=MLS&act=submit");
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
<div class="row" style="margin-bottom:25px;">
    <div class="col-sm-6 col-xs-6">
        <form class="horizontal-form" action="staff_index3.php?cont=MLS&act=search" method="post">
            <div class="input-group">
                <input id="q" name="q" class="form-control" type="text">
                <div class="input-group-addon">
                    <button type="submit" class="btn btn-block btn-default" value="Search">
                        <i class="fa fa-search fa-lg"></i>
                    </button>
                </div>
            </div>
            <input type="hidden" name="param" />
        </forM>
    </div>
    <div class="col-xs-6 col-sm-6">
        <div class="input-group pull-right">
            <a href="staff_index3.php?cont=MLS&act=submit&page=new" class="btn btn-primary btn-lg">
                <i class="fa fa-plus-circle"><span class="hidden-xs"> New</span></i>
            </a>&nbsp;
            <a href="staff_index3.php?cont=MLS&act=report" class="btn btn-primary btn-lg dropdown-toggle">
                <i class="fa fa-pie-chart"><span class="hidden-xs"> Report</span></i>
            </a>
        </div>
    </div>
</div>
<?php
if($mls_exist)
{
	echo("
        <table class='table table-hover'>
        <th>
            <td>Type</td>
            <td>Date</td>
            <td>Location</td>
            <td>Status</td>
            <td>Detail</td>
        </th>
        ");

	foreach($mls as $ml)
	{
		echo '<tr class="lead">
                <td>'.$ml['meeting_id'].'</td>
                <td>'.$ml['meeting_type'].'</td>
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
        echo '<td style="color:inhreit;" >
                <a href="#" onclick="submitform1('.$ml['meeting_id'].')" class="btn btn-default btn-lg" style="color:inherit;" ><i class="fa fa-list-alt fa-lg"></i></a>
               </td>
              </tr>';
	}
	echo '</table>';
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
