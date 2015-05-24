<?php
$query = "SELECT * FROM citizenship";
$result = mysqli_query($con,$query) or mysqli_error($con);
while($row = mysqli_fetch_array($result))
{
	$countries[] = $row;
}
if(isset($_POST['param']))
{
	$detail['salutation'] = $_POST['select1'];
	$detail['firstname'] = $_POST['text1'];
	$detail['surname'] = $_POST['text2'];
	$detail['citizenship'] = $_POST['select2'];
	$detail['telephone'] = $_POST['text3'];
	$detail['email'] = $_POST['text4'];
	$query = "UPDATE applicant SET salutation='$detail[salutation]', firstname='$detail[firstname]', surname='$detail[surname]',citizenship='$detail[citizenship]', telephone='$detail[telephone]',email='$detail[email]' WHERE App_NO = $user[App_NO]";
	$result = mysqli_query($con,$query) or mysqli_error($con);
	if($result)header("Location: student_index.php");
}
function printSalutation($param)
{
	$salutation = array('Mr','Ms','Mrs','Mdm','Dr','Prof');
	foreach( $salutation as $value)
	{
		echo "<option value='$value' ";
		if($value == $param)
		{
			echo "selected = 'selected'";
		}
		echo ">$value</option>";
	}
}
function printCitizenship($array,$param)
{
	foreach( $array as $value)
	{
		echo "<option value='$value[citizenship]' ";
		if($value['citizenship'] == $param)
		{
			echo "selected = 'selected'";
		}
		echo ">$value[country_name]</option>";
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
	for(var j=1;j<5;j++)
	{
		var text = document.getElementsByName('text'+i);
		if(text[0] != null && text[0].value == '')
		{
			var text_w = $id('text'+i+'_w');
			text_w.className = "";
			result = true;
		}
	}
}
</script>
<div id="right_window" class="container2">
<div class="title"> Update Your Personal Details </div>
<div class="content">
<div class="formflow_h" style="width:80%">
<form name="form1" method="post">
  <table cellspacing="3" cellpadding="5" style="width:100%">
    <col class="dark"  style="width:170px"/>
    <col class="light" style="width:200px"/>
    <col class="dark"  style="width:170px"/>
    <col class="light" />
    <tr>
      <td class="dark">Salutation</td>
      <td colspan="3"><select name="select1" ><?php printSalutation($user['salutation']); ?></select></td>
    </tr>
    <tr>
      <td class="dark">Firstname</td>
      <td><input type="text" name="text1" value="<?php echo $user['firstname'] ?>" /></td>
      <td class="dark">Surname</td>
      <td><input type="text" name="text2" value="<?php echo $user['surname'] ?>" /></td>
    </tr>
    <tr>
      <td class="dark">Citizenship</td>
      <td colspan="3"><select name="select2" ><?php printCitizenship($countries,$user['citizenship']); ?></select></td>
    </tr>
    <tr>
      <td class="dark">Telephone</td>
      <td colspan="3"><input type="text" name="text3" value="<?php echo $user['telephone'] ?>" /></td>
    </tr>
    <tr>
      <td>Email Address</td>
      <td colspan="3"><input type="text" name="text4" value="<?php echo $user['email'] ?>" size="50" /></td>
    </tr>
  </table>
  <p class="buttons"><a href="javascript:void()" onclick="submitform(function(){},'update')">update</a></p>
  <input name="param" type="hidden" value="" />
</form>
</div>
<div style="height:1px"> </div>
</div>
