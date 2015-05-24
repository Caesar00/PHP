<?php
if(isset($_SESSION['ml']))
{
	$ml = $_SESSION['ml'];
	if(isset($_SESSION['ml']['stud']))
		$stud = $ml['stud'];
	else
		$stud = $user;
}
else
{
	$ml = array();
	$stud = $user;
}

$name = $stud['salutation'].' '.$stud['firstname'].' '.$stud['surname'];
$query = "SELECT name FROM school WHERE Sc_NO = $stud[Sc_NO]";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$school1 = mysqli_fetch_array($result);
$query = "SELECT name FROM school WHERE Sc_NO = $stud[sub_school]";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$school2 = mysqli_fetch_array($result);
$query = "SELECT CONCAT(sa1.salutation,' ',sa1.firstname,' ',sa1.surname) as p_supervisor,CONCAT(sa2.salutation,' ',sa2.firstname,' ',sa2.surname) as c_supervisor FROM staff_account sa1,staff_account sa2 WHERE sa1.S_NO = $stud[p_supervisor] and sa2.S_NO = $stud[c_supervisor];";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$supervisor = mysqli_fetch_array($result);
session_commit();
?>
<script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="js/jquery.timepicker.js" type="text/javascript"></script>
<link href="css/datepicker.css" rel="stylesheet" />
<link href="css/jquery.timepicker.css" rel="stylesheet" />
<link href="css/gh-fork-ribbon.ie.css" rel="stylesheet" />
<link href="css/gh-fork-ribbon.css" rel="stylesheet" />
<script language="javascript" type='text/javascript'>
    $(document).ready(function() {
        $("#date").datepicker({
             format: "yyyy-mm-dd",
             endDate: "date();",
             todayBtn: "linked",
             autoclose: true,
             todayHighlight: true
        });

        $("#ctime").timepicker();
        $("#atime").timepicker();

        $("#ctime").on('click', function() {
            $("#ctime").timepicker({'forceRoundTime':true});
            $("#ctime").timepicker({'step':15});
        });

        $("#atime").timepicker();
        $("#atime").on('click', function() {
            $("#atime").timepicker({'forceRoundTime':true});
            $("#atime").timepicker({'step':15});
        });
    
        var locs = [];
        $.ajax({
            async: false, 
            type: "GET",
            url: "loc_query.php",
            data: {
                q:'0', 
            },
            success: function(data) {
                locs = data;
            },
            error: function(data) {
                locs.push("No Result Found");
            }
        });
        $("#location").autocomplete({
            source: locs,
            messages: {
                noResults: '',
                results: function() {}
            }
        });
    });

    function submitform1(func,str)
    {
        var result = func();
        if(result)
        {
            return;
        }
        document.form1.param.value=str;
        document.form1.submit();
    }
</script>
<div class="row">
    <div class="col-md-9 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h2>Meeting Log<span class="lead"> for candidate</span></h2>
                <div class="github-fork-ribbon-wrapper right" style="margin-right:15px;">
                    <div class="github-fork-ribbon">
                        <a href="#" class="text-center">
                            <?php 
                                if(isset($ml) && !empty($ml))
                                {
                                    echo ucfirst($ml['confirmation_status']);
                                }
                                else
                                {
                                    echo "New";
                                }
                            ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" name="form1" method="post">
                    <div class="input-group col-md-8" style="margin-bottom:15px">
                        <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                        <input class="form-control" type="text" id="date" name="date" value="<?php printText($ml, 'date');?>" placeholder="Date"/>
                    </div>
                    <div class="input-group col-md-8" style="margin-bottom:15px">
                        <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
                        <input class="form-control" type="text" id="ctime" name="ctime" size="100" value="<?php printText($ml, 'commenced_time');?>" placeholder="Commenced Time"/>
                        <span class="input-group-addon">-</span>
                        <input class="form-control" type="text" id="atime" name="atime" size="100" value="<?php printText($ml, 'adjourned_time');?>" placeholder="Adjourned Time"/>
                    </div>
                    <div class="input-group col-md-8" style="margin-bottom:15px">
                        <span class="input-group-addon"><i class="fa fa-map-marker fa-lg"></i></span>
                        <input class="form-control" type="text" id="location" name="location" size="100" value="<?php printText($ml, 'location');?>" placeholder="Location"/>
                    </div>
                    <div class="input-group col-md-10" style="margin-bottom:15px">
                        <span class="input-group-addon"><i class="fa fa-bookmark fa-lg"></i></span>
                        <textarea class="form-control" name="minutes" rows="5" placeholder="Write down some notes here"><?php printText($ml, 'meeting_minutes');?></textarea>
                    </div>
                    <div class="input-group col-md-10" style="margin-bottom:15px">
                        <span class="input-group-addon"><i class="fa fa-users fa-lg"></i></span>
                        <label for="attendees" class="col-md-2 control-label">Supervisors</label>
                        <div class="col-md-4" id="attendees">
                            <?php
                            $p_sup = $supervisor['p_supervisor'];
                            $c_sup = $supervisor['c_supervisor'];
                            echo "<input type='checkbox' name='psup' checked> ".$p_sup."<br />";
                            echo "<input type='checkbox' name='csup'> ".$c_sup."";
                            ?>
                        </div>
                        <label for="others" class="col-md-2 control-label">Others</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" name="others" size="100" placeholder="123,456" />
                            <input name="param" type="hidden" value="" />
                        </div>
                    </div>
                    <div class="form-group text-center" style="margin-top:50px;">
                        <div class="col-md-offset-3 col-md-6">
                            <a href="#" class="btn btn-success btn-block btn-lg pull-center" onclick="submitform1(function(){},'create')">
                            <?php 
                                if(isset($_SESSION['ml'])) 
                                {
                                    echo 'Update & Resubmit';
                                }
                                else {
                                    echo 'Create';
                                }
                            ?>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
