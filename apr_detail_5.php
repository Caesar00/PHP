<?php
session_start();
if(isset($_SESSION['apr_a']))
{
	$apr_a = $_SESSION['apr_a'];
	if(isset($apr_a['stud']))
		$stud = $apr_a['stud'];
	else
		$stud = $user;
}
else
{
	$apr_a = array();
	$stud = $user;
}
if($_GET['act']=='submit')
{
	if(isset($_POST['param']))
	{
		$apr_a['submission_thesis'] = $_POST['text1'];
		$apr_a['comunication_with_sup'] = $_POST['text2'];
		$_SESSION['apr_a']=$apr_a;
		if($stud['Sc_NO']!=6)
		{
			session_commit();
			if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=submit&page=6');
			if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=submit&page=4');
		}
	}
}
if($_GET['act']=='view')
{
	if(isset($_POST['param']))
	{
		if($_SESSION['role']=='stu')
		{
			if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=view&page=6');
			if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=view&page=4');
		}
		else
		{
			if($_POST['param']=='next')header('Location: gro_index.php?cont=APR&act=view&page=6');
			if($_POST['param']=='previous')header('Location: gro_index.php?cont=APR&act=view&page=4');
		}
	}
}
?>
<script language="javascript" type='text/javascript'>
$(document).ready(function() {
	$("[name$='text1']").datepicker({
			defaultDate: new Date(),
			dateFormat: "dd-mm-yy",
			changeMonth: true,
			changeYear: true,
		});
});
function submitform5(func,str)
{
	var result = func();
	if(result)
	{
		return;
	}
	document.form5.param.value=str;
	document.form5.submit();
}
function validation5()
{
	var result = false;
	for(var i=1;i<3;i++)
	{
		var text = $id('text'+i)
		if(text.value == '')
		{
			var text_w = $id('text'+i+'_w')
			text_w.className = "";
			result = true;
		}
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
      <td>Submission & Communication ></td>
      <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo '<td class="unselected">Signature</td>'; ?>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <form name="form5" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>When do you intend to submit your thesis for examination?<span>
          <input id="text1" name="text1" type="text" readonly="readonly" value="<?php printText($apr_a,'submission_thesis');?>" size="50" />
          </span></td>
      </tr>
      <tr id="text1_w" class="none">
        <td><p class="warning">*Please provide date</p></td>
      </tr>
      <tr class="light">
        <td>How frequently do you and your supervisor(s) communicate about your thesis?</td>
      </tr>
      <tr class="light">
        <td>Please provide details below about communication with your supervisor. This should include:<br />
          •type of contact e.g. face to face<br />
          •details of written work submitted<br />
          •feedback received<br />
          •If you have not received feedback why this is the case<br />
          <textarea id="text2" name="text2" style="width:99%; height:200px"><?php printText($apr_a,'comunication_with_sup');?></textarea></td>
      </tr>
      <tr id="text2_w" class="none">
        <td><p class="warning">*Please provide details</p></td>
      </tr>
      <?php
	  if($stud['Sc_NO']==6)
	  include "apr_detail_7.php";
	  ?>
    </table>
    <p class="buttons">
      <input name="param" type="hidden" value="" />
      <a href="#" onclick="submitform5(function(){},'previous')">< Previous</a>
      <?php 
	  if($_GET['act']=='submit')
	  {
		  echo "<a href='#' onclick='submitform5(validation5,\"next\")'>Next ></a>";
	  }?></p>
  </form>
</div>
