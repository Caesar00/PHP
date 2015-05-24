<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature</title>
</head>
<link href="css/header.css" rel="stylesheet" type="text/css" />
<body>
<?php
session_start();
include "connection.php";
/* this shows the error message when the page goes white
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if ($_SESSION['is_admin'])
{
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}
ini_set('html_errors', 'On');*/
$errlogin="";

if (isset($_POST['login_btn'])) { //isset is used to not run following command if button not pressed	
	//retrieve login records from database
	$id= mysql_real_escape_string($_POST['staff_id']);
	$password= mysql_real_escape_string($_POST['pass']);
	
	$get_user = "SELECT * FROM staffs WHERE BINARY staff_id = BINARY '$id' AND BINARY password = BINARY '$password'";
	$get_user_res = mysql_query($get_user) or die(mysql_error());
	while($user = mysql_fetch_array( $get_user_res )) 
	{
		$staff_id=$user['staff_id'];
		$status=$user['status'];
		$last_login=$user['last_login']; //lastlogin for staff for audit
	}
	
	$get_login = "SELECT last_login FROM academic_staff WHERE staff_id ='$staff_id'";
	$get_login_res = mysql_query($get_login) or die(mysql_error());
	while($logindetail = mysql_fetch_array( $get_login_res )) 
	{
		$last_login_prof=$logindetail['last_login'];//lastlogin is for profile update
	}

	if (mysql_num_rows($get_user_res) == 1) //if login record is correct
	{
		$_SESSION['staff_id'] = $staff_id;//ensure that all page will still log in, if not page will take it as not logged in
		$_SESSION['status'] = $status;//store the status variable to ensure that they only access specific sites
                session_write_close();
		if(!isset($page))
		{
			if($status == "Sup")
			{
				if($last_login_prof =="") // check if is first time log in
				{
					$last_login="UPDATE staffs SET last_login = now() WHERE staff_id='".$staff_id."'";//saves record on when they log in
					$uploadtimenow = mysql_query($last_login) or die (mysql_error());
					header("Location: Staff_ProfilePage.php");
				}
				if((isset($last_login_prof)&& $last_login_prof !=""))
				{
					$last_login="UPDATE staffs SET last_login = now() WHERE staff_id='".$staff_id."'";//saves record on when they log in
					$uploadtimenow = mysql_query($last_login) or die (mysql_error());
					header("Location: Staff_CurrentStudent.php");
				}
			}
			if($status == "GRO")
			{
				$last_login="UPDATE staffs SET last_login = now() WHERE staff_id='".$staff_id."'";//saves record on when they log in
				$uploadtimenow = mysql_query($last_login) or die (mysql_error());
				header("Location: GRO_ListOfEOI.php"); //jump to another page
			}
		}
		else {
		header("Location: " + $page); //jump to previous page that user access straight
		}
	}
	else 
	{
		$errlogin="*We were unable to match the User ID and password you entered. Please check your entries and try again.";
	}
}
?>

<table border="0" align="center" id="form1">
  
  <tr>
    <td>
    <div id="header"> 
    <div id="logo"></div>
</div>
  <div id="navbarhmpage">
  
   <?php
   include "Homepagenav.php"
   ?>
  </div></td>
  </tr>
<tr >
    <td >
    
      <table border="0" align="center"id="outertable" >
                <col width="75%">
			<col width="25%">
			<tr>
        <td width="6007" rowspan="2" style="padding:5px 40px ; "><h2>Research study</h2>
			<p align="justify">Murdoch University is one of the leading research universities in Australia and prides itself on the quality and depth of its research. Home to a supportive, stimulating environment, we provide research students with high quality training in an international context.<br clear="none" />
            <br clear="none" />
            We have very strong research links with industry which ensures that our research students are trained in areas of national and international relevance. This takes our students to the leading edge of their disciplines and aligns them with current and future industry and society needs.
			<br clear="none" />
			<br clear="none" />
            In 2006, Murdoch generated a record research income of over $35 million through nationally competitive grants, industry funding, grants from State and Commonwealth agencies and research consultancies. Murdoch University received a five-star rating for research intensity from the Good Universities Guide which comes based on our per capita research performance. This puts Murdoch in the top eight universities nationally and reinforces our excellent research reputation.
			<br>
            <?php if(!isset($_REQUEST['readmore'])){ ?>
            <a href="Login Page.php?readmore=yes" class="two">Read More</a> <?php } ?>
			<?php if(isset($_REQUEST['readmore'])&&$_REQUEST['readmore']=="yes") {?>
			<br clear="none" />
            We offer a range of research programs covering many areas including:</p>
			<ul>
				<li>
				<h2 align="justify">PhD</h2>
				</li>
			</ul>
			<div align="justify">
            <blockquote>The Doctor of Philosophy (PhD) involves the student independently researching a specific topic under the guidance of a supervisor. This research involves critical and creative activities and disciplined methods of inquiry designed to increase the stock of human knowledge. </blockquote>
			</div>
			<ul>
				<li>
					<h2 align="justify">Master of Philosophy</h2>
				</li>
			</ul>
			<blockquote>
            <p align="justify">The Master of Philosophy is also a supervised research program involving the independent research of a specific topic under the guidance of a supervisor. The candidate must undertake an original investigation which would normally be more limited in scope and degree of originality than for a PhD.</p>
			</blockquote>
			<ul>
				<li>
					<h2 align="justify">Research Masters with Training</h2>
				</li>
			</ul>
			<blockquote>
            <p align="justify">The Research Masters with Training is an 18 month full time degree designed for students for whom additional, or specialised, research training is desirable. It is suitable for industry professionals who seek to extend and deepen their research expertise and undertake research relevant to their professional field; and those hoping to proceed to a higher degree but lacking in the conventional background.</p>
			</blockquote>
			<div align="justify"> </div>
			<ul>
				<li>
					<h2 align="justify">Master of Education (Research)</h2>
				</li>
			</ul>
			<blockquote>
            <p align="justify">Students studying the Master of Education (MEd) undertake a research dissertation combined with a limited number of coursework units to both inform their dissertation and provide an appropriate methodology background. This course is designed to provide the education profession and the community with leaders capable of addressing critical issues in educational practice, policy and research.</p>
			</blockquote>
			<div align="justify"> </div>
			<ul>
				<li>
					<h2 align="justify">Doctor of Education</h2>
				</li>
			</ul>
			<blockquote>
            <p align="justify">The Doctor of Education is an intensive course of study consisting of coursework and applied research in a selected area of practice leading to a dissertation that contributes conceptually and practically to the profession.</p>
			</blockquote>
			<div align="justify"> </div>
			<ul>
				<li>
					<h2 align="justify">Master of Laws (Research)</h2>
				</li>
			</ul>
			<blockquote>
            <p align="justify">The Master of Laws (LLM) is designed to extend the opportunity for law students to undertake research at an advanced level.</p>
			</blockquote>
			<div align="justify"> </div>
			<ul>
				<li>
					<h2 align="justify">Master of Applied Psychology + PhD</h2>
				</li>
			</ul>
			<div align="justify">
            <blockquote>This combined course is offered to students wishing to combine professional training at Master's level in Clinical or Organisational Psychology with compatible research at the PhD level. It combines thorough, professional training in the chosen area of specialisation with the high level of research training associated with doctoral-level studies.<br><br>
            <?php }?> <?php if(isset($_REQUEST['readmore'])&&$_REQUEST['readmore']=="yes"){ ?>
            <a href="Login Page.php" class="two">Read Less</a> <?php } ?>
            <br clear="none" />
            </blockquote>
			</div>
			<p align="justify">Find out more about <a href="http://www.murdoch.edu.au/Research-capabilities/" title="Research-capabilities" alt="Research-capabilities" shape="rect" class="two">Research Capabilities at Murdoch.</a></p>
			<h3 align="justify">How and when to apply</h3>
			<p align="justify">Applications for admission to PhD, MPhil and LLM (Research) candidature may be made at any time directly through the <a shape="rect" href="http://www.research.murdoch.edu.au/gradcentre/prospective.html" class="two">Graduate Centre</a>. </p>
			<p align="justify">Click <a href="EOI_Page1.php" class="two">HERE</a> to apply. <br>If you have applied, click <a href="eoistatus.php" class="two">HERE</a> to check the status of the application.</p></td>
       
       
        <td  style="padding-right: 40px ;width:25%;"><table width="20%" border="0" align="right">
		<form  action ="" method="post"> 
		<tr>
            <td><p>&nbsp;</p></td>
            <td>&nbsp;</td>
		</tr>
		<tr>
            <td><strong>Username:</strong></td>
            <td><label for="textfield2"></label>
				<input type="text" name="staff_id" id="textfield2" autocomplete="off" value="<?php if (isset($_POST['login_btn'])) 
				{ echo $_REQUEST['staff_id']; } ?>" /></td>
		</tr>
		<tr>
			<td>&nbsp;
			</td>
		</tr>
		<tr>
            <td><strong>Password:</strong></td>
            <td><input type="password" name="pass" id="textfield" /></td>
		</tr>
		<tr>
            <td>&nbsp;</td>
		</tr>
		<tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="login_btn" id="button" class="btn1" value="Login" /></td>
		</tr>
		<tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
		</tr>
		<tr>
            <td colspan="2"><font color="#FF0000"><small><?php echo $errlogin; ?>
            </small></font></td>
			</tr>
		</form>
        </table>          
			<label for="textfield"></label></td>
		<tr>
            <td height="133"></td>
        </tr> 
        </table>
	</tr>
	<tr>
		<td>
		
			<?php
			include ("footer.php");
			?>
		</td>
	</tr>
</table>
<p>&nbsp;</p>
</body>
</html>
