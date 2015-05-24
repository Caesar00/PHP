<?php 
session_start();
if(isset($_SESSION['apr_b']))
{
        $apr_b = $_SESSION['apr_b'];
}
session_commit();
?>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$("[name='progressRate']").each(function(){
		var value = '<?php echo $apr_b['rate']?>';
		$(this).val([value]);
		if(value=='Marginal'||value=='Unsatisfactory')
		{
			$('#lowProgress').removeClass();
		}
	});
	$("input:text").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("input:radio").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("input:checkbox").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("textarea").each(function(){
		$(this).attr("disabled","disabled");
	});
	$("select").each(function(){
		$(this).attr("disabled","disabled");
	});
});
</script>

<div class="formflow_h" style="width:80%">
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
          <input type="radio" name="informGRO" value="Yes" <?php printRadio($apr_b,'standard_produce','Yes');?>/>
          Yes
          <input type="radio" name="informGRO" value="No" <?php printRadio($apr_b,'standard_produce','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td class="light">On the basis of current progress, is the student likely to submit the thesis by the date mentioned in Section A, Question 5?<span>
          <input type="radio" name="thesisSubmittable" value="Yes" <?php printRadioNo($apr_b,'submission_detail');?>/>
          Yes
          <input type="radio" name="thesisSubmittable" value="No" <?php printRadioYes($apr_b,'submission_detail');?>/>
          No </span></td>
      </tr>
      <tr id="submissionDetail" class="<?php showText($apr_b,'submission_detail');?>">
        <td class="light">When do you expect the thesis to be submitted? Indicate correspondence you have had with the student on progress:
          <p>
            <textarea id="textArea1" name="submissionDetail" style="width: 99%; height: 200px;"><?php printText($apr_b,'submission_detail');?></textarea>
          </p></td>
      </tr>
    </table>
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="dark" />
      <tr>
        <td>Does the student tend to fail to meet deadlines, e.g. hand in reports late without good reason?<span>
          <input type="radio" name="lateSubmits" value="Yes" <?php printRadio($apr_b,'fail_deadline','Yes');?>/>
          Yes
          <input type="radio" name="lateSubmits" value="No" <?php printRadio($apr_b,'fail_deadline','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student tend to avoid meeting/contacting you?<span>
          <input type="radio" name="avoidContact" value="Yes" <?php printRadio($apr_b,'avoid_contacting','Yes');?>/>
          Yes
          <input type="radio" name="avoidContact" value="No" <?php printRadio($apr_b,'avoid_contacting','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Has the student experienced changes in supervision?<span>
          <input type="radio" name="supChanged" value="Yes" <?php printRadio($apr_b,'change_experienced','Yes');?>/>
          Yes
          <input type="radio" name="supChanged" value="No" <?php printRadio($apr_b,'change_experienced','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student show signs of a diminishing interest, commitment or motivation?<span>
          <input type="radio" name="lowInterest" value="Yes" <?php printRadio($apr_b,'interest_diminishing','Yes');?>/>
          Yes
          <input type="radio" name="lowInterest" value="No" <?php printRadio($apr_b,'interest_diminishing','No');?>/>
          No </span></td>
      </tr>
      <tr id="clarifyComment1"  class="<?php showText($apr_b,'clarify_comment1');?>">
        <td>For any answer to the <b>4</b> questions above with <b>"Yes"</b>, where applicable, the supervisor is expected to provide additional comments for clarification:
          <p>
            <textarea id="clarifyCommentArea1" name="comment1" style="width: 99%; height: 200px;"><?php printText($apr_b,'clarify_comment1');?></textarea>
          </p></td>
      </tr>
    </table>
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="light" />
      <tr>
        <td>Has the student completed the milestones as set out in the POS or previous APR?<span>
          <input type="radio" name="milestoneComp" value="Yes" <?php printRadio($apr_b,'milestone_completed','Yes');?>/>
          Yes
          <input type="radio" name="milestoneComp" value="No" <?php printRadio($apr_b,'milestone_completed','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the report provide sufficient detail in the proposed work schedule for the next 12 months?<span>
          <input type="radio" name="sufficientDetail" value="Yes" <?php printRadio($apr_b,'sufficient_detail','Yes');?>/>
          Yes
          <input type="radio" name="sufficientDetail" value="No" <?php printRadio($apr_b,'sufficient_detail','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student produce research or conference papers?<span>
          <input type="radio" name="paperProduce" value="Yes" <?php printRadio($apr_b,'paper_produce','Yes');?>/>
          Yes
          <input type="radio" name="paperProduce" value="No" <?php printRadio($apr_b,'paper_produce','No');?>/>
          No </span></td>
      </tr>
      <tr>
        <td>Does the student produce draft chapters of adequate standard?<span>
          <input type="radio" name="draftStandard" value="Yes" <?php printRadio($apr_b,'standard_produce','Yes');?>/>
          Yes
          <input type="radio" name="draftStandard" value="No" <?php printRadio($apr_b,'standard_produce','No');?>/>
          No </span></td>
      </tr>
      <tr id="clarifyComment2" class="<?php showText($apr_b,'clarify_comment2');?>">
        <td>For any answer to the <b>4</b> questions above with <b>"No"</b>, where applicable, the supervisor is expected to provide additional comments for clarification:
          <p>
            <textarea id="clarifyCommentArea2" name="comment2" style="width: 99%; height: 200px;"><?php printText($apr_b,'clarify_comment2');?></textarea>
          </p></td>
      </tr>
    </table>
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="dark" />
      <tr>
        <td>Are you aware of the student taking any Personal or Annual leave within the last <b>12</b> months?<span>
          <input type="radio" name="studLeave" value="Yes" <?php printRadio($apr_b,'leaving_confirm','Yes');?>/>
          Yes
          <input type="radio" name="studLeave" value="No" <?php printRadio($apr_b,'leaving_confirm','No');?> />
          No </span></td>
      </tr>
      <tr>
        <td>Please briefly comment on the student's overall progress:
          <p>
            <textarea id="overall" name="overall" style="width: 99%; height: 200px;"><?php printText($apr_b,'overall_comment');?></textarea>
          </p></td>
      </tr>
      <tr>
        <td>Do you expect to be absent from the University for more than <b>3</b> months during the next year?<span>
          <input type="radio" name="supLeave" value="Yes" <?php printRadioYes($apr_b,'absent_arrangement');?>/>
          Yes
          <input type="radio" name="supLeave" value="No" <?php printRadioNo($apr_b,'absent_arrangement');?>/>
          No </span></td>
      </tr>
      <tr id="altSup" class="<?php showText($apr_b,'absent_arrangement');?>">
        <td>Please provide name(s) of alternative supervisor(s) or details of alternative supervisory arrangements for the student:
          <p>
            <textarea id="altSupArea" name="altSupArea" style="width: 99%; height: 100px;"><?php printText($apr_b,'absent_arrangement');?></textarea>
          </p></td>
      </tr>
    </table>
    <table cellspacing="3" cellpadding="5" style="width:100%">
      <col class="dark" />
      <tr>
        <td>Do you recommend the students continued enrolment and the continuation of the student's scholarship (if applicable)? <span>
          <input type="radio" name="discontinue" value="Yes" <?php printRadioNO($apr_b,'none_recommend_reason');?>/>
          Yes
          <input type="radio" name="discontinue" value="No" <?php printRadioYes($apr_b,'none_recommend_reason');?>/>
          No </span>
      </tr>
      <tr id="discontinueStatement" class="<?php showText($apr_b,'none_recommend_reason');?>">
        <td>Please provide a statement giving your reason, and copies of correspondence to the student:
          <p>
            <textarea id="discontinueArea" name="discontinueStatement" maxlength='2000' style="width: 99%; height: 200px;"><?php printText($apr_b,'none_recommend_reason');?></textarea>
          </p></td>
      </tr>
    </table>
  </form>
</div>
