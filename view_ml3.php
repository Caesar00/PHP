<?php 
    session_start();
    if(isset($_SESSION['ml']))
    {
        $ml = $_SESSION['ml'];
    }
    $sups_query = 'SELECT S_NO, type, salutation, firstname, surname, email FROM staff_account WHERE S_NO IN (SELECT account_id FROM mls_attendee WHERE attendee_type = \'supervisor\' AND meeting_id = '.$ml['meeting_id'].')';
    $sups_result = mysqli_query($con,$sups_query) or die(mysqli_error($con));
    while ($sup = mysqli_fetch_assoc($sups_result)) {
        $sups[] = $sup;
    }
    $_SESSION['sups'] = $sups;
    session_commit();
?>
<div class="row edit-panel">
    <div class="col-xs-4 ">
        <p class="text-left">
        <?php
            if(isset($_SESSION['role'])) {
                if($_SESSION['role'] == 'stu') {
                   echo "<a href='student_index3.php?cont=MLS' class='btn btn-default'><i class='fa fa-reply'></i> Go Back</a>";
                }
                else {
                   echo "<a href='staff_index3.php?cont=MLS' class='btn btn-default'><i class='fa fa-reply'></i> Go Back</a>";
                }
            }
        ?>
        </p>
    </div>
    <div class="col-xs-4">
        <p class="lead text-center">
            <?php echo 'On '.$ml['date'].', '.$ml['commenced_time'].' - '.$ml['adjourned_time']; ?> 
        </p>
    </div>
    <div class="col-xs-4">
        <p class="text-right">
            <a href="#" class="btn btn-default"><i class="fa fa-exclamation-circle"></i> <?php echo $ml['confirmation_status']; ?></a>
        </p>
    </div>
</div>
<div class="row edit-panel">
    <div class="col-md-2">
        <div class="list-group">
            <a href="#location" class="list-group-item"><i class="fa fa-map-marker fa-fw"></i> Location</a>
            <a href="#minutes" class="list-group-item"><i class="fa fa-microphone fa-fw"></i> Minutes</a>
            <a href="#ptime" class="list-group-item"><i class="fa fa-clock-o fa-fw"></i> Preparation</a>
            <a href="#attendees" class="list-group-item"><i class="fa fa-users fa-fw"></i> Attendees</a>
            <a href="#comments" class="list-group-item"><i class="fa fa-comments-o fa-fw"></i> Comments</a>
        </div>
    </div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5><a name="location">Location</a></h5>
            </div>
            <div class="panel-body">
                <h5><?php echo $ml['location'] ?></h5>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5><a name="minutes">Minutes</a></h5>
            </div>
            <div class="panel-body">
                <h5><?php echo $ml['meeting_minutes'] ?></h5>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5><a name="ptime">Preparation Time</a></h5>
            </div>
            <div class="panel-body">
                <h5>
                    <?php 
                        $secs = $ml['preparation_time'];
                        $hours = floor($secs/3600);
                        $mins = floor(($secs/60) % 60);
                        echo "<span class='lead'>$hours</span><span class='text-muted'> hrs</span>
                              <span class='lead'>$mins</span><span class='text-muted'> mins</span>";
                    ?>
                </h5>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5><a name="attendees">Attendees</a></h5>
            </div>
            <div class="panel-body">
                <h5><?php
					$sups = $_SESSION['sups'];
        			foreach($sups as $sup) {
						echo $sup['salutation'].'. '.$sup['firstname'].' '.$sup['surname'];
						echo("<br />");
					}?></h5>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5><a name="attendees">Comments</a></h5>
            </div>
            <div class="panel-body">
                <h5>
                    <?php 
                        if($ml['comments'] != "") {
                            echo $ml['comments'];
                        }
                        else {
                            echo "<Nothing Here>";
                        }
                    ?>
                </h5>
            </div>
        </div>
        <?php
        if($ml['confirmation_status'] == 'rejected' && $_SESSION['role'] == 'stu')
        {
            echo '
                <div class="panel panle-default text-center">
                    <div class="panel-heading"> 
                        <div>
                            <a href="student_index3.php?cont=MLS&act=submit" class="btn btn-warning btn-block">Resubmit</a>
                        </div>
                    </div>
                </div>';
        }
        else if($_SESSION['role'] == 'sta') 
        {
            if($ml['confirmation_status'] != 'confirmed') 
            {
                echo '
                    <div class="panel panle-default text-center">
                        <div class="panel-heading">'; 
                        if($ml['confirmation_status'] != 'rejected') {
                            echo '<div>
                             <button href="#rejectModal" class="btn btn-danger btn-block" data-toggle="modal" data-target="#rejectModal">reject</button>
                          </div>';
                        }
                echo '<div>
                        <a href="#confirmModal" class="btn btn-primary btn-block" data-toggle="modal" data-target="#confirmModal">Confirm</a>
                        </div>
                    </div>';
            }
        }
        ?>
        <script language="javascript" type="text/javascript">
            function submitform1()
            {
                document.form1.param.value='ok';
                document.form1.submit();
            }
            function submitform2()
            {
                document.form2.param.value='ok';
                document.form2.submit();
            }
        </script>
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h5 class="modal-title" id="myModalLabel">Comments</h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" name="form1" id="form1" method="post" action="staff_index3.php?cont=MLS&act=submit&page=reject">
                            <div class="input-group col-xs-offset-2 col-xs-8">
                                <textarea name="comments" id="comments" class="form-control" rows="6" placeholder="Why do you reject this meeting log?"></textarea>
                            </div>
                            <input type="hidden" name="param" value=""/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="input-group col-xs-offset-4 col-xs-4">
                            <button type="button" class="btn btn-default btn-lg btn-block" onclick="submitform1();" type="submit"><i class="fa fa-send"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h5 class="modal-title" id="myModalLabel">Any preparation time?</h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" name="form2" id="form2" method="post" action="staff_index3.php?cont=MLS&act=submit&page=confirm">
                            <div class="input-group col-xs-offset-2 col-xs-8">
                                <input type="text" name="ptime" class="form-control" \>
                            </div>
                            <input type="hidden" name="param" value=""/>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="input-group col-xs-offset-4 col-xs-4">
                            <button type="button" class="btn btn-default btn-lg btn-block" onclick="submitform2();" type="submit"><i class="fa fa-send"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
