<?php
session_start();
if(isset($_SESSION['apr_a']))
{
	$apr_a = $_SESSION['apr_a'];
	if(isset($apr_a['APR_NO']))
	{
		$query="SELECT APR_NO FROM apr_a WHERE APR_NO != $apr_a[APR_NO] ORDER BY date_submitted DESC LIMIT 1;";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$APR_NO = mysqli_fetch_array($result);
		if($APR_NO)
		{
			$query="SELECT * FROM apr_milestone_n WHERE APR_NO = $APR_NO[APR_NO]";
			$result=mysqli_query($con,$query) or die(mysqli_error($con));
			while($row = mysqli_fetch_array($result))
			{
				$milestone_c[]=$row['description'];
			}
		}
	}
	else
	{
		$query="SELECT APR_NO FROM apr_a ORDER BY date_submitted DESC LIMIT 1;";
		$result=mysqli_query($con,$query) or die(mysqli_error($con));
		$APR_NO = mysqli_fetch_array($result);
		if($APR_NO)
		{
			$query="SELECT * FROM apr_milestone_n WHERE APR_NO = $APR_NO[APR_NO]";
			$result=mysqli_query($con,$query) or die(mysqli_error($con));
			while($row = mysqli_fetch_array($result))
			{
				$milestone_c[]=$row['description'];
			}
		}
	}
}
if($_GET['act']=='submit')
{
	if(isset($_POST['param']))
	{
		for($i=1;$i<11;$i++)
		{
			if(isset($_POST['text1_t_'.$i])&&$_POST['text1_t_'.$i]!='')
			{
				$apr_milestone_c[$i]['description'] = $_POST['text1_t_'.$i];
				$apr_milestone_c[$i]['date'] = isset($_POST['text1_d_'.$i]) ? $_POST['text1_d_'.$i]:'';
			}
		}
		if(isset($apr_milestone_c))
		{
			$apr_a['milestone_c']=$apr_milestone_c;
		}
		for($i=1;$i<11;$i++)
		{
			if(isset($_POST['text2_t_'.$i])&&$_POST['text2_t_'.$i]!='')
			{
				$apr_milestone_n[$i]['description'] = $_POST['text2_t_'.$i];
				$apr_milestone_n[$i]['date'] = isset($_POST['text2_d_'.$i]) ? $_POST['text2_d_'.$i]:'';
			}
		}
		if(isset($apr_milestone_n))
		{
			$apr_a['milestone_n']=$apr_milestone_n;
		}
		if(isset($_POST['radio3']))
		{
			$apr_a['change_focus_detail'] = $_POST['text3'];
		}
		if(isset($_POST['radio4']))
		{
			$apr_a['issues_detail'] = $_POST['text4'];
		}
		for($i=1;$i<11;$i++)
		{
			if(isset($_POST['text5_'.$i])&&$_POST['text5_'.$i]!='')
			{
				$apr_publication[] = $_POST['text5_'.$i];
			}
		}
		if(isset($apr_publication))
		{
			$apr_a['publication']=$apr_publication;
		}
		$_SESSION['apr_a']=$apr_a;
		session_commit();
		if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=submit&page=5');
		if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=submit&page=3');
	}
}
if($_GET['act']=='view')
{
	if(isset($_POST['param']))
	{
		if($_SESSION['role']=='stu')
		{
			if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=view&page=5');
			if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=view&page=3');
		}
		else
		{
			if($_POST['param']=='next')header('Location: gro_index.php?cont=APR&act=view&page=5');
			if($_POST['param']=='previous')header('Location: gro_index.php?cont=APR&act=view&page=3');
		}
	}
}
function printmilestone_c($apr,$item,$milestone)
{
	$i=0;
	if(isset($apr[$item]))
	{
		foreach($apr[$item] as $key => $value)
		{
			echo "<tr class='light'><td><input name='text1_t_".($i+1)."' value='".$value['description']."' type='text' style='width:99%' readonly='readonly'/></td><td><input name='text1_d_".($i+1)."' value='".$value['date']."' type='text' style='width:99%'/></td></tr>";
			$i++;
		}
	}
	elseif(isset($milestone)&&$milestone!='')
	{
		foreach($milestone as $key => $value)
		{
			echo "<tr class='light'><td><input name='text1_t_".($i+1)."' value='".$value."' type='text' style='width:99%' readonly='readonly'/></td><td><input name='text1_d_".($i+1)."' value='' type='text' style='width:99%'/></td></tr>";
			$i++;
		}
		
	}
	else
	{
		echo "<tr class='light'><td colspan='2'>No previous milestones exist.</td></tr>";
	}
}
function printmilestone_n($apr,$item)
{
	$i=1;
	if(isset($apr[$item]))
	{
		foreach($apr[$item] as $key => $value)
		{
			echo "<tr class='dark'><td><input name='text2_t_".$i."' value='".$value['description']."' type='text' style='width:99%'/></td><td><input name='text2_d_".$i."' value='".$value['date']."' type='text' style='width:99%' readonly='readonly'/></td></tr>";
			$i++;
		}
	}
	else
	{
		echo "<tr class='dark'><td><input name='text2_t_1' type='text' style='width:99%'/></td><td><input name='text2_d_1' type='text' style='width:99%'  readonly='readonly'/></td></tr>";
	}
	return $i;
}
function printpublication($apr)
{
	$i=1;
	if(isset($apr['publication']))
	{
		foreach($apr['publication'] as $value)
		{
			echo "<tr><td colspan='2' class='light'><input type='text' name='text5_".$i."' value='".$value."' style='width:99%'/></td></tr>";
			$i++;
		}
	}
	else
	{
		echo "<tr><td colspan='2' class='light'><input type='text' name='text5_1' value='' style='width:99%'/></td></tr>";
	}
	return $i;
}
?>
<script language="javascript" type='text/javascript'>
$(document).ready(function() {
	for(var i=1;i<11;i++)
	{
		$("[name$='text1_d_"+i+"']").datepicker({
			maxDate: new Date(),
			defaultDate: new Date(),
			dateFormat: "dd-mm-yy",
			changeMonth: true,
			changeYear: true,
		});
	}
	$("[name$='text2_d_1']").datepicker({
			defaultDate: new Date(),
			dateFormat: "dd-mm-yy",
			changeMonth: true,
			changeYear: true,
	});
	$("#btn2_1").click(function() {
		var i=$("input:hidden#btn2_c").val();
		if(i<10)
		{
			i++;
			$(this).parents("tr").before("<tr><td><input name='text2_t_"+i+"' type='text' style='width:99%'/></td><td><input name='text2_d_"+i+"' type='text' style='width:99%' readonly='readonly'/></td></tr>");
			$("[name='text2_d_"+i+"']").datepicker({
				defaultDate: new Date(),
				dateFormat: "dd-mm-yy",
				changeMonth: true,
				changeYear: true,
			});
			$("input:hidden#btn2_c").val(i);
		}
		else
		{
			$("input:button#btn2_1").attr('disable',true);
		}
	});
	$("#btn2_2").click(function() {
		var i=$("input:hidden#btn2_c").val();
		if(i>1)
		{
			i--;
			$(this).parents("tr").prev().remove();
			$("input:hidden#btn2_c").val(i);
		}
		if(i<10)
		{
			$("input:button#btn2_1").attr('disable',false);
		}
	});
	$("#btn3_1").click(function() {
		var i=$("input:hidden#btn3_c").val();
		if(i<10)
		{
			i++;
			$(this).parents("tr").before("<tr><td colspan='2' class='light'><input type='text' name='text5_"+i+"' style='width:99%'/></td></tr>");
			$("input:hidden#btn3_c").val(i);
		}
		else
		{
			$("input:button#btn3_1").attr('disable',true);
		}
	});
	$("#btn3_2").click(function() {
		var i=$("input:hidden#btn3_c").val();
		if(i>1)
		{
			i--;
			$(this).parents("tr").prev().remove();
			$("input:hidden#btn3_c").val(i);
		}
		if(i<10)
		{
			$("input:button#btn3_1").attr('disable',false);
		}
	});
});
function submitform4(func,str)
{
	var result = func();
	if(result)
	{
		return;
	}
	document.form4.param.value=str;
	document.form4.submit();
}
function validation4()
{
	var result = false;
	for(var i=3;i<5;i++)
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
			var text = $id('text'+i+'_t')
			if(text.value == '')
			{
				var text_w = $id('text'+i+'_w')
				text_w.className = "";
				result = true;
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
      <td class="unselected">Ethics Approval ></td>
      <td>Progress ></td>
      <td class="unselected">Submission & Communication ></td>
      <?php if(isset($_GET['act'])&&$_GET['act']=='submit')echo '<td class="unselected">Signature</td>'; ?>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <form name="form4" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <col class="dark" />
      <tr >
        <td colspan="2"><b>Below is the milestone table you provided in your POS or previous APR. Please update the milestone table template below with complete and new milestones.<br />
          (One milestone should be roughly 4.6 weeks worth of work.<br />
          You can only have 10 maximum milestones for each APR.)</b></td>
      </tr>
      <tr class="light">
        <td>Completed Milestones (last 12 months)</td>
        <td>Achieved Dates</td>
      </tr>
      <?php
	  $milestone_num=printmilestone_c($apr_a,'milestone_c',isset($milestone_c) ? $milestone_c:'');
	  ?>
      <tr>
        <td>New Milestones (next 12 months)</td>
        <td>Target Dates</td>
      </tr>
      <?php
	  $milestone_num=printmilestone_n($apr_a,'milestone_n',2,'');
	  ?>
      <tr>
        <td colspan="2"><span>
          <input id="btn2_c" type="hidden" value="<?php echo $milestone_num;?>" />
          Add milestone<input id="btn2_1" type="button" value="+" />
          Reduce milestone<input id="btn2_2" type="button" value="-" />
          </span></td>
      </tr>
      <tr class="light">
        <td colspan="2">Have there been any changes to the focus of your research since your last report?<span>
          <input name="radio3" type="radio" value="yes" onclick="show('text3'),hide('radio3_w')" <?php printRadioYes($apr_a,'change_focus_detail');?>/>
          yes
          <input name="radio3" type="radio" value="no" onclick="hide('text3'),hide('radio3_w'),hide('text3_w')" <?php printRadioNo($apr_a,'change_focus_detail');?>/>
          no</span></td>
      </tr>
      <tr id="radio3_w" class="none">
        <td colspan="2" class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text3" class="<?php showText($apr_a,'change_focus_detail');?>">
        <td colspan="2" class="light">If yes, please provide details below:
          <textarea id="text3_t" name="text3" style="width:99%; height:200px"><?php printText($apr_a,'change_focus_detail');?></textarea></td>
      </tr>
      <tr id="text3_w" class="none">
        <td colspan="2" class="light"><p class="warning">*Please provide details</p></td>
      </tr>
      <tr>
        <td colspan="2">Are there been any problems/issues that have affected your progress during the reporting period?<span>
          <input name="radio4" type="radio" value="yes" onclick="show('text4'),hide('radio4_w')" <?php printRadioYes($apr_a,'issues_detail');?>/>
          yes
          <input name="radio4" type="radio" value="no" onclick="hide('text4'),hide('radio4_w'),hide('text4_w')" <?php printRadioNo($apr_a,'issues_detail');?>/>
          no</span></td>
      </tr>
      <tr id="radio4_w" class="none">
        <td colspan="2" class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text4" class="<?php showText($apr_a,'change_focus_detail');?>">
        <td colspan="2">If yes, please detail the steps you've taken to resolve these problems/issues:<br />
          (Please include any
          suspension in this reporting year)
          <textarea id="text4_t" name="text4" style="width:99%; height:200px"><?php printText($apr_a,'issues_detail');?></textarea></td>
      </tr>
      <tr id="text4_w" class="none">
        <td colspan="2"><p class="warning">*Please provide details</p></td>
      </tr>
      <tr>
        <td colspan="2" class="light">Please list any publications produced during the reporting period:</td>
      </tr>
      <?php $publication_num = printpublication($apr_a);?>
      <tr>
        <td colspan="2" class="light"><span>Add publication
          <input id="btn3_c" type="hidden" value="<?php echo $publication_num;?>" />
          <input id="btn3_1" type="button" value="+" />
          Reduce publication<input id="btn3_2" type="button" value="-" />
          </span></td>
      </tr>
    </table>
    <p class="buttons">
      <input name="param" type="hidden" value="" />
      <a href="#" onclick="submitform4(function(){},'previous')">< Previous</a><a href="#" onclick="submitform4(validation4,'next')">Next ></a></p>
  </form>
</div>
