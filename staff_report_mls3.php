<?php
if (isset($_POST['param'])) {
    $s = $_POST['sdate'];
    $f = $_POST['fdate'];
    $query = "select meeting_id, sum(duration) AS TotalDuration, sum(preparation_time)AS TotalPrep from mls_meeting where meeting_id IN (select meeting_id from mls_attendee where attendee_type='supervisor' and account_id = $staff_id ) AND date BETWEEN '$s' AND '$f' GROUP BY meeting_id;";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $ml_exist = mysqli_num_rows($result) > 0;
    $total_d = $total_p = $total_t = 0;
    $meeting_count = mysqli_num_rows($result);
    if($ml_exist)
    {
        while($row = mysqli_fetch_array($result))
        {
            $total_d += $row['TotalDuration'];
            $total_p += $row['TotalPrep'];
        }
        $total_t = $total_d + $total_p;
    }
    $query = "select location, sum(duration) as duration, count(location) AS freq from mls_meeting where meeting_id IN (select meeting_id from mls_attendee where attendee_type='supervisor' and account_id = $staff_id ) AND date BETWEEN '$s' AND '$f' GROUP BY location order by freq desc;";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $ml_exist = mysqli_num_rows($result) > 0;
    if($ml_exist)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $locs[] = $row;
        }
    }
    $query = "select confirmation_status, count(confirmation_status) AS freq from mls_meeting where meeting_id IN (select meeting_id from mls_attendee where attendee_type='supervisor' and account_id = $staff_id ) AND date BETWEEN '$s' AND '$f' GROUP BY confirmation_status order by freq desc;";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $ml_exist = mysqli_num_rows($result) > 0;
    if($ml_exist)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $logs[] = $row;
        }
    }
}
else {
    $total_d = $total_p = $total_t = 0;
}
?>
<script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="js/jquery.timepicker.js" type="text/javascript"></script>
<link href="css/datepicker.css" rel="stylesheet" />
<link href="css/jquery.timepicker.css" rel="stylesheet" />
<link href="css/gh-fork-ribbon.ie.css" rel="stylesheet" />
<link href="css/gh-fork-ribbon.css" rel="stylesheet" />
<script language="javascript" type='text/javascript'>
    $(document).ready(function() {
        $("#sdate").datepicker({
             format: "yyyy-mm-dd",
             endDate: "date();",
             todayBtn: "linked",
             autoclose: true,
             todayHighlight: true
        });
        $("#fdate").datepicker({
             format: "yyyy-mm-dd",
             endDate: "date();",
             todayBtn: "linked",
             autoclose: true,
             todayHighlight: true
        });

    });

    function submitform1()
    {
        document.form1.submit();
    }
</script>
<div class="container">
    <div class="col-md-12">
        <form class="form-horizontal" name="form1" method="post" action="">
            <div class="input-group col-md-offset-3 col-md-6">
                <input class="form-control text-center" type="text" id="sdate" name="sdate" value="2014-01-01" placeholder="From">
                <span class="input-group-addon"><i class="fa fa-arrows-h fa-lg"></i></span>
                <input class="form-control text-center" type="text" id="fdate" name="fdate" value="2014-12-31" placeholder="to"/>
                <input type="hidden" name="param"></input>
            </div>
        </form>
    </div>
    <div class="col-md-12 text-center" style="margin:15px 0px 15px 0px;">
        <a href="#" class="btn btn-default" type="submit" onclick="submitform1();">
            <i class="fa fa-database" ></i> 
            Generate
        </a>
    </div>
    <div class="col-md-12">
        <div class="jumbotron"> 
            <div class="panel panel-info">
                <div class="panel-body">
                    <p class="text-center">
                        <?php 
                            $secs = $total_d;
                            $hours = floor($secs/3600);
                            $mins = floor(($secs/60) % 60);
                            echo "<span>$hours</span><span class='text-muted'> hrs</span>
                                  <span>$mins</span><span class='text-muted'> mins (duration)</span>";
                        ?>
                    </p>
                    <p class="text-center">
                        <?php 
                            $secs = $total_p;
                            $hours = floor($secs/3600);
                            $mins = floor(($secs/60) % 60);
                            echo "<span>$hours</span><span class='text-muted'> hrs</span>
                                  <span>$mins</span><span class='text-muted'> mins (prep-time)</span>";
                        ?>
                    </p>
                    <h2 class="text-center">
                        <?php 
                            $secs = $total_t;
                            $hours = floor($secs/3600);
                            $mins = floor(($secs/60) % 60);
                            echo "<span>$hours</span><span class='text-muted'> hrs</span>
                                  <span>$mins</span><span class='text-muted'> mins</span>";
                        ?>
                    </h2>
                </div>
                <div class="panel-heading">
                    <p class="text-center" style="color:white">
                        <?php
                            if(isset($s) && isset($f))
                            {
                                $s_f = date("F jS, Y", strtotime($s));
                                $f_f = date("F jS, Y", strtotime($f));
                                echo "You've attended <span class='text-warning'> $meeting_count </a></span>meetings from <span class='text-warning'>$s_f</span> to <span class='text-warning'>$f_f</span>.";

                            }
                            else {
                                echo "Input date range to calculate your total meeting time.";
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-body">
                    <p class="text-center">
                        <?php
                            if(isset($locs)) {
                                foreach($locs as $key=>$value) 
                                {
                                    $mins = floor($locs[$key]['duration'] / 60);
                                    echo "<span class='text-warning'> ".$locs[$key]['freq'].'</span> meeting(s) at <span class="text-warning"> '.$locs[$key]['location'].'</span><span> for </span><span class="text-warning"> '.$mins.'</span> mins</span>';
                                    if($key != count($locs)) 
                                    {
                                        echo ",<br />";
                                    }
                                    else
                                    {
                                        echo ".";
                                    }
                                }
                            }
                        ?>
                    </p>
                    <p class="text-center">
                        <?php
                            if(isset($logs)) {
                                foreach($logs as $key=>$value) 
                                {
                                    echo "<span class='text-warning'> ".$logs[$key]['confirmation_status'].'</span> meeting(s): <span class="text-warning"> '.$logs[$key]['freq'].'</span>';
                                    if($key != count($logs)) 
                                    {
                                        echo ",<br />";
                                    }
                                    else
                                    {
                                        echo ".";
                                    }
                                }
                            }
                        ?>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
