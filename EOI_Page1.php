<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature (Page 1 of 5)</title>
</head>
<link href="css/header.css" rel="stylesheet" type="text/css" />
<body>
<?php 

include 'connection.php';
session_start();

$errtitle = "";
$errlastname = "";
$errfirstname = "";
$errcountry = "";
$errmurdoch ="";
$mr ="";
$ms ="";
$mrs ="";
$mdm ="";
$dr ="";
$prof ="";
$domestic ="";
$international ="";
$erremailadd ="";
$errtel ="";
$murdochchecked ="";
$nonmurdochchecked ="";
$internationalchecked ="";
$domchecked ="";
$citizenship="";
$murdoch_sid="";


if (isset($_POST['submit']))
{
	
	$err="";
	//declare input
	$lastname = trim($_POST['lastname']);
	$firstname = trim($_POST['firstname']);
	if (isset($_POST['title']))
		$title = trim($_POST['title']);
	if (isset($_POST['country']))
		$country = trim($_POST['country']);
	if (isset($_POST['murdoch']))
		$murdoch = trim($_POST['murdoch']);
	$tel = trim($_POST['tel']);
	$emailadd = trim($_POST['emailadd']);
	if (isset($_POST['murdoch_sid']))
	$murdoch_sid = trim($_POST['murdoch_sid']);
	
	//to chekc if the email is already in the database or not
	$emailcheck = "SELECT * FROM eoi WHERE (status !='REJECTED' AND email = '$emailadd')";
	$emailcheck_query = mysql_query($emailcheck) or die(mysql_error());
	$emailcheck_output = mysql_num_rows( $emailcheck_query );
	if( $emailcheck_output !=0)
	{ 
		$err="Yes";
		$erremailadd = "*Email is used and is either awaiting for outcome, pending or already accepted";
	}
	
	
	if (isset($title))
	{
		if($title == "Mr"){$mr = "selected";}
		if($title == "Ms"){$ms = "selected";}
		if($title == "Mrs"){$mrs = "selected";}
		if($title == "Mdm"){$mdm = "selected";}
		if($title == "Dr"){$dr = "selected";}
		if($title == "Prof"){$prof = "selected";}
	}
	
	if(isset($title) && $title=="") 
	{
		$errtitle = "*";
		$err = "Yes";
	}
	
	
	if(preg_match("/^[A-Z][a-zA-Z -]+$/", $lastname) === 0)
	{
		$errlastname = '*First character must be capital';
		$err ="Yes";
		if($lastname == '') 
		{
		$errlastname = "*";
		$err = "Yes";
		}
	}
		
	if(preg_match("/^[A-Z][a-zA-Z -]+$/", $firstname) === 0)
	{
		$errfirstname = '*First character must be capital';
		$err ="Yes";
		if($firstname == '') 
		{
		$errfirstname = "*";
		$err =="Yes";
		}
	}
	
	if(!isset($country))
	{
		$errcountry = "*";
		$err = "Yes";
	}
	if(isset($_POST['country']))
	{
		if($country=="International")
		{
			$internationalchecked = "checked";
			if (isset($_POST['citizenship']))
			$citizenship = $_POST['citizenship'];
			if((!isset($_POST['citizenship'])) || ($_POST['citizenship'] == ""))
			{
				$errcountry = "*";
				$err = "Yes";
			}
		}
		if($country=="Domestic")
		{
			$country = $_POST['country'];
			$domchecked = "checked";
		}
	}
	
	if(!isset($murdoch))
	{
		$errmurdoch = "*";
		$err = "Yes";
	}
	if(isset($murdoch))
	{
		if($murdoch=="Yes")
		{
			$murdochchecked = "checked";
			if ($murdoch_sid=="")
			{
				$err="Yes";
				$errmurdochexist = "*Please enter Murdoch ID";
			}
			if (($murdoch_sid!="")&&(strlen ($murdoch_sid) < 8))
			{
				$err="Yes";
				$errmurdochexist = "*Minimum Murdoch ID is 8 digits";
			}
			if ($murdoch_sid!=""&&strlen ($murdoch_sid) >=8)
			{
				$studentidcheck = "SELECT * FROM eoi WHERE (status !='REJECTED' AND mu_id = '$murdoch_sid')";
				$studentidcheck_query = mysql_query($studentidcheck) or die(mysql_error());
				$studentidcheck_outcome = mysql_num_rows( $studentidcheck_query );
				if( $studentidcheck_outcome !=0)
				{ 
					$err="Yes";
					$errmurdochexist = "<br>*Murdoch ID is used and is either awaiting for outcome, pending or already accepted";
				}
			}
		}	
		if($murdoch=="No")
		{
			$nonmurdochchecked = "checked";
		}
	}
	//check if input is email format
	if (!filter_var($emailadd,FILTER_VALIDATE_EMAIL))
	{
		$erremailadd = "*";
		$err = "Yes";
		if($_POST['emailadd']=="")
		{
			$erremailadd = "*";
		}
	}
	//check length of input
	if(strlen($tel) < 7){
		$err = "Yes";
		$errtel = "*";
		//check if all inputs are numbers
		if (!filter_var($tel,FILTER_VALIDATE_INT))
		{
			$errtel = "*";
			$err = "Yes";
			if ($tel =="")
			{
			$errtel = "*";
			$err = "Yes";
			}
		}
	}
	
	
	if ($err == "") 
	{
		$_SESSION['title']=$title;
		$_SESSION['lastname'] =  $lastname;  
		$_SESSION['firstname'] = $firstname;  
		$_SESSION['country']=$country;
		$_SESSION['citizenship']=$citizenship ;
		$_SESSION['murdoch']=$murdoch;
		$_SESSION['murdoch_sid']=$murdoch_sid;
		$_SESSION['emailadd'] = $emailadd;
		$_SESSION['tel'] = $tel;
		header("Location: EOI_Page2.php");
		
	}
}

?>
<table  border="0" align="center">
  
  <tr>
    <td>
    <div id="header"> 
<div id="logo"></div>
</div>
  <div id="navbar">EXPRESSION OF INTEREST IN HIGHER DEGREE RESEARCH CANDIDATURE</div><div><img  border="0" src="Image/Nav/Page 1.png" width="100%" height="" /></div></td>
</tr>
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table  border="0" align="center"id="outertable" >
          <tr>
            <td width="6007" style="padding:5px 40px; font-size: 16px;"><p align="justify"><strong><em>For Potential Higher Degree Research Applicants<br/>The School uses the Information provided to make an  assessment of your qualifications and suitability to undertake a higher degree  research and its capacity to provide you with an advisory team, research  facilities, project funds and general infrastructure and support services. <br/>On the basis of this Expression Of Interest you may be  invited to apply for admission using the Application for Admission &amp;  Scholarship form.</em></strong></p><font color="#FF0000">
			<?php if(isset($_POST['submit'])&& ($err !="")){ echo "*Required information is either missing or incorrect";} ?></font>
              <h2><strong>1. Personal details</strong></h2>
              <h4><strong>Title:</strong>
                <font color="#FF0000"><?php echo $errtitle; ?>
                </font><br/>
                
                <select name="title">
                  <option selected="selected" value="">-- Please Select --</option>
                  <option value="Mr" <?php echo $mr; ?> >Mr</option>
                  <option value="Ms" <?php echo $ms; ?> >Ms</option>
                  <option value="Mrs" <?php echo $mrs; ?>>Mrs</option>
                  <option value="Mdm" <?php echo $mdm; ?>>Mdm</option>
                  <option value="Dr" <?php echo $dr; ?>>Dr</option>
                  <option value="Prof" <?php echo $prof; ?>>Prof</option>
                </select>
              </font></h4>
              <h4><strong>Last/Family Name: </strong>
              <font color="#FF0000"><?php echo $errlastname;?></font>
            <br/>
              <input name="lastname" type="text" id="lastname" title="Example: Lee " value="<?php if(isset($lastname)) echo $lastname;?>" size="40" />
              </h4>
              <h4><strong>First/Given Names: </strong>
              <font color="#FF0000"><?php 
	  echo $errfirstname;
	?></font>
           <br/>
             
              <input name="firstname" type="text" id="firstname" title="Example: Micheal " value="<?php if(isset($firstname)) echo $firstname;?>" size="40" width="250px" />
              </font></h4>
              <h4><strong>Citizenship: 
                </strong><font color="#FF0000"><?php echo $errcountry; ?></font></h4>
              <label>
                  
                &emsp;
                <input name="country" type="radio" id="country" value="Domestic"  onclick="citizenship.disabled=true" <?php echo $domchecked;  ?>/>
              </font> Domestic (Australian/New Zealand Citizen or Australian Permanent Resident)</label>
                <label> <br/>
                  
                  &emsp;
                  <input name="country" type="radio" value="International"  onclick="citizenship.disabled=false"  <?php echo $internationalchecked ?>/>
                  </font> International  - Please specify country of citizenship</label>
				<select name="citizenship" id="citizenship"  <?php if(!isset($_POST['submit']) || !isset($_POST['country']) ||(isset($_POST['submit']) && $_POST['country']!="International")) echo "disabled"; ?>>
				<option value="" selected>Country</option>
				
                <?php 
				$country = mysql_query("SELECT * FROM `country` ORDER BY country ") or die(mysql_error());
				//query to get record
				while($countryrow = mysql_fetch_array( $country )) 
				{ 
					echo "<option value='".$countryrow['citizenship']."'";
					if(isset($_POST['submit'])&&($countryrow['citizenship']==$citizenship)){echo 'selected';}
					echo ">".$countryrow['country']."</option>\n";
				}
				?>
				
				</select>
              </font><br><br>
              <strong>Have you previously applied for a program at Murdoch University? 
                </strong><font color="#FF0000"><?php echo $errmurdoch; 	?></font><br>
				
                
                <label><font style="font-family:Arial, Helvetica, sans-serif">
                &emsp;
                <input name="murdoch" type="radio" value="No" onclick="murdoch_sid.disabled=true" <?php echo $nonmurdochchecked; ?>  />
                </font>No</label>
                <label> <br/>
                  
                  &emsp;
                  <input name="murdoch" type="radio" value="Yes" onclick="murdoch_sid.disabled=false" <?php echo $murdochchecked; ?> />
                  </font> Yes - MU Student Number</label>
                
                <input name="murdoch_sid" type="text" id="murdoch_sid" value="<?php if(isset($_POST['murdoch_sid'])) echo $_POST['murdoch_sid'];?>" size="20" width="200px" <?php if(!isset($_POST['submit']) || !isset($_POST['murdoch']) ||(isset($_POST['submit']) && $_POST['murdoch']!="Yes")) echo "disabled"; ?>/>
				<font color="#FF0000"><?php echo $errmurdochexist; ?></font>
            </h3>
            <h2><strong>2. Contact details</strong></h2>
            <p>Please give your contact details that are valid for at least one month after submission of this form.</p>
           <strong>Email Address: </strong>
              <font color="#FF0000"> <?php echo $erremailadd;?>
              </font><br/>
              
              <input name="emailadd" width="250px" type="text"  title="Example: someone@example.com " id="emailadd2" value="<?php if(isset($_POST['emailadd'])) echo $emailadd;?>"/>
              </font>
            <h4><strong>Telephone:</strong><small><em>(minimum 7 numbers)</em></small>
              <font color="#FF0000"><?php echo $errtel;?></font>
			  <br/>
             <input name="tel" type="text" width="250px" id="tel" title="Please enter correct telephone number in case the officer requires to call you" maxlength="15"   value="<?php if(isset($_POST['tel'])) echo $tel;?>"/>
            </font></h4></td>
          </tr>
          <tr>
		    <td>
			<TABLE BORDER="0" >
				<TR >
				<TD style="padding:5px 40px;"><font style="font-family:Arial, Helvetica, sans-serif">
				<input type="button" name="cancel"class="btn1"value="Cancel" onClick="location.href='logout.php'" /></font>
				</TD>
				<TD style="padding:5px 40px;" align="right">
				<font style="font-family:Arial, Helvetica, sans-serif" >
				<input type="submit" name="submit" class="btn1" value="Next &gt;&gt;" />
				</font>
				</TD>
				</TR>
			</TABLE>
			</td>
			
            
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
    </form>
    </td>
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
<?php //coding is credited by Chen Jia Wei & Wong Hui Bing ?>
</html>
