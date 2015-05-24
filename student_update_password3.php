<?php
session_start();
$query = "SELECT * FROM citizenship";
$result = mysqli_query($con,$query) or mysqli_error($con);
while($row = mysqli_fetch_array($result))
{
	$countries[] = $row;
}
$password_err = false;
if(isset($_POST['param']))
{
	if($user['password'] == $_POST['text1'])
	{
		$password = $_POST['text2'];
		$query = "UPDATE applicant SET password='$password' WHERE App_NO = $user[App_NO]";
		$result = mysqli_query($con,$query) or mysqli_error($con);
		if($result)
		{
            $_SESSION['update_msg'] = "Your password has been chagned.";
            session_commit();
			header("Location: student_index3.php?act=password");
		}
	}
	else
	{
		$password_err = true;
	}
}
?>
<script language="javascript" type='text/javascript'>
function submitform(str)
{
    if ($('#text2').text() === $('#text3').text()) {
        document.form1.param.value=str;
        document.form1.submit();
    }
    else {
       alert("PASSWORD DOES NOT MATCH");
       return;
    }
}
</script>
<div class="container">
    <form class="form-horizontal" name="form1" method="post">
        <fieldset>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Account Password</h4>
                </div>
                <div class="panel-body">
                <?php
                    if($password_err) {
                        echo '<div class="alert alert-dismissable alert-danger text-center">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>Failed to change password</strong>. Please enter correct passwrod.</div>'; 
                    }
                    if(isset($_SESSION['update_msg'])) {
                        echo '<div class="alert alert-dismissable alert-success text-center">
                            <button type="button" class="close" data-dismiss="alert">×</button>'
                            .$_SESSION['update_msg'].'</div>'; 
                    }
                    unset($_SESSION['update_msg']);
                    session_commit();
                ?>

                    <div class="form-group">
                        <label for="text1" class="col-sm-2 control-label text-muted">Current</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" id="text1" name="text1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text2" class="col-sm-2 control-label">New</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="text2" name="text2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text3" class="col-sm-2 control-label">Confirm</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="text3" name="text3" placeholder="Type in new password again">
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <input name="param" type="hidden" value="" />
                    <a class="btn btn-primary" href="javascript:void();" onclick="submitform('update')">Change</a>
                </div>
            </div>
        </fieldset>
    </form>
</div>
