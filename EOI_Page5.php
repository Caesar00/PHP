<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature (Page 5 of 5)</title>
</head>
<link href="css/header.css" rel="stylesheet" type="text/css" />
<?php session_start(); 

?>
<script>
function button_chk()
{
 var agreement = document.agreement;
  if( agreement.agreementchk.checked == true )
        {
            agreement.submit.disabled=false;
        }else
        {
            agreement.submit.disabled=true;
        }
}
</script>

<?php 
if(!isset($_SESSION['scholarqn1'])){
header("Location: EOI_Page3.php");}//force to go to previous page if mandatory field is not set first

if(isset($_POST['submit']))
{
	$_SESSION['agreement']=$_POST['agreement'];
	header("Location: uploadeoi.php");
}
?>
<body>
<table border="0" align="center">
  
  <tr>
    <td>
    <div id="header"> 
<div id="logo"></div>
</div>
  <div id="navbar">EXPRESSION OF INTEREST IN HIGHER DEGREE RESEARCH CANDIDATURE</div><div><img border="0" src="Image/Nav/Page 5.png" width="1072" height="" /></div></td>
</tr>


  <tr>
    <td>
      <form id="agreement" name="agreement" method="post" action="">
<table width="95%" border="0" align="center" id="outertable"  >
          
          <tr>
            <td colspan="2" style="padding:5px 40px ;"><h2><strong>Statement by Proposer</strong></h2>
              <p><strong>I AGREE TO</strong></p>
              <ul>
              <li>Notify the School and the Graduate Research Office of any change to the information I have given in this expression of interest</li>
            </ul>              <strong>I UNDERSTAND THAT</strong>
<ul>
	<li>The University may vary or cancel any decision it makes it the information I have given is incorrect or incomplete</li>
              <li>The University is not responsible for the loss of any documents submitted</li>
              <li>Submission of this form does not guarantee acceptance to a higher degree research program</li>
              <li>Giving false or misleading information is a serious offence under the Criminal Code (Commonwealth of Australia)</li>
            </ul>            <strong>I HAVE  </strong>
            <label><br />&emsp;&emsp;
              <input type="checkbox" name="agreementchk" id="agreementchk" onclick="button_chk()" autocomplete="off" value="agreed" />
            
			Answered all questions on this form truthfully </label><br /><br/></td></tr>
			<tr><td>
			<input type="button" name="back"class="btn1"value="Back" onClick="location.href='EOI_Page4.php'" /></td>
			<td id="form1" align="right">
            <input type="submit" name="submit"  width="70" class="btn1" value="SUBMIT" disabled="disabled"  />
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
    </form></td>
  </tr>
  <tr>
    <td>
          <footer id ="colophon">
    <?php
	include ("footer.php");
	?>
    </footer>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>