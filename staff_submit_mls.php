<?php
include "library.php";
?>

<div class="container2">
    <div class="title">Review Meeting Log</div>
    <div class="content">
        <?php
            if(isset($_GET['page']))
            {
                if($_GET['page']=='pre_time')
                {
                    include "MLS_confirm.php";
                }
                elseif($_GET['page']=='reject_comments')
                {
                    include "MLS_reject.php";
                }
                else {
                    include "MLS_submit.php";
                }
            }
            else
            {
                include "view_ml.php";
                ?>
                <div class="formflow_h" style="width:80%">
                    <p class="buttons"><a href="staff_MLS.php?cont=MLS&act=submit&page=pre_time">Confirm</a></p>
                </div>
                <br />
                <?php
                if ($ml['confirmation_status'] != 'rejected') {
                echo "<div class='formflow_h' style='width:80%'><p class='buttons'><a href='staff_MLS.php?cont=MLS&act=submit&page=reject_comments'>Reject</a></p>";
                }?>
                </div>
                <?php
            }
            session_commit();
        ?>
    </div>
</div>
