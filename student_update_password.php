<?php
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
			header("Location: student_index.php");
		}
	}
	else
	{
		$password_err = true;
	}
}
?>
<script language="javascript" type='text/javascript'>
function submitform(func,str)
{
	var result = func();
	if(result)
	{
		return;
	}
	document.form1.param.value=str;
	document.form1.submit();
}
function validation()
{
	var result = false;
	for(var i=1;i<4;i++)
	{
		var text = document.getElementsByName('text'+i);
		if(text[0] != null && text[0].value == '')
		{
			var text_w = $id('text'+i+'_w');
			text_w.className = "";
			result = true;
		}
	}
	var text1 = document.getElementsByName('text2');
	var text2 = document.getElementsByName('text3');
	if(text1[0].value != text2[0].value)
	{
		var text3_w = $id('text3_w');
		text3_w.className = "";
		result = true;
	}
	return result;
}
</script>
<div id="right_window" class="container2">
<div class="title"> Update Your Personal Details </div>
<div class="content">
<div class="formflow_h" style="width:80%">
<form name="form1" method="post">
  <table cellspacing="3" cellpadding="5" style="width:100%">
    <col class="dark" style="width:30%"/>
    <col class="light"/>
    <tr>
      <td class="dark"><span>Current Password</span></td>
      <td><input type="password" name="text1" value="" style="width:50%"/><font id="text1_w" <?php if(!$password_err) echo "class='none'" ?> style="color:#f00;font-weight:bold; margin-left:20px">*Invalid password</font></td>
    </tr>
    <tr>
      <td class="dark"><span>New Password</span></td>
      <td><input type="password" name="text2" value="" style="width:50%"/><font id="text2_w" class="none" style="color:#f00;font-weight:bold; margin-left:20px">*Please input a password</font></td>
    </tr>
    <tr>
      <td class="dark"><span>Confirm New Password</span></td>
      <td><input type="password" name="text3" value="" style="width:50%"/><font id="text3_w" class="none" style="color:#f00;font-weight:bold; margin-left:20px">*Passwords do not match</font></td>
    </tr>
  </table>
  <p class="buttons"><a href="javascript:void()" onclick="submitform(validation,'update')">update</a></p>
  <input name="param" type="hidden" value="" />
</form>
</div>
<div style="height:1px"> </div>
</div>
