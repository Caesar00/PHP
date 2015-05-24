<?php
    $ml = array();
    $sup = $user;
    $query = "select S_NO, CONCAT_WS(' ', salutation, firstname, surname) AS 'name' from staff_account WHERE S_NO <> $staff_id;";
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
    $staff_exist = mysqli_num_rows($result) > 0;
    if($staff_exist)
    {
        while($row = mysqli_fetch_array($result))
        {
            $staffs[] = $row;
        }
    }
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
        document.form1.param_new.value=str;
        document.form1.submit();
    }
</script>
<div class="row">
    <div class="col-md-9 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
                <h2>Meeting Log <span class="lead">for panel</span></h2>
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
                        <div class="col-xs-offset-2 col-xs-8 col-sm-offset-3 col-sm-6" id="attendees">
                            <?php 
                                echo '<select multiple="" name="staffs[]" class="form-control"';
                                $index = 1;
                                foreach($staffs as $staff) {
                                    echo "<option value=".$staff['S_NO'].">".$staff['name']."</option>";
                                    if($index = 1)
                                    {
                                    }
                                }
                                echo '</select>';
                            ?>
                        </div>
                        <input name="param_new" type="hidden" value="" />
                    </div>
                    <div class="form-group text-center" style="margin-top:50px;">
                        <div class="col-md-offset-3 col-md-6">
                            <a href="#" class="btn btn-success btn-block btn-lg pull-center" onclick="submitform1(function(){},'create')">Create</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
