<?php
    if(isset($_POST['param']))
    {
        $query = "SELECT meeting_id FROM mls_meeting WHERE ";
        if(isset($_POST['src']))
        {
            foreach($_POST['src'] as $s) 
            {
                $query .= $s.' LIKE "%'.$_POST['q'].'%"';

                if(end($_POST['src']) != $s)
                {
                    $query .= " or ";
                }
            } 
            $query .= ';';
        }
        else {
            $query .= 'meeting_minutes LIKE "%'.$_POST['q'].'%;"';
        }
        $result = mysqli_query($con,$query) or die(mysqli_error($con));
        $mls_exist = mysqli_num_rows($result) > 0;
        if($mls_exist)
        {
            while($row=mysqli_fetch_array($result))
            {
                $_SESSION['result'][]= $row['meeting_id'];
            }
        }
        session_commit();
    }
    else {
        if(isset($_SESSION['result'])) 
        {
            unset($_SESSION['result']);
        }
    }
        session_commit();
?>
<div id="right_window" class="container2">
    <div class="title">
        Log Search
    </div>
    <div class="content">
        <div class="formflow_h" style="width:80%;" action=".">
            <form method="post">
                <input id="q" name="q" type="text" size="35"/>
                <input type="submit" value="Search" />
                <input type="hidden" name="param" />
                <br /><br />
                <input type="checkbox" name="src[]" value="location">Location
                <input type="checkbox" name="src[]" value="comments">Comments
                <input type="checkbox" name="src[]" value="comments">Candidate
            </form>
        </div>
        <div class="formflow_h" style="width:80%;" action=".">
            <script>
                function submitform1(str) {
                    document.form1.param.value = str;
                    document.form1.submit();
                }
            </script>
            <ul>
            <?php 
                if(isset($_SESSION['result']))
                {
                    echo "<h4>Results:</h4>";
                    foreach($_SESSION['result'] as $m) {
                        echo '<li><a onclick="'."submitform1($m)".'" href="#" >Meeting: '.$m. '</a></li>';
                    }
                }
                else 
                {
                    if(isset($_POST['param'])) {
                        echo 'Sorry, no result found.';
                    }
                }
            ?>
            </ul>
            <form name="form1" method="post" action="staff_MLS.php?cont=MLS">
                <input type="hidden" name="param" />
            </form>
        </div>
    </div>
    <div style="height:1px"></div>
</div>
