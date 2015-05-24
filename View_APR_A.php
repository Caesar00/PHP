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
session_commit();
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
function printmilestone($apr,$item,$num,$class)
{
	$i=1;
	if(isset($apr[$item]))
	{
		foreach($apr[$item] as $key => $value)
		{
			echo "<tr class='".$class."'><td><input disabled name='text".$num."_t_".$i."' value='".$value['description']."' type='text' style='width:99%'/></td><td><input disabled name='text".$num."_d_".$i."' value='".$value['date']."' type='text' style='width:99%'/></td></tr>";
			$i++;
		}
	}
	else
	{
		echo "<tr class='".$class."'><td colspan='2'>No milestones</td></tr>";
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
			echo "<tr><td colspan='2' class='light'><input disabled type='text' name='text5_".$i."' value='".$value."' style='width:99%'/></td></tr>";
			$i++;
		}
	}
	else
	{
		echo "<tr><td colspan='2' class='light'><input disabled type='text' name='text5_1' value='' style='width:99%'/></td></tr>";
	}
	return $i;
}
?>

<div class="formflow_h" style="width:80%">
  <table cellspacing="3" cellpadding="5" style="width:100%">
    <col class="dark"  style="width:20%"/>
    <col class="light" style="width:25%"/>
    <col class="dark"  style="width:20%"/>
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
  <form name="form1" method="post">
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="dark" />
      <tr>
        <td>Thesis Title: <span>
          <input disabled type="text" name="title" size="100" value="<?php printText($apr_a,'thesis_title');?>" />
          </span></td>
      </tr>
      <tr id="title_w" class="none">
        <td><p class="warning">*Please input title</p></td>
      </tr>
      <tr>
        <td class="light">Has there been any periods of suspension: <span>
          <input disabled type="radio" name="radio1" value="yes" onclick="show('text1_1'),hide('radio1_w')" <?php printRadioYes($apr_a,'suspension_date');?>/>
          yes
          <input disabled type="radio" name="radio1" value="no" onclick="hide('text1_1'),hide('radio1_w'),hide('text1_1_w')" <?php printRadioNo($apr_a,'suspension_date');?>/>
          no </span></td>
      </tr>
      <tr id="radio1_w" class="none">
        <td class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text1_1" class="<?php showText($apr_a,'suspension_date');?>">
        <td class="light">Please indicate dates suspension occured: <span>
          <input disabled id="text1_1_t" name="text1_1"type="text" value="<?php printText($apr_a,'suspension_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text1_1_w" class="none">
        <td class="light"><p class="warning">*Please choose one date</p></td>
      </tr>
      <tr>
        <td>Has there been any change to your enrolment status (i.e. Part time to Full time): <span>
          <input disabled type="radio" name="radio2" value="yes" onclick="show('text2_1'),show('text2_2'),hide('radio2_w')" <?php printRadioYes($apr_a,'enroll_change_date');?>/>
          yes
          <input disabled type="radio" name="radio2" value="no" onclick="hide('text2_1'),hide('text2_2'),hide('radio2_w'),hide('text2_1_w'),hide('text2_2_w')" <?php printRadioNo($apr_a,'enroll_change_date');?>/>
          no </span></td>
      </tr>
      <tr id="radio2_w" class="none">
        <td><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text2_1" class="<?php showText($apr_a,'enroll_change_date');?>">
        <td>Please show dates when this occured: <span>
          <input disabled id="text2_1_t" name="text2_1" type="text" value="<?php printText($apr_a,'enroll_change_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text2_1_w" class="none">
        <td><p class="warning">*Please choose one date</p></td>
      </tr>
      <tr id="text2_2" class="<?php showText($apr_a,'enroll_change_date');?>">
        <td>Your status was on those dates: <span>
          <input disabled id="text2_1_t" name="text2_2" type="text" value="<?php printText($apr_a,'enroll_older_status');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text2_2_w" class="none">
        <td><p class="warning">*Please input the status</p></td>
      </tr>
      <tr>
        <td  class="light">Have you taken any personal leave or annual leave in the last 12 months: <span>
          <input disabled type="radio" name="radio3" value="yes" onclick="show('text3_1'),show('text3_2'),hide('radio3_w')" <?php printRadioYes($apr_a,'personal_leave_date');?>/>
          yes
          <input disabled type="radio" name="radio3" value="no" onclick="hide('text3_1'),hide('text3_2'),hide('radio3_w'),hide('text3_1_w'),hide('text3_2_w')" <?php printRadioNo($apr_a,'personal_leave_date');?>/>
          no </span></td>
      </tr>
      <tr id="radio3_w" class="none">
        <td class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text3_1" class="<?php showText($apr_a,'personal_leave_date');?>">
        <td class="light">Please indicate leave dates: <span>
          <input disabled id="text3_1_t" name="text3_1" type="text" value="<?php printText($apr_a,'personal_leave_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text3_1_w" class="none">
        <td class="light"><p class="warning">*Please choose one date</p></td>
      </tr>
      <tr id="text3_2" class="<?php showText($apr_a,'personal_leave_type');?>">
        <td class="light">Please indicate leave type: <span>
          <input disabled id="text3_2_t" name="text3_2"type="text" value="<?php printText($apr_a,'personal_leave_type');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text3_2_w" class="none">
        <td class="light"><p class="warning">*Please input the date</p></td>
      </tr>
      <tr>
        <td>Have you changed spervisors since commencement of your degree or last APR: <span>
          <input disabled type="radio" name="radio4" value="yes" onclick="show('chsup'),hide('radio4_w')" <?php if(isset($apr_a['change_supervisor'])&&$apr_a['change_supervisor']=='yes')echo "checked='checked'";?>/>
          yes
          <input disabled type="radio" name="radio4" value="no" onclick="hide('chsup'),hide('radio4_w')" <?php if(isset($apr_a['change_supervisor'])&&$apr_a['change_supervisor']=='no')echo "checked='checked'";?>/>
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
  </form>
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
          <input disabled id="check1" name="check1" type="checkbox" value="APA" <?php tickcheckbox($apr_a['scholarship_holder'],'APA');?>/>
          </span></td>
      </tr>
      <tr>
        <td> Murdoch University Research Studentship (MURS) <span>
          <input disabled id="check2" name="check2" type="checkbox" value="MURS" <?php tickcheckbox($apr_a['scholarship_holder'],'MURS');?>/>
          </span></td>
      </tr>
      <tr>
        <td class="light"> Murdoch University International Postgraduate Studentship (MIPS) <span>
          <input disabled id="check3" name="check3" type="checkbox" value="MIPS" <?php tickcheckbox($apr_a['scholarship_holder'],'MIPS');?>/>
          </span></td>
      </tr>
      <tr>
        <td> International Postgraduate Research Studentship (IPRS) <span>
          <input disabled id="check4" name="check4" type="checkbox" value="IPRS" <?php tickcheckbox($apr_a['scholarship_holder'],'IPRS');?>/>
          </span></td>
      </tr>
      <tr>
        <td class="light"> Murdoch University Partnership Scholarship <span>
          <input disabled id="check5" name="check5" type="checkbox" value="MUPS" <?php tickcheckbox($apr_a['scholarship_holder'],'MUPS');?>/>
          </span></td>
      </tr>
      <tr>
        <td> Industry Scholarship <span>
          <input disabled id="check6" name="check6" type="checkbox" value="IS" <?php tickcheckbox($apr_a['scholarship_holder'],'IS');?>/>
          </span></td>
      </tr>
      <tr>
        <td class="light"> Others – Please list
          <input disabled id="text7" name="text7" type="text" size="70" value="<?php printText($apr_a,'other_scholarship');?>"/>
          <span>
          <input disabled id="check7" name="check7" type="checkbox" value="OTH" <?php tickcheckbox($apr_a['scholarship_holder'],'OTH');?>/>
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
        <td><input disabled id="text8" name="text8" type="text" style="width:99%" value="<?php printText($apr_a,'employment');?>"/></td>
      </tr>
      <tr id="text8_w" class="none">
        <td class="light"><p class="warning">*Please provide detail</p></td>
      </tr>
    </table>
  </form>
</div>
<div class="formflow_h" style="width:80%">
  <form name="form3" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Does your reseach project involve human or animal subjects? <span>
          <input disabled name="radio" type="radio" value="yes" onclick="show('text1'),show('text2'),hide('radio_w')" <?php printRadioYes($apr_a,'ethics_number');?>/>
          yes
          <input disabled name="radio" type="radio" value="no" onclick="hide('text1'),hide('text2'),hide('radio_w'),hide('text1_w')" <?php printRadioNo($apr_a,'ethics_number');?>/>
          no</span></td>
      </tr>
      <tr id="radio_w" class="none">
        <td><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text1" class="<?php showText($apr_a,'ethics_number');?>">
        <td class="light">Please provide ethics number: <span>
          <input disabled id="text1_t" name="text1" type="text" size="50" value="<?php printText($apr_a,'ethics_number');?>" />
          </span></td>
      </tr>
      <tr id="text1_w" class="none">
        <td class="light"><p class="warning">*Please provide number</p></td>
      </tr>
      <tr id="text2" class="<?php showText($apr_a,'ethics_number');?>">
        <td>If you ticked yes and you do not have ethics approval, please indicate why and when this will be done:
          <textarea disabled id="text2_t" name="text2" style="width:99%; height:200px"><?php printText($apr_a,'ethics_detail');?></textarea></td>
      </tr>
    </table>
  </form>
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
	  $milestone_num=printmilestone($apr_a,'milestone_c',1,'light');
	  ?>
      <tr>
        <td>New Milestones (next 12 months)</td>
        <td>Target Dates</td>
      </tr>
      <?php
	  $milestone_num=printmilestone($apr_a,'milestone_n',2,'');
	  ?>
      <tr class="light">
        <td colspan="2">Has there been any change to the focus of your research since your last report?<span>
          <input disabled name="radio3" type="radio" value="yes" onclick="show('text3'),hide('radio3_w')" <?php printRadioYes($apr_a,'change_focus_detail');?>/>
          yes
          <input disabled name="radio3" type="radio" value="no" onclick="hide('text3'),hide('radio3_w'),hide('text3_w')" <?php printRadioNo($apr_a,'change_focus_detail');?>/>
          no</span></td>
      </tr>
      <tr id="radio3_w" class="none">
        <td colspan="2" class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text3" class="<?php showText($apr_a,'change_focus_detail');?>">
        <td colspan="2" class="light">If yes please provide details below:
          <textarea disabled id="text3_t" name="text3" style="width:99%; height:200px"><?php printText($apr_a,'change_focus_detail');?></textarea></td>
      </tr>
      <tr id="text3_w" class="none">
        <td colspan="2" class="light"><p class="warning">*Please provide details</p></td>
      </tr>
      <tr>
        <td colspan="2">Have there been any problems/issues that may have affected your progress during the reporting period?<span>
          <input disabled name="radio4" type="radio" value="yes" onclick="show('text4'),hide('radio4_w')" <?php printRadioYes($apr_a,'issues_detail');?>/>
          yes
          <input disabled name="radio4" type="radio" value="no" onclick="hide('text4'),hide('radio4_w'),hide('text4_w')" <?php printRadioNo($apr_a,'issues_detail');?>/>
          no</span></td>
      </tr>
      <tr id="radio4_w" class="none">
        <td colspan="2" class="light"><p class="warning">*Please tick one option</p></td>
      </tr>
      <tr id="text4" class="<?php showText($apr_a,'change_focus_detail');?>">
        <td colspan="2">If yes, Please detail the steps you've taken to resolve these problems/issues:<br />
          (Please include any
          suspension in this reporting year)
          <textarea disabled id="text4_t" name="text4" style="width:99%; height:200px"><?php printText($apr_a,'issues_detail');?></textarea></td>
      </tr>
      <tr id="text4_w" class="none">
        <td colspan="2"><p class="warning">*Please provide details</p></td>
      </tr>
      <tr>
        <td colspan="2" class="light">Please list any publications produced during the reporting period:</td>
      </tr>
      <?php $publication_num = printpublication($apr_a);?>
    </table>
  </form>
</div>
<div class="formflow_h" style="width:80%">
  <form name="form5" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>When do you intend to submit your thesis for examination?<span>
          <input disabled id="text1" name="text1" type="text" value="<?php printText($apr_a,'submission_thesis');?>" size="50" />
          </span></td>
      </tr>
      <tr id="text1_w" class="none">
        <td><p class="warning">*Please provide date</p></td>
      </tr>
      <tr class="light">
        <td>How Frequently do you and your supervisor(s) communicate about your thesis?</td>
      </tr>
      <tr class="light">
        <td>Please provide details below about communication with your supervisor. This should include:<br />
          •type of contact e.g. face to face<br />
          •details of written work submitted<br />
          •feedback received<br />
          •If you have not received feedback why this is the case<br />
          <textarea disabled id="text2" name="text2" style="width:99%; height:200px"><?php printText($apr_a,'comunication_with_sup');?></textarea></td>
      </tr>
      <tr id="text2_w" class="none">
        <td><p class="warning">*Please provide detail</p></td>
      </tr>
      <?php
	  if($stud['Sc_NO']==6 &&( isset($apr_d_a) || isset($apr_d_b)))
          {
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
          <input disabled type="radio" name="radio3" value="yes" onclick="show('text3')" <?php printRadioYes($apr_d_a,'stp_workshop_date');?>/>
          yes
          <input disabled type="radio" name="radio3" value="no" onclick="hide('text3')" <?php printRadioNo($apr_d_a,'stp_workshop_date');?>/>
          no</span></td>
      </tr>
      <tr id="text3" class="<?php showText($apr_d_a,'stp_workshop_date');?>">
        <td class="light"> Date attended:<span>
          <input disabled id="text3_t" name="text3" type="text" value="<?php printText($apr_d_a,'stp_workshop_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr>
        <td>OR</td>
      </tr>
      <tr>
        <td class="light"> I was unable to attend the workshop 'Starting the PhD'. As a substitute, I completed the required written assignment and sent it to my Principal Supervisor.<span>
          <input disabled type="radio" name="radio4" value="yes" onclick="show('text4')" <?php printRadioYes($apr_d_a,'assignment_date');?>/>
          yes
          <input disabled type="radio" name="radio4" value="no" onclick="hide('text4')" <?php printRadioNo($apr_d_a,'assignment_date');?>/>
          no</span></td>
      </tr>
      <tr id="text4" class="<?php showText($apr_d_a,'assignment_date');?>">
        <td class="light"> Date sent to supervisor:<span>
          <input disabled id="text4_t" name="text4"type="text" value="<?php printText($apr_a,'assignment_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr>
        <td>I attended and reported to my Principal Supervisor on the following four academic research seminars,using the reporting guidelines provided to me.<br />
          (Please give title of seminar, name of speaker, date and location of presentation.)
          <textarea disabled name="texta1" style="width:99%; height:200px"><?php printText($apr_d_a,'p_sup_reporting');?></textarea></td>
      </tr>
      <tr>
        <td class="light"> I attended the two days of Thesis Development Workshops.<span>
          <input disabled type="radio" name="radio5" value="yes" onclick="show('text5')" <?php printRadioYes($apr_d_a,'td_workshop_date');?>/>
          yes
          <input disabled type="radio" name="radio5" value="no" onclick="hide('text5')" <?php printRadioNo($apr_d_a,'td_workshop_date');?>/>
          no</span></td>
      </tr>
      <tr id="text5" class="<?php showText($apr_d_a,'td_workshop_date');?>">
        <td class="light"> Dates attended:<span>
          <input disabled id="text5_t" name="text5"type="text" value="<?php printText($apr_a,'td_workshop_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr>
        <td> I attended the Dress Rehearsal for the One-Day Conference.<span>
          <input disabled type="radio" name="radio6" value="yes" onclick="show('text6')" <?php printRadioYes($apr_d_a,'dr_odc_date');?>/>
          yes
          <input disabled type="radio" name="radio6" value="no" onclick="hide('text6')" <?php printRadioNo($apr_d_a,'dr_odc_date');?>/>
          no</span></td>
      </tr>
      <tr id="text6" class="<?php showText($apr_d_a,'dr_odc_date');?>">
        <td> Date attended:<span>
          <input disabled id="text6_t" name="text6"type="text" value="<?php printText($apr_a,'dr_odc_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr>
        <td class="light"> I gave an oral presentation at the One-Day Conference.<span>
          <input disabled type="radio" name="radio7" value="yes" onclick="show('text7')" <?php printRadioYes($apr_d_a,'op_odc_date');?>/>
          yes
          <input disabled type="radio" name="radio7" value="no" onclick="hide('text7')" <?php printRadioNo($apr_d_a,'op_odc_date');?>/>
          no</span></td>
      </tr>
      <tr id="text7" class="<?php showText($apr_d_a,'op_odc_date');?>">
        <td class="light"> Date of presentation:<span>
          <input disabled id="text7_t" name="text7"type="text" value="<?php printText($apr_a,'op_odc_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr>
        <td><b>B. For students completing the second year of enrolment (or fourth year part-time)</b></td>
      </tr>
      <tr>
        <td class="light"> I have given my mid-candidature seminar presentation.<span>
          <input disabled type="radio" name="radio8" value="yes" onclick="show('text8'),show('text9')" <?php printRadioYes($apr_d_b,'mcs_presentation_date');?>/>
          yes
          <input disabled type="radio" name="radio8" value="no" onclick="hide('text8'),hide('text9')" <?php printRadioNo($apr_d_b,'mcs_presentation_date');?>/>
          no</span></td>
      </tr>
      <tr id="text8" class="<?php showText($apr_d_b,'mcs_presentation_date');?>">
        <td class="light"> Date of presentation:<span>
          <input disabled id="text8_t" name="text8"type="text" value="<?php printText($apr_d_b,'mcs_presentation_date');?>" size="50"/>
          </span></td>
      </tr>
      <tr id="text9" class="<?php showText($apr_d_b,'mcs_presentation_date');?>">
        <td class="light"> Title of presentation:<span>
          <input disabled id="text9_t" name="text9"type="text" value="<?php printText($apr_d_b,'mcs_presentation_title');?>" size="90"/>
          </span></td>
      </tr>
      <tr>
        <td><b>Additional comments, if any</b>
          <textarea disabled name="texta2" style="width:99%; height:200px"><?php printText($apr_d_a,'additional_comment'); printText($apr_d_b,'additional_comment');?></textarea></td>
      </tr>
      <?php
}
?>
      <tr class="<?php showText($apr_a,'rejected_comment');?>">
        <td><b>The reason why supervisor rejected this APR</b>
          <textarea disabled name="texta3" style="width:99%; height:200px"><?php printText($apr_a,'rejected_comment');?></textarea></td>
      </tr>
    </table>
  </form>
</div>
