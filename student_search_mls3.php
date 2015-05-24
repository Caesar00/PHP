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
            $query .= 'meeting_minutes LIKE "%'.$_POST['q'].'%";';
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
<div class="row">
    <div class="col-md-10">
        <form class="horizontal-form" method="post">
            <div class="form-group">
                <div class="col-xs-9">
                    <?php
                        $query = '';
                        if(isset($_POST['q'])) {
                            $query = ($_POST['q']);
                        }
                        echo "<input id='q' name='q' class='form-control' type='text' size='35' value='$query'/>";
                    ?>
                </div>
                <div class="col-xs-3" style="margin-bottom:25px;">
                    <button type="submit" class="btn btn-default" value="Search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <?php
                if(!isset($min_c)) {
                    $min_c = 'checked';
                }
                else {
                    $min_c = '';
                }
                $loc_c = $com_c = $can_c = "";

                if(isset($_POST['src'])) 
                { 
                    if(in_array('meeting_minutes', $_POST['src']))
                    {
                        $min_c = 'checked';
                    }
                    if(in_array('location', $_POST['src']))
                    {
                        $loc_c = 'checked';
                    }
                    if(in_array('comments', $_POST['src']))
                    {
                        $com_c = 'checked';
                    }
                    if(in_array('candidate', $_POST['src']))
                    {
                        $can_c = 'checked';
                    }    
                }
            ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <label><input type="checkbox" name="src[]" value="meeting_minutes"<?php echo $min_c ?>> Meeting Minutes</label>
                    <label><input type="checkbox" name="src[]" value="location"<?php echo $loc_c ?>> Location</label>
                    <label><input type="checkbox" name="src[]" value="comments"<?php echo $com_c ?>> Comments</label>
                    <label><input type="checkbox" name="src[]" value="candidate"<?php echo $can_c ?>> Candidate</label>
                </div>
            </div>
            <input type="hidden" name="param" />
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <script>
            function submitform1(str) {
                document.form1.param.value = str;
                document.form1.submit();
            }
        </script>
        <?php 
            if(isset($_SESSION['result']))
            {
                $len = count($_SESSION['result']);
                echo "<div class='well'><h4 class='text-warning'>Total of $len result(s) found:</h4><ul class='list-group'>";
                foreach($_SESSION['result'] as $m) {
                    echo '<li class="list-group-item"><a onclick="'."submitform1($m)".'" href="#" >Meeting: '.$m. '</a></li>';
                }
                echo "</ul></div>";
            }
            else 
            {
                if(isset($_POST['param'])) {
                    echo '<div class="well text-center"><h4 class="text-warning">Sorry, no result found.</h4></div>';
                }
            }
        ?>
        <form name="form1" method="post" action="student_index3.php?cont=MLS">
            <input type="hidden" name="param" />
        </form>
        </div>
    </div>
</div>
