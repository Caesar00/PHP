<?php
session_start();
if(isset($_SESSION['apr_a']))
{
	$apr_a = $_SESSION['apr_a'];
	if(isset($_SESSION['apr_a']['stud']))
		$stud = $apr_a['stud'];
	else
		$stud = $user;
}
else
{
	$apr_a = array();
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
if($_GET['act']=='submit')
{
	if(isset($_POST['param']))
	{
		$apr_a['thesis_title']=$_POST['title'];
		$apr_a['suspension_date']=$_POST['text1_1'];
		$apr_a['enroll_change_date']=$_POST['text2_1'];
		$apr_a['enroll_older_status']=$_POST['text2_2'];
		$apr_a['personal_leave_date']=$_POST['text3_1'];
		$apr_a['personal_leave_type']=$_POST['text3_2'];
		$apr_a['change_supervisor']=$_POST['radio4'];
		$_SESSION['apr_a']=$apr_a;
		session_commit();
		header('Location: student_index.php?cont=APR&act=submit&page=2');
	}
}
if($_GET['act']=='view')
{
	if(isset($_POST['param']))
	{
		if($_SESSION['role']=='stu')
			header('Location: student_index.php?cont=APR&act=view&page=2');
		else
			header('Location: gro_index.php?cont=APR&act=view&page=2');
	}
}
?>
<script language="javascript" type='text/javascript'>
$(document).ready(function() {
	for(var i=1;i<4;i++)
	{
		$("#text"+i+"_1_t").datepicker({
			maxDate: new Date(),
			defaultDate: new Date(),
			dateFormat: "dd-mm-yy",
			changeMonth: true,
			changeYear: true,
		});
		$("#text"+i+"_1_t").attr("readonly",true);
	}
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
function validation1()
{
	var result = false;
	var title = document.form1.title;
	if(title.value == '')
	{
		var title_w = $id('title_w');
		title_w.className = "";
		result = true;
	}
	for(var i=1;i<5;i++)
	{
		var radio = getRadio('radio'+i);
		if(radio=='')
		{
			var radio_w = $id('radio'+i+'_w');
			radio_w.className = "";
			result = true;
		}
		else if(radio=='yes')
		{
			for(var j=1;j<3;j++)
			{
				var text = document.getElementsByName('text'+i+'_'+j);
				if(text[0] != null && text[0].value == '')
				{
					var text_w = $id('text'+i+'_'+j+'_w');
					text_w.className = "";
					result = true;
				}
			}
		}
	}
	return result;
}
</script>

<div class="formflow_b" style="width:80%">
  <table cellspacing="3" cellpadding="4" style="width:100%">
    <tr>
      <td>Student Details ></td>
      <td class="unselected">Scholaship ></td>
      <td class="unselected">Ethics Approval ></td>
      <td class="unselected">Progress ></td>
      <td class="unselected">Submission & Communication ></td>
      <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo '<td class="unselected">Signature</td>'; ?>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <table cellspacing="3" cellpadding="5" style="width:100%">
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
      <td>Commencement Date</td>
      <td><?php echo $stud['commencement_date']; ?></td>
      <td>Enrollment Type</td>
      <td><?php echo $stud['enrollment_type']; ?></td>
    </tr>
    <tr>
      <td>School</td>
      <td><?php echo $school1['name']; ?></td>
      <td>AOU/Sub-School</td>
      <td><?php echo $school2['name']; ?></td>
    </tr>
    <tr>
      <td>Scholarship Type</td>
      <td><?php echo $stud['scholarship_type']; ?></td>
      <td>Degree enrolled</td>
      <td><?php echo $stud['degree_enrolled']; ?></td>
    </tr>
    <tr>
      <td>Principal Supervisor</td>
      <td><?php echo $supervisor['p_supervisor']; ?></td>
      <td>Co Supervisors</td>
      <td><?php echo $supervisor['c_supervisor']; ?></td>
    </tr>
  </table>
  <p class="warning">*Please ensure that the above information is correct. <br />
    *If it's incorrect, please update your 'My Profile' page or contact GRO.</p>
  <form name="form1" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Thesis Title: <span>
          <input type="text" name="title" size="100" value="<?php printText($apr_a,'thesis_title');?>" />
          </span></td>
      </tr>
      <tr id="title_w" class="none">
        <td><p class="warning">*Please input title</p></td>
      </tr>
      <tr>
        <td class="light">Have there been any periods of suspension: <span>
          <input type="radio" name="radio1" value="yes" onclick="show('text1_1'),hide('radio1_w')" <?php printRadioYes($apr_a,'suspension_date');?>/>
          yes
          <input type="radio" name="radio1" value="no" onclick="hide('text1_1'),hide('radio1_w'),hide('text1_1_w')" <?php printRadioNo($apr_a,'suspension_date');?>/>
          no </span></td>
      </tr>
      <tr id="radio1_w" class="none">
        <td class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text1_1" class="<?php showText($apr_a,'suspension_date');?>">
        <td class="light">Please indicate dates suspension occured: <span>
          <input id="text1_1_t" name="text1_1"type="text" value="<?php printText($apr_a,'suspension_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text1_1_w" class="none">
        <td class="light"><p class="warning">*Please choose one date</p></td>
      </tr>
      <tr>
        <td>Have there been any changes to your enrolment status (i.e. Part time to Full time): <span>
          <input type="radio" name="radio2" value="yes" onclick="show('text2_1'),show('text2_2'),hide('radio2_w')" <?php printRadioYes($apr_a,'enroll_change_date');?>/>
          yes
          <input type="radio" name="radio2" value="no" onclick="hide('text2_1'),hide('text2_2'),hide('radio2_w'),hide('text2_1_w'),hide('text2_2_w')" <?php printRadioNo($apr_a,'enroll_change_date');?>/>
          no </span></td>
      </tr>
      <tr id="radio2_w" class="none">
        <td><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text2_1" class="<?php showText($apr_a,'enroll_change_date');?>">
        <td>Please show dates when this occured: <span>
          <input id="text2_1_t" name="text2_1" type="text" value="<?php printText($apr_a,'enroll_change_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text2_1_w" class="none">
        <td><p class="warning">*Please choose one date</p></td>
      </tr>
      <tr id="text2_2" class="<?php showText($apr_a,'enroll_change_date');?>">
        <td>Your status was on those dates: <span>
          <input id="text2_1_t" name="text2_2" type="text" value="<?php printText($apr_a,'enroll_older_status');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text2_2_w" class="none">
        <td><p class="warning">*Please input the status</p></td>
      </tr>
      <tr>
        <td  class="light">Have you taken any personal or annual leave in the last 12 months: <span>
          <input type="radio" name="radio3" value="yes" onclick="show('text3_1'),show('text3_2'),hide('radio3_w')" <?php printRadioYes($apr_a,'personal_leave_date');?>/>
          yes
          <input type="radio" name="radio3" value="no" onclick="hide('text3_1'),hide('text3_2'),hide('radio3_w'),hide('text3_1_w'),hide('text3_2_w')" <?php printRadioNo($apr_a,'personal_leave_date');?>/>
          no </span></td>
      </tr>
      <tr id="radio3_w" class="none">
        <td class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text3_1" class="<?php showText($apr_a,'personal_leave_date');?>">
        <td class="light">Please indicate leave dates: <span>
          <input id="text3_1_t" name="text3_1" type="text" value="<?php printText($apr_a,'personal_leave_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text3_1_w" class="none">
        <td class="light"><p class="warning">*Please choose one date</p></td>
      </tr>
      <tr id="text3_2" class="<?php showText($apr_a,'personal_leave_type');?>">
        <td class="light">Please indicate leave type: <span>
          <input id="text3_2_t" name="text3_2"type="text" value="<?php printText($apr_a,'personal_leave_type');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text3_2_w" class="none">
        <td class="light"><p class="warning">*Please input the date</p></td>
      </tr>
      <tr>
        <td>Have you changed spervisors since the commencement of your degree or last APR: <span>
          <input type="radio" name="radio4" value="yes" onclick="show('chsup'),hide('radio4_w')" <?php if(isset($apr_a['change_supervisor'])&&$apr_a['change_supervisor']=='yes')echo "checked='checked'";?>/>
          yes
          <input type="radio" name="radio4" value="no" onclick="hide('chsup'),hide('radio4_w')" <?php if(isset($apr_a['change_supervisor'])&&$apr_a['change_supervisor']=='no')echo "checked='checked'";?>/>
          no </span></td>
      </tr>
      <tr id="radio4_w" class="none">
        <td><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="chsup" class="<?php if(!isset($apr_a['change_supervisor'])||$apr_a['change_supervisor']=='no')echo 'none';?>">
        <td class="bright">If you ticked yes to the above please fill in the 'Change of supervision form' which you will find in:<br />
          <a href="http://our.murdoch.edu.au/Research-and-Development/Resources-for-students/Forms/Research-candidature-forms/">Research candidature forms</a></td>
      </tr>
    </table>
    <p class="buttons">
      <input name="param" type="hidden" value="" />
      <a href="#" onclick="submitform1(validation1,'next')">Next ></a></p>
  </form>
</div>
