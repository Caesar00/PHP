<?php 
session_start();
if(isset($_SESSION['apr_c']))
{
        $apr_c = $_SESSION['apr_c'];
}
session_commit();
?>

<div class="formflow_h" style="width:80%">
  <form name="form1" id="form1" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Do you recommend the students continued enrolment and the continuation of the student's scholarship (if applicable)? <span>
          <input type="radio" name="discontinue" value="Yes" <?php printRadioNo($apr_c,'discontinue_reason');?>/>
          Yes
          <input type="radio" name="discontinue" value="No" <?php printRadioYes($apr_c,'discontinue_reason');?>/>
          No</span>
      </tr>
      <tr id="discontinue_reason" class="<?php showText($apr_c,'discontinue_reason');?>">
        <td>If the student is not supported in their continued enrolment, or there are special conditions, requirements or additional milestones which apply to this student, please give details. Clear lines of responsibility regarding these conditions should also be established.
          <p>
            <textarea id="discontinueArea" name="discontinue_reason" maxlength='2000' style="width: 99%; height: 200px;"><?php printText($apr_c,'discontinue_reason');?></textarea>
          </p></td>
      </tr>
    </table>
  </form>
</div>
