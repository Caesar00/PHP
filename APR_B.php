<?php
//include ("library.php");
session_start();
if(!isset($_SESSION) || !isset($_SESSION['status']))
    header("Location: staff_login.php");
else if($_SESSION['status']!="Sup" && $_SESSION['status']!="Dean")
    header("Location: 403error.php");
if(isset($_SESSION['apr_b']))
{
        $apr_b = $_SESSION['apr_b'];
}
else
{
        //header("Location: staff_APR.php?cont=APR");
}
if (isset($_POST['next'])) 
{
	$apr_b['progressRate']=$_POST['progressRate'];
	$apr_b['informGRO']=$_POST['informGRO'];
	$apr_b['thesisSubmittable']=$_POST['thesisSubmittable'];
	$apr_b['submissionDetail']=$_POST['submissionDetail'];
	$apr_b['lateSubmits']=$_POST['lateSubmits'];
	$apr_b['avoidContact']=$_POST['avoidContact'];
	$apr_b['supChanged']=$_POST['supChanged'];
	$apr_b['lowInterest']=$_POST['lowInterest'];
	$apr_b['comment1']=$_POST['comment1'];
	$apr_b['milestoneComp']=$_POST['milestoneComp'];
	$apr_b['sufficientDetail']=$_POST['sufficientDetail'];
	$apr_b['paperProduce']=$_POST['paperProduce'];
	$apr_b['draftStandard']=$_POST['draftStandard'];
	$apr_b['comment2']=$_POST['comment2'];
	$apr_b['studLeave']=$_POST['studLeave'];
	$apr_b['overall']=$_POST['overall'];
	$apr_b['supLeave']=$_POST['supLeave'];
	$apr_b['altSupArea']=$_POST['altSupArea'];
// Save to session, move on to 2. Recommendations
	if(!isset($_POST['progressRate'],$_POST['thesisSubmittable'],$_POST['lateSubmits'],$_POST['avoidContact'],$_POST['supChanged'],$_POST['lowInterest'],$_POST['milestoneComp'],$_POST['sufficientDetail'],$_POST['paperProduce'],$_POST['draftStandard'],$_POST['studLeave'],$_POST['overall'],$_POST['supLeave']) || trim($_POST['overall'])=="")
	$err="Please fill out all fields!";
	else
	{
		$err="No";

	}
    $apr_b['err']=$err;
    $_SESSION['apr_b']=$apr_b;
    session_commit();
    if($err=="No")
    {
        header("Location: staff_APR.php?cont=APR&act=submit&page=3");
    }
}
session_commit();
?>
<div class="formflow_b"  style="width:80%" >
  <table cellspacing="3" cellpadding="4" style="width:100%" >
    <tr>
      <td>Student Progress ></td>
      <td class="unselected">Recommendations ></td>
      <td class="unselected">Submission ></td>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <p class="warning">
    <?php if(isset($err)&&$err!="No") echo $err ?>
  </p>
  <form name="form1" id="form1" method="post">
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="dark" />
      <tr>
        <td>Please rate the student's progress: <span>
          <select name="progressRate">
            <option></option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Satisfactory">Satisfactory</option>
            <option value="Marginal">Marginal</option>
            <option value="Unsatisfactory">Unsatisfactory</option>
          </select>
          </span></td>
      </tr>
      <tr id="lowProgress" class="none">
        <td class="dark">Have you informed the student of the above rated progress in writing with a copy to the Graduate Research Office? <span>
          <input type="radio" name="informGRO" value="Yes" <?php printRadio($apr_b,'informGRO','Yes');?>/>
          Yes
          <input type="radio" name="informGRO" value="No" <?php printRadio($apr_b,'informGRO','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td class="light">On the basis of current progress, is the student likely to submit the thesis by the date mentioned in Section A, Question 5?<span>
          <input type="radio" name="thesisSubmittable" value="Yes" onclick="hide('submissionDetail');" <?php printRadioNo($apr_b,'thesisSubmittable');?>/>
          Yes
          <input type="radio" name="thesisSubmittable" value="No" onclick="show('submissionDetail')" <?php printRadioYes($apr_b,'thesisSubmittable');?>/>
          No </span></td>
      </tr>
      <tr id="submissionDetail" class="<?php showText($apr_b,'submissionDetail');?>">
        <td class="light">When do you expect the thesis to be submitted? Indicate correspondence you have had with the student on progress:
          <p>
            <textarea id="textArea1" name="submissionDetail" style="width: 99%; height: 200px;"><?php printText($apr_b,'submissionDetail');?></textarea>
          </p></td>
      </tr>
    </table>
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="dark" />
      <tr>
        <td>Does the student tend to fail to meet deadlines, e.g. hand in reports late without good reason?<span>
          <input type="radio" name="lateSubmits" value="Yes" onclick="window.lateSubmit=true;clarifyComment1();" <?php printRadio($apr_b,'lateSubmits','Yes');?>/>
          Yes
          <input type="radio" name="lateSubmits" value="No" onclick="window.lateSubmit=false;clarifyComment1();" <?php printRadio($apr_b,'lateSubmits','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student tend to avoid meeting/contacting you?<span>
          <input type="radio" name="avoidContact" value="Yes" onclick="window.avoidMeet=true;clarifyComment1();" <?php printRadio($apr_b,'avoidContact','Yes');?>/>
          Yes
          <input type="radio" name="avoidContact" value="No" onclick="window.avoidMeet=false;clarifyComment1();" <?php printRadio($apr_b,'avoidContact','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Has the student experienced changes in supervision?<span>
          <input type="radio" name="supChanged" value="Yes" onclick="window.supChanged=true;clarifyComment1();" <?php printRadio($apr_b,'supChanged','Yes');?>/>
          Yes
          <input type="radio" name="supChanged" value="No" onclick="window.supChanged=false;clarifyComment1();" <?php printRadio($apr_b,'supChanged','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student show signs of a diminishing interest, commitment or motivation?<span>
          <input type="radio" name="lowInterest" value="Yes" onclick="window.lowInterest=true;clarifyComment1();" <?php printRadio($apr_b,'lowInterest','Yes');?>/>
          Yes
          <input type="radio" name="lowInterest" value="No" onclick="window.lowInterest=false;clarifyComment1();" <?php printRadio($apr_b,'lowInterest','No');?>/>
          No </span></td>
      </tr>
      <tr id="clarifyComment1"  class="<?php showText($apr_b,'comment1');?>">
        <td>For any answer to the <b>4</b> questions above with <b>"Yes"</b>, where applicable, the supervisor is expected to provide additional comments for clarification:
          <p>
            <textarea id="clarifyCommentArea1" name="comment1" style="width: 99%; height: 200px;"><?php printText($apr_b,'comment1');?></textarea>
          </p></td>
      </tr>
    </table>
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="light" />
      <tr>
        <td>Has the student completed the milestones as set out in the POS or previous APR?<span>
          <input type="radio" name="milestoneComp" value="Yes" onclick="window.milestoneComp=true;clarifyComment2();" <?php printRadio($apr_b,'milestoneComp','Yes');?>/>
          Yes
          <input type="radio" name="milestoneComp" value="No" onclick="window.milestoneComp=false;clarifyComment2();" <?php printRadio($apr_b,'milestoneComp','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the report provide sufficient detail in the proposed work schedule for the next 12 months?<span>
          <input type="radio" name="sufficientDetail" value="Yes" onclick="window.sufficientDetail=true;clarifyComment2();" <?php printRadio($apr_b,'sufficientDetail','Yes');?>/>
          Yes
          <input type="radio" name="sufficientDetail" value="No" onclick="window.sufficientDetail=false;clarifyComment2();" <?php printRadio($apr_b,'sufficientDetail','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student produce research or conference papers?<span>
          <input type="radio" name="paperProduce" value="Yes" onclick="window.paperProduce=true;clarifyComment2();" <?php printRadio($apr_b,'paperProduce','Yes');?>/>
          Yes
          <input type="radio" name="paperProduce" value="No" onclick="window.paperProduce=false;clarifyComment2();" <?php printRadio($apr_b,'paperProduce','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student produce draft chapters of adequate standard?<span>
          <input type="radio" name="draftStandard" value="Yes" onclick="window.draftStandard=true;clarifyComment2();" <?php printRadio($apr_b,'draftStandard','Yes');?>/>
          Yes
          <input type="radio" name="draftStandard" value="No" onclick="window.draftStandard=false;clarifyComment2();" <?php printRadio($apr_b,'draftStandard','No');?>/>
          No </span></td>
      </tr>
      <tr id="clarifyComment2" class="<?php showText($apr_b,'comment2');?>">
        <td>For any answer to the <b>4</b> questions above with <b>"No"</b>, where applicable, the supervisor is expected to provide additional comments for clarification:
          <p>
            <textarea id="clarifyCommentArea2" name="comment2" style="width: 99%; height: 200px;"><?php printText($apr_b,'comment2');?></textarea>
          </p></td>
      </tr>
    </table>
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="dark" />
      <tr>
        <td>Are you aware of the student taking any Personal or Annual leave within the last <b>12</b> months?<span>
          <input type="radio" name="studLeave" value="Yes" <?php printRadio($apr_b,'studLeave','Yes');?>/>
          Yes
          <input type="radio" name="studLeave" value="No" <?php printRadio($apr_b,'studLeave','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Please briefly comment on the student's overall progress:
          <p>
            <textarea id="overall" name="overall" style="width: 99%; height: 200px;"><?php printText($apr_b,'overall');?></textarea>
          </p></td>
      </tr>
      <tr>
        <td>Do you expect to be absent from the University for more than <b>3</b> months during the next year?<span>
          <input type="radio" name="supLeave" value="Yes" onclick="show('altSup')" <?php printRadioYes($apr_b,'supLeave');?>/>
          Yes
          <input type="radio" name="supLeave" value="No" onclick="hide('altSup')" <?php printRadioNo($apr_b,'supLeave');?>/>
          No </span></td>
      </tr>
      <tr id="altSup" class="<?php showText($apr_b,'altSupArea');?>">
        <td>Please provide name(s) of alternative supervisor(s) or details of alternative supervisory arrangements for the student:
          <p>
            <textarea id="altSupArea" name="altSupArea" style="width: 99%; height: 100px;"><?php printText($apr_b,'altSupArea');?></textarea>
          </p></td>
      </tr>
    </table>
    <p class="buttons">
      <input type="hidden" name="next" value="" />
      <a href="#" onclick="document.form1.next.value='Next >';document.form1.submit();">Next ></a> </p>
  </form>
</div>
<script language="javascript" type='text/javascript'>
$(document).ready(function(){
	$("[name='progressRate']").each(function(){
		var value = '<?php if(isset($apr_b['progressRate']))echo $apr_b['progressRate']?>';
		$(this).val([value]);
		if(value=='Marginal'||value=='Unsatisfactory')
		{
			$('#lowProgress').removeClass();
		}
	});
	$("[name='progressRate']").change(function(){
		$("option[value='']").remove();
		if($(this).val()=='Marginal' || $(this).val()=='Unsatisfactory')
			$("#lowProgress").show();
		else
			$("#lowProgress").hide();
	});
});
window.milestoneComp = true;
window.sufficientDetail = true;
window.paperProduce = true;
window.draftStandard = true;
function clarifyComment1()
{
	if(window.lowInterest || window.supChanged || window.avoidMeet || window.lateSubmit)
	{
		show('clarifyComment1');
	}
	else
	{
		hide('clarifyComment1');
	}
}
function clarifyComment2()
{
	if(!window.milestoneComp || !window.sufficientDetail || !window.paperProduce || !window.draftStandard)
	{
		show('clarifyComment2');
	}
	else
	{
		hide('clarifyComment2');
	}
}      
</script> 
