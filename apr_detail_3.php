<?php
session_start();
if(isset($_SESSION['apr_a']))
{
	$apr_a = $_SESSION['apr_a'];
}
if($_GET['act']=='submit')
{
	if(isset($_POST['param']))
	{
		if(isset($_POST['radio']))
		{
			$apr_a['ethics_number'] = $_POST['text1'];
			$apr_a['ethics_detail'] = $_POST['text2'];
			$_SESSION['apr_a']=$apr_a;
			session_commit();
		}
		if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=submit&page=4');
		if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=submit&page=2');
	}
}
if($_GET['act']=='view')
{
	if(isset($_POST['param']))
	{
		if($_SESSION['role']=='stu')
		{
			if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=view&page=4');
			if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=view&page=2');
		}
		else
		{
			if($_POST['param']=='next')header('Location: gro_index.php?cont=APR&act=view&page=4');
			if($_POST['param']=='previous')header('Location: gro_index.php?cont=APR&act=view&page=2');
		}
	}
}
?>
<script language="javascript" type='text/javascript'>
function submitform3(func,str)
{
	var result = func();
	if(result)
	{
		return;
	}
	document.form3.param.value=str;
	document.form3.submit();
}
function validation3()
{
	var result = false;
	var radio = getRadio('radio');
	if(radio=='')
	{
		var radio_w = $id('radio_w');
		radio_w.className = "";
		result = true;
	}
	else if(radio=='yes')
	{
		var text = $id('text1_t')
		if(text.value == '')
		{
			var text_w = $id('text1_w')
			text_w.className = "";
			result = true;
		}
		else
		{
			var inputStr = text.value
			for (var i = 0; i < inputStr.length; i++){
				var oneChar=inputStr.substring(i,i+1)
				if (oneChar < "0" || oneChar > "9"){
					var text_w = $id('text1_w')
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
      <td class="unselected">Student Details ></td>
      <td class="unselected">Scholarship ></td>
      <td>Ethics Approval ></td>
      <td class="unselected">Progress ></td>
      <td class="unselected">Submission & Communication ></td>
      <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo '<td class="unselected">Signature</td>'; ?>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <form name="form3" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Does your research project involve human or animal subjects? <span>
          <input name="radio" type="radio" value="yes" onclick="show('text1'),show('text2'),hide('radio_w')" <?php printRadioYes($apr_a,'ethics_number');?>/>
          yes
          <input name="radio" type="radio" value="no" onclick="hide('text1'),hide('text2'),hide('radio_w'),hide('text1_w')" <?php printRadioNo($apr_a,'ethics_number');?>/>
          no</span></td>
      </tr>
      <tr id="radio_w" class="none">
        <td><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text1" class="<?php showText($apr_a,'ethics_number');?>">
        <td class="light">Please provide ethics number(digital only): <span>
          <input id="text1_t" name="text1" type="text" size="50" value="<?php printText($apr_a,'ethics_number');?>" /></span></td>
      </tr>
      <tr id="text1_w" class="none">
        <td class="light"><p class="warning">*Please provide number</p></td>
      </tr>
      <tr id="text2" class="<?php showText($apr_a,'ethics_number');?>">
        <td>If you ticked yes and you do not have ethics approval, please indicate why and when it will be attained:
		<textarea id="text2_t" name="text2" style="width:99%; height:200px"><?php printText($apr_a,'ethics_detail');?></textarea></td>
      </tr>
    </table>
    <p class="buttons">
      <input name="param" type="hidden" value="" />
      <a href="#" onclick="submitform3(function(){},'previous')">< Previous</a><a href="#" onclick="submitform3(validation3,'next')">Next ></a></p>
  </form>
</div>
