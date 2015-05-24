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
<script src="js/jquery.timepicker.js" type="text/javascript"></script>
<link href="css/jquery.timepicker.css" rel="stylesheet" />
<script language="javascript" type='text/javascript'>
    $(document).ready(function() {
        $("#date").datepicker({
            maxDate: new Date(),
            defaultDate: new Date(),
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });
        $("#date").attr("readonly",true);

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
            source: locs
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
<div class="formflow_h" style="width:80%">
  <table cellspacing="3" cellpadding="5" style="width:100%">
    <th colspan=4>Candidate Details</th>
    <col class="dark"  style="width:170px"/>
    <col class="light" style="width:200px"/>
    <col class="dark"  style="width:170px"/>
    <col class="light" />
    <tr>
      <td class="dark">Full Name</td>
      <td><?php echo $name; ?></td>
      <td>Student Number</td>
      <td><?php echo $stud['Stud_NO']; ?></td>
    </tr>
    <tr>
      <td>Email Address</td>
      <td colspan="3"><?php echo $stud['email']; ?></td>
    </tr>
    <tr>
      <td>Principal Supervisor</td>
      <td><?php echo $supervisor['p_supervisor']; ?></td>
      <td>Co-Supervisors</td>
      <td><?php echo $supervisor['c_supervisor']; ?></td>
    </tr>
    <tr>
      <td colspan=4>
        <p class="warning"><small>*If the above personal information is incorrect, please click <a href="student_index.php?act=update">here</a> to update.</small></p>
      </td>
    </tr>
  </table>
  <form name="form1" method="post">
    <table cellspacing="3" cellpadding="5">
      <th>Meeting Details</th>
      <col class="dark" />
      <tr>
        <td>Date: <span>
          <input type="text" id="date" name="date" size="100" value="<?php printText($ml, 'date');?>" />
          </span>
        </td>
      </tr>
      <tr id="date_w" class="none">
        <td><p class="warning">*Please input date</p></td>
      </tr>
      <tr>
        <td>Commenced Time:<span>
          <input type="text" id="ctime" name="ctime" size="100" value="<?php printText($ml, 'commenced_time');?>" />
          </span></td>
      </tr>
      <tr id="ct_w" class="none">
        <td><p class="warning">*Please input commenced time</p></td>
      </tr>
      <tr>
        <td>Adjourned Time:<span>
          <input type="text" id="atime" name="atime" size="100" value="<?php printText($ml, 'adjourned_time');?>" />
          </span></td>
      </tr>
      <tr id="at_w" class="none">
        <td><p class="warning">*Please input adjourned time</p></td>
      </tr>
      <tr>
        <td><label for="location">Location:</label><span>
          <input type="text" id="location" name="location" size="100" value="<?php printText($ml, 'location');?>" />
          </span></td>
      </tr>
      <tr id="loc_w" class="none">
        <td><p class="warning">*Please input location</p></td>
      </tr>
      <tr>
        <td>
            Meeting Minutes:
            <p><textarea name="minutes" maxlength='2000' style='width: 99%; height: 200px;'></textarea></p>
        </td>
      </tr>
      <tr><td>Attendees:</td></tr>
      <?php
        $p_sup = $supervisor['p_supervisor'];
        $c_sup = $supervisor['c_supervisor'];
        echo "<tr class=light><td><input type=checkbox name='psup' checked>".$p_sup." (principle supervisor) </td></tr>";
        echo "<tr class=light><td><input type=checkbox name='csup'>".$c_sup." (co-supervisor) </td></tr>";
      ?>
     <!-- <tr>
        <td>
            Other attendees:
            <input type="text" name="others" size="100" placeholder="Student/Staff No, seperate by comma: 123,456" />
        </td>
      </tr>-->
    </table>
    <p class="buttons">
      <input name="param" type="hidden" value="" />
      <a href="#" onclick="submitform1(function(){},'create')">
      <?php 
        if(isset($_SESSION['ml'])) 
        {
            echo 'Resubmit';
        }
        else {
            echo 'Create';
        }
      ?>
      </a>
    </p>
  </form>
</div>
