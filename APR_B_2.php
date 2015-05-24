<?php
session_start();
if(!isset($_SESSION) || !isset($_SESSION['status']))
    header("Location: staff_login.php");
else if($_SESSION['status']!="Sup" && $_SESSION['status']!="Dean")
    header("Location: 403error.php");
if(isset($_SESSION['apr_b']))
{
		$apr_b = $_SESSION['apr_b'];
}
if (isset($_POST['submitAPR'])) 
{
    // Save to session, move on to 3. Submit
    $apr_b['discontinue']=$_POST['discontinue'];
    $apr_b['discontinueStatement']=$_POST['discontinueStatement'];
    
    if(isset($_POST['discontinue']))
    {
        if($_POST['discontinue']=="No")
        {
            if(empty ($_POST['discontinueStatement']))
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
    
    $apr_b['err2']=$err;
    $_SESSION['apr_b']=$apr_b;
    session_commit();
    if($err=="No")
	{
        header("Location: staff_APR.php?cont=APR&act=submit&page=4");   
	}
}
?>

<div class="formflow_b" style="width:80%">
  <table cellspacing="3" cellpadding="4" style="width:100%" >
    <tr>
      <td class="unselected">Student Progress ></td>
      <td>Recommendations ></td>
      <td class="unselected">Submission ></td>
    </tr>
  </table>
</div>
<div class="formflow_h" style="width:80%">
  <p class="warning">
    <?php if(isset($err)&&$err!="No") echo $err ?>
  </p>
  <form name="form1" id="form1" method="post">
    <table cellspacing="3" cellpadding="5">
      <col class="dark" />
      <tr>
        <td>Do you recommend the students continued enrolment and the continuation of the student's scholarship (if applicable)? <span>
          <input type="radio" name="discontinue" value="Yes" onclick="hide('discontinueStatement');"/>
          Yes
          <input type="radio" name="discontinue" value="No" onclick="show('discontinueStatement');"/>
          No</span>
      </tr>
      <tr id="discontinueStatement" class="none">
        <td>Please provide a statement giving your reason, and copies of correspondence to the student:
          <p>
            <textarea id="discontinueArea" name="discontinueStatement" maxlength='2000' style="width: 99%; height: 200px;"></textarea>
          </p></td>
      </tr>
      <tr>
        <td> I <b><?php echo $fullname ?></b>, hereby acknowledge and agree to the information submitted in this APR. <span>
          <input type="checkbox" name="acknowledge" id="acknowledge" value="acknowledge" />
          </span></td>
      </tr>
    </table>
    <p class="buttons"> <a href="staff_APR.php?cont=APR&act=submit&page=2">< Previous</a> <a href="#" onclick="document.form1.submitAPR.value='next';document.form1.submit();" style="display:none">Submit APR ></a>
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
