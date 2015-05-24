<?php
session_start();
if(isset($_SESSION['apr_a']))
{
	$apr_a = $_SESSION['apr_a'];
}
if(isset($_POST['param']))
{
	if($_POST['param']=='Submit')
	{
		if(!isset($apr_a['APR_NO']))
		{
			$apr_a['APR_NO']=(time()+date('now')+$user['Stud_NO'])/100;
		}
		$apr_a['status']='student submitted';
		$query = "INSERT INTO apr_a (APR_NO,Std_NO,thesis_title,suspension_date,enroll_change_date,enroll_older_status,".
		"personal_leave_date,personal_leave_type,change_supervisor,scholarship_holder,other_scholarship,employment,".			"ethics_number,ethics_detail,change_focus_detail,issues_detail,submission_thesis,comunication_with_sup,date_submitted,status)". 
		"VALUES ('$apr_a[APR_NO]','$user[Stud_NO]','$apr_a[thesis_title]','$apr_a[suspension_date]','$apr_a[enroll_change_date]','$apr_a[enroll_older_status]',".
		"'$apr_a[personal_leave_date]','$apr_a[personal_leave_type]','$apr_a[change_supervisor]',"."'$apr_a[scholarship_holder]','$apr_a[other_scholarship]','$apr_a[employment]','$apr_a[ethics_number]','$apr_a[ethics_detail]',"."'$apr_a[change_focus_detail]','$apr_a[issues_detail]','$apr_a[submission_thesis]','$apr_a[comunication_with_sup]',now(),'$apr_a[status]')";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		if(isset($apr_a['milestone_c']))
		{
			$i = 0;
			foreach($apr_a['milestone_c'] as $value)
			{
				$query ="INSERT INTO apr_milestone_c (A_M_C_NO,APR_NO,description,date) VALUES ($apr_a[APR_NO]*100+$i,$apr_a[APR_NO],'$value[description]','$value[date]')";
				$result = mysqli_query($con,$query) or die(mysqli_error($con));
				$i++;
			}
		}
		if(isset($apr_a['milestone_n']))
		{
			$i = 0;
			foreach($apr_a['milestone_n'] as $value)
			{
				$query ="INSERT INTO apr_milestone_n (A_M_N_NO,APR_NO,description,date) VALUES ($apr_a[APR_NO]*100+$i,$apr_a[APR_NO],'$value[description]','$value[date]')";
				$result = mysqli_query($con,$query) or die(mysqli_error($con));
				$i++;
			}
		}
		if(isset($apr_a['publication']))
		{
			$i = 0;
			foreach($apr_a['publication'] as $value)
			{
				$query ="INSERT INTO apr_publication (A_P_NO,APR_NO,detail) VALUES ($apr_a[APR_NO]*100+$i,$apr_a[APR_NO],'$value')";
				$result = mysqli_query($con,$query) or die(mysqli_error($con));
				$i++;
			}
		}
		if(isset($_SESSION['apr_d_a']))
		{
			$apr_d_a = $_SESSION['apr_d_a'];
			$query = "INSERT INTO apr_d_a (APR_NO,stp_workshop_date,assignment_date,p_sup_reporting,td_workshop_date,dr_odc_date,op_odc_date,additional_comment) VALUES ($apr_a[APR_NO],'$apr_d_a[stp_workshop_date]','$apr_d_a[assignment_date]','$apr_d_a[p_sup_reporting]','$apr_d_a[td_workshop_date]','$apr_d_a[dr_odc_date]','$apr_d_a[op_odc_date]','$apr_d_a[additional_comment]')";
			$result = mysqli_query($con,$query) or die(mysqli_error($con));
			unset($apr_d_a);
			unset($_SESSION['apr_d_a']);
		}
		if(isset($_SESSION['apr_d_b']))
		{
			$apr_d_b = $_SESSION['apr_d_b'];
			$query = "INSERT INTO apr_d_b (APR_NO,mcs_presentation_date,mcs_presentation_title,additional_comment) VALUES ($apr_a[APR_NO],'$apr_d_a[mcs_presentation_date]','$apr_d_a[mcs_presentation_title]','$apr_d_a[additional_comment]')";
			$result = mysqli_query($con,$query) or die(mysqli_error($con));
			unset($apr_d_b);
			unset($_SESSION['apr_d_b']);
		}
		unset($apr_a);
		unset($_SESSION['apr_a']);
		if($result)header('Location: student_index.php?cont=APR&act=submit&page=7');
	}
	if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=submit&page=5');
}
?>
<script language="javascript" type='text/javascript'>
$(document).ready(function() {
});
function submitform6(func,str)
{
	var result = func();
	if(result)
	{
		return;
	}
	document.form6.param.value=str;
	document.form6.submit();
}
function validation6()
{
	var result = false;
	var checkbox = $id('check1');
	if(checkbox.checked == false)
	{
		var check_w = $id('check1_w');
		check_w.className = '';
		result = true;
	}
	return result;
}
</script>

<div class="formflow_b" style="width:80%">
  <table cellspacing="3" cellpadding="4" style="width:100%">
    <tr>
      <td class="unselected">Student Details ></td>
      <td class="unselected">Scholarship ></td>
      <td class="unselected">Ethics Approval ></td>
      <td class="unselected">Progress ></td>
      <td class="unselected">Submission & Communication ></td>
      <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo '<td>Signature</td>'; ?>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <form name="form6" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td><b>You acknowledge and agree that signing, writing or typing your name on this form and submitting the form to your principal supervisor by email will constitute signature by electronic communication under the Electronic Transactions Act 2003 (WA) and related Acts. In signing this form you agree that your Annual Progress Report is deemed satisfactory, the Graduate Research Office will automatically re-enrol you.</b></td>
      </tr>
      <tr>
        <td><span>Yes, I agree.<input id="check1" name="check1" type="checkbox"/></span></td>
      </tr>
      <tr id="check1_w" class="none">
        <td><p class="warning">*Please tick abouve</p></td>
      </tr>
    </table>
    <p class="buttons">
      <input name="param" type="hidden" value="" />
      <a href="#" onclick="submitform6(function(){},'previous')">< Previous</a><a href="#" onclick="submitform6(validation6,'Submit')">Submit ></a></p>
  </form>
</div>
