<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature (Page 4 of 5)</title>
<?php session_start(); include 'connection.php'; 

?>
<link href="css/header.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/resources/demos/style.css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>

jQuery('document').ready(function($){
	var content;
	//count word inside textarea
	$('textarea').on('keyup', function()
	{
		// count words
		var words = $(this).val().split(/\s+/).length;
		$('#myWordCount').text("("+(101-words)+" words left)");
		// limit message
		if(words>=100){
			$(this).val(content);
			alert('no more than 100 words, please!');
		} else {    
			content = $(this).val();
		}
	});
	//datepicker
	$( "#testdate" ).datepicker
	({
		maxDate: new Date(),
        minDate: '-2Y',
		defaultDate: new Date(),
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
	});
});

	


function toggleTB(what,elid) 
{ 
	if(what.checked) 
	{ document.getElementById(elid).disabled=1 } 
	else { document.getElementById(elid).disabled=0 } 	
} 

// toggle button using checkbox
function toggleTB(what,elid) 
{ 
	if(what.checked) { document.getElementById(elid).disabled=0 } 
	else { document.getElementById(elid).disabled=1 } 
}  

function addSubject1( el ){
var newValu = el.value,
kiddies = document.getElementById("scholar").childNodes,
klength = kiddies.length, curNode;
while ( klength-- ) {
curNode = kiddies[klength];
if( curNode.nodeName == "DIV" )
curNode.style.display = curNode.id == newValu ? "block" : "none" ;
}
}

function addSubject( el ){
var newValu = el.value,
kiddies = document.getElementById("options").childNodes,
klength = kiddies.length, curNode;
while ( klength-- ) {
curNode = kiddies[klength];
if( curNode.nodeName == "DIV" )
curNode.style.display = curNode.id == newValu ? "block" : "none" ;
}
}
</script>
</head>

<!--------------page 1---------->
<?php
if(!isset($_SESSION['scholarqn1'])){
header("Location: EOI_Page3.php");}//force to go to previous page if mandatory field is not set first

if (isset($_POST['cancel']))
{ header ("Location: logout.php");}
if (isset($_POST['submit']))
{ header("Location: EOI_Page5.php");}

$mainerror="";
$err="";
$errtitle = "";
$errlastname = "";
$errfirstname = "";
$errcountry = "";
$errmurdoch ="";
$mr ="";
$ms ="";
$mrs ="";
$mdm ="";
$dr="";
$prof="";
$erremailadd ="";
$errtel ="";
$murdochchecked ="";
$nonmurdochchecked ="";
$internationalchecked ="";
$domchecked ="";
$murdoch_sid="";
$citizenship="";


if (!isset($_POST['part1updatebtn']))
{
$lastname = $_SESSION['lastname'];  
$firstname=$_SESSION['firstname'];  
$country=$_SESSION['country'];
$citizenship=$_SESSION['citizenship'];
$murdoch=$_SESSION['murdoch'];
$murdoch_sid=$_SESSION['murdoch_sid'];
}

if(isset($_SESSION['title'])){
$title = $_SESSION['title'];
if($title == "Mr"){$mr = "selected";}
if($title == "Ms"){$ms = "selected";}
if($title == "Mrs"){$mrs = "selected";}
if($title == "Mdm"){$mdm = "selected";}
if($title == "Dr"){$dr = "selected";}
if($title == "Prof"){$prof = "selected";}
}

if((!isset($_POST['country']) && $_SESSION['country']=="International") || (isset($_POST['country']) && $_POST['country']=="International"))
{
	$internationalchecked = "checked";
}
if((!isset($_POST['country']) && $_SESSION['country']=="Domestic") || (isset($_POST['country']) && $_POST['country']=="Domestic"))
{
	$domchecked = "checked";
}

if((!isset($_POST['murdoch']) && $_SESSION['murdoch']=="Yes") || (isset($_POST['murdoch']) && $_POST['murdoch']=="Yes"))
{
	$murdochchecked = "checked";
}
if((!isset($_POST['murdoch']) && $_SESSION['murdoch']=="No") || (isset($_POST['murdoch']) && $_POST['murdoch']=="No"))
{
	$nonmurdochchecked = "checked";
}



if (isset($_POST['cancelbtn']))
{
	header("Location: EOI_Page4.php");
}
if (isset($_REQUEST['part1updatebtn']))
{
	//declare input
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	if (isset($_POST['title']))
		$title = $_POST['title'];
	if (isset($_POST['country']))
		$country = $_POST['country'];
	if (isset($_POST['murdoch']))
		$murdoch = $_POST['murdoch'];
	if (isset($_POST['murdoch_sid']))
		$murdoch_sid = $_POST['murdoch_sid'];
	if (isset($_POST['citizenship']))
		$citizenship = $_POST['citizenship'];
	
	if (isset($_POST['title']))
	{
		$title = $_POST['title'];
		if($title == "Mr"){$mr = "selected";}
		if($title == "Ms"){$ms = "selected";}
		if($title == "Mrs"){$mrs = "selected";}
		if($title == "Mdm"){$mdm = "selected";}
		if($title == "Dr"){$dr = "selected";}
		if($title == "Prof"){$prof = "selected";}
	}
	
	if(($_POST['title'])=="") 
	{
		$errtitle = "You forgot to select title!";
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
	if(isset($_POST['country']))
	{
		if($_POST['country']=="International" && isset($_POST['citizenship']))
		{
			$internationalchecked = "checked";
			if(preg_match("/^[A-Z][a-zA-Z -]+$/", $_POST['citizenship']) === 0)
			{
				if((!isset($_POST['citizenship'])) || (isset($_POST['citizenship']) && $_POST['citizenship'] == ""))
				{
				$errcountry = "You forgot to enter country name!";
				$err = "Yes";
				}
			}
			$citizenship = $_POST['citizenship'];
		}
		if($_POST['country']=="Domestic")
		{
			$domchecked = "checked";
			$country = $_POST['country'];
		}
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
	}
	if($err!="")
	{
		$mainerror="*Required information is either missing or incorrect";
	}
	if ($err == "") {
		$_SESSION['title']=$title;
		$_SESSION['lastname'] =  $lastname;  
		$_SESSION['firstname'] = $firstname;  
		$_SESSION['country']=$country ;
		$_SESSION['citizenship']=$citizenship ;
		$_SESSION['murdoch']=$murdoch;
		$_SESSION['murdoch_sid']=$murdoch_sid;
		header("Location: EOI_Page4.php");
	}	
}


if (!isset($_REQUEST['part2updatebtn']))
{
	if(isset($_SESSION['emailadd']))
	{
	$emailadd =$_SESSION['emailadd'];
	}
	if(isset($_SESSION['tel']))
	{
	$tel =$_SESSION['tel'];
	}
}

if (isset($_REQUEST['part2updatebtn']))
{	
	//check if input is email format
	if (!filter_var($_POST['emailadd'],FILTER_VALIDATE_EMAIL))
	{
		$erremailadd = "Invalid email!";
		$err = "Yes";
		if($_POST['emailadd'])
		{
			$erremailadd = "*";
		}
	}
	if(isset($_POST['emailadd'])&& $_POST['emailadd']!="")
	{
		$emailadd = $_POST['emailadd'];
	}
	if(isset($_POST['tel'])&& $_POST['tel']!="")
	{
		$tel = $_POST['tel'];
	}
	//check length of input
	if(strlen($_POST['tel']) < 7){
		$err = "Yes";
		$errtel = "*Invalid Phone Number!";
		//check if all inputs are numbers
		if (!filter_var($_POST['tel'],FILTER_VALIDATE_INT))
		{
			$errtel = "*Invalid Number!";
			$err = "Yes";
			if ($tel =="")
			{
			$errtel = "*";
			$err = "Yes";
			}
		}
	}
	//to chekc if the email is already in the database or not
	$emailcheck = "SELECT * FROM eoi WHERE (status !='REJECTED' AND email = '$emailadd')";
	$emailcheck_query = mysql_query($emailcheck) or die(mysql_error());
	$emailcheck_output = mysql_num_rows( $emailcheck_query );
	if( $emailcheck_output !=0)
	{ 
		$err="Yes";
		$erremailadd = "*Email is used and is either awaiting for outcome, pending or already accepted";
	}
	if($err!="")
	{
		$mainerror="*Required information is either missing or incorrect";
	}
	if ($err == "") {
		$_SESSION['emailadd'] = $emailadd;
		$_SESSION['tel'] = $tel;
		header("Location: EOI_Page4.php");
		}	
}
	
	
	

//--------------page 2----------> 
// variables
$programcounter ="";
unset($program);

$monthselected ="";
$PFtime ="";
$FOR1 ="";
$FOR2 ="";
$FOR3 ="";

$suptitle1="";
$sup1mr ="";
$sup1ms ="";
$sup1mrs ="";
$sup1mdm ="";
$sup1dr="";
$sup1prof="";


$suptitle2="";
$sup2mr ="";
$sup2ms ="";
$sup2mrs ="";
$sup2mdm ="";
$sup2dr="";
$sup2prof="";

$researchinterest1 ="";
$researchinterest2 ="";
$researchinterest3 ="";
$researchinterest4 ="";
$researchinterest5 ="";
$empinst1="";
$empinst2="";
$yearappoint1="";
$yearappoint2="";
$engcourse="";
$testtype="";
$testdate="";


$school ="";
//used to select the chosen radio submit or checksubmit
$phdchecked ="";
$mphilchecked ="";
$rmtchecked ="";
$dvetmedschecked ="";
$medreschecked ="";
$dpsychchecked ="";
$llmchecked="";
$ditchecked="";
$eddchecked="";
$mapppsychchecked = "";

$degree1 = "";
$duration1 = "";
$yearaward1 = "";
$GPA1 = "";
$completion1 = "";
$institute1 = "";

$degree2 = "";
$duration2 = "";
$yearaward2 = "";
$GPA2 = "";
$completion2 = "";
$institute2 = "";

$degree3 = "";
$duration3 = "";
$yearaward3 = "";
$GPA3 = "";
$completion3 = "";
$institute3 = "";

$school1 ="";
$school2 ="";
$school3 ="";
$school4 ="";
$school5 ="";
$school6 ="";
$school7 ="";
$school8 ="";
$school9 ="";

$sup1school1 ="";
$sup1school2 ="";
$sup1school3 ="";
$sup1school4 ="";
$sup1school5 ="";
$sup1school6 ="";
$sup1school7 ="";
$sup1school8 ="";
$sup1school9 ="";

$sup2school1 ="";
$sup2school2 ="";
$sup2school3 ="";
$sup2school4 ="";
$sup2school5 ="";
$sup2school6 ="";
$sup2school7 ="";
$sup2school8 ="";
$sup2school9 ="";

$PFtime ="";
$PTchecked ="";
$FTchecked ="";

//referral supervisor
$supname1 ="";
$supname2 ="";
$supschool1 ="";
$supschool2 ="";
$supemail1 ="";
$supemail2 ="";

$mainchecked ="";
$pendingchecked="";
$completedchecked="";
$otherchecked="";
$eng="";
$engcourse="";
//error message variable
$errprogram = "";
$errschool ="";
$errdate ="";
$errPFtime ="";
$errFOR="";
$errresearchinterest ="";
$errtestscore ="";
$errresult="";
$errtesttype="";
$erreng="";
$errdegree ="";
$errgpa ="";
$ieltscheck ="";
$toeflpprcheck ="";
$toeflwwwcheck =""; // toefl internet(www)
$result = "";
$err = "";
$errposition="";
$errpubyear="";
$errqualyear="";


if (isset($_SESSION['program'])) {
	$program = $_SESSION['program'];
	$programcounter = explode (",",$_SESSION['program']);
	for($i=0; $i < count($programcounter); $i++)
	{
		if($programcounter[$i]=="PhD"){$phdchecked ="checked";}
		if($programcounter[$i]=="MPhil"){$mphilchecked ="checked";}
		if($programcounter[$i]=="RMT"){$rmtchecked ="checked";}
		if($programcounter[$i]=="DVetMedS"){$dvetmedschecked ="checked";}
		if($programcounter[$i]=="MEd Res"){$medreschecked ="checked";}
		if($programcounter[$i]=="DPSYCH"){$dpsychchecked ="checked";}
		if($programcounter[$i]=="LLM"){$llmchecked="checked";}
		if($programcounter[$i]=="DIT"){$ditchecked="checked";}
		if($programcounter[$i]=="EdD"){$eddchecked="checked";}
		if($programcounter[$i]=="MAppPsych/PhD"){$mapppsychchecked = "checked";}
		
	}
}

if(isset($_SESSION['school']))
$school= $_SESSION['school'];
if(isset($_SESSION['month']))
$month = $_SESSION['month'];
if(isset($_SESSION['year']))
$year=$_SESSION['year'];
if(isset($_SESSION['PFtime']))
{
	$PFtime=$_SESSION['PFtime'];
	if ($PFtime == "PT")
	{
		$PTchecked = "checked";
	}
	else if ($PFtime == "FT")
	{
		$FTchecked = "checked";
	}
}
if(!isset($_POST['part4updatebtn']))
{
if(isset($_SESSION['FOR1']))
$FOR1=$_SESSION['FOR1'];
if(isset($_SESSION['FOR2']))
$FOR2=$_SESSION['FOR2'];
if(isset($_SESSION['FOR3']))
$FOR3=$_SESSION['FOR3'];
if(isset($_SESSION['researchinterest1']))
$researchinterest1=$_SESSION['researchinterest1'];
if(isset($_SESSION['researchinterest2']))
$researchinterest2=$_SESSION['researchinterest2'];
if(isset($_SESSION['researchinterest3']))
$researchinterest3=$_SESSION['researchinterest3'];
if(isset($_SESSION['researchinterest4']))
$researchinterest4=$_SESSION['researchinterest4'];
if(isset($_SESSION['researchinterest5']))
$researchinterest5=$_SESSION['researchinterest5'];


if(isset($_SESSION['suptitle1'])){
$suptitle1 = $_SESSION['suptitle1'];
if($suptitle1 == "Mr"){$sup1mr = "selected";}
if($suptitle1 == "Ms"){$sup1ms = "selected";}
if($suptitle1 == "Mrs"){$sup1mrs = "selected";}
if($suptitle1 == "Mdm"){$sup1mdm = "selected";}
if($suptitle1 == "Dr"){$sup1dr = "selected";}
if($suptitle1 == "Prof"){$sup1prof = "selected";}}

if(isset($_SESSION['suptitle2'])){
$suptitle2 = $_SESSION['suptitle2'];
if($suptitle2 == "Mr"){$sup2mr = "selected";}
if($suptitle2 == "Ms"){$sup2ms = "selected";}
if($suptitle2 == "Mrs"){$sup2mrs = "selected";}
if($suptitle2 == "Mdm"){$sup2mdm = "selected";}
if($suptitle2 == "Dr"){$sup2dr = "selected";}
if($suptitle2 == "Prof"){$sup2prof = "selected";}}

if(isset($_SESSION['supname1']))
$supname1=$_SESSION['supname1'];
if(isset($_SESSION['supschool1']))
$supschool1=$_SESSION['supschool1'];
if(isset($_SESSION['supemail1']))
$supemail1=$_SESSION['supemail1'];
if(isset($_SESSION['supname2']))
$supname2=$_SESSION['supname2'];
if(isset($_SESSION['supschool2']))
$supschool2=$_SESSION['supschool2'];
if(isset($_SESSION['supemail2']))
$supemail2=$_SESSION['supemail2'];
}
if(isset($_SESSION['degree1']))
{
	$degree1=$_SESSION['degree1'] ;
	if($degree1 ==""){$deg1blank ="selected";}
	if($degree1 =="AA"){$deg1AA ="selected";}
	if($degree1 =="AS"){$deg1AS ="selected";}
	if($degree1 =="AAS"){$deg1AAS ="selected";}
	if($degree1 =="ADEng"){$deg1ADEng ="selected";}
	if($degree1 =="AAA"){$deg1AAA ="selected";}
	if($degree1 =="APS"){$deg1APS ="selected";}
	if($degree1 =="BA"){$deg1BA ="selected";}
	if($degree1 =="BSc"){$deg1BSc ="selected";}
	if($degree1 =="BFA"){$deg1BFA ="selected";}
	if($degree1 =="BBA"){$deg1BBA ="selected";}
	if($degree1 =="BArch"){$deg1BArch ="selected";}
	if($degree1 =="MA"){$deg1MA ="selected";}
	if($degree1 =="MS"){$deg1MS ="selected";}
	if($degree1 =="MARes"){$deg1MARes ="selected";}
	if($degree1 =="MPhil"){$deg1MPhil ="selected";}
	if($degree1 =="LLM"){$deg1LLM ="selected";}
	if($degree1 =="MBA"){$deg1MBA ="selected";}
	if($degree1 =="PhD"){$deg1PhD ="selected";}
	if($degree1 =="MD"){$deg1MD ="selected";}
	if($degree1 =="DEd"){$deg1DEd ="selected";}
	if($degree1 =="JD"){$deg1JD ="selected";}
}
if(isset($_SESSION['duration1']))
$duration1=$_SESSION['duration1'];
if(isset($_SESSION['yearaward1']))
$yearaward1=$_SESSION['yearaward1'];
if(isset($_SESSION['GPA1']))
$GPA1=$_SESSION['GPA1'];
if(isset($_SESSION['completion1']))
$completion1=$_SESSION['completion1'];
if(isset($_SESSION['institute1']))
$institute1=$_SESSION['institute1'];

if(isset($_SESSION['degree2']))
{
	$degree2=$_SESSION['degree2'] ;
	if($degree2 ==""){$deg2blank ="selected";}
	if($degree2 =="AA"){$deg2AA ="selected";}
	if($degree2 =="AS"){$deg2AS ="selected";}
	if($degree2 =="AAS"){$deg2AAS ="selected";}
	if($degree2 =="ADEng"){$deg2ADEng ="selected";}
	if($degree2 =="AAA"){$deg2AAA ="selected";}
	if($degree2 =="APS"){$deg2APS ="selected";}
	if($degree2 =="BA"){$deg2BA ="selected";}
	if($degree2 =="BSc"){$deg2BSc ="selected";}
	if($degree2 =="BFA"){$deg2BFA ="selected";}
	if($degree2 =="BBA"){$deg2BBA ="selected";}
	if($degree2 =="BArch"){$deg2BArch ="selected";}
	if($degree2 =="MA"){$deg2MA ="selected";}
	if($degree2 =="MS"){$deg2MS ="selected";}
	if($degree2 =="MARes"){$deg2MARes ="selected";}
	if($degree2 =="MPhil"){$deg2MPhil ="selected";}
	if($degree2 =="LLM"){$deg2LLM ="selected";}
	if($degree2 =="MBA"){$deg2MBA ="selected";}
	if($degree2 =="PhD"){$deg2PhD ="selected";}
	if($degree2 =="MD"){$deg2MD ="selected";}
	if($degree2 =="DEd"){$deg2DEd ="selected";}
	if($degree2 =="JD"){$deg2JD ="selected";}
}
if(isset($_SESSION['duration2']))
$duration2=$_SESSION['duration2'];
if(isset($_SESSION['yearaward2']))
$yearaward2=$_SESSION['yearaward2'];
if(isset($_SESSION['GPA2']))
$GPA2=$_SESSION['GPA2'];
if(isset($_SESSION['completion2']))
$completion2=$_SESSION['completion2'];
if(isset($_SESSION['institute2']))
$institute2=$_SESSION['institute2'];

if(isset($_SESSION['degree3']))
{
	$degree3=$_SESSION['degree3'];
	if($degree3 ==""){$deg3blank ="selected";}
	if($degree3 =="AA"){$deg3AA ="selected";}
	if($degree3 =="AS"){$deg3AS ="selected";}
	if($degree3 =="AAS"){$deg3AAS ="selected";}
	if($degree3 =="ADEng"){$deg3ADEng ="selected";}
	if($degree3 =="AAA"){$deg3AAA ="selected";}
	if($degree3 =="APS"){$deg3APS ="selected";}
	if($degree3 =="BA"){$deg3BA ="selected";}
	if($degree3 =="BSc"){$deg3BSc ="selected";}
	if($degree3 =="BFA"){$deg3BFA ="selected";}
	if($degree3 =="BBA"){$deg3BBA ="selected";}
	if($degree3 =="BArch"){$deg3BArch ="selected";}
	if($degree3 =="MA"){$deg3MA ="selected";}
	if($degree3 =="MS"){$deg3MS ="selected";}
	if($degree3 =="MARes"){$deg3MARes ="selected";}
	if($degree3 =="MPhil"){$deg3MPhil ="selected";}
	if($degree3 =="LLM"){$deg3LLM ="selected";}
	if($degree3 =="MBA"){$deg3MBA ="selected";}
	if($degree3 =="PhD"){$deg3PhD ="selected";}
	if($degree3 =="MD"){$deg3MD ="selected";}
	if($degree3 =="DEd"){$deg3DEd ="selected";}
	if($degree3 =="JD"){$deg3JD ="selected";}
}
if(isset($_SESSION['duration3']))
$duration3=$_SESSION['duration3'];
if(isset($_SESSION['yearaward3']))
$yearaward3=$_SESSION['yearaward3'];
if(isset($_SESSION['GPA3']))
$GPA3=$_SESSION['GPA3'];
if(isset($_SESSION['completion3']))
$completion3=$_SESSION['completion3'];
if(isset($_SESSION['institute3']))
$institute3=$_SESSION['institute3'];

if(isset($_SESSION['position1']))
$position1=$_SESSION['position1'];
if(isset($_SESSION['empinst1']))
$empinst1=$_SESSION['empinst1'];
if(isset($_SESSION['yearappoint1']))
$yearappoint1=$_SESSION['yearappoint1'];

if(isset($_SESSION['position2']))
$position2=$_SESSION['position2'];
if(isset($_SESSION['empinst2']))
$empinst2=$_SESSION['empinst2'];
if(isset($_SESSION['yearappoint2']))
$yearappoint2=$_SESSION['yearappoint2'];

if(isset($_SESSION['position3']))
$position3=$_SESSION['position3'];
if(isset($_SESSION['empinst3']))
$empinst3=$_SESSION['empinst3'];
if(isset($_SESSION['yearappoint3']))
$yearappoint3=$_SESSION['yearappoint3'];

if(isset($_SESSION['pubyear1']))
$pubyear1=$_SESSION['pubyear1'];
if(isset($_SESSION['pubtitle1']))
$pubtitle1=$_SESSION['pubtitle1'];
if(isset($_SESSION['pubref1']))
$pubref1=$_SESSION['pubref1'];

if(isset($_SESSION['pubyear2']))
$pubyear2=$_SESSION['pubyear2'];
if(isset($_SESSION['pubtitle2']))
$pubtitle2=$_SESSION['pubtitle2'];
if(isset($_SESSION['pubref2']))
$pubref2=$_SESSION['pubref2'];

if(isset($_SESSION['pubyear3']))
$pubyear3=$_SESSION['pubyear3'];
if(isset($_SESSION['pubtitle3']))
$pubtitle3=$_SESSION['pubtitle3'];
if(isset($_SESSION['pubref3']))
$pubref3=$_SESSION['pubref3'];

if(isset($_SESSION['pubyear4']))
$pubyear4=$_SESSION['pubyear4'];
if(isset($_SESSION['pubtitle4']))
$pubtitle4=$_SESSION['pubtitle4'];
if(isset($_SESSION['pubref4']))
$pubref4=$_SESSION['pubref4'];

if(isset($_SESSION['pubyear5']))
$pubyear5=$_SESSION['pubyear5'];
if(isset($_SESSION['pubtitle5']))
$pubtitle5=$_SESSION['pubtitle5'];
if(isset($_SESSION['pubref5']))
$pubref5=$_SESSION['pubref5'];

if(isset($_SESSION['qualyear1']))
$qualyear1=$_SESSION['qualyear1'];
if(isset($_SESSION['qualname1']))
$qualname1=$_SESSION['qualname1'];
if(isset($_SESSION['institutename1']))
$institutename1=$_SESSION['institutename1'];

if(isset($_SESSION['qualyear2']))
$qualyear2=$_SESSION['qualyear2'];
if(isset($_SESSION['qualname2']))
$qualname2=$_SESSION['qualname2'];
if(isset($_SESSION['institutename2']))
$institutename2=$_SESSION['institutename2'];

if(isset($_SESSION['qualyear3']))
$qualyear3=$_SESSION['qualyear3'];
if(isset($_SESSION['qualname3']))
$qualname3=$_SESSION['qualname3'];
if(isset($_SESSION['institutename3']))
$institutename3=$_SESSION['institutename3'];

if(isset($_SESSION['qualyear4']))
$qualyear4=$_SESSION['qualyear4'];
if(isset($_SESSION['qualname4']))
$qualname4=$_SESSION['qualname4'];
if(isset($_SESSION['institutename4']))
$institutename4=$_SESSION['institutename4'];

if(isset($_SESSION['testscore'])){
$testscore = $_SESSION['testscore'];}
if(isset($_SESSION['testdate'])){
$testdate = $_SESSION['testdate'];}
if(isset($_SESSION['engcourse'])){
$engcourse = $_SESSION['engcourse'];}
if(isset($_SESSION['result'])){
$result = $_SESSION['result'];}

if(!isset($_POST['part6updatebtn'])){
	if(isset($_SESSION['eng']))
	{
	$eng=$_SESSION['eng'];
	if($eng =="main")
	{
		$mainchecked ="checked";
	}
	if($eng =="pending")
	{
		$pendingchecked ="checked";
	}
	if($eng =="completed")
	{
		$completedchecked = "checked";
		if(isset($_SESSION['testtype'])){
			$testtype = $_SESSION['testtype'];
			if($testtype == "IELTS")
			{
				$ieltscheck = "checked";
			}
			if($testtype == "TOEFL_Paper")
			{
				$toeflpprcheck = "checked";
			}
			if($testtype == "TOEFL_IE")
			{
				$toeflwwwcheck = "checked";
			}
		}
	}
	if($eng =="other")
	{
		$otherchecked = "checked";
		
		if(isset($_SESSION['testtype'])){
			$testtype = $_SESSION['testtype'];
			if(isset($_SESSION['engcourse']))
			{
				$engcourse = $_SESSION['engcourse'];
			}
			if(isset($_SESSION['result']))
			{
				$result = $_SESSION['result'];
			}
		}
	}
}}
if(isset($_SESSION['engcourse']))
$engcourse=$_SESSION['engcourse'];
if(isset($_SESSION['result']))
$result=$_SESSION['result'];
if(isset($_SESSION['testtype']))
$testtype=$_SESSION['testtype'];

if(isset($_SESSION['testdate']))
$testdate=$_SESSION['testdate'];


if (isset($_POST['part3updatebtn']))
{
	$err = ""; // error checker
	//declare input
	
	
	if(!isset($_POST['program'])){
    $err = "Yes"; 
	$errprogram = "Please select at least one program";	
    }
	if(isset($_POST['program'])) 
	{		
		$programcounter = $_POST['program'];
		$program = "";
		
		for($i=0; $i < count($programcounter); $i++)
		{			
			if ($i + 1 < count($programcounter)) 
			{
				$program .= $programcounter[$i].",";
			}
			else 
			{
				$program .= $programcounter[$i];
			}
			if($programcounter[$i]=="PhD"){$phdchecked ="checked";}
			if($programcounter[$i]=="MPhil"){$mphilchecked ="checked";}
			if($programcounter[$i]=="RMT"){$rmtchecked ="checked";}
			if($programcounter[$i]=="DVetMedS"){$dvetmedschecked ="checked";}
			if($programcounter[$i]=="MEd Res"){$medreschecked ="checked";}
			if($programcounter[$i]=="DPSYCH"){$dpsychchecked ="checked";}
			if($programcounter[$i]=="LLM"){$llmchecked="checked";}
			if($programcounter[$i]=="DIT"){$ditchecked="checked";}
			if($programcounter[$i]=="EdD"){$eddchecked="checked";}
			if($programcounter[$i]=="MAppPsych/PhD"){$mapppsychchecked = "checked";}
			
		}
	}
	if (isset($_POST['school']))
	{
		$school = $_POST['school'];
	}
		
	if ($_POST['year'] == date('Y')) 
	{
		if ($_POST['month'] < date('m')) 
		{
			$err = "Yes";
			$errdate ="*Please enter future period";
		}
	}
	
	if (($_POST['month'] == "")||$_POST['year'] == "")
		{
			$err = "Yes";
			$errdate ="*Please select correct period";
		}
	
	
	
	// part time or full time check
	if(!isset($_POST["PFtime"])){
    $errPFtime = "Please select either part or full time";
    }
    if(isset($_POST['PFtime']))
	{
        $PFtime = $_POST["PFtime"];
        if ($PFtime == "PT"){
            $PTchecked = "checked";
        }
        else if ($PFtime == "FT"){
            $FTchecked = "checked";
        }
    }
	if($err!="")
	{
		$mainerror="*Required information is either missing or incorrect";
	}
	if($err == "")
		{
		$_SESSION['program'] = $program;
		$_SESSION['school'] = $school;
		$_SESSION['month'] = $_POST['month'];
		$_SESSION['year'] = $_POST['year'];
		$_SESSION['PFtime'] = $PFtime;
		header("Location:EOI_Page4.php");
		}
	}
	
if (isset($_POST['part4updatebtn']))
{
	$err = "";
////////////////////referral supervisor/////////////	
	if (isset($_POST['suptitle1']))
	{
		$suptitle1 = $_POST['suptitle1'];
		if($suptitle1 == "Mr"){$sup1mr = "selected";}
		if($suptitle1 == "Ms"){$sup1ms = "selected";}
		if($suptitle1 == "Mrs"){$sup1mrs = "selected";}
		if($suptitle1 == "Mdm"){$sup1mdm = "selected";}
		if($suptitle1 == "Dr"){$sup1dr = "selected";}
		if($suptitle1 == "Prof"){$sup1prof = "selected";}
	}
	if (isset($_POST['suptitle2']))
	{
		$suptitle2 = $_POST['suptitle2'];
		if($suptitle2 == "Mr"){$sup2mr = "selected";}
		if($suptitle2 == "Ms"){$sup2ms = "selected";}
		if($suptitle2 == "Mrs"){$sup2mrs = "selected";}
		if($suptitle2 == "Mdm"){$sup2mdm = "selected";}
		if($suptitle2 == "Dr"){$sup2dr = "selected";}
		if($suptitle2 == "Prof"){$sup2prof = "selected";}
	}
	if (isset($_POST['supname1']))
	{
		$supname1 = $_POST['supname1'];
	}
	if (isset($_POST['supschool1']))
	{
		$supschool1 = $_POST['supschool1'];
	}
	if($_POST['supemail1']!=""){
		$supemail1 = $_POST['supemail1'];
		if ((!filter_var($_POST['supemail1'],FILTER_VALIDATE_EMAIL)))
		{
			$errsup = "Invalid email address!";
			$err = "Yes";
		}
	}
	
	if(isset($_POST['supname2']))
	{
		$supname2 = $_POST['supname2'];
	}
	if (isset($_POST['supschool2']))
	{
		$supschool2 = $_POST['supschool2'];
	}
	if($_POST['supemail2']!="")
	{
		$supemail2 = $_POST['supemail2'];
		if ((!filter_var($_POST['supemail2'],FILTER_VALIDATE_EMAIL)))
		{
			$errsup = "Invalid email address!";
			$err = "Yes";
			
		}
	}
	if($suptitle1 !="" || $supname1 !="" || $supschool1 !="" || $supemail1 !="")
	{
		if($suptitle1 =="" || $supname1 =="" || $supschool1 =="" || $supemail1 =="")
		{
			$err="Yes";
			$errsup ="*";
		}
	}
	if($suptitle2 !="" || $supname2 !="" || $supschool2 !="" || $supemail2 !="")
	{
		if($suptitle2 =="" || $supname2 =="" || $supschool2 =="" || $supemail2 =="")
		{
			$err="Yes";
			$errsup ="*";
		}
	}
//////////////////////////////////////////////////////	
		
	if(($_POST['FOR1']=="")&&($_POST['FOR2']=="")&&($_POST['FOR3']==""))
	{
		$errFOR ="Please select at least 1 FOR";
		$err = "Yes";
	}
	if(($_POST['FOR1']!="")||($_POST['FOR2']!="")||($_POST['FOR3']!=""))
	{
		$FOR1=$_POST['FOR1'];
		$FOR2=$_POST['FOR2'];
		$FOR3=$_POST['FOR3'];
		if(($_POST['FOR1']!="" && $_POST['FOR2']!="")|| ($_POST['FOR1']!="" && $_POST['FOR2']!="")||($_POST['FOR1']!="" && $_POST['FOR2']!=""))
		{
			if((($_POST['FOR1']==$_POST['FOR2']))||(($_POST['FOR2']==$_POST['FOR3']))||(($_POST['FOR2']==$_POST['FOR3'])))
			{
				$err = "Yes"; 
				$errFOR ="Please select a different FOR";
			}
		}
	}
		
	if(
	(isset($_POST['researchinterest1'])&& ($_POST['researchinterest1'])=="")&&
	(isset($_POST['researchinterest2'])&& ($_POST['researchinterest2'])=="")&&
	(isset($_POST['researchinterest3'])&& ($_POST['researchinterest3'])=="")&&
	(isset($_POST['researchinterest4'])&& ($_POST['researchinterest4'])=="")&&
	(isset($_POST['researchinterest5'])&& ($_POST['researchinterest5'])==""))
	{
		$err="Yes";
		$errresearchinterest="*";
	}
	if(
	((isset($_POST['researchinterest1'])&& $_POST['researchinterest1'])!="")||
	((isset($_POST['researchinterest2'])&& $_POST['researchinterest2'])!="")||
	((isset($_POST['researchinterest3'])&& $_POST['researchinterest3'])!="")||
	((isset($_POST['researchinterest4'])&& $_POST['researchinterest4'])!="")||
	((isset($_POST['researchinterest5'])&& $_POST['researchinterest5'])!=""))
	{
		$researchinterest1= trim($_POST['researchinterest1']);
		$researchinterest2= trim($_POST['researchinterest2']);
		$researchinterest3= trim($_POST['researchinterest3']);
		$researchinterest4= trim($_POST['researchinterest4']);
		$researchinterest5= trim($_POST['researchinterest5']);
	}
	if($err!="")
	{
		$mainerror="*Required information is either missing or incorrect";
	}
	if($err == "")
	{
	$_SESSION['FOR1'] = $FOR1;
	$_SESSION['FOR2'] = $FOR2;
	$_SESSION['FOR3'] = $FOR3;
	
	$_SESSION['researchinterest1'] = $researchinterest1;
	$_SESSION['researchinterest2'] = $researchinterest2;
	$_SESSION['researchinterest3'] = $researchinterest3;
	$_SESSION['researchinterest4'] = $researchinterest4;
	$_SESSION['researchinterest5'] = $researchinterest5;
	

	$_SESSION['suptitle1'] = $suptitle1;
	$_SESSION['supname1'] = $supname1;
	$_SESSION['supschool1'] = $supschool1;
	$_SESSION['supemail1'] = $supemail1;
	$_SESSION['suptitle2'] = $suptitle2;
	$_SESSION['supname2'] = $supname2;
	$_SESSION['supschool2'] = $supschool2;
	$_SESSION['supemail2'] = $supemail2;
	
	header("Location:EOI_Page4.php");
	}
}
if (isset($_POST['part5updatebtn']))
	{
//////////////academic qualitication//////////////////	
		if(isset($_POST['degree1']))
		{
			$degree1=$_POST['degree1'];
			if($degree1 ==""){$deg1blank ="selected";}
			if($degree1 =="AA"){$deg1AA ="selected";}
			if($degree1 =="AS"){$deg1AS ="selected";}
			if($degree1 =="AAS"){$deg1AAS ="selected";}
			if($degree1 =="ADEng"){$deg1ADEng ="selected";}
			if($degree1 =="AAA"){$deg1AAA ="selected";}
			if($degree1 =="APS"){$deg1APS ="selected";}
			if($degree1 =="BA"){$deg1BA ="selected";}
			if($degree1 =="BSc"){$deg1BSc ="selected";}
			if($degree1 =="BFA"){$deg1BFA ="selected";}
			if($degree1 =="BBA"){$deg1BBA ="selected";}
			if($degree1 =="BArch"){$deg1BArch ="selected";}
			if($degree1 =="MA"){$deg1MA ="selected";}
			if($degree1 =="MS"){$deg1MS ="selected";}
			if($degree1 =="MARes"){$deg1MARes ="selected";}
			if($degree1 =="MPhil"){$deg1MPhil ="selected";}
			if($degree1 =="LLM"){$deg1LLM ="selected";}
			if($degree1 =="MBA"){$deg1MBA ="selected";}
			if($degree1 =="PhD"){$deg1PhD ="selected";}
			if($degree1 =="MD"){$deg1MD ="selected";}
			if($degree1 =="DEd"){$deg1DEd ="selected";}
			if($degree1 =="JD"){$deg1JD ="selected";}
		}
		if(isset($_POST['yearaward1'])){$yearaward1=$_POST['yearaward1'];}
		if(isset($_POST['duration1'])){$duration1=$_POST['duration1'];}
		if(isset($_POST['GPA1'])){$GPA1=trim($_POST['GPA1']);}
		if(isset($_POST['completion1'])){$completion1=trim($_POST['completion1']);}
		if(isset($_POST['institute1'])){$institute1=trim($_POST['institute1']);}
		
		if(isset($_POST['degree2']))
		{
			$degree2=$_POST['degree2'];
			if($degree2 ==""){$deg2blank ="selected";}
			if($degree2 =="AA"){$deg2AA ="selected";}
			if($degree2 =="AS"){$deg2AS ="selected";}
			if($degree2 =="AAS"){$deg2AAS ="selected";}
			if($degree2 =="ADEng"){$deg2ADEng ="selected";}
			if($degree2 =="AAA"){$deg2AAA ="selected";}
			if($degree2 =="APS"){$deg2APS ="selected";}
			if($degree2 =="BA"){$deg2BA ="selected";}
			if($degree2 =="BSc"){$deg2BSc ="selected";}
			if($degree2 =="BFA"){$deg2BFA ="selected";}
			if($degree2 =="BBA"){$deg2BBA ="selected";}
			if($degree2 =="BArch"){$deg2BArch ="selected";}
			if($degree2 =="MA"){$deg2MA ="selected";}
			if($degree2 =="MS"){$deg2MS ="selected";}
			if($degree2 =="MARes"){$deg2MARes ="selected";}
			if($degree2 =="MPhil"){$deg2MPhil ="selected";}
			if($degree2 =="LLM"){$deg2LLM ="selected";}
			if($degree2 =="MBA"){$deg2MBA ="selected";}
			if($degree2 =="PhD"){$deg2PhD ="selected";}
			if($degree2 =="MD"){$deg2MD ="selected";}
			if($degree2 =="DEd"){$deg2DEd ="selected";}
			if($degree2 =="JD"){$deg2JD ="selected";}
		}
		if(isset($_POST['yearaward2'])){$yearaward2=$_POST['yearaward2'];}
		if(isset($_POST['duration2'])){$duration2=$_POST['duration2'];}
		if(isset($_POST['GPA2'])){$GPA2=trim($_POST['GPA2']);}
		if(isset($_POST['completion2'])){$completion2=trim($_POST['completion2']);}
		if(isset($_POST['institute2'])){$institute2=trim($_POST['institute2']);}
		
		if(isset($_POST['degree3']))
		{
			$degree3=$_POST['degree3'];
			if($degree3 ==""){$deg3blank ="selected";}
			if($degree3 =="AA"){$deg3AA ="selected";}
			if($degree3 =="AS"){$deg3AS ="selected";}
			if($degree3 =="AAS"){$deg3AAS ="selected";}
			if($degree3 =="ADEng"){$deg3ADEng ="selected";}
			if($degree3 =="AAA"){$deg3AAA ="selected";}
			if($degree3 =="APS"){$deg3APS ="selected";}
			if($degree3 =="BA"){$deg3BA ="selected";}
			if($degree3 =="BSc"){$deg3BSc ="selected";}
			if($degree3 =="BFA"){$deg3BFA ="selected";}
			if($degree3 =="BBA"){$deg3BBA ="selected";}
			if($degree3 =="BArch"){$deg3BArch ="selected";}
			if($degree3 =="MA"){$deg3MA ="selected";}
			if($degree3 =="MS"){$deg3MS ="selected";}
			if($degree3 =="MARes"){$deg3MARes ="selected";}
			if($degree3 =="MPhil"){$deg3MPhil ="selected";}
			if($degree3 =="LLM"){$deg3LLM ="selected";}
			if($degree3 =="MBA"){$deg3MBA ="selected";}
			if($degree3 =="PhD"){$deg3PhD ="selected";}
			if($degree3 =="MD"){$deg3MD ="selected";}
			if($degree3 =="DEd"){$deg3DEd ="selected";}
			if($degree3 =="JD"){$deg3JD ="selected";}
		}
		if(isset($_POST['yearaward3'])){$yearaward3=$_POST['yearaward3'];}
		if(isset($_POST['duration3'])){$duration3=$_POST['duration3'];}
		if(isset($_POST['GPA3'])){$GPA3=trim($_POST['GPA3']);}
		if(isset($_POST['completion3'])){$completion3=trim($_POST['completion3']);}
		if(isset($_POST['institute3'])){$institute3=trim($_POST['institute3']);}
		
		if(($degree1 ==""||$yearaward1 ==""||$duration1 ==""||$GPA1 ==""||$completion1==""||$institute1=="")&&
		($degree2 ==""||$yearaward2 ==""||$duration2 ==""||$GPA2 ==""||$completion2==""||$institute2=="")&&
		($degree3 ==""||$yearaward3 ==""||$duration3 ==""||$GPA3 ==""||$completion3==""||$institute3==""))
		{
			$err="Yes";
			$errdegree ="*";
		}
	
		/*					degree 1								*/
		if($degree1 !=""&&$yearaward1 !=""&&$duration1 !=""&&$GPA1 !=""&&$completion1!=""&&$institute1!="")
		{
			//check for only 1 number with 2 decimal
			if(($GPA1 > 7  || $GPA1 < 0)||!preg_match("#^\d{1}+(?:\.[0-9]{0,2})?$#",$GPA1))
			{
				$err="Yes";
				$errdegree ="*";
			}
			if($completion1 > 100 || $completion1 < 0 ||(!preg_match("/^(?:100|\d{1,2})?$/",$completion1)))
			{
				$err="Yes";
				$errdegree ="*";
			}
		}
		/*					degree 2								*/
		if($degree2 !=""&&$yearaward2 !=""&&$duration2 !=""&&$GPA2 !=""&&$completion2!=""&&$institute2!="")
		{
			if(($GPA2 > 7  || $GPA2 < 0)||!preg_match("#^\d{1}+(?:\.[0-9]{0,2})?$#",$GPA2))
			{
				$err="Yes";
				$errdegree ="*";
			}
			if($completion2 > 100 || $completion2 < 0||!preg_match("/^(?:100|\d{1,2})?$/",$completion2))
			{
				$err="Yes";
				$errdegree ="*";
			}
		}
		/*					degree 3								*/
		if($degree3 !=""&&$yearaward3 !=""&&$duration3 !=""&&$GPA3 !=""&&$completion3!=""&&$institute3!="")
		{
		
			if(($GPA3 > 7  || $GPA3 < 0)||!preg_match("#^\d{1}+(?:\.[0-9]{0,2})?$#",$GPA3))
			{
				$err="Yes";
				$errdegree ="*";
			}
			if($completion3 > 100 || $completion3 < 0||!preg_match("/^(?:100|\d{1,2})?$/",$completion3))
			{
				$err="Yes";
				$errdegree ="*";
			}
		}
		
		
	///////////////////employment//////////////////
		if(isset($_POST['position1']))
		{
			$position1 = trim($_POST['position1']);
		}
		if(isset($_POST['empinst1']))
		{
			$empinst1 = trim($_POST['empinst1']);
		}
		if(isset($_POST['yearappoint1']))
		{
			$yearappoint1 = trim($_POST['yearappoint1']);
		}
		if($position1 !="" || $empinst1 !="" || $yearappoint1 !="")
		{
			if($position1 =="" || $empinst1 =="" || $yearappoint1 =="")
			{
				$err="Yes";
				$errposition ="*";
			}
		}
		if(isset($_POST['position2']))
		{
			$position2 = trim($_POST['position2']);
		}
		if(isset($_POST['empinst2']))
		{
			$empinst2 = trim($_POST['empinst2']);
		}
		if(isset($_POST['yearappoint2']))
		{
			$yearappoint2 = trim($_POST['yearappoint2']);
		}
		if($position2 !="" || $empinst2 !="" || $yearappoint2 !="")
		{
			if($position2 =="" || $empinst2 =="" || $yearappoint2 =="")
			{
				$err="Yes";
				$errposition ="*";
			}
		}
		if(isset($_POST['position3']))
		{
			$position3 = trim($_POST['position3']);
		}
		if(isset($_POST['empinst3']))
		{
			$empinst3 = trim($_POST['empinst3']);
		}
		if(isset($_POST['yearappoint3']))
		{
			$yearappoint3 = trim($_POST['yearappoint3']);
		}
		if($position3 !="" || $empinst3 !="" || $yearappoint3 !="")
		{
			if($position3 =="" || $empinst3 =="" || $yearappoint3 =="")
			{
				$err="Yes";
				$errposition ="*";
			}
		}
		
		
		
	///////////////////publification/////////////////
		if(isset($_POST['pubyear1']))
		{
			$pubyear1 = trim($_POST['pubyear1']);
		}
		if(isset($_POST['pubtitle1']))
		{
			$pubtitle1 = trim($_POST['pubtitle1']);
		}
		if(isset($_POST['pubref1']))
		{
			$pubref1 = trim($_POST['pubref1']);
		}
		if($pubyear1 !="" || $pubtitle1 !="" || $pubref1 !="")
		{
			if($pubyear1 =="" || $pubtitle1 =="" || $pubref1 =="")
			{
				$err="Yes";
				$errpubyear ="*";
			}
		}
		if(isset($_POST['pubyear2']))
		{
			$pubyear2 = trim($_POST['pubyear2']);
		}
		if(isset($_POST['pubtitle2']))
		{
			$pubtitle2 = trim($_POST['pubtitle2']);
		}
		if(isset($_POST['pubref2']))
		{
			$pubref2 = trim($_POST['pubref2']);
		}
		if($pubyear2 !="" || $pubtitle2 !="" || $pubref2 !="")
		{
			if($pubyear2 =="" || $pubtitle2 =="" || $pubref2 =="")
			{
				$err="Yes";
				$errpubyear ="*";
			}
		}
		if(isset($_POST['pubyear3']))
		{
			$pubyear3 = trim($_POST['pubyear3']);
		}
		if(isset($_POST['pubtitle3']))
		{
			$pubtitle3 = trim($_POST['pubtitle3']);
		}
		if(isset($_POST['pubref3']))
		{
			$pubref3 = trim($_POST['pubref3']);
		}
		if($pubyear3 !="" || $pubtitle3 !="" || $pubref3 !="")
		{
			if($pubyear3 =="" || $pubtitle3 =="" || $pubref3 =="")
			{
				$err="Yes";
				$errpubyear ="*";
			}
		}
		if(isset($_POST['pubyear4']))
		{
			$pubyear4 = trim($_POST['pubyear4']);
		}
		if(isset($_POST['pubtitle4']))
		{
			$pubtitle4 = trim($_POST['pubtitle4']);
		}
		if(isset($_POST['pubref4']))
		{
			$pubref4 = trim($_POST['pubref4']);
		}
		if($pubyear4 !="" || $pubtitle4 !="" || $pubref4 !="")
		{
			if($pubyear4 =="" || $pubtitle4 =="" || $pubref4 =="")
			{
				$err="Yes";
				$errpubyear ="*";
			}
		}
		if(isset($_POST['pubyear5']))
		{
			$pubyear5 = trim($_POST['pubyear5']);
		}
		if(isset($_POST['pubtitle5']))
		{
			$pubtitle5 = trim($_POST['pubtitle5']);
		}
		if(isset($_POST['pubref5']))
		{
			$pubref5 = trim($_POST['pubref5']);
		}
		if($pubyear5 !="" || $pubtitle5 !="" || $pubref5 !="")
		{
			if($pubyear5 =="" || $pubtitle5 =="" || $pubref5 =="")
			{
				$err="Yes";
				$errpubyear ="*";
			}
		}
	/////////////////awards & membership///////////
		
		if(isset($_POST['qualyear1']))
		{
			$qualyear1 = trim($_POST['qualyear1']);
		}
		if(isset($_POST['qualname1']))
		{
			$qualname1 = trim($_POST['qualname1']);
		}
		if(isset($_POST['institutename1']))
		{
			$institutename1 = trim($_POST['institutename1']);
		}
		if($qualyear1 !="" || $qualname1 !="" || $institutename1 !="")
		{
			if($qualyear1 =="" || $qualname1 =="" || $institutename1 =="")
			{
				$err="Yes";
				$errqualyear ="*";
			}
		}
		
		if(isset($_POST['qualyear2']))
		{
			$qualyear2 = trim($_POST['qualyear2']);
		}
		if(isset($_POST['qualname2']))
		{
			$qualname2 = trim($_POST['qualname2']);
		}
		if(isset($_POST['institutename2']))
		{
			$institutename2 = trim($_POST['institutename2']);
		}
		if($qualyear2 !="" || $qualname2 !="" || $institutename2 !="")
		{
			if($qualyear2 =="" || $qualname2 =="" || $institutename2 =="")
			{
				$err="Yes";
				$errqualyear ="*";
			}
		}
		if(isset($_POST['qualyear3']))
		{
			$qualyear3 = trim($_POST['qualyear3']);
		}
		if(isset($_POST['qualname3']))
		{
			$qualname3 = trim($_POST['qualname3']);
		}
		if(isset($_POST['institutename3']))
		{
			$institutename3 = trim($_POST['institutename3']);
		}
		if($qualyear3 !="" || $qualname3 !="" || $institutename3 !="")
		{
			if($qualyear3 =="" || $qualname3 =="" || $institutename3 =="")
			{
				$err="Yes";
				$errqualyear ="*";
			}
		}
		if(isset($_POST['qualyear4']))
		{
			$qualyear4 = trim($_POST['qualyear4']);
		}
		if(isset($_POST['qualname4']))
		{
			$qualname4 = trim($_POST['qualname4']);
		}
		if(isset($_POST['institutename4']))
		{
			$institutename4 = trim($_POST['institutename4']);
		}
		if($qualyear4 !="" || $qualname4 !="" || $institutename4 !="")
		{
			if($qualyear4 =="" || $qualname4 =="" || $institutename4 =="")
			{
				$err="Yes";
				$errqualyear ="*";
			}
		}
		
		
	////////////////////////////////////////////////////
		if($err!="")
		{
			$mainerror="*Required information is either missing or incorrect";
		}
		if($err == "")
		{
			$_SESSION['degree1'] = $degree1;
			$_SESSION['duration1'] = $duration1;
			$_SESSION['yearaward1'] = $yearaward1;
			$_SESSION['GPA1'] = $GPA1;
			$_SESSION['completion1'] = $completion1;
			$_SESSION['institute1'] = $institute1;
			
			$_SESSION['degree2'] = $degree2;
			$_SESSION['duration2'] = $duration2;
			$_SESSION['yearaward2'] = $yearaward2;
			$_SESSION['GPA2'] = $GPA2;
			$_SESSION['completion2'] = $completion2;
			$_SESSION['institute2'] = $institute2;
			
			$_SESSION['degree3'] = $degree3;
			$_SESSION['duration3'] = $duration3;
			$_SESSION['yearaward3'] = $yearaward3;
			$_SESSION['GPA3'] = $GPA3;
			$_SESSION['completion3'] = $completion3;
			$_SESSION['institute3'] = $institute3;
			
			$_SESSION['position1'] = $position1;
			$_SESSION['empinst1'] = $empinst1;
			$_SESSION['yearappoint1'] = $yearappoint1;
			
			$_SESSION['position2'] = $position2;
			$_SESSION['empinst2'] = $empinst2;
			$_SESSION['yearappoint2'] = $yearappoint2;
			
			$_SESSION['position3'] = $position3;
			$_SESSION['empinst3'] = $empinst3;
			$_SESSION['yearappoint3'] = $yearappoint3;
			
			$_SESSION['pubyear1'] = $pubyear1;
			$_SESSION['pubtitle1'] = $pubtitle1;
			$_SESSION['pubref1'] = $pubref1;
			
			$_SESSION['pubyear2'] = $pubyear2;
			$_SESSION['pubtitle2'] = $pubtitle2;
			$_SESSION['pubref2'] = $pubref2;
			
			$_SESSION['pubyear3'] = $pubyear3;
			$_SESSION['pubtitle3'] = $pubtitle3;
			$_SESSION['pubref3'] = $pubref3;
			
			$_SESSION['pubyear4'] = $pubyear4;
			$_SESSION['pubtitle4'] = $pubtitle4;
			$_SESSION['pubref4'] = $pubref4;
			
			$_SESSION['pubyear5'] = $pubyear5;
			$_SESSION['pubtitle5'] = $pubtitle5;
			$_SESSION['pubref5'] = $pubref5;
			
			
			$_SESSION['qualyear1'] = $qualyear1;
			$_SESSION['qualname1'] = $qualname1;
			$_SESSION['institutename1'] = 		$institutename1;
			
			$_SESSION['qualyear2'] = $qualyear2;
			$_SESSION['qualname2'] = $qualname2;
			$_SESSION['institutename2'] = 		$institutename2;
			
			$_SESSION['qualyear3'] = $qualyear3;
			$_SESSION['qualname3'] = $qualname3;
			$_SESSION['institutename3'] = 		$institutename3;
			
			$_SESSION['qualyear4'] = $qualyear4;
			$_SESSION['qualname4'] = $qualname4;
			$_SESSION['institutename4'] = 		$institutename4;
			
			
			header("Location: EOI_Page4.php");
		}
	}

	if (isset($_POST['part6updatebtn']))
	{
		///////////////////english proficiency/////////////

		if(!isset($_POST['eng']))
		{
			$err = "Yes";
			$erreng = "Please select the level of English.";
		}
		if(isset($_POST['eng']))
		{
			$eng = trim($_POST['eng']);
			if($eng =="main")
			{
				$mainchecked ="checked";
				$engcourse="";
				$result="";
				$testtype="";
				$testscore="";
				$testdate="";
			}
			if($eng =="pending")
			{
				$pendingchecked ="checked";
				$engcourse="";
				$result="";
				$testtype="";
				$testscore="";
				$testdate="";
			}
			if($eng =="completed")
			{
				$completedchecked ="checked";
				$engcourse="";
				$result="";
				if(!isset($_POST['testtype']))
				{
					$err ="Yes";
					$errtesttype = "*";
				}
				if(!isset($_POST['testdate'])||$_POST['testdate']=="")
				{
					$err ="Yes";
					$errtestdate = "*";
				}
				if($_POST['testscore']=="")
				{
					$err="Yes";
					$errtestscore = "*";
				}
				////////////////Test type/////////////////	
				if(isset($_POST['testtype']))
				{
					$testtype = $_POST['testtype'];
					$testscore = trim($_POST['testscore']);
					$testdate = trim($_POST['testdate']);
					if($testtype == "IELTS")
					{
						$ieltscheck = "checked";
						if(($testscore > 9  || $testscore < 0)||!preg_match("#^\d{1}+(?:\.[0,5]{0,1})?$#",$testscore))
						{
							$errtestscore = "Invalid result";
							$err = "Yes";
						}
						if (!filter_var($testscore,FILTER_VALIDATE_FLOAT))
						{
							$err = "Yes";
							$errtestscore ="Please enter result";
							if($testscore=="")
							{
								$errtestscore = "*";
								$err = "Yes";
							}
						}
						
					}
					if($testtype == "TOEFL_Paper")
				{
					$toeflpprcheck = "checked";
					if($testscore !="" &&($testscore >  677 || $testscore < 310 ))
					{
						$errtestscore = "*";
						$err = "Yes";
					}
					if (!filter_var($testscore,FILTER_VALIDATE_INT))
					{
						$err = "Yes";
						$errtestscore ="*";
					}
					
				}
					if($testtype == "TOEFL_IE")
					{
						$toeflwwwcheck = "checked";
						if (!filter_var($testscore,FILTER_VALIDATE_INT))
						{
							$err = "Yes";
							$errtestscore ="Please enter result";
							if($testscore=="")
							{
								$errtestscore = "*";
								$err = "Yes";
							}
						}
						if($testscore > 120 || $testscore < 0)
						{
							$errtestscore = "*";
							$err = "Yes";
						}
					}
				}
			}
			if($eng =="other")
			{
				$completedchecked ="";
				$otherchecked = "checked";
				$testtype="";
				$testscore="";
				$testdate="";
				if(isset($_POST['engcourse']))
				{$engcourse = trim($_POST['engcourse']);}
				if(isset($_POST['result']))
				{$result = trim($_POST['result']);}
				if(isset($engcourse) && $engcourse =="")
				{
					$errengcourse = "*";
					$err = "Yes";
				}
				if (!filter_var($result,FILTER_VALIDATE_INT))
				{
					$err = "Yes";
					$errresult ="*";
					if($result=="")
					{
						$errresult = "*";
						$err = "Yes";
					}
				}
			}
		}
	if($err!="")
	{
		$mainerror="*Required information is either missing or incorrect";
	}
		if($err == "")
		{
			$_SESSION['eng'] = $eng;
			$_SESSION['engcourse'] = $engcourse;
			$_SESSION['result'] = $result;
			$_SESSION['testtype'] = $testtype;
			$_SESSION['testscore'] = $testscore;
			$_SESSION['testdate'] = $testdate;
			
			header("Location: EOI_Page4.php");
		}
	}



//<!---page 3 here-->
 
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

$whyresearch ="";

$errscholarqn="";
$errwhyresearch ="";
$errvpa ="";


if(isset($_SESSION['scholarqn1']))
{
$scholarqn1=$_SESSION['scholarqn1'];}

if((!isset($_POST['scholarqn1']) && $_SESSION['scholarqn1']=="yes") || (isset($_POST['scholarqn1']) && $_POST['scholarqn1']=="yes"))
{
	$scholarqn1yes ="checked";
}
if((!isset($_POST['scholarqn1']) && $_SESSION['scholarqn1']=="no") || (isset($_POST['scholarqn1']) && $_POST['scholarqn1']=="no"))
{
	$scholarqn1no ="checked";
}
if((!isset($_POST['scholarqn2']) && $_SESSION['scholarqn2']=="yes") || (isset($_POST['scholarqn2']) && $_POST['scholarqn2']=="yes"))
{
	$scholarqn2yes ="checked";
}
if((!isset($_POST['scholarqn2']) && $_SESSION['scholarqn2']=="no") || (isset($_POST['scholarqn2']) && $_POST['scholarqn2']=="no"))
{
	$scholarqn2no ="checked";
}
if((!isset($_POST['scholarqn3']) && $_SESSION['scholarqn3']=="yes") || (isset($_POST['scholarqn3']) && $_POST['scholarqn3']=="yes"))
{
	$scholarqn3yes ="checked";
}
if((!isset($_POST['scholarqn3']) && $_SESSION['scholarqn3']=="no") || (isset($_POST['scholarqn3']) && $_POST['scholarqn3']=="no"))
{
	$scholarqn3no ="checked";
}



if(isset($_SESSION['scholarname1']))
{
$scholarname1=$_SESSION['scholarname1'];
}
if(isset($_SESSION['sponsor1']))
{
$sponsor1=$_SESSION['sponsor1'];
}
if(isset($_SESSION['VPA1'])&&$_SESSION['VPA1']!="")
{
$VPA1=$_SESSION['VPA1'];
}
if(isset($_SESSION['scholarduration1']))
{
$scholarduration1=$_SESSION['scholarduration1'];
}
if(isset($_SESSION['purpose1']))
{
$purpose1=$_SESSION['purpose1'];
}
if(isset($_SESSION['status1'])&& $_SESSION['status1']!="")
{
$status1=$_SESSION['status1'];
}

if(isset($_SESSION['scholarname2']))
{
$scholarname2=$_SESSION['scholarname2'];
}
if(isset($_SESSION['sponsor2']))
{
$sponsor2=$_SESSION['sponsor2'];
}
if(isset($_SESSION['VPA2'])&&$_SESSION['VPA2']!="")
{
$VPA2=$_SESSION['VPA2'];
}
if(isset($_SESSION['purpose2']))
{
$purpose2=$_SESSION['purpose2'];
}
if(isset($_SESSION['status2'])&& $_SESSION['status2']!="")
{
$status1=$_SESSION['status2'];
}
if(isset($_SESSION['scholarduration2']))
{
$scholarduration2=$_SESSION['scholarduration2'];
}

if(isset($_SESSION['status1'])&&$_SESSION['status1']!="")
{
$status1 = $_SESSION['status1'];
if($status1 =="applied"){$applied1 = "selected";}
if($status1 =="awarded"){$awarded1 = "selected";}
}
if(isset($_SESSION['status2'])&&$_SESSION['status2']!="")
{
$status2 = $_SESSION['status2'];
if($status2 =="applied"){$applied2 = "selected";}
if($status2 =="awarded"){$awarded2 = "selected";}
}


	
if(isset($_SESSION['whyresearch'])){
$whyresearch=$_SESSION['whyresearch'];}

$err="";




if(isset($_POST['part7updatebtn'])){
	$err="";
	
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
				$scholarduration1 = trim($_POST['scholarduration1']);
			}
			if(isset($_POST['scholarduration2']))
			{
				$scholarduration2 = trim($_POST['scholarduration2']);
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
			$scholarname1="";
			$sponsor1='';
			$VPA1='';
			$scholarduration1='';
			$purpose1='';
			$status1='';
			$scholarname2="";
			$sponsor2='';
			$VPA2='';
			$scholarduration2='';
			$purpose2='';
			$status2='';
		}
	}	
	if($err!="")
	{
		$mainerror="*Required information is either missing or incorrect";
	}
//proceed if no error//////////
	if($err =="")
	{
		$_SESSION['scholarqn1']=$scholarqn1;
		$_SESSION['scholarqn2']=$scholarqn2;
		$_SESSION['scholarqn3']=$scholarqn3;
		
		$_SESSION['scholarname1']=$scholarname1;
		$_SESSION['sponsor1']=$sponsor1;
		$_SESSION['VPA1']=$VPA1;
		$_SESSION['scholarduration1']=$scholarduration1;
		$_SESSION['purpose1']=$purpose1;
		$_SESSION['status1']=$status1;
		
		$_SESSION['scholarname2']=$scholarname2;
		$_SESSION['sponsor2']=$sponsor2;
		$_SESSION['VPA2']=$VPA2;
		$_SESSION['scholarduration2']=$scholarduration2;
		$_SESSION['purpose2']=$purpose2;
		$_SESSION['status2']=$status2;
		
		header("Location:EOI_Page4.php");
	}
}


if(isset($_POST['part8updatebtn']))
{
	$err="";
	if(isset($_POST['whyresearch']))
	{
		$whyresearch = trim($_POST['whyresearch']);
		if ($whyresearch ==""){
		$err = "Yes";
		$errwhyresearch ="*";}
	}
	if($err!="")
	{
		$mainerror="*Required information is either missing or incorrect";
	}
	if($err=="")
	{
		$_SESSION['whyresearch']=$whyresearch;
		header("Location:EOI_Page4.php");
	}
}
?>

<body>
<table border="0"  align="center">
	<tr>
		<td><div id="header">
				<div id="logo"></div>
			</div>
			<div id="navbar">EXPRESSION OF INTEREST IN HIGHER DEGREE RESEARCH CANDIDATURE</div>
			<div><img border="0" src="Image/Nav/Page 4.png" width="100%" /></div></td>
	</tr>
	
	<tr>
		<td id="form1">
			<table width="95%" border="0" align="center" id="outertable" >
				<tr >
					<td width="" style="padding:5px 40px ;"><font color="#FF0000">
					<?php echo $mainerror; ?></font><br /><h3>Please check that the information below is correct before proceeding</h3></td>
				</tr>
				<tr>
					<td style="padding:5px 40px ;">
					<!-------------section 1---------------->
						
						<form id="part1" name="eoiform" method="post"  action="#">
							<font size="+2" ><strong>1. Personal details</strong></font>
							<?php  if (!isset($_REQUEST['edit'])){?>
							<a href="EOI_Page4.php?edit=part1#part1">(Edit)</a>
							<?php } if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
								<input name="part1updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							<p><strong>Title: </strong><font color="#FF0000"><?php echo $errtitle; ?></font>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part1"))){echo $_SESSION['title'];} ?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
									<select name="title">
										<option value="Mr" <?php echo $mr; ?> >Mr</option>
										<option value="Ms" <?php echo $ms; ?> >Ms</option>
										<option value="Mrs" <?php echo $mrs; ?>>Mrs</option>
										<option value="Mdm" <?php echo $mdm; ?>>Mdm</option>
										<option value="Dr" <?php echo $dr; ?>>Dr</option>
										<option value="Prof" <?php echo $prof; ?>>Prof</option>
									</select>
									<?php } ?>
							</p>
							<p><strong>Last/Family Name: </strong>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part1"))){echo $_SESSION['lastname'];}?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
									<input type="text" name="lastname" id="lastname"  title="Example: Lee "
									value="<?php echo $_SESSION['lastname']; ?>" />
									<?php } ?><font color="#FF0000"><?php echo $errlastname; ?></font>
							</p>
							<p><strong>First/Given Names: </strong>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part1"))){echo $_SESSION['firstname'];}?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
									<input type="text" name="firstname"  title="Example: Micheal "
									id="firstname" value="<?php echo $_SESSION['firstname']; ?>" />
									<?php } ?><font color="#FF0000"><?php echo $errfirstname; ?></font>
							</p>
							<p><strong>Citizenship:</strong><font color="#FF0000"><?php echo $errcountry; ?></font>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part1"))){echo $_SESSION['country'];}?>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part1")))
									{ 
										$countryselect= strtolower($_SESSION['citizenship']);
										$country = mysql_query("SELECT * FROM country WHERE citizenship='$countryselect'") or die(mysql_error());
										$countryrow = mysql_num_rows($country);
										while($countryrow = mysql_fetch_array( $country )) 
										{ 
											$country1 =" - ";
											$country1 .=$countryrow['country'];
											
										}
										echo $country1;
									}?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
									<br /><br />
									<input name="country" type="radio" id="country" value="Domestic"  onclick="citizenship.disabled=true" <?php echo $domchecked;  ?>/>
									Domestic (Australian/New Zealand Citizen or Australian Permanent Resident)<br><br/>
									<input name="country" type="radio" value="International"  onclick="citizenship.disabled=false"  <?php echo $internationalchecked; ?>/>
									International  - Please specify country of citizenship
									<select name="citizenship" id="citizenship"
									<?php if((!isset($_POST['part1updatebtn']) || !isset($_REQUEST['edit']) || ((isset($_REQUEST['edit']) && (isset($_POST['country']) && $_POST['country']!="International")))) && (!isset($_POST['part1updatebtn'])&& $_SESSION['country']!="International")) echo "disabled"; ?>>
									<option value=''>Country</option>
									<?php 
										$country = mysql_query("SELECT * FROM country ORDER BY country ") or die(mysql_error());
										//query to get record
										while($countryrow = mysql_fetch_array( $country )) 
										{ 
											echo "<option value='".$countryrow['citizenship']."'";
											if((isset($_SESSION['citizenship'])&&($countryrow['citizenship']==$_SESSION['citizenship']))||(isset($_POST['citizenship'])&&($countryrow['citizenship']==$citizenship))){echo 'selected';}
											echo ">".$countryrow['country']."</option>\n";
										}
										?>
									</select>
									<?php } ?>
							</p>
							<p><strong>Have you previously applied for a program at Murdoch University?</strong> <font color="#FF0000"><?php echo $errmurdoch;?></font>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part1")))
								{echo $_SESSION['murdoch'];}?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
									<input name="murdoch" type="radio" value="No" onClick="murdoch_sid.disabled=true" <?php echo $nonmurdochchecked; ?>  />
									No
									<?php } ?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
									<input name="murdoch" type="radio" value="Yes" onClick="murdoch_sid.disabled=false" <?php echo $murdochchecked; ?> />
									Yes
									<?php } ?>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part1")))
								{echo $_SESSION['murdoch_sid'];}?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part1")) { ?>
									- MU Student Number
									<input type="text" width="250px" name="murdoch_sid" id="murdoch_sid" <?php if((!isset($_POST['part1updatebtn']) || !isset($_REQUEST['edit']) || ((isset($_REQUEST['edit']) && (isset($_POST['murdoch']) && $_POST['murdoch']!="Yes")))) && (!isset($_POST['part1updatebtn'])&& $_SESSION['murdoch']!="Yes")) echo "disabled"; ?> value="<?php if(isset($_POST['murdoch_sid'])) echo $_POST['murdoch_sid']; else echo $_SESSION['murdoch_sid'];?>"/>
									<?php } ?><font color="#FF0000"><?php echo $errmurdochexist; ?></font>
							</p>
						</form>
						<br />
						
						<!-------------section 2---------------->
						
						<form id="part2" name="eoiform" method="post"  action="#">
							<font size="+2" ><strong>2. Contact details</strong> </font>
							<?php  if (!isset($_REQUEST['edit'])){?>
							<a href="EOI_Page4.php?edit=part2#part2">(Edit)</a>
							<?php }
								if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part2")) { ?>
								<input name="part2updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							<h3>Please give your contact details that are valid for at least one month after submission of this form.</h3>
							<p><strong>Email Address: </strong>
              <font color="#FF0000"> <?php echo $erremailadd;?>
              </font><br/>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part2")))
								{echo $_SESSION['emailadd'];} ?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part2")) { ?>
									<input type="text" name="emailadd"  title="Example: someone@example.com " id="emailadd" value="<?php echo $emailadd; ?>"  size="35" />
									<?php } ?>
							</p>
							<p><strong>Telephone: </strong><small><em>(minimum 7 numbers)</em></small><font color="#FF0000"><?php echo $errtel;?></font>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part2")))
										{ echo $_SESSION['tel'];}?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part2")) { ?>
									<input type="text" name="tel" id="tel" title="Please enter correct telephone number in case the officer requires to call you" value="<?php echo $tel; ?>" />
									<?php } ?>
							</p>
						</form> <br />
						
						<!-------------section 3---------------->
						
						<form id="part3" name="eoiform" method="post"  action="#">
							<font size="+2" ><strong>3. Proposed enrolment </strong></font>
							<?php  if (!isset($_REQUEST['edit'])){?>
							<a href="EOI_Page4.php?edit=part3#part3">(Edit)</a>
							<?php }
								if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part3")) { ?>
								<input name="part3updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							<h3>Murdoch University offers a variety of higher degree  research programs. Selection for admission to these programs is based on the  criteria set out in the Murdoch University policy for Higher Degree Research  Candidature Selection. </h3>
							<br/>
							<strong>Program :</strong><font color="#FF0000"> <?php echo $errprogram; ?></font><br>
							<table width="587" border="0">
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part3")) { ?>
									<tr align="center">
										<td><div align="left">
												<label><input type="checkbox" name="program[]" value="PhD" <?php echo $phdchecked;?> />
												PhD</label> </div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="MPhil"<?php echo $mphilchecked;?> />
												MPhil </div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="DIT" <?php echo $ditchecked;?> />
												DIT </div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="MEd Res" <?php echo $medreschecked;?> />
												MEd Res </div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="DVetMedSc"<?php echo $dvetmedschecked;?> />
												DVetMedSc </div></td>
									</tr>
									<tr align="center">
										<td><div align="left">
												<label><input type="checkbox" name="program[]" value="LLM"<?php echo $llmchecked;?> />
												LLM </label></div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="EdD" <?php echo $eddchecked;?> />
												EdD </div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="RMT" <?php echo $rmtchecked;?> />
												RMT </div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="DPSYCH" <?php echo $dpsychchecked;?> />
												DPSYCH </div></td>
										<td><div align="left">
												<input type="checkbox" name="program[]" value="MAppPsych/PhD" <?php echo $mapppsychchecked;?> />
												MAppPsych/PhD </div></td>
									</tr>
									<?php } ?>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part3"))){ ?>
								<tr align="left">
									<td height="25"><label><input type="checkbox" name="program[]" value="PhD" disabled <?php echo $phdchecked;?> />
										PhD</label> </td>
									<td><label><input type="checkbox" name="program[]" value="MPhil"disabled <?php echo $mphilchecked;?> />
										MPhil </label></td>
									<td><label><input type="checkbox" name="program[]" value="DIT" disabled <?php echo $ditchecked;?> />
										DIT </label></td>
									<td><label>
									<input type="checkbox" name="program[]" value="MEd Res" disabled <?php echo $medreschecked;?> />
									MEd Res </label></td>
									<td><label><input type="checkbox" name="program[]" value="DVetMedSc" disabled <?php echo $dvetmedschecked;?> />
									DVetMedSc </label></td>
								</tr>
								<tr align="left">
									<td><label><input type="checkbox" name="program[]" value="LLM" disabled <?php echo $llmchecked;?> />
									LLM </label></td>
									<td><label>
									<label><input type="checkbox" name="program[]" value="EdD" disabled <?php echo $eddchecked;?> />
									EdD </label></td>
									<td><label> </label>
									<label>
									<input type="checkbox" name="program[]" value="RMT" disabled <?php echo $rmtchecked;?> />
									RMT </label></td>
									<td><label>
									<input type="checkbox" name="program[]" value="DPSYCH" disabled <?php echo $dpsychchecked;?> />
									DPSYCH </label></td>
									<td><label> </label>
									<label>
									<input type="checkbox" name="program[]" disabled value="MAppPsych/PhD" <?php echo $mapppsychchecked;?> />
									MAppPsych/PhD </label></td>
								</tr>
								<?php } ?>
							</table>
							<br/>
							<h3>Candidates enrolled in higher degree research programs at Murdoch University are located in specific Schools. In which School do you wish to undertake your research</h3>
							<font color="#FF0000"><?php echo $errschool; ?></font>
							<table width="589" border="0">
								<!--------------------first view------------------->
								<tr>
									<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part3"))){?>
									<td width='102'><strong>School : </strong></td>
									
									<td><select name="school" id="school" disabled="disabled">
										<option selected="selected" value="">-- Please Select --</option>
										<?php 
										$school_list = mysql_query("SELECT * FROM `school` ORDER BY school_id ") or die(mysql_error());
										//query to get record
										while($schoolrow = mysql_fetch_array( $school_list )) 
										{ 
											echo "<option value='".$schoolrow['school_id']."'";
											if(isset($_SESSION['school'])&&($schoolrow['school_id']==$_SESSION['school'])){echo 'selected';}
											echo ">".$schoolrow['school_name']."</option>\n";
										}
										?>
										</select></td>
									<!--------------------edit button pressed------------------->
									<?php } ?>
									<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part3")) { ?>
										<td width="102">School : </td>
										<td width="477"><select name="school" id="school">
											<?php 
											$school_list = mysql_query("SELECT * FROM `school` ORDER BY school_id ") or die(mysql_error());
											//query to get record
											while($schoolrow = mysql_fetch_array( $school_list )) 
											{ 
												echo "<option value='".$schoolrow['school_id']."'";
												if((isset($_POST['part3updatebtn'])&&($schoolrow['school_id']==$supschool1))||(isset($_SESSION['school'])&&($schoolrow['school_id']==$_SESSION['school']))){echo 'selected';}
												echo ">".$schoolrow['school_name']."</option>\n";
											}
											?>
											</select></td>
										<?php } ?>
								</tr>
							</table>
							<h3>In order for your School and potential advisors to identify whether it is possible to provide appropriate resources for you at the time you wish to undertake your higher degree research we require details of your proposed commencement:</h3>
							<br>
							<strong>Commencing:</strong> 
							<!-----editable portion of commencing month and year--------------------->
							<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part3")) { ?>
								<select name="month" id="month">
									<?php 
									for($i=1; $i<=12; $i++)
									{
									$month = date("M", mktime(0, 0, 0, $i, 10));
									echo "<option value='";
									echo $i."'";
									if ((isset($_POST['part3updatebtn']) && $_POST['month'] == $i)||(isset($_SESSION['month']) && $_SESSION['month'] == $i)) echo "selected";
									echo">".$month."</option>";
									}?>
								</select>
								<?php } ?>
							<!----review portion of commencing month and year--------------------->
							<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part3"))){?>
							<select name="month" id="month" disabled>
								<option>
								<?php
								$i=$_SESSION['month'];
								$monthselected = date("M", mktime(0, 0, 0, $i, 10));
								echo $monthselected; 
								?>
								</option>
							</select>
							<?php }?>
							<!--------------------------------------------------------------------> 
							<!----editable portion of commencing month and year--------------------->
							<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part3")) { ?>
								<select name="year" id="year">
									<?php 
									$year = date('Y');
									for($i=0; $i<5; $i++)
									{
									echo "<option ";
									if ((isset($_POST['part3updatebtn']) && $_POST['year'] == $year)||(isset($_SESSION['year'])&&$_SESSION['year']==$year)) echo "selected";
									echo">".$year."</option>";
									$year++;
									}?>
								</select>
								<?php } ?>
							<!----review portion of commencing month and year--------------------->
							<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part3"))){ ?>
							<select name="year" id="year" disabled>
								<option><?php echo $year; ?></option>
							</select>
							<?php }?><font color="#FF0000"><?php echo $errdate; ?></font>
							<br>
							<br>
							<!--------------------------------------------------------------------->
							<label><?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part3")) { ?>
								<input type="radio" name="PFtime" id="PFtime" value="FT" <?php echo $FTchecked;?>>
								<?php } ?>
							<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part3"))) { ?>
								<input type="radio" name="PFtime" id="PFtime" value="FT" disabled <?php echo $FTchecked;?>>
								<?php } ?>
							Full-Time candidate</label><label>
							<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part3")) { ?>
								<input type="radio" name="PFtime" id="PFtime" value="PT" <?php echo $PTchecked;?>>
								<?php } ?>
							<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part3"))){  ?>
							<input type="radio" name="PFtime" id="PFtime" value="PT" disabled <?php echo $PTchecked;?>>
							<?php }?>
							Part-time Candidate </label><font color="#FF0000"><?php echo $errPFtime;?></font> <br>
							<p> <em>**Please note that Part-time candidature may not be possible in all research fields, or for international candidates studying on a student visa.</em></p>
						</form> <br />
						
						<!-----------------section 4 --------------------->
						
						<form id="part4" name="eoiform" method="post"  action="#">
							<font size="+2" ><strong>4. Research Interests</strong> </font>
							<?php  if (!isset($_REQUEST['edit']))
							{?>
							<a href="EOI_Page4.php?edit=part4#part4">(Edit)</a>
							<?php }
								if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
								<input name="part4updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							<h3>Murdoch University's higher degree in research can be completed in any field or research where sufficient expertise and resource are available to carry out such research. </h3>
							<p><strong>Field of Research: </strong><font color="#FF0000"><?php echo $errFOR; ?></font><br/>
								<!-------------------------------------------------------------> 
								<!--view of first referral supervisor---> 
								<!-------------------------------------------------------------> 
								1.
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?>
								<select name="FOR1"id="FOR" disabled>
									<option selected value="">-- Please Select --</option>
									<?php 
									$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
									//query to get record
									while($row = mysql_fetch_array( $query )) 
									{ 
										echo "<option value='".$row['code']."'";
										if((isset($_SESSION['FOR1'])&&($row['code']==$_SESSION['FOR1']))||(isset($_POST['FOR1'])&&($row['code']==$FOR1))){echo 'selected';}
										echo ">".$row['description']."</option>\n";
									}
									?>
								</select>
								<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")){?>
								<select name="FOR1"id="FOR">
									<option selected value="">-- Please Select --</option>
									<?php 
									$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
									//query to get record
									while($row = mysql_fetch_array( $query )) 
									{ 
										$results[] = $row;
										echo "<option value='".$row['code']."'";
										if((isset($_POST['part4updatebtn'])&&($row['code']==$FOR1))||(isset($_SESSION['FOR1'])&&($_SESSION['FOR1']==$row['code']))){echo 'selected';}
										echo ">".$row['description']."</option>\n";
									}
									?>
								</select>
								<?php }?>
								<br>
								2.
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?>
								<select name="FOR2"id="FOR" disabled>
									<option selected value="">-- Please Select --</option>
									<?php 
									$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
									//query to get record
									while($row = mysql_fetch_array( $query )) 
									{ 
										$results[] = $row;
										echo "<option value='".$row['code']."'";
										if((isset($_SESSION['FOR2'])&&($row['code']==$_SESSION['FOR2']))||(isset($_POST['FOR2'])&&($row['code']==$FOR2))){echo 'selected';}
										echo ">".$row['description']."</option>\n";
									}
									?>
								</select>
								<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")){?>
								<select name="FOR2"id="FOR">
									<option selected value="">-- Please Select --</option>
									<?php 
									$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
									//query to get record
									while($row = mysql_fetch_array( $query )) 
									{ 
										$results[] = $row;
										echo "<option value='".$row['code']."'";
										if((isset($_POST['part4updatebtn'])&&($row['code']==$FOR2))||(isset($_SESSION['FOR2'])&&($_SESSION['FOR2']==$row['code']))){echo 'selected';}
										echo ">".$row['description']."</option>\n";
									}
									?>
								</select>
								<?php }?>
								<br>
								3.
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?>
								<select name="FOR3"id="FOR" disabled>
									<option selected value="">-- Please Select --</option>
									<?php 
									$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
									//query to get record
									while($row = mysql_fetch_array( $query )) 
									{ 
										$results[] = $row;
										echo "<option value='".$row['code']."'";
										
										if((isset($_SESSION['FOR3'])&&($row['code']==$_SESSION['FOR3']))||(isset($_POST['FOR3'])&&($row['code']==$FOR3))){echo 'selected';}
										echo ">".$row['description']."</option>\n";
									}
									?>
								</select>
								<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")){?>
								<select name="FOR3"id="FOR">
									<option selected value="">-- Please Select --</option>
									<?php 
									$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
									//query to get record
									while($row = mysql_fetch_array( $query )) 
									{ 
										$results[] = $row;
										echo "<option value='".$row['code']."'";
										if((isset($_POST['part4updatebtn'])&&($row['code']==$FOR3))||(isset($_SESSION['FOR3'])&&($_SESSION['FOR3']==$row['code']))){echo 'selected';}
										echo ">".$row['description']."</option>\n";
									}
									?>
								</select>
								<?php }?>
								<!-------------------------------------------------------------> 
							</p>
							<p><strong>Research Keywords </strong><font color="#FF0000"><?php echo $errresearchinterest;?></font><br/>
								<!-------------------------------------------------------------> 
								<!--view of research interest---> 
								<!-------------------------------------------------------------> 
								
								1.
								<input type="text" name="researchinterest1" size="35" 
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?> disabled value="<?php if(isset($_SESSION['researchinterest1'])) echo $_SESSION['researchinterest1'];?>"<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) {  if((isset($_POST['researchinterest1'])&&$_POST['researchinterest1'] !="")||(isset($_SESSION['researchinterest1'])&&$_SESSION['researchinterest1'] !=""))?> title="Example: Mobile Security" value="<?php echo $researchinterest1; }?>" />
								2.
								<input type="text" name="researchinterest2" size="35" 
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?> disabled value="<?php if(isset($_SESSION['researchinterest2'])) echo $_SESSION['researchinterest2'];?>"<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) {  if((isset($_POST['researchinterest2'])&& $_POST['researchinterest2']!="")|| (isset($_SESSION['researchinterest2'])&& $_SESSION['researchinterest2']!="")) ?> title="Example: Mobile Security" value="<?php echo $researchinterest2; }?>" />
								3.
								<input type="text" name="researchinterest3" size="35" 
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?> disabled value="<?php if(isset($_SESSION['researchinterest3']))  echo $_SESSION['researchinterest3'];?>"<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) {  if((isset($_POST['researchinterest3'])&& $_POST['researchinterest3']!="")|| (isset($_SESSION['researchinterest3'])&& $_SESSION['researchinterest3']!="")) ?> title="Example: Mobile Security" value="<?php echo $_SESSION['researchinterest3']; }?>" />
								<br />4.
								<input type="text" name="researchinterest4" size="35" 
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?> disabled value="<?php if(isset($_SESSION['researchinterest4'])) echo $_SESSION['researchinterest4'];?>"<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) {  if((isset($_POST['researchinterest4'])&& $_POST['researchinterest4']!="")|| (isset($_SESSION['researchinterest4'])&& $_SESSION['researchinterest4']!="")) ?> title="Example: Mobile Security" value="<?php echo $_SESSION['researchinterest4']; }?>"/>
								5.
								<input type="text" name="researchinterest5" size="35" 
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))) {?> disabled value="<?php if(isset($_SESSION['researchinterest5'])) echo $_SESSION['researchinterest5'];?>"<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) {  if((isset($_POST['researchinterest5'])&& $_POST['researchinterest5']!="")|| (isset($_SESSION['researchinterest5'])&& $_SESSION['researchinterest5']!="")) ?> title="Example: Mobile Security" value="<?php echo $_SESSION['researchinterest5']; }?>"/>
							</p>
							<!-------------------------------------------->
							<p>Please identify any Murdoch University academics with whom you wish to discuss your research interest with. <font color="#FF0000"><strong><?php echo $errsup; ?></strong></font><br/>
							</p>
							<table width="100%" border="1" cellpadding="3" cellspacing="2">
										                <col width="15%">
<col width="25%">
<col width="45%">
<col width="25%">
								<tr>
									<td><strong>Title</strong></td>
									<td><strong>Name</strong></td>
									<td><strong>School</strong></td>
									<td><strong>Email Address</strong></td>
								</tr>
								<!---------------supervisor 1 edit and update ---------->
								<tr>
									<td><?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4")))
										{
										echo "<select disabled  style='width:99%;'><option>";
										 if(isset($_SESSION['suptitle1'])) {echo $_SESSION['suptitle1'];}
										echo "</option></select>";
										}?>
										<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
											<select name="suptitle1" style="width:99%;">
												<option selected="selected" value="">-- Please Select --</option>
												<option value="Mr" <?php echo $sup1mr; ?> >Mr</option>
												<option value="Ms" <?php echo $sup1ms; ?> >Ms</option>
												<option value="Mrs" <?php echo $sup1mrs; ?>>Mrs</option>
												<option value="Mdm" <?php echo $sup1mdm; ?>>Mdm</option>
												<option value="Dr" <?php echo $sup1dr; ?>>Dr</option>
												<option value="Prof" <?php echo $sup1prof; ?>>Prof</option>
											</select>
											<?php } ?></td>
									<td><?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))){?>
										<input type="text" name="supname1" style="width:99%;" disabled value="<?php if(isset($supname1)) echo $supname1;?>">
										<?php }?>
										<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
											<input type="text" name="supname1" style="width:99%;" value="<?php if(isset($supname1)) echo $supname1;?>" >
											<?php } ?></td>
									<td><?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))){ ?>
										<?php if(isset($_SESSION['supschool1']))
											{
											if(isset($_SESSION['supschool1'])){
											$supschool1=$_SESSION['supschool1'];
											if($supschool1 == "1"){$sup1school1 = "selected";}
											if($supschool1 == "2"){$sup1school2 = "selected";}
											if($supschool1 == "3"){$sup1school3 = "selected";}
											if($supschool1 == "4"){$sup1school4 = "selected";}
											if($supschool1 == "5"){$sup1school5 = "selected";}
											if($supschool1 == "6"){$sup1school6 = "selected";}
											if($supschool1 == "7"){$sup1school7 = "selected";}
											if($supschool1 == "8"){$sup1school8 = "selected";}
											if($supschool1 == "9"){$sup1school9 = "selected";}
											} }?>
										<select name="supschool1" id="school" style="width:99%;" disabled >
											<option selected value=""></option>
											<option value="1" <?php echo $sup1school1;?>>Sir Walter Murdoch School of Public Policy and International Affairs</option>
											<option value="2" <?php echo $sup1school2;?>>School of Engineering and Information Technology</option>
											<option value="3" <?php echo $sup1school3;?>>School of Management and Governance</option>
											<option value="4" <?php echo $sup1school4;?>>School of Psychology and Exercise Science</option>
											<option value="5" <?php echo $sup1school5;?>>School of Health Professions</option>
											<option value="6" <?php echo $sup1school6;?>>School of Arts</option>
											<option value="7" <?php echo $sup1school7;?>>School of Education</option>
											<option value="8" <?php echo $sup1school8;?>>School of Law</option>
											<option value="9" <?php echo $sup1school9;?>>School of Veterinary and Life Sciences</option>
										</select>
										<?php } ?>
										<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
											<select name="supschool1" id="school" style="width:99%;">
												<option selected value="">--Please Select--</option>
												<?php if(isset($_SESSION['supschool1']))
												{
													if(isset($_SESSION['supschool1'])){
													$supschool1=$_SESSION['supschool1'];
													if($supschool1 == "1"){$sup1school1 = "selected";}
													if($supschool1 == "2"){$sup1school2 = "selected";}
													if($supschool1 == "3"){$sup1school3 = "selected";}
													if($supschool1 == "4"){$sup1school4 = "selected";}
													if($supschool1 == "5"){$sup1school5 = "selected";}
													if($supschool1 == "6"){$sup1school6 = "selected";}
													if($supschool1 == "7"){$sup1school7 = "selected";}
													if($supschool1 == "8"){$sup1school8 = "selected";}
													if($supschool1 == "9"){$sup1school9 = "selected";}
													} 
												}?>
												<option value="1" <?php echo $sup1school1;?>>Sir Walter Murdoch School of Public Policy and International Affairs</option>
												<option value="2" <?php echo $sup1school2;?>>School of Engineering and Information Technology</option>
												<option value="3" <?php echo $sup1school3;?>>School of Management and Governance</option>
												<option value="4" <?php echo $sup1school4;?>>School of Psychology and Exercise Science</option>
												<option value="5" <?php echo $sup1school5;?>>School of Health Professions</option>
												<option value="6" <?php echo $sup1school6;?>>School of Arts</option>
												<option value="7" <?php echo $sup1school7;?>>School of Education</option>
												<option value="8" <?php echo $sup1school8;?>>School of Law</option>
												<option value="9" <?php echo $sup1school9;?>>School of Veterinary and Life Sciences</option>
											</select>
											<?php } ?></td>
									<td><?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
										<input name="supemail1" style="width:99%;" type="text" id="emailtext" value="<?php if(isset($_POST['supemail1'])||(isset($_SESSION['supemail1']))) echo $supemail1;?>"/>
										<?php }?>
										<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))){ ?>
										<input name="supemail1" style="width:99%;" type="text" id="emailtext" value="<?php if(isset($_SESSION['supemail1'])) echo $_SESSION['supemail1'];?>" disabled >
										<?php }?></td>
								</tr>
								<!------------------2nd supervisor-------------------------->
								<tr>
									<td><?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4")))
										{
										echo "<select disabled  style='width:99%;'><option>";
										 if(isset($_SESSION['suptitle2'])) {echo $_SESSION['suptitle2'];}
										echo "</option></select>";
										}?>
										<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
											<select name="suptitle2" style="width:99%;">
												<option value="">-- Please Select --</option>
												<option value="Mr" <?php echo $sup2mr; ?> >Mr</option>
												<option value="Ms" <?php echo $sup2ms; ?> >Ms</option>
												<option value="Mrs" <?php echo $sup2mrs; ?>>Mrs</option>
												<option value="Mdm" <?php echo $sup2mdm; ?>>Mdm</option>
												<option value="Dr" <?php echo $sup2dr; ?>>Dr</option>
												<option value="Prof" <?php echo $sup2prof; ?>>Prof</option>
											</select>
											<?php } ?></td>
									<td><?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))){?>
										<input type="text" name="supname2" style="width:99%;" disabled value="<?php if(isset($supname2)) echo $supname2;?>">
										<?php }?>
										<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
											<input type="text" name="supname2" style="width:99%;" value="<?php if(isset($supname2)) echo $supname2;?>">
											<?php } ?></td>
									<td><?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))){ ?>
										<?php if(isset($_SESSION['supschool2']))
										{
										if(isset($_SESSION['supschool2'])){
										$supschool2=$_SESSION['supschool2'];
										if($supschool2 == "1"){$sup2school1 = "selected";}
										if($supschool2 == "2"){$sup2school2 = "selected";}
										if($supschool2 == "3"){$sup2school3 = "selected";}
										if($supschool2 == "4"){$sup2school4 = "selected";}
										if($supschool2 == "5"){$sup2school5 = "selected";}
										if($supschool2 == "6"){$sup2school6 = "selected";}
										if($supschool2 == "7"){$sup2school7 = "selected";}
										if($supschool2 == "8"){$sup2school8 = "selected";}
										if($supschool2 == "9"){$sup2school9 = "selected";}
										} }?>
										<select name="supschool2" id="school" style="width:99%;" disabled >
											<option selected value=""></option>
											<option value="1" <?php echo $sup2school1;?>>Sir Walter Murdoch School of Public Policy and International Affairs</option>
											<option value="2" <?php echo $sup2school2;?>>School of Engineering and Information Technology</option>
											<option value="3" <?php echo $sup2school3;?>>School of Management and Governance</option>
											<option value="4" <?php echo $sup2school4;?>>School of Psychology and Exercise Science</option>
											<option value="5" <?php echo $sup2school5;?>>School of Health Professions</option>
											<option value="6" <?php echo $sup2school6;?>>School of Arts</option>
											<option value="7" <?php echo $sup2school7;?>>School of Education</option>
											<option value="8" <?php echo $sup2school8;?>>School of Law</option>
											<option value="9" <?php echo $sup2school9;?>>School of Veterinary and Life Sciences</option>
										</select>
										
										<?php } if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
											<select name="supschool2" id="school" style="width:99%;">
												<option selected value="">--Please Select--</option>
												<?php if(isset($_SESSION['supschool2']))
												{
													if(isset($_SESSION['supschool2'])){
													$supschool2=$_SESSION['supschool2'];
													if($supschool2 == "1"){$sup2school1 = "selected";}
													if($supschool2 == "2"){$sup2school2 = "selected";}
													if($supschool2 == "3"){$sup2school3 = "selected";}
													if($supschool2 == "4"){$sup2school4 = "selected";}
													if($supschool2 == "5"){$sup2school5 = "selected";}
													if($supschool2 == "6"){$sup2school6 = "selected";}
													if($supschool2 == "7"){$sup2school7 = "selected";}
													if($supschool2 == "8"){$sup2school8 = "selected";}
													if($supschool2 == "9"){$sup2school9 = "selected";}
													} 
												}?>
												<option value="1" <?php echo $sup2school1;?>>Sir Walter Murdoch School of Public Policy and International Affairs</option>
												<option value="2" <?php echo $sup2school2;?>>School of Engineering and Information Technology</option>
												<option value="3" <?php echo $sup2school3;?>>School of Management and Governance</option>
												<option value="4" <?php echo $sup2school4;?>>School of Psychology and Exercise Science</option>
												<option value="5" <?php echo $sup2school5;?>>School of Health Professions</option>
												<option value="6" <?php echo $sup2school6;?>>School of Arts</option>
												<option value="7" <?php echo $sup2school7;?>>School of Education</option>
												<option value="8" <?php echo $sup2school8;?>>School of Law</option>
												<option value="9" <?php echo $sup2school9;?>>School of Veterinary and Life Sciences</option>
											</select>
											<?php } ?></td>
									<td><?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part4")) { ?>
										<input name="supemail2" style="width:99%;" type="text" id="emailtext" value="<?php if(isset($_POST['supemail2'])||(isset($_SESSION['supemail2']))) echo $supemail2;?>"/>
										<?php }?>
										<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part4"))){ ?>
										<input name="supemail2" style="width:99%;" type="text" id="emailtext" value="<?php if(isset($_SESSION['supemail2'])) echo $_SESSION['supemail2'];?>" disabled >
										<?php }?></td>
								</tr>
								<!---------------------------------------------------------->
							</table>
							</p>
						</form> <br />
						<!-----------------section 5------------------------->
						<form id="part5" name="eoiform" method="post"  action="#">
							<font size="+2" ><strong>5. Academic Qualifications and Research Training Experience </strong></font>
							<?php  if (!isset($_REQUEST['edit'])) {?>
							<a href="EOI_Page4.php?edit=part5#part5">(Edit)</a>
							<?php }
								if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part5")) { ?>
								<input name="part5updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							</strong>
							</h2>
							<h3>Selection for admission to higher degree research programs  at Murdoch University requires that applicants to have sufficient previous research  training experience to satisfy the basis of admission. </h3>
							<p><strong>Please list qualifications attained for all previous  tertiary studies.</strong><br>
								<font color="#FF0000"><?php echo $errdegree." "; echo $errcompletion." "; echo $errgpa;?></font></p>
							<table width="100%" border="1">
								<tr align="center" valign="top">
									<th width="30%" >Degree</th>
									<th width="10%">Duration <br />
										(No of years)</th>
									<th width="10%">Year Awarded</th>
									<th width="10%">GPA <br />
										(Max 7.00)</th>
									<th width="10%">% of degree Completed By Research</th>
									<th width="30%">Institution</th>
								</tr>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part5"))){?>
								<tr>
									<td><select name="degree1" style="width:99%;" disabled>
										<option value="" <?php echo "$deg1blank";?>>--Please Select--</option>
										<option value="AA" <?php echo "$deg1AA"; ?>>Associate of Arts</option>
										<option value="AS" <?php echo "$deg1AS";?>>Associate of Science</option>
										<option value="AAS" <?php echo "$deg1AAS";?>>Associate of Applied Science</option>
										<option value="ADEng" <?php echo "$deg1ADEng";?>>Associate of Engineering</option>
										<option value="AAA" <?php echo "$deg1AAA";?>>Associate of Applied Arts</option>
										<option value="APS" <?php echo "$deg1APS";?>>Associate of Political Science</option>

										<option value="BA" <?php echo "$deg1BA";?>>Bachelor of Arts</option>
										<option value="BSc" <?php echo "$deg1BSc";?>>Bachelor of Science</option>
										<option value="BFA" <?php echo "$deg1BFA";?>>Bachelor of Fine Arts</option>
										<option value="BBA" <?php echo "$deg1BBA";?>>Bachelor of Business Administration</option>
										<option value="BArch" <?php echo "$deg1BArch";?>>Bachelor of Architecture</option>

										<option value="MA" <?php echo "$deg1MA";?>>Master of Arts</option>
										<option value="MS" <?php echo "$deg1MS";?>>Master of Science</option>
										<option value="MARes" <?php echo "$MARes";?>>Master of Research</option>
										<option value="MPhil" <?php echo "$deg1MPhil";?>>Master of Philosophy</option>
										<option value="LLM" <?php echo "$deg1LLM";?>>Master of Laws</option>
										<option value="MBA" <?php echo "$deg1MBA";?>>Master of Business Administration</option>

										<option value="PhD" <?php echo "$deg1PhD";?>>Doctor of Philosophy</option>
										<option value="MD" <?php echo "$deg1MD";?>>Doctor of Medicine</option>
										<option value="DEd" <?php echo "$deg1DEd";?>>Doctor of Education</option>
										<option value="JD" <?php echo "$deg1JD";?>>Juris Doctor</option>
										</select></td>
									<td><select name="duration1" style="width:99%;" disabled>
											<option>
											<?php if(isset($_SESSION['duration1'])){echo $_SESSION['duration1'];}?>
											</option>
										</select></td>
									<td><select name="yearaward1" style="width:99%;" disabled>
											<option>
											<?php if(isset($_SESSION['yearaward1'])){echo $_SESSION['yearaward1'];}?>
											</option>
										</select></td>
									<td><input name="GPA1" type="text" disabled value="<?php if(isset($GPA1)) echo $GPA1;?>" style="width:96%;" maxlength="4"></td>
									<td><input name="completion1" type="text" disabled value="<?php if(isset($completion1)) echo $completion1;?>" style="width:96%;"maxlength="3"></td>
									<td><input name="institute1" type="text" disabled value="<?php if(isset($institute1)) echo $institute1;?>" style="width:98%;"></td>
								</tr>
								<tr>
									<td>
									<select name="degree2" style="width:99%;" disabled>
										<option value="" <?php echo "$deg2blank";?>>--Please Select--</option>
										<option value="AA" <?php echo "$deg2AA"; ?>>Associate of Arts</option>
										<option value="AS" <?php echo "$deg2AS";?>>Associate of Science</option>
										<option value="AAS" <?php echo "$deg2AAS";?>>Associate of Applied Science</option>
										<option value="ADEng" <?php echo "$deg2ADEng";?>>Associate of Engineering</option>
										<option value="AAA" <?php echo "$deg2AAA";?>>Associate of Applied Arts</option>
										<option value="APS" <?php echo "$deg2APS";?>>Associate of Political Science</option>

										<option value="BA" <?php echo "$deg2BA";?>>Bachelor of Arts</option>
										<option value="BSc" <?php echo "$deg2BSc";?>>Bachelor of Science</option>
										<option value="BFA" <?php echo "$deg2BFA";?>>Bachelor of Fine Arts</option>
										<option value="BBA" <?php echo "$deg2BBA";?>>Bachelor of Business Administration</option>
										<option value="BArch" <?php echo "$deg2BArch";?>>Bachelor of Architecture</option>

										<option value="MA" <?php echo "$deg2MA";?>>Master of Arts</option>
										<option value="MS" <?php echo "$deg2MS";?>>Master of Science</option>
										<option value="MARes" <?php echo "$MARes";?>>Master of Research</option>
										<option value="MPhil" <?php echo "$deg2MPhil";?>>Master of Philosophy</option>
										<option value="LLM" <?php echo "$deg2LLM";?>>Master of Laws</option>
										<option value="MBA" <?php echo "$deg2MBA";?>>Master of Business Administration</option>

										<option value="PhD" <?php echo "$deg2PhD";?>>Doctor of Philosophy</option>
										<option value="MD" <?php echo "$deg2MD";?>>Doctor of Medicine</option>
										<option value="DEd" <?php echo "$deg2DEd";?>>Doctor of Education</option>
										<option value="JD" <?php echo "$deg2JD";?>>Juris Doctor</option>
										</select>
									</td>
									<td><select name="duration2" style="width:99%;" disabled >
											<option>
											<?php if(isset($_SESSION['duration2'])){echo $_SESSION['duration2'];}?>
											</option>
										</select></td>
									<td><select name="yearaward2" style="width:99%;" disabled>
											<option>
											<?php if(isset($_SESSION['yearaward2'])){echo $_SESSION['yearaward2'];}?>
											</option>
										</select></td>
									<td><input name="GPA2" type="text" disabled value="<?php if(isset($GPA2)) echo $GPA2;?>" style="width:96%;" maxlength="4"></td>
									<td><input name="completion2" type="text" disabled value="<?php if(isset($completion2)) echo $completion2;?>" style="width:96%;" maxlength="3"></td>
									<td><input name="institute2" type="text" disabled value="<?php if(isset($institute2)) echo $institute2;?>" style="width:98%;"></td>
								</tr>
								<tr>
									<td>
									<select name="degree3" style="width:99%;" disabled >
										<option value="" <?php echo "$deg3blank";?>>--Please Select--</option>
										<option value="AA" <?php echo "$deg3AA"; ?>>Associate of Arts</option>
										<option value="AS" <?php echo "$deg3AS";?>>Associate of Science</option>
										<option value="AAS" <?php echo "$deg3AAS";?>>Associate of Applied Science</option>
										<option value="ADEng" <?php echo "$deg3ADEng";?>>Associate of Engineering</option>
										<option value="AAA" <?php echo "$deg3AAA";?>>Associate of Applied Arts</option>
										<option value="APS" <?php echo "$deg3APS";?>>Associate of Political Science</option>

										<option value="BA" <?php echo "$deg3BA";?>>Bachelor of Arts</option>
										<option value="BSc" <?php echo "$deg3BSc";?>>Bachelor of Science</option>
										<option value="BFA" <?php echo "$deg3BFA";?>>Bachelor of Fine Arts</option>
										<option value="BBA" <?php echo "$deg3BBA";?>>Bachelor of Business Administration</option>
										<option value="BArch" <?php echo "$deg3BArch";?>>Bachelor of Architecture</option>

										<option value="MA" <?php echo "$deg3MA";?>>Master of Arts</option>
										<option value="MS" <?php echo "$deg3MS";?>>Master of Science</option>
										<option value="MARes" <?php echo "$MARes";?>>Master of Research</option>
										<option value="MPhil" <?php echo "$deg3MPhil";?>>Master of Philosophy</option>
										<option value="LLM" <?php echo "$deg3LLM";?>>Master of Laws</option>
										<option value="MBA" <?php echo "$deg3MBA";?>>Master of Business Administration</option>

										<option value="PhD" <?php echo "$deg3PhD";?>>Doctor of Philosophy</option>
										<option value="MD" <?php echo "$deg3MD";?>>Doctor of Medicine</option>
										<option value="DEd" <?php echo "$deg3DEd";?>>Doctor of Education</option>
										<option value="JD" <?php echo "$deg3JD";?>>Juris Doctor</option>
										</select>
									</td>
									<td><select name="duration3" style="width:99%;" disabled>
											<option>
											<?php if(isset($_SESSION['duration3'])){echo $_SESSION['duration3'];}?>
											</option>
										</select></td>
									<td><select name="yearaward3" style="width:99%;" disabled>
											<option>
											<?php if(isset($_SESSION['yearaward3'])){echo $_SESSION['yearaward3'];}?>
											</option>
										</select></td>
									<td><input name="GPA3" type="text" disabled value="<?php if(isset($GPA3)) echo $GPA3;?>" style="width:96%;" maxlength="4"></td>
									<td><input name="completion3" type="text" disabled value="<?php if(isset($completion3)) echo $completion3;?>" style="width:96%;" maxlength="3"></td>
									<td><input name="institute3" type="text" disabled value="<?php if(isset($institute3)) echo $institute3;?>" style="width:98%;"></td>
								</tr>
								<?php } ?>
								<!--------------------------------------------->
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part5")) { ?>
									<tr>
										<td>
											<select name="degree1" style="width:99%;">
											<option value="" <?php echo "$deg1blank";?>>--Please Select--</option>
											<option value="AA" <?php echo "$deg1AA"; ?>>Associate of Arts</option>
											<option value="AS" <?php echo "$deg1AS";?>>Associate of Science</option>
											<option value="AAS" <?php echo "$deg1AAS";?>>Associate of Applied Science</option>
											<option value="ADEng" <?php echo "$deg1ADEng";?>>Associate of Engineering</option>
											<option value="AAA" <?php echo "$deg1AAA";?>>Associate of Applied Arts</option>
											<option value="APS" <?php echo "$deg1APS";?>>Associate of Political Science</option>

											<option value="BA" <?php echo "$deg1BA";?>>Bachelor of Arts</option>
											<option value="BSc" <?php echo "$deg1BSc";?>>Bachelor of Science</option>
											<option value="BFA" <?php echo "$deg1BFA";?>>Bachelor of Fine Arts</option>
											<option value="BBA" <?php echo "$deg1BBA";?>>Bachelor of Business Administration</option>
											<option value="BArch" <?php echo "$deg1BArch";?>>Bachelor of Architecture</option>

											<option value="MA" <?php echo "$deg1MA";?>>Master of Arts</option>
											<option value="MS" <?php echo "$deg1MS";?>>Master of Science</option>
											<option value="MARes" <?php echo "$MARes";?>>Master of Research</option>
											<option value="MPhil" <?php echo "$deg1MPhil";?>>Master of Philosophy</option>
											<option value="LLM" <?php echo "$deg1LLM";?>>Master of Laws</option>
											<option value="MBA" <?php echo "$deg1MBA";?>>Master of Business Administration</option>

											<option value="PhD" <?php echo "$deg1PhD";?>>Doctor of Philosophy</option>
											<option value="MD" <?php echo "$deg1MD";?>>Doctor of Medicine</option>
											<option value="DEd" <?php echo "$deg1DEd";?>>Doctor of Education</option>
											<option value="JD" <?php echo "$deg1JD";?>>Juris Doctor</option>
											</select>
											</td>
										<td>
										<select name="duration1" id="year" style="width:99%;">
												<option value="" selected>-- Select --</option>
												<?php 
												for($i=2; $i<=10; $i++)
												{
													echo "<option ";
													if ((isset($_SESSION['duration1']) && $_SESSION['duration1'] == $i)||(isset($_SESSION['part5updatebtn']) && $_POST['duration1'] == $i)) echo "selected";
													echo">".$i."</option>";
												}
												?>
											</select></td>
										<td><select name="yearaward1" id="year" style="width:99%;">
												<option value="" selected>-- Select --</option>
												<?php 
												  $year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['yearaward1']) && $_SESSION['yearaward1'] == $year)||(isset($_POST['part5updatebtn']) && $_POST['yearaward1'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="GPA1" type="text" value="<?php if(isset($GPA1)) echo $GPA1;?>" style="width:98%;" title="Example: 5.59" maxlength="4"></td>
										<td><input name="completion1" type="text" title="Example: 80"  value="<?php if(isset($completion1)) echo $completion1;?>" style="width:98%;" maxlength="3"></td>
										<td><input name="institute1" type="text" value="<?php if(isset($institute1)) echo $institute1;?>" style="width:98%;"></td>
									</tr>
									<tr>
										<td>
										<select name="degree2" style="width:99%;">
											<option value="" <?php echo "$deg2blank";?>>--Please Select--</option>
											<option value="AA" <?php echo "$deg2AA"; ?>>Associate of Arts</option>
											<option value="AS" <?php echo "$deg2AS";?>>Associate of Science</option>
											<option value="AAS" <?php echo "$deg2AAS";?>>Associate of Applied Science</option>
											<option value="ADEng" <?php echo "$deg2ADEng";?>>Associate of Engineering</option>
											<option value="AAA" <?php echo "$deg2AAA";?>>Associate of Applied Arts</option>
											<option value="APS" <?php echo "$deg2APS";?>>Associate of Political Science</option>

											<option value="BA" <?php echo "$deg2BA";?>>Bachelor of Arts</option>
											<option value="BSc" <?php echo "$deg2BSc";?>>Bachelor of Science</option>
											<option value="BFA" <?php echo "$deg2BFA";?>>Bachelor of Fine Arts</option>
											<option value="BBA" <?php echo "$deg2BBA";?>>Bachelor of Business Administration</option>
											<option value="BArch" <?php echo "$deg2BArch";?>>Bachelor of Architecture</option>

											<option value="MA" <?php echo "$deg2MA";?>>Master of Arts</option>
											<option value="MS" <?php echo "$deg2MS";?>>Master of Science</option>
											<option value="MARes" <?php echo "$MARes";?>>Master of Research</option>
											<option value="MPhil" <?php echo "$deg2MPhil";?>>Master of Philosophy</option>
											<option value="LLM" <?php echo "$deg2LLM";?>>Master of Laws</option>
											<option value="MBA" <?php echo "$deg2MBA";?>>Master of Business Administration</option>

											<option value="PhD" <?php echo "$deg2PhD";?>>Doctor of Philosophy</option>
											<option value="MD" <?php echo "$deg2MD";?>>Doctor of Medicine</option>
											<option value="DEd" <?php echo "$deg2DEd";?>>Doctor of Education</option>
											<option value="JD" <?php echo "$deg2JD";?>>Juris Doctor</option>
											</select>
										</td>
										<td><select name="duration2" id="year" style="width:99%;">
												<option value="" selected>-- Select --</option>
												<?php 
												for($i=2; $i<=10; $i++)
												{
													echo "<option ";
													if ((isset($_SESSION['duration2']) && $_SESSION['duration2'] == $i)||(isset($_POST['part5updatebtn']) && $_POST['duration2'] == $i)) echo "selected";
													echo">".$i."</option>";
												}
												?>
											</select></td>
										<td><select name="yearaward2" id="year" style="width:99%;">
												<option value="" selected>-- Select --</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['yearaward2']) && $_SESSION['yearaward2'] == $year)||isset($_POST['part5updatebtn']) && $_POST['yearaward2'] == $year) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="GPA2" type="text" id="textfield8" value="<?php if(isset($GPA2)) echo $GPA2;?>" title="Example: 5.59" style="width:98%;" maxlength="4"></td>
										<td><input name="completion2" type="text" id="textfield9"title="Example: 80"  value="<?php if(isset($completion2)) echo $completion2;?>" style="width:98%;" maxlength="3"></td>
										<td><input name="institute2" type="text" id="textfield10" value="<?php if(isset($institute2)) echo $institute2;?>" style="width:98%;"></td>
									</tr>
									<tr>
										<td>
										<select name="degree3" style="width:99%;">
											<option value="" <?php echo "$deg3blank";?>>--Please Select--</option>
											<option value="AA" <?php echo "$deg3AA"; ?>>Associate of Arts</option>
											<option value="AS" <?php echo "$deg3AS";?>>Associate of Science</option>
											<option value="AAS" <?php echo "$deg3AAS";?>>Associate of Applied Science</option>
											<option value="ADEng" <?php echo "$deg3ADEng";?>>Associate of Engineering</option>
											<option value="AAA" <?php echo "$deg3AAA";?>>Associate of Applied Arts</option>
											<option value="APS" <?php echo "$deg3APS";?>>Associate of Political Science</option>

											<option value="BA" <?php echo "$deg3BA";?>>Bachelor of Arts</option>
											<option value="BSc" <?php echo "$deg3BSc";?>>Bachelor of Science</option>
											<option value="BFA" <?php echo "$deg3BFA";?>>Bachelor of Fine Arts</option>
											<option value="BBA" <?php echo "$deg3BBA";?>>Bachelor of Business Administration</option>
											<option value="BArch" <?php echo "$deg3BArch";?>>Bachelor of Architecture</option>

											<option value="MA" <?php echo "$deg3MA";?>>Master of Arts</option>
											<option value="MS" <?php echo "$deg3MS";?>>Master of Science</option>
											<option value="MARes" <?php echo "$MARes";?>>Master of Research</option>
											<option value="MPhil" <?php echo "$deg3MPhil";?>>Master of Philosophy</option>
											<option value="LLM" <?php echo "$deg3LLM";?>>Master of Laws</option>
											<option value="MBA" <?php echo "$deg3MBA";?>>Master of Business Administration</option>

											<option value="PhD" <?php echo "$deg3PhD";?>>Doctor of Philosophy</option>
											<option value="MD" <?php echo "$deg3MD";?>>Doctor of Medicine</option>
											<option value="DEd" <?php echo "$deg3DEd";?>>Doctor of Education</option>
											<option value="JD" <?php echo "$deg3JD";?>>Juris Doctor</option>
											</select>
										</td>
										<td><select name="duration3" id="year" style="width:99%;">
												<option value="" selected>-- Select --</option>
												<?php 
												for($i=2; $i<=10; $i++)
												{
													echo "<option ";
													if ((isset($_SESSION['duration3']) && $_SESSION['duration3'] == $i)||(isset($_POST['part5updatebtn']) && $_POST['duration3'] == $i)) echo "selected";
													echo">".$i."</option>";
												}
												?>
											</select></td>
										<td><select name="yearaward3" id="year" style="width:99%;">
												<option value="" selected>-- Select --</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['yearaward3']) && $_SESSION['yearaward3'] == $year)||isset($_POST['part5updatebtn']) && $_POST['yearaward3'] == $year) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="GPA3" type="text" id="textfield" value="<?php if(isset($GPA3)) echo $GPA3;?>" title="Example: 5.59" style="width:98%;" maxlength="4"></td>
										<td><input name="completion3" type="text" id="textfield"title="Example: 80"  value="<?php if(isset($completion3)) echo $completion3;?>" style="width:98%;" maxlength="3"></td>
										<td><input name="institute3" type="text" id="textfield" value="<?php if(isset($institute3)) echo $institute3;?>" style="width:98%;"></td>
									</tr>
									<?php } ?>
							</table>
							<p><strong>List <u>all</u> previously relevant research experience/employment. </strong><font color="#FF0000"><?php echo $errposition; ?></font></p>
							<table width="100%" border="1">
								<tr align="center" valign="top">
									<th width="45%">Position</th>
									<th width="45%">Employer/Institution</th>
									<th width="10%">Year Appointed</th>
								</tr>
								<!--------------read portion of position---------------------->
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part5"))){?>
								<tr>
									<td><input name="position1" type="text" disabled id="text" value="<?php if(isset($position1)) echo $position1;?>" style="width:99%;"></td>
									<td><input name="empinst1" type="text" disabled id="text" value="<?php echo $empinst1;?>" style="width:99%;"></td>
									<td><input type="text" name="yearappoint1" id="text" disabled value="<?php if(isset($yearappoint1)) echo $yearappoint1;?>"style="width:96%;"></td>
								</tr>
								<tr>
									<td><input name="position2" type="text" disabled id="text" value="<?php if(isset($position2)) echo $position2;?>" style="width:99%;"></td>
									<td><input name="empinst2" type="text" disabled id="text" value="<?php if(isset($empinst2)) echo $empinst2;?>" style="width:99%;"></td>
									<td><input type="text" name="yearappoint2" id="text" disabled value="<?php if(isset($yearappoint2)) echo $yearappoint2;?>"style="width:96%;"></td>
								</tr>
								<tr>
									<td><input name="position3" type="text" disabled id="text" value="<?php if(isset($position3)) echo $position3;?>" style="width:99%;"></td>
									<td><input name="empinst3" type="text" disabled id="text" value="<?php if(isset($empinst3)) echo $empinst3;?>" style="width:99%;"></td>
									<td><input type="text" name="yearappoint3" id="text" disabled value="<?php if(isset($yearappoint3)) echo $yearappoint3;?>"style="width:96%;"></td>
								</tr>
								<?php } ?>
								<!----------------------------------------------------------------> 
								<!--------------edit portion of position---------------------->
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part5")) { ?>
									<tr>
										<td><input name="position1" type="text" id="text" style="width:99%;" value="<?php if(isset($position1)) echo $position1;?>" ></td>
										<td><input name="empinst1" type="text" id="text"  value="<?php if(isset($_SESSION['empinst1'])||$_POST['empinst1']) echo $empinst1;?>" style="width:99%;"></td>
										<td><select name="yearappoint1" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['yearappoint1']) && $_SESSION['yearappoint1'] == $year)||(isset($_POST['part5updatebtn']) && $_POST['yearappoint1'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
									</tr>
									<tr>
										<td><input name="position2" type="text" id="text"  value="<?php if(isset($position2)) echo $position2;?>" style="width:99%;"></td>
										<td><input name="empinst2" type="text" id="text"  value="<?php if(isset($empinst2)||$_POST['empinst2']) echo $empinst2;?>" style="width:99%;"></td>
										<td><select name="yearappoint2" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['yearappoint2']) && ($_SESSION['yearappoint2'] == $year))||(isset($_POST['part5updatebtn']) && $_POST['yearappoint2'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
									</tr>
									<tr>
										<td><input name="position3" type="text" id="text2"  value="<?php if(isset($position3)) echo $position3;?>" style="width:99%;" /></td>
										<td><input name="empinst3" type="text" id="text4"  value="<?php if(isset($empinst3)||$_POST['empinst3']) echo $empinst3;?>" style="width:99%;" /></td>
										<td><select name="yearappoint3" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['yearappoint3']) && ($_SESSION['yearappoint3'] == $year))||(isset($_POST['part5updatebtn']) && $_POST['yearappoint3'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
									</tr>
									<?php } ?>
								<!---------------------------------------------------------------->
							</table>
							<p><strong>List your 5 most recent (or <u>all</u>) publications.</strong><font color="#FF0000"><?php echo $errpubyear; ?></font></p>
							<table width="100%" border="1">
								<tr align="center" valign="top">
									<th width="10%">Year</th>
									<th width="45%">Title</th>
									<th width="45%">Publication ref</th>
								</tr>
								<!-- showcase of entered records for Publication --> 
								<!------------------------------------------------------------->
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part5"))){?>
								<tr>
									<td><input type="text" name="pubyear1" id="text" style="width:96%;" disabled value="<?php if(isset($_SESSION['pubyear1'])){echo $_SESSION['pubyear1'];}?>"></td>
									<td><input name="pubtitle1" type="text" disabled id="text" value="<?php if(isset($pubtitle1)) echo $pubtitle1;?>" style="width:99%;"></td>
									<td><input name="pubref1" type="text" disabled id="text" value="<?php if(isset($pubref1)) echo $pubref1;?>" style="width:99%;"></td>
								</tr>
								<tr>
									<td><input type="text" name="pubtitle2" id="text" style="width:96%;"disabled value="<?php if(isset($_SESSION['pubyear2'])){echo $_SESSION['pubyear2'];}?>"></td>
									<td><input name="pubtitle2" type="text" disabled id="text" value ="<?php if(isset($pubtitle2)) echo $pubtitle2;?>" style="width:99%;"></td>
									<td><input name="pubref2" type="text" disabled id="text" value="<?php if(isset($pubref2)) echo $pubref2;?>" style="width:99%;"></td>
								</tr>
								<tr>
									<td><input type="text" name="pubtitle3" id="text" style="width:96%;" disabled value="<?php if(isset($_SESSION['pubyear3'])){echo $_SESSION['pubyear3'];}?>"></td>
									<td><input name="pubtitle3" type="text" disabled id="text" style="width:99%;" value="<?php if(isset($pubtitle3)) echo $pubtitle3;?>" size="65"></td>
									<td><input name="pubref3" type="text" disabled id="text" value="<?php if(isset($pubref3)) echo $pubref3;?>" style="width:99%;"></td>
								</tr>
								<tr>
									<td><input type="text" name="pubtitle4" id="text" style="width:96%;" disabled value="<?php if(isset($_SESSION['pubyear4'])){echo $_SESSION['pubyear4'];}?>"></td>
									<td><input name="pubtitle4" type="text" disabled id="text" value="<?php if(isset($pubtitle4)) echo $pubtitle4;?>" style="width:99%;"></td>
									<td><input name="pubref4" type="text" disabled id="text" value="<?php if(isset($pubref4)) echo $pubref4;?>" style="width:99%;"></td>
								</tr>
								<tr>
									<td><input type="text" name="pubtitle5" id="text" style="width:96%;" disabled value="<?php if(isset($_SESSION['pubyear5'])){echo $_SESSION['pubyear5'];}?>"></td>
									<td><input name="pubtitle5" type="text" disabled id="text" style="width:99%;" value="<?php if(isset($pubtitle5)) echo $pubtitle5;?>" size="65"></td>
									<td><input name="pubref5" type="text" disabled id="text" value="<?php if(isset($pubref5)) echo $pubref5;?>" style="width:99%;"></td>
								</tr>
								<?php } ?>
								<!-------------------------------------------------------------> 
								<!-- allows edit of entered records for Publication --> 
								<!------------------------------------------------------------->
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part5")) { ?>
									<tr>
										<td><select name="pubyear1" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['pubyear1'])&& ($_SESSION['pubyear1'])==$year)||
													(isset($_POST['part5updatebtn']) && $_POST['pubyear1'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="pubtitle1" type="text" id="text" value="<?php if(isset($pubtitle1)) echo $pubtitle1;?>" style="width:99%;"></td>
										<td><input name="pubref1" type="text" id="text" style="width:99%;" value="<?php if(isset($pubref1)) echo $pubref1;?>" size="52"></td>
									</tr>
									<tr>
										<td><select name="pubyear2" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['pubyear2'])&& ($_SESSION['pubyear2'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['pubyear2'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="pubtitle2" type="text" id="text" value ="<?php if(isset($pubtitle2)) echo $pubtitle2;?>" style="width:99%;"></td>
										<td><input name="pubref2" type="text" id="text" style="width:99%;" value="<?php if(isset($pubref2)) echo $pubref2;?>" size="52"></td>
									</tr>
									<tr>
										<td><select name="pubyear3" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['pubyear3'])&& ($_SESSION['pubyear3'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['pubyear3'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="pubtitle3" type="text" id="text" value="<?php if(isset($pubtitle3)) echo $pubtitle3;?>" style="width:99%;"></td>
										<td><input name="pubref3" type="text" id="text" value="<?php if(isset($pubref3)) echo $pubref3;?>" style="width:99%;"></td>
									</tr>
									<tr>
										<td><select name="pubyear4" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['pubyear4'])&& ($_SESSION['pubyear4'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['pubyear4'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="pubtitle4" type="text" id="text" value="<?php if(isset($pubtitle4)) echo $pubtitle4;?>" style="width:99%;"></td>
										<td><input name="pubref4" type="text" id="text" value="<?php if(isset($pubref4)) echo $pubref4;?>" style="width:99%;"></td>
									</tr>
									<tr>
										<td><select name="pubyear5" id="year" style="width:99%;">
												<option value="" selected>-- Select--</option>
												<?php 
												$year = date('Y');
												for($i=40; $i>=1; $i--)
												{
													echo "<option ";
													if ((isset($_SESSION['pubyear5'])&& ($_SESSION['pubyear5'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['pubyear5'] == $year)) echo "selected";
													echo">".$year."</option>";
													$year--;
												}
												?>
											</select></td>
										<td><input name="pubtitle5" type="text" id="text" value="<?php if(isset($pubtitle5)) echo $pubtitle5;?>" style="width:99%;"></td>
										<td><input name="pubref5" type="text" id="text" value="<?php if(isset($pubref5)) echo $pubref5;?>" style="width:99%;"></td>
									</tr>
									<?php } ?>
							</table>
							<!-------------------------------------------------->
							<p><strong>List any professional qualifications and memberships, awards and prizes, or additional relevant information</strong><font color="#FF0000"><?php echo $errqualyear; ?></font></p>
							<table width="100%" border="1">
								<tr align="center" valign="top">
									<th width="10%">Year</th>
									<th width="45%">Qualification/Membership/Award/Prize</th>
									<th width="45%">Name and Location of Institution</th>
								</tr>
								<!-------------------------------------------------------------------> 
								<!---		showcase of inserted records in the particular field	---> 
								<!------------------------------------------------------------------->
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part5"))){?>
								<tr>
									<td><input type="text" name="qualyear1" id="text" style="width:96%;" disabled value="<?php if(isset($qualyear1)){echo $qualyear1;}?>"></td>
									<td><input name="qualname1" style="width:99%;" type="text" disabled id="text" value="<?php if(isset($qualname1)) echo $qualname1;?>" size="52"></td>
									<td><input name="institutename1"  style="width:99%;" type="text"disabled id="text" value="<?php if(isset($institutename1)) echo $institutename1;?>" size="65"></td>
								</tr>
								<tr>
									<td><input type="text" name="qualyear2" id="text" style="width:96%;"disabled value="<?php if(isset($_SESSION['qualyear2'])){echo $_SESSION['qualyear2'];}?>"></td>
									<td><input name="qualname2" style="width:99%;" type="text" disabled id="text" value="<?php if(isset($qualname2)) echo $qualname2;?>" ></td>
									<td><input name="institutename2" style="width:99%;" type="text" disabled id="text" value="<?php if(isset($institutename2)) echo $institutename2;?>" size="65"></td>
								</tr>
								<tr>
									<td><input type="text" name="qualyear3" id="text" style="width:96%;" disabled value="<?php if(isset($_SESSION['qualyear3'])){echo $_SESSION['qualyear3'];}?>"></td>
									<td><input name="qualname3" style="width:99%;" type="text" disabled id="text" value="<?php if(isset($qualname3)) echo $qualname3;?>" ></td>
									<td><input name="institutename3" style="width:99%;" type="text" disabled id="text" value="<?php if(isset($institutename3)) echo $institutename3;?>" ></td>
								</tr>
								<tr>
									<td><input type="text" name="qualyear4" id="text" style="width:96%;" disabled value="<?php if(isset($_SESSION['qualyear4'])){echo $_SESSION['qualyear4'];}?>"></td>
									<td><input name="qualname4" type="text" style="width:99%;" disabled id="text" value="<?php if(isset($qualname4)) echo $qualname4;?>"></td>
									<td><input name="institutename4" style="width:99%;" type="text" disabled id="text" value="<?php if(isset($institutename4)) echo $institutename4;?>" ></td>
								</tr>
								<?php }?>
								<!-------------------------------------------------------------------> 
								<!---	editable of inserted records in the particular field	-----> 
								<!------------------------------------------------------------------->
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part5")) { ?>
								<tr>
									<td><select name="qualyear1" id="year" style="width:99%;">
											<option value="" selected>-- Select--</option>
											<?php 
											$year = date('Y');
											for($i=40; $i>=1; $i--)
											{
												echo "<option ";
												if ((isset($_SESSION['qualyear1'])&& ($_SESSION['qualyear1'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['qualyear1'] == $year)) echo "selected";
												echo">".$year."</option>";
												$year--;
											}
											?>
										</select></td>
									<td><input name="qualname1" style="width:99%;" type="text" id="text" value="<?php if(isset($qualname1)) echo $qualname1;?>" size="52"></td>
									<td><input name="institutename1" style="width:99%;" type="text" id="text" value="<?php if(isset($institutename1)) echo $institutename1;?>" ></td>
								</tr>
								<tr>
									<td><select name="qualyear2" id="year" style="width:99%;">
											<option value="" selected>-- Select--</option>
											<?php 
											$year = date('Y');
											for($i=40; $i>=1; $i--)
											{
												echo "<option ";
												if ((isset($_SESSION['qualyear2'])&& ($_SESSION['qualyear2'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['qualyear2'] == $year)) echo "selected";
												echo">".$year."</option>";
												$year--;
											}
											?>
										</select></td>
									<td><input name="qualname2" type="text" style="width:99%;" id="text"value="<?php if(isset($qualname2)) echo $qualname2;?>" ></td>
									<td><input name="institutename2" style="width:99%;" type="text" id="text" value="<?php if(isset($institutename2)) echo $institutename2;?>" ></td>
								</tr>
								<tr>
									<td><select name="qualyear3" id="year" style="width:99%;">
											<option value="" selected>-- Select--</option>
											<?php 
											$year = date('Y');
											for($i=40; $i>=1; $i--)
											{
												echo "<option ";
												if ((isset($_SESSION['qualyear3'])&& ($_SESSION['qualyear3'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['qualyear3'] == $year)) echo "selected";
												echo">".$year."</option>";
												$year--;
											}
											?>
										</select></td>
									<td><input name="qualname3" type="text" id="text" style="width:99%;" value="<?php if(isset($qualname3)) echo $qualname3;?>" size="52"></td>
									<td><input name="institutename3" style="width:99%;" type="text" id="text" value="<?php if(isset($institutename3)) echo $institutename3;?>" size="65"></td>
								</tr>
								<tr>
									<td><select name="qualyear4" id="year" style="width:99%;">
											<option value="" selected>--Select--</option>
											<?php 
											$year = date('Y');
											for($i=40; $i>=1; $i--)
											{
												echo "<option ";
												if ((isset($_SESSION['qualyear4'])&& ($_SESSION['qualyear4'])==$year)||(isset($_POST['part5updatebtn']) && $_POST['qualyear4'] == $year)) echo "selected";
												echo">".$year."</option>";
												$year--;
											}
											?>
										</select></td>
									<td><input name="qualname4" type="text" id="text" value="<?php if(isset($qualname4)) echo $qualname4;?>"style="width:99%;"></td>
									<td><input name="institutename4" style="width:99%;" type="text" id="text" value="<?php if(isset($institutename4)) echo $institutename4;?>" size="65"></td>
								</tr>
								<?php }?>
							</table>
						</form>
						<br />
						
						<!-----------------section 6------------------------->
						
						<form id="part6" name="eoiform" method="post"  action="#">
							<font size="+2" ><strong>6. English Language Proficiency</strong></font>
							<?php  if (!isset($_REQUEST['edit']))
					{?>
							<a href="EOI_Page4.php?edit=part6#part6">(Edit)</a>
							<?php }
								if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part6")) { ?>
								<input name="part6updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							<h3>All higher degree research applications are required to achieve an appropriate level of proficiency in academic English before they can commence their higher degree research program. <font color="#FF0000"><?php echo $erreng; ?></font></h3>
							<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part6"))){?>
							<input type="radio" name="eng" value="main" onClick="addSubject(this)" <?php echo $mainchecked;?> disabled />
							English is my first language <br />
							<input type="radio" name="eng" value="pending"  onClick="addSubject(this)" <?php echo $pendingchecked;?> disabled />
							I intend to sit an IELTS or TOEFL test at a later date <br />
							<input type="radio" name="eng" value="completed" id="completed" onClick="addSubject(this)" <?php echo $completedchecked;?> disabled />
							I have completed an IELTS or TOEFL test within the past two years to the required standard<br />
							<input name="eng" id="other" type="radio" value="other" onClick="addSubject(this)" <?php echo $otherchecked; ?> disabled />
							Other English Course
							<?php }?>
							<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part6")) { ?>
							<br />
							<label><input type="radio" name="eng" value="main" onClick="addSubject(this)" <?php echo $mainchecked;?>/>
							English is my first language</label><br />
							<label><input type="radio" name="eng" value="pending"  onClick="addSubject(this)" <?php echo $pendingchecked;?>/>
							I intend to sit an IELTS or TOEFL test at a later date</label><br />
							<label><input type="radio" name="eng" value="completed" id="completed" onClick="addSubject(this)" <?php echo $completedchecked;?>/>
							I have completed an IELTS or TOEFL test within the past two years to the required standard </label><br />
							<label><input name="eng" id="other" type="radio" value="other" onClick="addSubject(this)" <?php echo $otherchecked; ?> />
							Other English Course </label>
							<?php }?>
							<!--------------------------------------------------------------->
							<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part6"))){?>
							<br />
							<div id="options">
								<div class="box" id="completed" <?php if($_SESSION['eng']!="completed"){echo "style='display: none;'";}?>>
									<div>
										<table>
											<tr>
												<td><div align="left"><strong>&emsp;Please specify below: </strong></div></td>
									</tr>
											<tr>
												<td><strong>&emsp;&emsp;</strong>Test Type:
												<input type="radio" name="testtype1" disabled id="testtype4" value="IELTS" <?php  echo $ieltscheck; ?> />
												IELTS 
												<input type="radio" name="testtype1" id="testtype2" disabled value="TOEFL_Paper" <?php echo $toeflpprcheck; ?> />
												TOEFL (paper) 
												<input type="radio" name="testtype1" id="testtype3" disabled value="TOEFL_IE" <?php echo $toeflwwwcheck; ?> />
												TOEFL (internet)</td>
											
											</tr>
											<tr>
												<td><strong>&emsp;&emsp;</strong>Test Score: 
														<input type="text" name="testscore2" disabled id="testscore2" size="3" value="<?php echo $testscore; ?>"/>
												Test Date:
												<input type="text" id="testdate2" name="testdate2" disabled value="<?php if(isset($testdate))echo $testdate ?>" /></td>
												
											</tr>
										</table>
									</div>
								</div>
								<div class="box" id="other" <?php if($_SESSION['eng']!="other"){echo "style='display: none;'";}?>>
									<div> <span>
										<table>
											<tr>
												<th><div align="left"><strong>&emsp;Please specify below:</strong></div></th>
											</tr>
											<tr>
												<td> &emsp;&emsp;Course Name:  													
													<input name="engcourse" type="text" disabled value="<?php if(isset($_SESSION['engcourse'])) echo $_SESSION['engcourse'];?>"/>
												Result:													
												<input type="text" name="result2" size="3" disabled value="<?php if(isset($_SESSION['result'])) echo $_SESSION['result'];?>" /></td>
				
											</tr>
										</table>
										</span> </div>
								</div>
							</div>
							<?php }?>
							<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part6")) { ?>
								<div id="options">
									<div class="box" id="completed" <?php if((!isset($_POST['part6updatebtn']) && isset($_SESSION['eng']) && $_SESSION['eng']!="completed") || (isset($_POST['part6updatebtn']) && $_POST['eng']!="completed")) {echo "style='display: none;'";}?>>
										<div>
											<table>
												<tr>
													<th colspan="3"><div align="left"><strong>&emsp;Please specify below:</strong></div></th>
												</tr>
												<tr>
													<td>&emsp;&emsp;<font color="#FF0000"><?php echo $errtesttype;?></font>Test Type:
														<input type="radio" name="testtype" id="testtype1" title="International English Language Testing System (Score range: 0 - 9)" value="IELTS" <?php echo $ieltscheck ?> />
														IELTS
														<input type="radio" name="testtype" title="Test of English as a Foreign Language (Score range: 310 - 677)" value="TOEFL_Paper" <?php echo $toeflpprcheck ?> />
														TOEFL (paper)
														<input type="radio" name="testtype" value="TOEFL_IE" title="Test of English as a Foreign Language (Score range: 0 - 120)" <?php echo $toeflwwwcheck ?> />
														TOEFL (internet) </td>
												</tr>
												<tr>
													<td>&emsp;&emsp;<font color="#FF0000"><?php echo $errtestscore; ?></font>Test Score: 
														<input type="text" name="testscore" id="testscore" size="3" value="<?php  echo $testscore; ?>"/>
														<font color="#FF0000"><?php echo $errtestdate;?></font>Test Date:
														<input type="text" id="testdate" name="testdate" value="<?php echo $testdate ?>" /></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="box" id="other" <?php if((!isset($_POST['part6updatebtn']) && isset($_SESSION['eng']) && $_SESSION['eng']!="other") || (isset($_POST['part6updatebtn']) && $_POST['eng']!="other")) {echo "style='display: none;'";}?>>
										<div> <span>
											<table>
												<tr>
													<th><div align="left"><strong>&emsp;Please specify below:</strong></div>
													</th>
												</tr>
												<tr>
													<td> <strong>&emsp;&emsp;</strong><font color="#FF0000"><?php echo $errengcourse; ?></font>
													Course Name:
													<input name="engcourse" type="text" title="Example: English Language Proficiency Test" value="<?php if(isset($_POST['part6updatebtn'])&&isset($_POST['engcourse'])) echo $_POST['engcourse'];
														if(!isset($_POST['part6updatebtn'])&&isset($_SESSION['engcourse'])) echo $_SESSION['engcourse'];?>"/>
													<font color="#FF0000"><?php echo $errresult; ?></font>Result:														
													<input type="text" name="result" size="3" value="<?php if(isset($_POST['part6updatebtn'])&&isset($_POST['result'])) echo $_POST['result'];
													if(!isset($_POST['part6updatebtn'])&&isset($_SESSION['result'])) echo $_SESSION['result'];?>" /></td>
				
												</tr>
											</table>
											</span> </div>
									</div>
								</div>
								<?php } ?>
							</p>
						</form> <br />
						
						<!-----------------section 7------------------------->
						
						<form id="part7" name="eoiform" method="post" action="#">
							<font size="+2" ><strong>7. Scholarship support</strong> </font>
							<?php  if (!isset($_REQUEST['edit']))
						{?>
							<a href="EOI_Page4.php?edit=part7#part7">(Edit)</a>
							<?php }
						if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part7")) { ?>
								<input name="part7updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							<h3>The University may award a living allowance and / or tuition fee scholarship to a higher degree research candidate. Note that scholarship numbers are limited and thus only available for candidates with a higher competitive track record. Information on higher degree research scholarship schemes can be found on the Murdoch University Graduate Research Office <a href="http://our.murdoch.edu.au/Research-and-Development/Resources-for-students/Future-research-students/Admission-and-scholarships/Domestic-students-scholarships/Australian-Postgraduate-Award/">Website</a>. <font color="#FF0000"><?php $errwhyresearch; ?></font></h3>
							<p><strong>I require a scholarship to undertake studies at Murdoch </strong><font color="#FF0000"><?php echo $errscholarqn1; ?></font><br/>
								<label>
									<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part7")))
						{
							if(isset($_SESSION['scholarqn1'])&&$_SESSION['scholarqn1']=="yes")
							{
								$scholarqn1yes ="checked";
							}?>
									<input type="radio" name="scholarqn1" value="yes" <?php echo $scholarqn1yes; ?> disabled>
									<?php }?>
									<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part7")) { ?>
										<input type="radio" name="scholarqn1" value="yes" <?php echo $scholarqn1yes;?> />
										<?php } ?>
									Yes</label>
								<br />
								<label>
									<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part7")))
						{
							if(isset($_SESSION['scholarqn1'])&&$_SESSION['scholarqn1']=="no")
							{
								$scholarqn1no ="checked";
							}?>
									<input type="radio" name="scholarqn1" value="no" <?php echo $scholarqn1no; ?> disabled>
									<?php }?>
									<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part7")) { ?>
										<input type="radio" name="scholarqn1" value="no" <?php echo $scholarqn1no;?> />
										<?php } ?>
									No</label>
							</p>
							<p><strong>I have been awarded a tuition fee scholarship from another organisation to undertake studies at Murdoch</strong><font color="#FF0000"><?php echo $errscholarqn2; ?></font><br />
								<label>
									<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part7")))
						{
							if(isset($_SESSION['scholarqn2'])&&$_SESSION['scholarqn2']=="yes")
							{
								$scholarqn2yes ="checked";
							}?>
									<input type="radio" name="scholarqn2" value="yes" <?php echo $scholarqn2yes; ?> disabled>
									<?php }?>
									<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part7")) { ?>
										<input type="radio" name="scholarqn2" value="yes" <?php echo $scholarqn2yes;?> />
										<?php } ?>
									Yes</label>
								<br />
								<label>
									<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part7")))
									{
										if(isset($_SESSION['scholarqn2'])&&$_SESSION['scholarqn2']=="no")
										{
											$scholarqn2no ="checked";
										}?>
									<input type="radio" name="scholarqn2" value="no" <?php echo $scholarqn2no; ?> disabled />
									<?php }?>
									<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part7")) { ?>
										<input type="radio" name="scholarqn2" value="no" <?php echo $scholarqn2no;?> />
										<?php } ?>
									No</label>
							</p>
							<p><strong>I have been awarded a living allowance scholarship from another organization to undertake studies at Murdoch<font color="#FF0000"><?php echo $errscholarqn3; ?></font></strong><br />
								<label>
									<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part7")))
									{		
										if(isset($_SESSION['scholarqn3'])&&$_SESSION['scholarqn3']=="yes")
										{
											$scholarqn3yes ="checked";
										}?>
									<input type="radio" name="scholarqn3" value="yes" <?php echo $scholarqn3yes; ?> disabled>
									<?php }?>
									<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part7")) { ?>
										<input type="radio" name="scholarqn3" value="yes"  onclick="addSubject1(this)" <?php echo $scholarqn3yes;?> />
										<?php } ?>
									Yes</label>
								<br />
								<label>
									<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part7")))
									{
										if(isset($_SESSION['scholarqn3'])&&$_SESSION['scholarqn3']=="no")
										{
											$scholarqn3no ="checked";
										}?>
									<input type="radio" name="scholarqn3" value="no"  <?php echo $scholarqn3no ;?> disabled>
									<?php }?>
									<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part7")) { ?>
										<input type="radio" name="scholarqn3" value="no"  onclick="addSubject1(this)" <?php echo $scholarqn3no;?> />
										<?php } ?>
									No</label>
							</p>
							<!--display whenedit not pressed-->
							<?php if(!isset($_REQUEST['edit'])||isset($_REQUEST['edit'])&&$_REQUEST['edit']!="part7") { ?>
							<div id="scholar">
								<div class="box" id="yes" <?php if(isset($_SESSION['scholarqn3'])&&$_SESSION['scholarqn3']!="yes"){echo " style='display: none;'";}?>>
									<div>
										<p><strong>Please list details of scholarships awarded below. </strong><font color="#FF0000"><?php echo $errscholartable; ?></font></p>
										<table border="1">
											<tr>
												<td><strong>Name of scholarship</strong></td>
												<td><strong>Sponsor/<br/>
													Organisation</strong></td>
												<td><strong>Value per annum (Aus $)</strong></td>
												<td><strong>Duration in total</strong></td>
												<td><strong>Purpose(s) eg. tuition fees, living expenses</strong></td>
												<td><strong>Status</strong></td>
											</tr>
											<tr>
												<td><input name="scholarname1"  type="text" id="textfield3" disabled value="<?php if(isset($scholarname1)){ echo $scholarname1;} ?>" style="width:97%;" /></td>
												<td><input name="sponsor1" type="text" id="textfield4" disabled value="<?php if(isset($sponsor1)&&$sponsor1 !="") echo $sponsor1; ?>"  style="width:97%;" /></td>
												<td><input name="VPA1" type="text" id="textfield5" disabled value="<?php if((isset($_SESSION['VPA1'])&&$_SESSION['VPA1']!="")||(isset($_POST['VPA1'])&&$_POST['VPA1']!="")) echo $VPA1 ?>"  style="width:97%;"  /></td>
												<td><select name="scholarduration1" id="year" disabled style="width:99%;">
														<option value="" selected="selected">--Please Select--</option>
														<?php 
												$year1 =1;
												for($i=1; $i<=20; $i++)
												{
												echo "<option value='";
												echo $i."'";
												if (isset($_SESSION['scholarduration1'])&&$_SESSION['scholarduration1']==$i) echo "selected";
												echo">".$year1."</option>";
												$year1++;
												}
												?>
													</select></td>
												<td><input name="purpose1" type="text" id="textfield6" disabled value="<?php if(isset($purpose1)&&$purpose1 !="") echo $purpose1 ?>" style="width:97%;"/></td>
												<td><select name="status1" id="status1"  disabled style="width:99%;">
														<option value="" selected="selected">--Please Select--</option>
														<option value="applied" <?php if((isset($_POST['status1'])&&$_POST['status1']=="applied")||isset($_SESSION['status1'])&&$_SESSION['status1']=="applied") echo $applied1; ?>>Applied</option>
														<option value="awarded"<?php if((isset($_POST['status1'])&&$_POST['status1']=="awarded")||isset($_SESSION['status1'])&&$_SESSION['status1']=="awarded") echo $awarded1; ?>>Awarded</option>
													</select></td>
											</tr>
											<tr>
												<td><input name="scholarname2" type="text" id="textfield7" disabled value="<?php if(isset($scholarname2)) echo $scholarname2; ?>"  style="width:97%;" /></td>
												<td><input name="sponsor2" type="text" id="textfield2" disabled value="<?php if(isset($sponsor2)) echo $sponsor2; ?>"  style="width:97%;" /></td>
												<td><input name="VPA2" type="text" id="textfield8" disabled value="<?php if(isset($_SESSION['VPA2'])&&$_SESSION['VPA2']!=""||(isset($_POST['VPA2'])&&$_POST['VPA2']!="")) echo $VPA2 ?>" style="width:97%;"  /></td>
												<td><select name="scholarduration2" disabled id="scholarduration" style="width:99%;">
														<option value="" selected="selected">--Please Select--</option>
														<?php 
											$year2 =1;
											for($i=1; $i<=20; $i++)
											{
											echo "<option value='";
											echo $i."'";
											if ((isset($_REQUEST['part7updatebtn']) && $_REQUEST['scholarduration2'] == $i)||isset($_SESSION['scholarduration2'])&&$_SESSION['scholarduration2']==$i) echo "selected";
											echo">".$year2."</option>";
											$year2++;
											}

											?>
													</select></td>
												<td><input name="purpose2" type="text" id="textfield9" disabled value="<?php if(isset($purpose2)&&$purpose2 !="") echo $purpose2 ?>"style="width:97%;" /></td>
												<td><select name="status2" id="status2" disabled style="width:99%;">
														<option value="" selected="selected" >--Please Select--</option>
														<option value="applied" <?php echo $applied2; ?>>Applied</option>
														<option value="awarded" <?php echo $awarded2; ?>>Awarded</option>
													</select></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<?php } if(isset($_REQUEST['edit'])&&$_REQUEST['edit']=="part7") { ?>
							<!-- shows when edit button is pressed -->
								<div id="scholar">
								<div class="box" id="yes" <?php if((!isset($_POST['part7updatebtn']) && isset($_SESSION['scholarqn3']) && $_SESSION['scholarqn3']!="yes") || (isset($_POST['part7updatebtn']) && (isset($_SESSION['scholarqn3']) && $_POST['scholarqn3']!="yes"))){echo " style='display: none;'";}?>>
									<div>
										<p><strong>Please list details of scholarships awarded below. </strong><font color="#FF0000"><?php echo $errscholartable; ?></font></p>
										<table border="1">
											<tr>
												<td><strong>Name of scholarship</strong></td>
												<td><strong>Sponsor/<br/>
													Organisation</strong></td>
												<td><strong>Value per annum (Aus $)</strong></td>
												<td><strong>Duration in total</strong></td>
												<td><strong>Purpose(s)</strong></td>
												<td><strong>Status</strong></td>
											</tr>
											<tr>
												<td><input name="scholarname1"  type="text" id="textfield3" <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?> value="<?php if(isset($scholarname1)){ echo $scholarname1;} ?>" style="width:97%;" /></td>
												<td><input name="sponsor1" type="text" id="textfield4"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  value="<?php if(isset($sponsor1)&&$sponsor1 !="") echo $sponsor1; ?>" style="width:97%;" /></td>
												<td><input name="VPA1" type="text" id="textfield5"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  value="<?php if((isset($_SESSION['VPA1'])&&$_SESSION['VPA1']!="")||(isset($_POST['VPA1'])&&$_POST['VPA1']!="")) echo $VPA1 ?>"  style="width:97%;" title="Please enter numbers only (round up to nearest whole number)" /></td>
												<td><select name="scholarduration1" id="year"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  style="width:99%;">
														<option value="" selected="selected">--Please Select--</option>
														<?php 
												$year1 =1;
												for($i=1; $i<=20; $i++)
												{
												echo "<option value='";
												echo $i."'";
												if ((isset($_REQUEST['part7updatebtn']) && $_REQUEST['scholarduration1'] == $i)||isset($_SESSION['scholarduration1'])&&$_SESSION['scholarduration1']==$i) echo "selected";
												echo">".$year1."</option>";
												$year1++;
												}
												?>
													</select></td>
												<td><input name="purpose1" type="text" id="textfield6"  title="Example: Tuition fee, living expenses" <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  value="<?php if(isset($purpose1)&&$purpose1 !="") echo $purpose1 ?>" style="width:97%;"/></td>
												<td><select name="status1" id="status1"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  style="width:99%;">
														<option value="" selected="selected">--Please Select--</option>
														<option value="applied" <?php if((isset($_POST['status1'])&&$_POST['status1']=="applied")||isset($_SESSION['status1'])&&$_SESSION['status1']=="applied") echo $applied1; ?>>Applied</option>
														<option value="awarded"<?php if((isset($_POST['status1'])&&$_POST['status1']=="awarded")||isset($_SESSION['status1'])&&$_SESSION['status1']=="awarded") echo $awarded1; ?>>Awarded</option>
													</select></td>
											</tr>
											<tr>
												<td><input name="scholarname2" type="text" id="textfield7"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  value="<?php if(isset($scholarname2)) echo $scholarname2; ?>"  style="width:97%;" /></td>
												<td><input name="sponsor2" type="text" id="textfield2"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  value="<?php if(isset($sponsor2)) echo $sponsor2; ?>"  style="width:97%;" /></td>
												<td><input name="VPA2" type="text" id="textfield8"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  value="<?php if(isset($_SESSION['VPA2'])&&$_SESSION['VPA2']!=""||(isset($_POST['VPA2'])&&$_POST['VPA2']!="")) echo $VPA2 ?>" title="Please enter numbers only (round up to nearest whole number)" style="width:97%;"/></td>
												<td><select name="scholarduration2"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  id="scholarduration" style="width:99%;">
														<option value="" selected="selected">--Please Select--</option>
														<?php 
											$year2 =1;
											for($i=1; $i<=20; $i++)
											{
											echo "<option value='";
											echo $i."'";
											if ((isset($_REQUEST['part7updatebtn']) && $_REQUEST['scholarduration2'] == $i)||isset($_SESSION['scholarduration2'])&&$_SESSION['scholarduration2']==$i) echo "selected";
											echo">".$year2."</option>";
											$year2++;
											}

											?>
													</select></td>
												<td><input name="purpose2" type="text" id="textfield9" title="Example: Tuition fee, living expenses" style="width:97%;" <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  value="<?php if(isset($purpose2)&&$purpose2 !="") echo $purpose2 ?>"  /></td>
												<td><select name="status2" id="status2"  <?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']) && $_REQUEST['edit'] != "part7")) {echo "disabled";} ?>  style="width:99%;">
														<option value="" selected="selected" >--Please Select--</option>
														<option value="applied" <?php echo $applied2; ?>>Applied</option>
														<option value="awarded" <?php echo $awarded2; ?>>Awarded</option>
													</select></td>
											</tr>
										</table>
									</div>
								</div>
							</div><?php } ?>
						</form>
						
						<!-----------------section 8------------------------->
						
						<form id="part8" name="eoiform" method="post"  action="#">
							<font size="+2" ><strong><br>
							8. Why do you want to do Research?</strong> </font><font color="#FF0000"><?php echo $errwhyresearch; ?></font>
							<?php  if (!isset($_REQUEST['edit'])) {?>
							<a href="EOI_Page4.php?edit=part8#part8">(Edit)</a>
							<?php }
						if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part8")) { ?>
								<input name="part8updatebtn" type="submit" value="Update">
								<input name="cancelbtn" type="submit" value="Cancel">
								<?php } ?>
							</strong>
							<p>Please outline the main reasons why you want to do research at Murdoch University </p>
							<div>
								<?php if (!isset($_REQUEST['edit'])||(isset($_REQUEST['edit']))&&(($_REQUEST['edit'] != "part8")))	{ ?>
								<textarea cols="50" rows="4" name='whyresearch' id="textarea" disabled><?php if((isset($_SESSION['whyresearch'])&&$_SESSION['whyresearch']!="")){echo $_SESSION['whyresearch'];}?>
								</textarea>
								<?php }?>
								<?php if (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "part8")) { ?>
									<textarea cols="50" rows="4" name="whyresearch" id="textarea" ><?php if(isset($_SESSION['whyresearch'])&& $_SESSION['whyresearch']!="") echo $_SESSION['whyresearch'];?></textarea>
									<font size="1" id="myWordCount">(100 words left)</font>
									<?php } ?>
							</div>
						</form>
						<p>&nbsp;</p></td>
				</tr>
				<tr>
					<td id="form1" style="padding:5px 40px;"><!-----submit button------->
						
						<TABLE BORDER="0" >
							<TR >
								<form id="express_eoi" name="eoiform" method="post" action="#">
									<TD style="padding:5px 40px;"><font style="font-family:Arial, Helvetica, sans-serif">
										<?php if(!isset($_REQUEST['edit'])){ ?>
										<input type="button" name="cancel"class="btn1"value="Cancel" onClick="location.href='logout.php'" />
										<?php }?>
										</font></TD>
									<TD style="padding:5px 40px;" align="right"><font style="font-family:Arial, Helvetica, sans-serif" >
										<div align="right">
											<?php if(!isset($_REQUEST['edit'])){?>
											<input name="submit" type="submit" class="btn1" value="Next &gt;&gt;">
											<?php }?>
										</div>
										</font></TD>
								</form>
							</TR>
						</TABLE></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table></td>
			</tr>
			<tr>
				<td ><footer id ="colophon">
				<?php
				include ("footer.php");
				?>
			</footer></td>
	</tr>
</table>
<p>&nbsp;</p>
</body>
<?php //coding is credited by Chen Jia Wei & Wong Hui Bing ?>
</html>