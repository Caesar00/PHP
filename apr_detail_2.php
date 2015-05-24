<?php
session_start();
if(isset($_SESSION['apr_a']))
{
	$apr_a = $_SESSION['apr_a'];
}
if(!isset($apr_a['scholarship_holder']))
{
	$apr_a['scholarship_holder'] = '';
}
if($_GET['act']=='submit')
{
	if(isset($_POST['param']))
	{
		for($i=1;$i<8;$i++)
		{
			if(isset($_POST['check'.$i]))
			{
				$apr_a['scholarship_holder'] = $i==1 ? $_POST['check'.$i] : $apr_a['scholarship_holder'].','.$_POST['check'.$i];
			}
		}
		$apr_a['other_scholarship'] = $_POST['text7'];
		$apr_a['employment'] = $_POST['text8'];
		$_SESSION['apr_a']=$apr_a;
		session_commit();
		if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=submit&page=3');
		if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=submit');
	}
}
if($_GET['act']=='view')
{
	if(isset($_POST['param']))
	{
		if($_SESSION['role']=='stu')
		{
			if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=view&page=3');
			if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=view');
		}
		else
		{
			if($_POST['param']=='next')header('Location: gro_index.php?cont=APR&act=view&page=3');
			if($_POST['param']=='previous')header('Location: gro_index.php?cont=APR&act=view');
		}
	}
}
?>
<script language="javascript" type='text/javascript'>
function submitform2(func,str)
{
	var result = func();
	if(result)
	{
		return;
	}
	document.form2.param.value=str;
	document.form2.submit();
}
function validation2()
{
	var result = false;
	var checkbox = $id("check7");
	if(checkbox.checked == true)
	{
		var text = $id("text7");
		if(text.value == '')
		{
			var text_w = $id("text7_w");
			text_w.className='';
			result = true;
		}
	}
	var haschecked = false;
	for(var i=1;i<8;i++)
	{
		checkbox = $id("check"+i);
		if(checkbox.checked == true)
		{
			haschecked = true;
			break;
		}
	}
	if(haschecked)
	{
		var text = $id("text8");
		if(text.value == '')
		{
			var text_w = $id("text8_w");
			text_w.className='';
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
      <td>Scholarship ></td>
      <td class="unselected">Ethics Approval ></td>
      <td class="unselected">Progress ></td>
      <td class="unselected">Submission & Communication ></td>
      <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo '<td class="unselected">Signature</td>'; ?>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <form name="form2" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td><b>Are you a recipient of one of the following scholarships?</b></td>
      </tr>
      <tr>
        <td class="light"> Australian Postgraduate Award (APA) <span>
          <input id="check1" name="check1" type="checkbox" value="APA" <?php tickcheckbox($apr_a['scholarship_holder'],'APA');?>/>
          </span></td>
      </tr>
      <tr>
        <td> Murdoch University Research Studentship (MURS) <span>
          <input id="check2" name="check2" type="checkbox" value="MURS" <?php tickcheckbox($apr_a['scholarship_holder'],'MURS');?>/>
          </span></td>
      </tr>
      <tr>
        <td class="light"> Murdoch University International Postgraduate Studentship (MIPS) <span>
          <input id="check3" name="check3" type="checkbox" value="MIPS" <?php tickcheckbox($apr_a['scholarship_holder'],'MIPS');?>/>
          </span></td>
      </tr>
      <tr>
        <td> International Postgraduate Research Studentship (IPRS) <span>
          <input id="check4" name="check4" type="checkbox" value="IPRS" <?php tickcheckbox($apr_a['scholarship_holder'],'IPRS');?>/>
          </span></td>
      </tr>
      <tr>
        <td class="light"> Murdoch University Partnership Scholarship <span>
          <input id="check5" name="check5" type="checkbox" value="MUPS" <?php tickcheckbox($apr_a['scholarship_holder'],'MUPS');?>/>
          </span></td>
      </tr>
      <tr>
        <td> Industry Scholarship <span>
          <input id="check6" name="check6" type="checkbox" value="IS" <?php tickcheckbox($apr_a['scholarship_holder'],'IS');?>/>
          </span></td>
      </tr>
      <tr>
        <td class="light"> Others – Please list
          <input id="text7" name="text7" type="text" size="70" value="<?php printText($apr_a,'other_scholarship');?>"/>
          <span>
          <input id="check7" name="check7" type="checkbox" value="OTH" <?php tickcheckbox($apr_a['scholarship_holder'],'OTH');?>/>
          </span></td>
      </tr>
      <tr id="text7_w" class="none">
        <td class="light"><p class="warning">*Please list the scholarship</p></td>
      </tr>
      <tr>
        <td><b>If you ticked any of the boxes above and undertook paid employment please provide name of employer
          and number hours per week:</b></td>
      </tr>
      <tr class="light">
        <td><input id="text8" name="text8" type="text" style="width:99%" value="<?php printText($apr_a,'employment');?>"/></td>
      </tr>
      <tr id="text8_w" class="none">
        <td class="light"><p class="warning">*Please provide detail</p></td>
      </tr>
    </table>
    <p class="buttons">
      <input name="param" type="hidden" value="" />
      <a href="#" onclick="submitform2(function(){},'previous')">< Previous</a><a href="#" onclick="submitform2(validation2,'next')">Next ></a></p>
  </form>
</div>
