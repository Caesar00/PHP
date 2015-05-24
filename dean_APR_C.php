<?php
session_start();
if(isset($_SESSION['apr_c']))
{
		$apr_c = $_SESSION['apr_c'];
}
if (isset($_POST['submitAPR'])) 
{
    // Save to session, move on to 3. Submit
    $apr_c['discontinue']=$_POST['discontinue'];
    $apr_c['discontinue_reason']=$_POST['discontinue_reason'];
    
    if(isset($_POST['discontinue']))
    {
        if($_POST['discontinue']=="No")
        {
            if(empty ($_POST['discontinue_reason']))
            {
                $err = "Please fill out all fields!";
            }
            else
                $err="No";
        }
        else
        {
            $err="No";
        }
    }
    else
        $err = "Please fill out all fields!";
    
    $apr_c['err']=$err;
    $_SESSION['apr_c']=$apr_c;
    session_commit();
    if($err=="No")
        header("Location: dean_APR.php?cont=APR&act=submit&page=4");       
}

?>

<div class="formflow_h" style="width:80%">
  <p class="warning">
    <?php if(isset($err)&&$err!="No") echo $err ?>
  </p>
  <form name="form1" id="form1" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Do you recommend the students continued enrolment and the continuation of the student's scholarship (if applicable)? <span>
          <input type="radio" name="discontinue" value="Yes" onclick="hide('discontinue_reason');"/>
          Yes
          <input type="radio" name="discontinue" value="No" onclick="show('discontinue_reason');"/>
          No</span>
      </tr>
      <tr id="discontinue_reason" class="none">
        <td>If the student is not supported in their continued enrolment, or there are special conditions, requirements or additional milestones which apply to this student, please give details. Clear lines of responsibility regarding these conditions should also be established.
          <p>
            <textarea id="discontinueArea" name="discontinue_reason" maxlength='2000' style="width: 99%; height: 200px;"></textarea>
          </p></td>
      </tr>
      <tr>
        <td> I <b><?php echo $fullname ?></b>, hereby acknowledge and agree to the information submitted in this APR.
          <span><input type="checkbox" name="acknowledge" id="acknowledge" value="acknowledge"/></span></td>
      </tr>
    </table>
    <p class="buttons">
       <a href="#" onclick="document.form1.submitAPR.value='next';document.form1.submit();" style="display:none">Submit APR ></a>
      <input type="hidden" name="submitAPR" value=""/>
    </p>
  </form>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$(':checkbox').click(function(){
		$("[href='#']").show();
	});
});
</script> 
