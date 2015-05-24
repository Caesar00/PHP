<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature (Page 3 of 5)</title>
</head>
<link href="css/header.css" rel="stylesheet" type="text/css" />



<body>


<?php 
include 'connection.php';
session_start();

if(!isset($_SESSION['eng'])){
header("Location: EOI_Page2.php");}//force to go to previous page if mandatory field is not set first


$scholarqn1no="";
$scholarqn1yes="";
$scholarqn2no="";
$scholarqn2yes="";
$scholarqn3no="";
$scholarqn3yes="";
$scholarduration1="";
$scholarduration2="";
$applied1="";
$awarded1="";
$applied2="";
$awarded2="";
$VPA1 ="";
$VPA2 ="";

$scholarname1="";
$scholarname2="";
$sponsor1="";
$sponsor2="";
$scholarduration1="";
$scholarduration2="";
$purpose1="";
$purpose2="";
$status1="";
$status2="";
$errwhyresearch="";
$errscholarqn="";
$whyresearch ="";
$errscholarqn1="";
$errscholarqn2="";
$errscholarqn3="";
$errscholartable="";

if(isset($_POST['submit'])){
	
	$err="";
	
	
	if(!isset($_POST['scholarqn1'])||!isset($_POST['scholarqn2'])||!isset($_POST['scholarqn3']))
	{
		$err = "Yes"; 
		if(!isset($_POST['scholarqn1']))
		{
			$errscholarqn1 ="*";
		}
		if(!isset($_POST['scholarqn2']))
		{
			$errscholarqn2 ="*";
		}
		if(!isset($_POST['scholarqn3']))
		{
			$errscholarqn3 ="*";
		}
	}
	
	if(isset($_POST['scholarqn1']))
	{
		$scholarqn1 = $_POST['scholarqn1'];
		if($scholarqn1 == "yes")
		{
			$scholarqn1yes ="checked";
		}
		if($scholarqn1 == "no")
		{
			$scholarqn1no ="checked";
		}
	}
	if(isset($_POST['scholarqn2']))
	{
		$scholarqn2 = $_POST['scholarqn2'];
		if($scholarqn2 == "yes")
		{
			$scholarqn2yes ="checked";
		}
		if($scholarqn2 == "no")
		{
			$scholarqn2no ="checked";
		}
	}
	if(isset($_POST['scholarqn3']))
	{
		$scholarqn3 = $_POST['scholarqn3'];
		if($scholarqn3 == "yes")
		{
			$scholarqn3yes ="checked";
			if(isset($_POST['scholarname1']))
			{
				$scholarname1 = trim($_POST['scholarname1']);
			}
			if(isset($_POST['scholarname2']))
			{
				$scholarname2 = trim($_POST['scholarname2']);
			}
			if(isset($_POST['sponsor1']))
			{
				$sponsor1 = trim($_POST['sponsor1']);
			}
			if(isset($_POST['sponsor2']))
			{
				$sponsor2 = trim($_POST['sponsor2']);
			}
			
			if(isset($_POST['VPA1']))
			{
				$VPA1 = trim($_POST['VPA1']);
			}
			if( ($_POST['VPA1'] !='') && (!is_numeric($_POST['VPA1'])) )
			{
				$err="Yes";
				$errscholartable ="*";
			}
			if(isset($_POST['VPA2']))
			{
				$VPA2 = trim($_POST['VPA2']);
			}
			if( ($_POST['VPA2'] !='') && (!is_numeric($_POST['VPA2'])) )
			{
				$err="Yes";
				$errscholartable ="*";
			}
			if(isset($_POST['scholarduration1']))
			{
				$scholarduration1 = $_POST['scholarduration1'];
			}
			if(isset($_POST['scholarduration2']))
			{
				$scholarduration2 = $_POST['scholarduration2'];
			}
			if(isset($_POST['purpose1'])&&$_POST['purpose1']!="")
			{
				$purpose1 = trim($_POST['purpose1']);
			}
			if(isset($_POST['purpose2'])&&$_POST['purpose2']!="")
			{
				$purpose2 = trim($_POST['purpose2']);
			}
			if(isset($_POST['status1']))
			{
				$status1 = $_POST['status1'];
				if($status1 =="applied"){$applied1 = "selected";}
				if($status1 =="awarded"){$awarded1 = "selected";}
			}
			if(isset($_POST['status2']))
			{
				$status2 = $_POST['status2'];
				if($status2 =="applied"){$applied2 = "selected";}
				if($status2 =="awarded"){$awarded2 = "selected";}
			}
			if(($scholarname1 =="" || $sponsor1=="" || $VPA1=="" || $scholarduration1=="" || $purpose1=="" || $status1=="")&&($scholarname2 =="" ||  $sponsor2=="" || $VPA2=="" || $scholarduration2=="" || $purpose2=="" || $status2==""))
			{
				$err="Yes";
				$errscholartable ="*Please fill in either one row<br /><br />";
			}
		}
		if($scholarqn3 == "no")
		{
			$scholarqn3no ="checked";
		}
	}
	if(empty($_POST['whyresearch'])) 
	{
		$err = "Yes";
		$errwhyresearch ="*";
	}
	if(!empty($_POST['whyresearch']))
	{
		$whyresearch = trim($_POST['whyresearch']);
	}
	
		//proceed if no error//////////
	
	if($err =="")
	{
		$_SESSION['scholarqn1']=$scholarqn1;
		$_SESSION['scholarqn2']=$scholarqn2;
		$_SESSION['scholarqn3']=$scholarqn3;
		
		$_SESSION['scholarname1']=$scholarname1;
		$_SESSION['scholarname2']=$scholarname2;
		$_SESSION['sponsor1']=$sponsor1;
		$_SESSION['sponsor2']=$sponsor2;
		$_SESSION['VPA1']=$VPA1;
		$_SESSION['VPA2']=$VPA2;
		$_SESSION['scholarduration1']=$scholarduration1;
		$_SESSION['scholarduration2']=$scholarduration2;
		$_SESSION['purpose1']=$purpose1;
		$_SESSION['purpose2']=$purpose2;
		$_SESSION['status1']=$status1;
		$_SESSION['status2']=$status2;
	
		$_SESSION['whyresearch']=$whyresearch;
		header("Location: EOI_Page4.php");
	}	
}

?>
<table  border="0" align="center">
  
  <tr>
    <td>
    <div id="header"> 
<div id="logo"></div>
</div>
  <div id="navbar">EXPRESSION OF INTEREST IN HIGHER DEGREE RESEARCH CANDIDATURE</div><div><img border="0" src="Image/Nav/Page 3.png" width="100%" height="" /></div></td>
</tr>

  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table  border="0" align="center"id="outertable" >
          <tr>
            <td width="6007"style="padding:5px 40px ;"><p><font color="#FF0000">
			<?php if(isset($_POST['submit'])&& ($err !="")){ echo "*Required information is either missing or incorrect";} ?></font></p></td>
          </tr>
          <tr>
            <td style="padding:5px 40px ;"><h2><strong>7. Scholarship support</strong></h2>
              <h3>The University may award a living allowance and / or tuition fee scholarship to a higher degree research candidate. Note that scholarship numbers are limited and thus only available for candidates with a higher competitive track record. Information on higher degree research scholarship schemes can be found on the Murdoch University Graduate Research Office <a href="http://our.murdoch.edu.au/Research-and-Development/Resources-for-students/Future-research-students/Admission-and-scholarships/Domestic-students-scholarships/Australian-Postgraduate-Award/"class="two">Website</a>.</h3>
              <h4>I require a scholarship to undertake studies at Murdoch <font color="#FF0000"><?php echo $errscholarqn1; ?></font><br/></h4>
              <label>
               &emsp; 
               <input type="radio" name="scholarqn1" value="yes"<?php echo $scholarqn1yes; ?> />
Yes</label>
              <br />
              <label>
                &emsp;
                <input type="radio" name="scholarqn1" value="no" <?php echo $scholarqn1no; ?> />
No</label>
              
              <h4>I have been awarded a tuition fee scholarship from another organisation to undertake studies at Murdoch<font color="#FF0000"><?php echo $errscholarqn2; ?></font></h4>
              <label>
                &emsp;
                <input type="radio" name="scholarqn2" value="yes"<?php echo $scholarqn2yes; ?> />
				Yes</label>
              <br />
              <label>
                &emsp;
                <input type="radio" name="scholarqn2" value="no" <?php echo $scholarqn2no; ?> />
				No</label>
              
              <h4>I have been awarded   a living allowance scholarship from another organization to undertake studies at Murdoch<font color="#FF0000"><?php echo $errscholarqn3; ?></font></h4>
              <label>
                &emsp;
                <input type="radio" name="scholarqn3" value="yes" onclick="addSubject(this)" <?php echo $scholarqn3yes; ?> />
				Yes</label>
              <br />
              <label>
                &emsp;
                <input type="radio" name="scholarqn3" value="no" onclick="addSubject(this)" <?php echo $scholarqn3no; ?> />
				No</label>
            <div id="scholar">
	<div class="box" id="yes" <?php if(!isset($_POST['submit']) || !isset($_POST['scholarqn3']) ||(isset($_POST['submit']) && $_POST['scholarqn3']=="no")) {echo " style='display: none;'";}?>>
		<div>
			
            <p><strong>Please list details of scholarships awarded below. </strong><font color="#FF0000"><?php echo $errscholartable; ?></font></p>
			
            <table border="1">
              <tr>
                <td><strong>Name of scholarship</strong></td>
                <td><strong>Sponsor/<br/>Organisation</strong></td>
                <td><strong>Value per annum (Aus $)</strong></td>
                <td><strong>Duration in total</strong></td>
                <td><strong>Purpose(s)</strong></td>
                <td><strong>Status</strong></td>
              </tr>
              <tr>
                <td><input name="scholarname1"  type="text" id="textfield3" value="<?php if(isset($scholarname1)) echo $scholarname1; ?>" style="width:97%;" /></td>
                <td><input name="sponsor1" type="text" id="textfield4" value="<?php if(isset($sponsor1)) echo $sponsor1; ?>"  style="width:97%;" /></td>
                <td><input name="VPA1" type="text" id="textfield5" title="Please enter numbers only (round up to nearest whole number)" value="<?php if(isset($VPA1)) echo $VPA1 ?>"  style="width:97%;" /></td>
                <td><select name="scholarduration1" id="year" style="width:99%;">
					<option value="" selected="selected">--Please Select--</option>
					<?php 
					$year1 =1;
					for($i=1; $i<=20; $i++)
					{
						echo "<option value='";
						echo $i."'";
						if (isset($_REQUEST['submit']) && $_REQUEST['scholarduration1'] == $i) echo "selected";
						echo">".$year1."</option>";
						$year1++;
					}?>
                </select></td>
                <td><input name="purpose1" type="text" id="textfield6" title="Example: Tuition fee, living expenses" value="<?php if(isset($purpose1)&&$purpose1 !="") echo $purpose1 ?>" style="width:97%;"/></td>
                <td><select name="status1" id="status1"style="width:99%;">
                  <option value="" selected="selected">--Please Select--</option>
                  <option value="applied" <?php echo $applied1; ?>>Applied</option>
                  <option value="awarded" <?php echo $awarded1; ?>>Awarded</option>
                </select></td>
              </tr>
              <tr>
                <td><input name="scholarname2" type="text" id="textfield7" value="<?php if(isset($scholarname2)) echo $scholarname2; ?>"  style="width:97%;" /></td>
                <td><input name="sponsor2" type="text" id="textfield2" value="<?php if(isset($sponsor2)) echo $sponsor2; ?>"  style="width:97%;" /></td>
                <td><input name="VPA2" type="text" id="textfield8" title="Please enter numbers only (round up to nearest whole number)" value="<?php if(isset($_POST['VPA2'])) echo $VPA2 ?>" style="width:97%;" /></td>
                <td><select name="scholarduration2" id="scholarduration" style="width:99%;"> 
                  <option value="" selected="selected">--Please Select--</option>
                  <?php 
					$year2 =1;
					for($i=1; $i<=20; $i++)
					{
						echo "<option value='";
						echo $i."'";
						if (isset($_REQUEST['submit']) && $_REQUEST['scholarduration2'] == $i) echo "selected";
						echo">".$year2."</option>";
						$year2++;
					}
					
					?>
                </select></td>
                <td><input name="purpose2" type="text" id="textfield9" title="Example: Tuition fee, living expenses" value="<?php if(isset($purpose2)&&$purpose2 !="") echo $purpose2 ?>"style="width:97%;"/></td>
                <td><select name="status2" id="status2" style="width:99%;">
                  <option value="" selected="selected">--Please Select--</option>
                  <option value="applied" <?php echo $applied2; ?>>Applied</option>
                  <option value="awarded" <?php echo $awarded2; ?>>Awarded</option>
                </select>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
            <h2><strong>8. Why do you want to do Research?</strong></h2>
            <h3>Please outline the main reasons why you want to do research at Murdoch University. <font color="#FF0000"><?php echo $errwhyresearch; ?></font></h3>
            <p>
              <textarea cols="50" id="textarea" rows="4" name="whyresearch" ><?php if(isset($_POST['whyresearch'])&&$_POST['whyresearch']!="") echo $_POST['whyresearch'];if(isset($_POST['test'])) echo $_POST['whyresearch'];?></textarea>
              <font size="1" id="myWordCount">(100 words left)</font>
            </p></td>
          </tr>

          <tr>
            
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
<?php //coding is credited by Chen Jia Wei & Wong Hui Bing ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script language="javascript" type="text/javascript">

	
	var content;
	$('textarea').on('keyup', function()
	{
		// count words
		var words = $(this).val().split(/\s+/).length;
		$('#myWordCount').text("("+(101-words)+" words left)");
		// limit message
		if(words>=101){
			$(this).val(content);
			alert('no more than 100 words, please!');
		} else {    
			content = $(this).val();
		}
	});
	
	function toggleTB(what,elid) { if(what.checked) 
	{ document.getElementById(elid).disabled=1 } 
	else { document.getElementById(elid).disabled=0 } 	}
	// toggle button using checkbox
	function toggleTB(what,elid) 
{ if(what.checked) { document.getElementById(elid).disabled=0 } else { document.getElementById(elid).disabled=1 } }  

function addSubject( el ){
    var newValu = el.value,
        kiddies = document.getElementById("scholar").childNodes,
        klength = kiddies.length, curNode;
    while ( klength-- ) {
      curNode = kiddies[klength];
      if( curNode.nodeName == "DIV" )
        curNode.style.display = curNode.id == newValu ? "block" : "none" ;
    }
}
</script>
