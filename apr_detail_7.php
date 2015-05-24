<?php
if(isset($_SESSION['apr_d_a']))
{
	$apr_d_a = $_SESSION['apr_d_a'];
}
else
{
	$apr_d_a=array();
}
if(isset($_SESSION['apr_d_b']))
{
	$apr_d_b = $_SESSION['apr_d_b'];
}
else
{
	$apr_d_b=array();
}
if($_GET['act']=='submit')
{
	if(isset($_POST['param']))
	{
		$apr_d_a['stp_workshop_date'] = $_POST['text3'];
		$apr_d_a['assignment_date'] = $_POST['text4'];
		$apr_d_a['p_sup_reporting'] = $_POST['texta1'];
		$apr_d_a['td_workshop_date'] = $_POST['text5'];
		$apr_d_a['dr_odc_date'] = $_POST['text6'];
		$apr_d_a['op_odc_date'] = $_POST['text7'];
		$apr_d_b['mcs_presentation_date'] = $_POST['text8'];
		$apr_d_b['mcs_presentation_date'] = $_POST['text9'];
		foreach($apr_d_a as $value)
		{
			if($value!='')
			{
				$apr_d_a['additional_comment'] = $_POST['texta2'];
				$_SESSION['apr_d_a'] = $apr_d_a;
				session_commit();
				break;
			}
		}
		foreach($apr_d_b as $value)
		{
			if($value!='')
			{
				$apr_d_b['additional_comment'] = $_POST['texta2'];
				$_SESSION['apr_d_b'] = $apr_d_b;
				session_commit();
				break;
			}
		}
		session_commit();
		if($_POST['param']=='next')header('Location: student_index.php?cont=APR&act=submit&page=6');
		if($_POST['param']=='previous')header('Location: student_index.php?cont=APR&act=submit&page=4');
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
<tr>
  <td><b>THE FOLLOWING IS ONLY FOR PhD CANDIDATES IN THE SCHOOL OF ARTS WHO ENROLLED AFTER THE 1ST OF JANUARY <?php echo date('Y');?></b><br />
    (if this does not apply to you, please skip to the bottom of the screen)</td>
</tr>
<tr>
  <td class="light"> You are asked to indicate whether you have complied with the requirements of the School of Arts GRD
    Training Programme. Please tick the appropriate boxes and provide detail where necessary. </td>
</tr>
<tr>
  <td><b>A. For students completing the first year of enrolment (or second year part-time)</b></td>
</tr>
<tr>
  <td class="light">I attended the workshop 'Starting the PhD'<span>
    <input type="radio" name="radio3" value="yes" onclick="show('text3')" <?php printRadioYes($apr_d_a,'stp_workshop_date');?>/>
    yes
    <input type="radio" name="radio3" value="no" onclick="hide('text3')" <?php printRadioNo($apr_d_a,'stp_workshop_date');?>/>
    no</span></td>
</tr>
<tr id="text3" class="<?php showText($apr_d_a,'stp_workshop_date');?>">
  <td class="light"> Date attended:<span>
    <input id="text3_t" name="text3" type="text" value="<?php printText($apr_d_a,'stp_workshop_date');?>" size="50"/>
    </span></td>
</tr>
<tr>
  <td>OR</td>
</tr>
<tr>
  <td class="light"> I was unable to attend the workshop 'Starting the PhD'. As a substitute, I completed the required written assignment and sent it to my Principal Supervisor.<span>
    <input type="radio" name="radio4" value="yes" onclick="show('text4')" <?php printRadioYes($apr_d_a,'assignment_date');?>/>
    yes
    <input type="radio" name="radio4" value="no" onclick="hide('text4')" <?php printRadioNo($apr_d_a,'assignment_date');?>/>
    no</span></td>
</tr>
<tr id="text4" class="<?php showText($apr_d_a,'assignment_date');?>">
  <td class="light"> Date sent to supervisor:<span>
    <input id="text4_t" name="text4"type="text" value="<?php printText($apr_a,'assignment_date');?>" size="50"/>
    </span></td>
</tr>
<tr>
  <td>I attended and reported to my Principal Supervisor on the following four academic research seminars,using the reporting guidelines provided to me.<br />
    (Please give title of seminar, name of speaker, date and location of presentation.)
    <textarea name="texta1" style="width:99%; height:200px"><?php printText($apr_d_a,'p_sup_reporting');?></textarea></td>
</tr>
<tr>
  <td class="light"> I attended the two days of Thesis Development Workshops.<span>
    <input type="radio" name="radio5" value="yes" onclick="show('text5')" <?php printRadioYes($apr_d_a,'td_workshop_date');?>/>
    yes
    <input type="radio" name="radio5" value="no" onclick="hide('text5')" <?php printRadioNo($apr_d_a,'td_workshop_date');?>/>
    no</span></td>
</tr>
<tr id="text5" class="<?php showText($apr_d_a,'td_workshop_date');?>">
  <td class="light"> Dates attended:<span>
    <input id="text5_t" name="text5"type="text" value="<?php printText($apr_a,'td_workshop_date');?>" size="50"/>
    </span></td>
</tr>
<tr>
  <td> I attended the Dress Rehearsal for the One-Day Conference.<span>
    <input type="radio" name="radio6" value="yes" onclick="show('text6')" <?php printRadioYes($apr_d_a,'dr_odc_date');?>/>
    yes
    <input type="radio" name="radio6" value="no" onclick="hide('text6')" <?php printRadioNo($apr_d_a,'dr_odc_date');?>/>
    no</span></td>
</tr>
<tr id="text6" class="<?php showText($apr_d_a,'dr_odc_date');?>">
  <td> Date attended:<span>
    <input id="text6_t" name="text6"type="text" value="<?php printText($apr_a,'dr_odc_date');?>" size="50"/>
    </span></td>
</tr>
<tr>
  <td class="light"> I gave an oral presentation at the One-Day Conference.<span>
    <input type="radio" name="radio7" value="yes" onclick="show('text7')" <?php printRadioYes($apr_d_a,'op_odc_date');?>/>
    yes
    <input type="radio" name="radio7" value="no" onclick="hide('text7')" <?php printRadioNo($apr_d_a,'op_odc_date');?>/>
    no</span></td>
</tr>
<tr id="text7" class="<?php showText($apr_d_a,'op_odc_date');?>">
  <td class="light"> Date of presentation:<span>
    <input id="text7_t" name="text7"type="text" value="<?php printText($apr_a,'op_odc_date');?>" size="50"/>
    </span></td>
</tr>
<tr>
  <td><b>B. For students completing the second year of enrolment (or fourth year part-time)</b></td>
</tr>
<tr>
  <td class="light"> I have given my mid-candidature seminar presentation.<span>
    <input type="radio" name="radio8" value="yes" onclick="show('text8'),show('text9')" <?php printRadioYes($apr_d_b,'mcs_presentation_date');?>/>
    yes
    <input type="radio" name="radio8" value="no" onclick="hide('text8'),hide('text9')" <?php printRadioNo($apr_d_b,'mcs_presentation_date');?>/>
    no</span></td>
</tr>
<tr id="text8" class="<?php showText($apr_d_b,'mcs_presentation_date');?>">
  <td class="light"> Date of presentation:<span>
    <input id="text8_t" name="text8"type="text" value="<?php printText($apr_d_b,'mcs_presentation_date');?>" size="50"/>
    </span></td>
</tr>
<tr id="text9" class="<?php showText($apr_d_b,'mcs_presentation_date');?>">
  <td class="light"> Title of presentation:<span>
    <input id="text9_t" name="text9"type="text" value="<?php printText($apr_d_b,'mcs_presentation_title');?>" size="90"/>
    </span></td>
</tr>
<tr>
  <td><b>Additional comments, if any</b>
    <textarea name="texta2" style="width:99%; height:200px"><?php printText($apr_d_a,'additional_comment'); printText($apr_d_b,'additional_comment');?></textarea></td>
</tr>
