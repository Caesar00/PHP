<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murdoch University Expression Of Interest In Higher Degree Research Candidature (Page 2 of 5)</title>
</head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<link rel="stylesheet" href="/resources/demos/style.css" />
<link href="css/header.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script language="javascript" type="text/javascript">
//datepicker
$(function() {
	$( "#testdate" ).datepicker
	({
		maxDate: new Date(),
        minDate: '-2Y',
		defaultDate: new Date(),
		dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
	});
});

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

<?php 
include 'connection.php';
session_start();


if(!isset($_SESSION['lastname'])||$_SESSION['lastname']==""){
header("Location: EOI_Page1.php");}//force to go to previous page if mandatory field is not set first

// variables
$programcounter ="";
unset($program);

$PFtime ="";
$FOR1 ="";
$FOR2 ="";
$FOR3 ="";

$researchinterest1 ="";
$researchinterest2 ="";
$researchinterest3 ="";
$researchinterest4 ="";
$researchinterest5 ="";

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
$testscore ="";
$err = "";
$errposition="";
$errpubyear="";
$errqualyear="";
$errsup1="";
$errsup2="";

if(isset($_POST['cancel']))
{
	header("Location: logout.php");
}
if (isset($_POST['submit'])){

	$err = ""; // error checker
	//declare input
	
	
	$supemail1 = trim($_POST['supemail1']);
	$supemail2 = trim($_POST['supemail2']);

		
	
	if(!isset($_POST['program'])){
    $err = "Yes";
	$errprogram = "*";	
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
		
				print_r($programcounter);
		
	}
	if($_POST["school"]=="")
	{
    $err = "Yes";
	$errschool="*";
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
			$errdate ="*";
		}
	}
	
	if (($_POST['month'] == "")||$_POST['year'] == "")
		{
			$err = "Yes";
			$errdate ="*";
		}
	
	
	
	// part time or full time check
	if(!isset($_POST["PFtime"])){
    $errPFtime = "*";
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
	
	if(($_POST['FOR1']=="")&&($_POST['FOR2']=="")&&($_POST['FOR3']=="")){
    $errFOR ="*";
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
				$errFOR ="*";
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
////////////////////referral supervisor/////////////	
	if(isset($_POST['suptitle1']))
	{
		$suptitle1 = $_POST['suptitle1'];
		if($suptitle1 == "Mr"){$sup1mr = "selected";}
		if($suptitle1 == "Ms"){$sup1ms = "selected";}
		if($suptitle1 == "Mrs"){$sup1mrs = "selected";}
		if($suptitle1 == "Mdm"){$sup1mdm = "selected";}
		if($suptitle1 == "Dr"){$sup1dr = "selected";}
		if($suptitle1 == "Prof"){$sup1prof = "selected";}
	}
	if (isset($_POST['supname1']))
	{
		$supname1 = trim($_POST['supname1']);
	}
	if (isset($_POST['supschool1']))
	{
		$supschool1 = $_POST['supschool1'];
	}
	if(trim($_POST['supemail1'])!=""){
		$supemail1 = trim($_POST['supemail1']);
		if ((!filter_var(trim($_POST['supemail1']),FILTER_VALIDATE_EMAIL)))
		{
			$errsup = "*";
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
	if(isset($_POST['suptitle2']))
	{
		$suptitle2 = $_POST['suptitle2'];
		if($suptitle2 == "Mr"){$sup2mr = "selected";}
		if($suptitle2 == "Ms"){$sup2ms = "selected";}
		if($suptitle2 == "Mrs"){$sup2mrs = "selected";}
		if($suptitle2 == "Mdm"){$sup2mdm = "selected";}
		if($suptitle2 == "Dr"){$sup2dr = "selected";}
		if($suptitle2 == "Prof"){$sup2prof = "selected";}
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
			$errsup = "*";
			$err = "Yes";
			
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
	if(isset($_POST['yearaward1'])){$yearaward1=trim($_POST['yearaward1']);}
	if(isset($_POST['duration1'])){$duration1=trim($_POST['duration1']);}
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
	if(isset($_POST['yearaward2'])){$yearaward2=trim($_POST['yearaward2']);}
	if(isset($_POST['duration2'])){$duration2=trim($_POST['duration2']);}
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
	if(isset($_POST['yearaward3'])){$yearaward3=trim($_POST['yearaward3']);}
	if(isset($_POST['duration3'])){$duration3=trim($_POST['duration3']);}
	if(isset($_POST['GPA3'])){$GPA3=trim($_POST['GPA3']);}
	if(isset($_POST['completion3'])){$completion3=trim($_POST['completion3']);}
	if(isset($_POST['institute3'])){$institute3=trim($_POST['institute3']);}
	
	/*					degree 1								*/
	if(($degree1 ==""||$yearaward1 ==""||$duration1 ==""||$GPA1 ==""||$completion1==""||$institute1=="")&&($degree2 ==""||$yearaward2 ==""||$duration2 ==""||$GPA2 ==""||$completion2==""||$institute2=="")&&($degree3 ==""||$yearaward3 ==""||$duration3 ==""||$GPA3 ==""||$completion3==""||$institute3==""))
	{
		$err="Yes";
		$errdegree ="*";
	}
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
///////////////////english proficiency/////////////

	if(!isset($_POST['eng']))
	{
		$err = "Yes";
		$erreng = "*";
	}
	if(isset($_POST['eng']))
	{
		$eng = $_POST['eng'];
		if($eng =="main"){$mainchecked ="checked";}
		if($eng =="pending"){$pendingchecked ="checked";}
		if($eng =="completed")
		{
			$completedchecked ="checked";
			if(!isset($_POST['testtype']))
			{
				$err ="Yes";
				$errtesttype = "*";
			}
			if(!isset($_POST['testdate'])||trim($_POST['testdate'])=="")
			{
				$err ="Yes";
				$errtesttype = "*";
			}
			if(trim($_POST['testscore'])=="")
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
						$errtestscore = "*";
						$err = "Yes";
					}
					if (!filter_var($testscore,FILTER_VALIDATE_FLOAT))
					{
						$err = "Yes";
						$errtestscore ="*";
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
		////////////////Test Date/////////////////		
		if($eng =="other")
		{
			$otherchecked = "checked";
			if(isset($_POST['engcourse']))
			{$engcourse = trim($_POST['engcourse']);}
			if(isset($_POST['result']))
			{$result = trim($_POST['result']);}
			if(isset($engcourse) && $engcourse =="")
			{
				$erreng = "*";
				$err = "Yes";
			}
			if (!filter_var($result,FILTER_VALIDATE_INT))
			{
				$err = "Yes";
				$errresult ="*";
				if($result=="")
				{
					$errresult = "please enter result";
					$err = "Yes";
				}
			}
		}
	}
	
////////////////////////////////////////////////////
////////////////////////////////////////////////////
	
	if($err == "")
	{
		$_SESSION['program'] = $program;
		$_SESSION['school'] = $school;
		$_SESSION['month'] = $_POST['month'];
		$_SESSION['year'] = $_POST['year'];
		$_SESSION['PFtime'] = $PFtime;
		$_SESSION['FOR1'] = $FOR1;
		$_SESSION['FOR2'] = $FOR2;
		$_SESSION['FOR3'] = $FOR3;

		$_SESSION['researchinterest1']= $researchinterest1;
		$_SESSION['researchinterest2']= $researchinterest2;
		$_SESSION['researchinterest3']= $researchinterest3;
		$_SESSION['researchinterest4']= $researchinterest4;
		$_SESSION['researchinterest5']= $researchinterest5;
		
		$_SESSION['suptitle1'] = $suptitle1;
		$_SESSION['supname1'] = $supname1;
		$_SESSION['supschool1'] = $supschool1;
		$_SESSION['supemail1'] = $supemail1;
		
		$_SESSION['suptitle2'] = $suptitle2;
		$_SESSION['supname2'] = $supname2;
		$_SESSION['supschool2'] = $supschool2;
		$_SESSION['supemail2'] = $supemail2;
		
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
		$_SESSION['institutename1'] = 	$institutename1;
		
		$_SESSION['qualyear2'] = $qualyear2;
		$_SESSION['qualname2'] = $qualname2;
		$_SESSION['institutename2'] = 	$institutename2;
		
		$_SESSION['qualyear3'] = $qualyear3;
		$_SESSION['qualname3'] = $qualname3;
		$_SESSION['institutename3'] = 	$institutename3;
		
		$_SESSION['qualyear4'] = $qualyear4;
		$_SESSION['qualname4'] = $qualname4;
		$_SESSION['institutename4'] = 	$institutename4;
		
		$_SESSION['eng'] = $eng;
		$_SESSION['engcourse'] = $engcourse;
		$_SESSION['result'] = $result;
		$_SESSION['testtype'] = $testtype;
		$_SESSION['testscore'] = $testscore;
		$_SESSION['testdate'] = $testdate;
		header("Location: EOI_Page3.php");
	}
}

?>

<body>
<table border="0" align="center">
	<tr>
		<td>
			<div id="header"> 
			<div id="logo"></div>
			</div>
			<div id="navbar">EXPRESSION OF INTEREST IN HIGHER DEGREE RESEARCH CANDIDATURE</div>
			<div><img border="0" src="Image/Nav/Page 2.png" width="100%" height="" /></div>
		</td>
	</tr>
    
	<tr>
    <td>
	<form id="form1" name="form1" method="post" action="">
        <table  border="0" align="center" id="outertable" >
			<tr>
            <td style="padding:5px 40px ;">
				<p><font color="#FF0000">
				<?php if(isset($_POST['submit'])&& ($err !="")){ echo "*Required information is either missing or incorrect";} ?></font>
				</p>
			</td>
			</tr>
			<tr>
				<td style="padding:5px 40px ;"><h2><strong>3. Proposed enrolment</strong></h2>
					<h3>Murdoch University offers a variety of higher degree  research programs. Selection for admission to these programs is based on the  criteria set out in the Murdoch University policy for Higher Degree Research  Candidature Selection. </h3>
					<div><strong>Program: </strong><font color="#FF0000">
					<?php echo $errprogram; ?></font></div>
					<table width="60%" border="0" align="left">
						<tr>
							<td><label>
							<input type="checkbox" name="program[]" value="PhD" <?php echo $phdchecked;?> />
							PhD</label>
							&emsp;</td>
							<td><label><input type="checkbox" name="program[]" value="MPhil"<?php echo $mphilchecked;?> />
							MPhil </label></td>
							<td><label><input type="checkbox" name="program[]" value="DIT" <?php echo $ditchecked;?> />
							DIT</label></td>
							<td><label>
							<input type="checkbox" name="program[]" value="MEd Res"<?php echo $medreschecked;?> />
							MEd Res</label>
							</td>
							<td><label>
							<input type="checkbox" name="program[]" value="DVetMedS" <?php echo $dvetmedschecked;?> />
							DVetMedSc</label>
							</td>
						</tr>
						<tr>
							<td><label><input type="checkbox" name="program[]" value="LLM" <?php echo $llmchecked;?> />
							LLM </label></td>
							<td><label>
							<input type="checkbox" name="program[]" value="EdD" <?php echo $eddchecked;?> />
							EdD</label>
							<label></label></td>
							<td><label>
							<input type="checkbox" name="program[]" value="RMT" <?php echo $rmtchecked;?> />
							RMT</label>
							<label></label></td>
							<td><label><input type="checkbox" name="program[]" value="DPSYCH"<?php echo $dpsychchecked;?> />
							DPSYCH&emsp;
							</label></td>
							<td><label>
							<input type="checkbox" name="program[]" value="MAppPsych/PhD"<?php echo $mapppsychchecked;?> />
							MAppPsych/PhD</label></td>
						</tr>
					</table>
					<h4><br /><br /></h4>
					<h4>Candidates enrolled in higher degree research programs at Murdoch University are located in specific Schools. In which School do you wish to undertake your research?<br/></h4>
					&emsp;&emsp;
					<select name="school" id="school">
						<option selected="selected" value="">-- Please Select --</option>
						<?php 
						$school_list = mysql_query("SELECT * FROM `school` ORDER BY school_id ") or die(mysql_error());
						//query to get record
						while($schoolrow = mysql_fetch_array( $school_list )) 
						{ 
							echo "<option value='".$schoolrow['school_id']."'";
							if(isset($_POST['submit'])&&($schoolrow['school_id']==$school)){echo 'selected';}
							//delete line code 1210 upon testing over
							if(isset($_POST['test'])&&$schoolrow['school_id']==$school){echo 'selected';}
							echo ">".$schoolrow['school_name']."</option>\n";
						}
						?>
					</select>
					<font color="#FF0000"><?php echo $errschool; ?></font>
					<h4>In order for your School and potential advisors to identify whether it is possible to provide appropriate resources for you at the time you wish to undertake your higher degree research we require details of your proposed commencement:<br/><br/>
					Commencing: </h4>
					&emsp;&emsp; Month:
					<select name="month" id="month" >
						<option value="" selected="selected">-- Please Select --</option>
						<?php 
						for($i=1; $i<=12; $i++)
						{
							$month = date("M", mktime(0, 0, 0, $i, 10));
							echo "<option value='";
							echo $i."'";
							if (isset($_POST['submit']) && $_POST['month'] == $i) echo "selected";
							//delete line code 1229 upon testing over
							if(isset($_POST['test'])&&$_POST['month']==$i){echo 'selected';}
							echo">".$month."</option>";	
						}
						?>
					</select>
					Year: 
					<select name="year" id="year">
						<option value="" selected="selected">-- Please Select --</option>
						<?php 
						$year = date('Y');
						for($i=0; $i<5; $i++)
						{
							echo "<option ";
							if (isset($_POST['submit']) && $_POST['year'] == $year) echo "selected";
							//delete line code 1244 upon testing over
							if(isset($_POST['test'])&&$_POST['year']==$year){echo 'selected';}
							echo">".$year."</option>";
							$year++;
						}
						?>
					</select>
					<label> <font color="#FF0000"><?php echo $errdate; ?></font>&emsp;
					<br /><br />
					&emsp;&emsp;
					<input type="radio" name="PFtime" id="PFtime" value="FT" <?php echo $FTchecked;?> />
					Full-time Candidate</label>
					<label>
					<input type="radio" name="PFtime" id="PFtime2" value="PT" <?php echo $PTchecked;?> />
					Part-time Candidate</label>
					<font color="#FF0000"><?php echo $errPFtime;?></font><br /><br />
					<em>**Please note that Part-time candidature may not be possible in all research fields, or for international candidates studying on a student visa.</em>
					<h2><strong>4. Research Interests</strong></h2>
					<h3>Murdoch University's higher degree in research can be completed in any field or research where sufficient expertise and resource are available to carry out such research. </h3>
					<h4>Field of Research: <font color="#FF0000"><?php echo $errFOR; ?></font></h4>
					1.
					<select name="FOR1"id="FOR">
						<option selected="selected" value="">-- Please Select --</option>
						<?php 	
						$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
						//query to get record
						while($row = mysql_fetch_array( $query )) 
						{ 
							$results[] = $row;
							echo "<option value='".$row['code']."'";
							if(isset($_POST['submit'])&&($row['code']==$FOR1)){echo 'selected';}
							//delete line code 1272 upon testing over
							if(isset($_POST['test'])&&$row['code']==$FOR1){echo 'selected';}
							echo ">".$row['description']."</option>\n";
						}
						?>
					</select>
					<br />
					2.
					<select name="FOR2"id="FOR2">
						<option selected="selected" value="">-- Please Select --</option>
						<?php 
						$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
						//query to get record
						while($row = mysql_fetch_array( $query )) 
						{ 
							echo "<option value='".$row['code']."'";
							if(isset($_POST['submit'])&&($row['code']==$FOR2)){echo 'selected';}
							echo ">".$row['description']."</option>\n";
						}
						?>
					</select>
					<br />3.
					<select name="FOR3"id="FOR3">
						<option selected="selected" value="">-- Please Select --</option>
						<?php 
						$query = mysql_query("SELECT * FROM field_of_research ") or die(mysql_error());
						//query to get record
						while($row = mysql_fetch_array( $query )) 
						{ 
							echo "<option value='".$row['code']."'";
							if(isset($_POST['submit'])&&($row['code']==$FOR3)){echo 'selected';}
							echo ">".$row['description']."</option>\n";
						}
						?>
					</select>
				<h4>Research Keywords: <font color="#FF0000"><?php echo $errresearchinterest;?></font></h4>
				1.
				<input name='researchinterest1' type='text' title="Example: Mobile Security" value="<?php if(isset($researchinterest1)) echo $researchinterest1;?>" size="35" />
				2.
				<input name='researchinterest2' type='text'  title="Example: Mobile Security" value="<?php if(isset($researchinterest2)) echo $researchinterest2;?>" size="35" />
				3.
				<input name='researchinterest3' type='text' title="Example: Mobile Security" value="<?php if(isset($researchinterest3)) echo $researchinterest3;?>" size="35" />
				&nbsp;<br />
				4.
				<input name='researchinterest4' type='text' title="Example: Mobile Security" value="<?php if(isset($researchinterest4)) echo $researchinterest4;?>" size="35" />
				5.
				<input name='researchinterest5' type='text' title="Example: Mobile Security" value="<?php if(isset($researchinterest5)) echo $researchinterest5;?>" size="35" />
				<h3>Please identify any Murdoch University academics with whom you wish to discuss your research interest with. <font color="#FF0000"><strong><?php echo $errsup; ?></strong></font></h3>
				<br/>
            
			<table width="100%" border="1" cellpadding="3" cellspacing="2">
				<col width="15%">
				<col width="25%">
				<col width="45%">
				<col width="25%">
				<tr>
					<td><div align="center"><strong>Title</strong></div></td>
					<td><div align="center"><strong>Name</strong></div></td>
					<td><div align="center"><strong>School</strong></div></td>
					<td><div align="center"><strong>Email Address</strong></div></td>
				</tr>
				<tr>
					<td><select name="suptitle1">
						<option selected="selected" value="">-- Please Select --</option>
						<option value="Mr" <?php echo $sup1mr; ?> >Mr</option>
						<option value="Ms" <?php echo $sup1ms; ?> >Ms</option>
						<option value="Mrs" <?php echo $sup1mrs; ?>>Mrs</option>
						<option value="Mdm" <?php echo $sup1mdm; ?>>Mdm</option>
						<option value="Dr" <?php echo $sup1dr; ?>>Dr</option>
						<option value="Prof" <?php echo $sup1prof; ?>>Prof</option>
					</select></td>
					<td><input name='supname1' type='text' value="<?php if(isset($supname1)) echo $supname1;?>" style="width:99%;" /></td>
					<td><select name="supschool1" id="supschool1">
						<option selected="selected" value="">-- Please Select --</option>
						<?php 
						$school_list = mysql_query("SELECT * FROM `school` ORDER BY school_id ") or die(mysql_error());
						//query to get record
						while($schoolrow = mysql_fetch_array( $school_list )) 
						{ 
							echo "<option value='".$schoolrow['school_id']."'";
							if(isset($_POST['submit'])&&($schoolrow['school_id']==$supschool1)){echo 'selected';}
							echo ">".$schoolrow['school_name']."</option>\n";
						}
						?>
					</select></td>
					<td><input name="supemail1" style="width:99%;" type="text" id="emailtext" value="<?php if(isset($_POST['supemail1'])) echo $_POST['supemail1'];?>"/></td>
				</tr>
				<tr>
					<td><select name="suptitle2">
						<option selected="selected" value="">-- Please Select --</option>
						<option value="Mr" <?php echo $sup2mr; ?> >Mr</option>
						<option value="Ms" <?php echo $sup2ms; ?> >Ms</option>
						<option value="Mrs" <?php echo $sup2mrs; ?>>Mrs</option>
						<option value="Mdm" <?php echo $sup2mdm; ?>>Mdm</option>
						<option value="Dr" <?php echo $sup2dr; ?>>Dr</option>
						<option value="Prof" <?php echo $sup2prof; ?>>Prof</option>
					</select></td>
					<td><input name='supname2' type='text' value="<?php if(isset($supname2)) echo $supname2;?>" style="width:99%;"/></td>
					<td><select name="supschool2" id="supschool2">
						<option selected="selected" value="">-- Please Select --</option>
						<?php 
						$school_list = mysql_query("SELECT * FROM `school` ORDER BY school_id ") or die(mysql_error());
						//query to get record
						while($schoolrow = mysql_fetch_array( $school_list )) 
						{ 
							echo "<option value='".$schoolrow['school_id']."'";
							if(isset($_POST['submit'])&&($schoolrow['school_id']==$supschool2)){echo 'selected';}
							echo ">".$schoolrow['school_name']."</option>\n";
						}
						?>
					</select></td>
					<td><input name="supemail2" style="width:99%;" type="text" id="emailtext2" value="<?php if(isset($_POST['supemail2'])) echo $_POST['supemail2'];?>"/></td>
				</tr>
            </table>
            <br>
		<h2><strong>5. Academic Qualifications and Research Training Experience</strong></h2>
		<h3>Selection for admission to higher degree research programs  at Murdoch University requires that applicants to have sufficient previous research  training experience to satisfy the basis of admission. </h3>
		<h4>Please list all qualifications attained for all previous  tertiary studies <small>(at least one)</small>.<font color="#FF0000"><?php echo $errdegree."<br>";?></font><br> </h4>
            <table border="1" cellpadding="3" cellspacing="2"><tr align="center" valign="top">
              <tr align="center" valign="top">
                <th width="30%">Degree</th>
                <th width="10%">Duration <br />
                  (No of years)</th>
                <th width="10%">Year<br />Awarded</th>
                <th width="10%">GPA <br />
                  (Max 7.00)</th>
                <th width="10%">% of degree completed by research</th>
                <th width="30%">Institution</th>
				</tr>
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
					<select name="duration1" id="duration" style="width:99%;">
						<option value="" selected="selected">- Select -</option>
						<?php 
						for($i=2; $i<=10; $i++)
						{
							echo "<option ";
							if (isset($_POST['submit']) && $_POST['duration1'] == $i) echo "selected";
							//delete line code 1272 upon testing over
							if(isset($_POST['test'])&&$_POST['duration1']==$i){echo 'selected';}
							echo">".$i."</option>";
						}
						?>
					</select></td>
					<td><select name="yearaward1" id="yearaward" style="width:99%;">
						<option value="" selected="selected">- Select -</option>
						<?php 
						$year = date('Y');
						for($i=40; $i>=1; $i--)
						{
							echo "<option ";
							if (isset($_POST['submit']) && $_POST['yearaward1'] == $year) echo "selected";
							//delete line code 1272 upon testing over
							if(isset($_POST['test'])&&$_POST['yearaward1']==$year){echo 'selected';}
							echo">".$year."</option>";
							$year--;
						}
						?>
					</select></td>
					<td><input name="GPA1" type="text" id="textfield" title="Example: 5.59" value="<?php if(isset($GPA1)) echo $GPA1;?>" style="width:96%;" maxlength="4" /></td>
					<td><input name="completion1" type="text" id="textfield9"  style="width:96%;" title="Example: 80" value="<?php if(isset($completion1)) echo $completion1;?>" size="20" maxlength="3" /></td>
					<td><input name="institute1" type="text" id="textfield12" value="<?php if(isset($institute1)) echo $institute1;?>" style="width:99%;" /></td>
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
					<td><select name="duration2" id="duration2" style="width:99%;">
						<option value="" selected="selected">- Select -</option>
						<?php 
						for($i=2; $i<=10; $i++)
						{
						echo "<option ";
						if (isset($_POST['submit']) && $_POST['duration2'] == $i) echo "selected";
						echo">".$i."</option>";
						}
						?>
					</select></td>
					<td><select name="yearaward2" id="yearaward2" style="width:99%;">
						<option value="" selected="selected">- Select -</option>
						<?php 
						$year = date('Y');
						for($i=40; $i>=1; $i--)
						{
						echo "<option ";
						if (isset($_POST['submit']) && $_POST['yearaward2'] == $year) echo "selected";
						echo">".$year."</option>";
						$year--;
						}
						?>
					</select></td>
					<td><input name="GPA2" type="text" id="textfield"  title="Example: 5.59" style="width:96%;"  value="<?php if(isset($GPA2)) echo $GPA2;?>" size="8" maxlength="4" /></td>
					<td><input name="completion2" title="Example: 80" type="text" id="textfield10"  style="width:96%;" value="<?php if(isset($completion2)) echo $completion2;?>" size="20" maxlength="3" /></td>
					<td><input name="institute2" type="text" id="textfield13" value="<?php if(isset($institute2)) echo $institute2;?>" style="width:99%;"/></td>
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
					<td><select name="duration3" id="duration3" style="width:99%;">
					<option value="" selected="selected">- Select -</option>
						<?php 
						for($i=2; $i<=10; $i++)
						{
							echo "<option ";
							if (isset($_POST['submit']) && $_POST['duration3'] == $i) echo "selected";
							echo">".$i."</option>";
						}
						?>
                </select></td>
					<td><select name="yearaward3" id="yearaward3" style="width:99%;">
						<option value="" selected="selected">- Select -</option>
						<?php 
						$year = date('Y');
						for($i=40; $i>=1; $i--)
						{
						echo "<option ";
						if (isset($_POST['submit']) && $_POST['yearaward3'] == $year) echo "selected";
						echo">".$year."</option>";
						$year--;
						}
						?>
					</select></td>
						<td><input name="GPA3" type="text" id="textfield"  title="Example: 5.59" style="width:96%;"  value="<?php if(isset($GPA3)) echo $GPA3;?>" size="8" maxlength="4" /></td>
						<td><input name="completion3" title="Example: 80" type="text" id="textfield11"  style="width:96%;" value="<?php if(isset($completion3)) echo $completion3;?>" size="20" maxlength="3" /></td>
						<td><input name="institute3" type="text" id="textfield14"  value="<?php if(isset($institute3)) echo $institute3;?>" style="width:99%;" /></td>
					</tr>
				</table>
			<h4>List <u>all</u> previously relevant research experience/employment. <font color="#FF0000"><?php echo $errposition; ?></font></h4>
				<table width="100%" border="1">
					<tr align="center" valign="top">
						<th width="45%">Position</th>
						<th width="45%">Employer/Institution</th>
						<th width="10%">Year Appointed</th>
					</tr>
					<tr>
						<td><input name="position1" type="text" id="text" value="<?php if(isset($position1)) echo $position1;?>" size="52"  style="width:99%;"/></td>
						<td><input name="empinst1" type="text" id="text2" value="<?php if(isset($empinst1)&&$empinst1!="") echo $empinst1;?>" style="width:99%;"/></td>
						<td><select name="yearappoint1" id="yearappoint" style="width:auto">
						  <option value="" selected="selected">--Please Select--</option>
						  <?php 
								$year = date('Y');
								for($i=40; $i>=1; $i--)
								{
								echo "<option ";
								if (isset($_POST['submit']) && $_POST['yearappoint1'] == $year) echo "selected";
								echo">".$year."</option>";
								$year--;
								}
								?>
						</select></td>
					</tr>
					<tr>
					<td><input name="position2" type="text" id="text4" value="<?php if(isset($position2)) echo $position2;?>" size="52"  style="width:99%;"/></td>
					<td><input name="empinst2" type="text" id="text5"value="<?php if(isset($empinst2)&&$empinst2!="") echo $empinst2;?>"  style="width:99%;" /></td>
					<td>
					<select name="yearappoint2" id="yearappoint3" style="width:auto">
						<option value="" selected="selected">--Please Select--</option>
						<?php 
						$year = date('Y');
						for($i=40; $i>=1; $i--)
						{
						echo "<option ";
						if (isset($_POST['submit']) && $_POST['yearappoint2'] == $year) echo "selected";
						echo">".$year."</option>";
						$year--;
						}
						?>
					</select></td>
					</tr>
					<tr>
						<td><input name="position3" type="text" id="text3" value="<?php if(isset($position3)) echo $position3;?>" size="52"  style="width:99%;"/></td>
						<td><input name="empinst3" type="text" id="text6"value="<?php if(isset($empinst3)&&$empinst3!="") echo $empinst3;?>" style="width:99%;" /></td>
						<td><select name="yearappoint3" id="yearappoint2" style="width:auto">
							<option value="" selected="selected">--Please Select--</option>
							<?php 
							
							
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
							echo "<option ";
							if (isset($_POST['submit']) && $_POST['yearappoint3'] == $year) echo "selected";
							echo">".$year."</option>";
							$year--;
							}
							?>
						</select></td>
					</tr>
				</table>
					<h4>List your 5 most recent (or <u>all</u>) publications.<font color="#FF0000"><?php echo $errpubyear; ?></font></h4>
				<table width="100%" border="1">
					<tr align="center" valign="top">
						<th width="10%">Year</th>
						<th width="45%">Title</th>
						<th width="45%">Publication ref</th>
					</tr>
					<tr>
						<td><select name="pubyear1" id="pubyear">
							<option value="" selected="selected">-- Please Select --</option>
							<?php 
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
							echo "<option ";
							if (isset($_POST['submit']) && $_POST['pubyear1'] == $year) echo "selected";
							echo">".$year."</option>";
							$year--;
							}
							?>
						</select>
						</td>
						<td><input name="pubtitle1" type="text" id="text7" value="<?php if(isset($pubtitle1)) echo $pubtitle1;?>" style="width:99%;" /></td>
						<td><input name="pubref1" type="text" id="text12" value="<?php if(isset($pubref1)) echo $pubref1;?>" style="width:99%;" /></td>
					</tr>
					<tr>
						<td>
						<select name="pubyear2" id="pubyear2">
							<option value="" selected="selected">-- Please Select --</option>
							<?php 
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
								echo "<option ";
								if (isset($_POST['submit']) && $_POST['pubyear2'] == $year) echo "selected";
								echo">".$year."</option>";
								$year--;
							}
							?>
						</select>
						</td>
						<td><input name="pubtitle2" type="text" id="text8" value ="<?php if(isset($pubtitle2)) echo $pubtitle2;?>" style="width:99%;"/></td>
						<td><input name="pubref2" type="text" id="text13" value="<?php if(isset($pubref2)) echo $pubref2;?>" style="width:99%;"/></td>
					</tr>
					<tr>
						<td><select name="pubyear3" id="pubyear3">
						<option value="" selected="selected">-- Please Select --</option>
						<?php 
						$year = date('Y');
						for($i=40; $i>=1; $i--)
						{
						echo "<option ";
						if (isset($_POST['submit']) && $_POST['pubyear3'] == $year) echo "selected";
						echo">".$year."</option>";
						$year--;
						}
						?>
						</select></td>
						<td><input name="pubtitle3" type="text" id="text9" value="<?php if(isset($pubtitle3)) echo $pubtitle3;?>" style="width:99%;"/></td>
						<td><input name="pubref3" type="text" id="text14" value="<?php if(isset($pubref3)) echo $pubref3;?>" style="width:99%;"/></td>
					</tr>
					<tr>
					<td><select name="pubyear4" id="pubyear4">
						<option value="" selected="selected">-- Please Select --</option>
						<?php 
						$year = date('Y');
						for($i=40; $i>=1; $i--)
						{
							echo "<option ";
							if (isset($_POST['submit']) && $_POST['pubyear4'] == $year) echo "selected";
							echo">".$year."</option>";
							$year--;
						}
						?>
					</select></td>
					<td><input name="pubtitle4" type="text" id="text10" value="<?php if(isset($pubtitle4)) echo $pubtitle4;?>" style="width:99%;"/></td>
					<td><input name="pubref4" type="text" id="text15" value="<?php if(isset($pubref4)) echo $pubref4;?>" style="width:99%;"/></td>
					</tr>
					<tr>
						<td>
						<select name="pubyear5" id="pubyear5">
							<option value="" selected="selected">-- Please Select --</option>
							<?php 
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
								echo "<option ";
								if (isset($_POST['submit']) && $_POST['pubyear5'] == $year) echo "selected";
								echo">".$year."</option>";
								$year--;
							}
							?>
						</select>
						</td>
						<td><input name="pubtitle5" type="text" id="text11" value="<?php if(isset($pubtitle5)) echo $pubtitle5;?>" style="width:99%;"/></td>
						<td><input name="pubref5" type="text" id="text16" value="<?php if(isset($pubref5)) echo $pubref5;?>" style="width:99%;" /></td>
					</tr>
				</table>
					<h4>List any professional qualifications and memberships, awards and prizes, or additional relevant information.<font color="#FF0000"><?php echo $errqualyear; ?></font></h4>
				<table width="100%" border="1">
					<tr align="center" valign="top">
						<th width="10%">Year</th>
						<th width="45%">Qualification/Membership/Award/Prize</th>
						<th width="45%">Name and Location of Institution</th>
					</tr>
					<tr>
						<td>
							<select name="qualyear1" id="qualyear">
							<option value="" selected="selected">-- Please Select --</option>
							<?php 
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
								echo "<option ";
								if (isset($_POST['submit']) && $_POST['qualyear1'] == $year) echo "selected";
								echo">".$year."</option>";
								$year--;
							}
							?>
							</select>
						</td>
						<td><input name="qualname1"  type="text" id="text17" value="<?php if(isset($qualname1)) echo $qualname1;?>" style="width:99%;"/></td>
						<td><input name="institutename1"  type="text" id="text21" value="<?php if(isset($institutename1)) echo $institutename1;?>" style="width:99%;"/></td>
					</tr>
					<tr>
						<td>
						<select name="qualyear2" id="qualyear2">
							<option value="" selected="selected">-- Please Select --</option>
							<?php 
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
								echo "<option ";
								if (isset($_POST['submit']) && $_POST['qualyear2'] == $year) echo "selected";
								echo">".$year."</option>";
								$year--;
							}
							?>
						</select>
						</td>
						<td>
						<input name="qualname2" type="text" id="text18"value="<?php if(isset($qualname2)) echo $qualname2;?>" style="width:99%;"/>
						</td>
						<td>
						<input name="institutename2"  type="text" id="text22" value="<?php if(isset($institutename2)) echo $institutename2;?>" style="width:99%;"/>
						</td>
					</tr>
					<tr>
						<td>	
						<select name="qualyear3" id="qualyear3">
							<option value="" selected="selected">
							-- Please Select --</option>
							<?php 
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
								echo "<option ";
								if (isset($_POST['submit']) && $_POST['qualyear3'] == $year) echo "selected";
								echo">".$year."</option>";
								$year--;
							}
							?>
							</select>
						</td>
						<td>
						<input name="qualname3" type="text" id="text19" value="<?php if(isset($qualname3)) echo $qualname3;?>"style="width:99%;"/>
						</td>
						<td>
						<input name="institutename3"  type="text" id="text23" value="<?php if(isset($institutename3)) echo $institutename3;?>" style="width:99%;"/>
						</td>
					</tr>
					<tr>
						<td>
						<select name="qualyear4" id="qualyear4">
							<option value="" selected="selected">-- Please Select --</option>
							<?php 
							$year = date('Y');
							for($i=40; $i>=1; $i--)
							{
								echo "<option ";
								if (isset($_POST['submit']) && $_POST['qualyear4'] == $year) echo "selected";
								echo">".$year."</option>";
								$year--;
							}
							?>
						</select>
						</td>
						<td>
						<input name="qualname4" type="text" id="text20" value="<?php if(isset($qualname4)) echo $qualname4;?>" style="width:99%;"/>
						</td>
						<td>
						<input name="institutename4"  type="text" id="text24" value="<?php if(isset($institutename4)) echo $institutename4;?>" style="width:99%;" />
						</td>
					</tr>
				</table>
				<h2><strong>6. English Language Proficiency</strong></h2>
				<strong>All higher degree research applications are required to achieve an appropriate level of proficiency in academic English before they can commence their higher degree research program.</strong> <font color="#FF0000"><?php echo $erreng; ?></font><br /><br />			
				&emsp; <label><input type="radio" name="eng" value="main" onclick="addSubject(this)" <?php echo $mainchecked;?>/>
				English is my first language </label> <br />
				&emsp;
				<label><input type="radio" name="eng" value="pending"  onclick="addSubject(this)" <?php echo $pendingchecked;?>/>
				I intend to sit an IELTS or TOEFL test at a later date </label><br />
				&emsp;
				<label><input type="radio" name="eng" value="completed" id="completed" onclick="addSubject(this)" <?php echo $completedchecked;?>/>
				I Have Completed an IELTS or TOEFL test within the past two years to the required standard </label><br />
				&emsp;
				<label><input name="eng" id="other" type="radio" value="other"  onclick="addSubject(this)" <?php echo $otherchecked; ?> />
				Other English Course </label>  
				<br /> <br />           
					<div id="options">
						<div class="box" id="completed" <?php if(!isset($_POST['submit']) || !isset($_POST['eng']) ||(isset($_POST['submit']) && $_POST['eng']!="completed")) {echo " style='display: none;'";}?>>
							<div>
							 <strong>&emsp;Please specify below: </strong><font color="#FF0000"><?php echo $errtestscore; ?></font>
							<table>
								<tr>
									<td>&emsp;&emsp;Test Type : 
									<label><input type="radio" name="testtype" id="testtype1" value="IELTS" title="International English Language Testing System (Score range: 0 - 9)" <?php echo $ieltscheck ?> />
									IELTS </label>
									<label><input type="radio" name="testtype" id="testtype2" value="TOEFL_Paper" title="Test of English as a Foreign Language (Score range: 310 - 677)" <?php echo $toeflpprcheck ?> />
									TOEFL (Paper) </label>
									<label><input type="radio" name="testtype" id="testtype3" value="TOEFL_IE" title="Test of English as a Foreign Language (Score range: 0 - 120)" <?php echo $toeflwwwcheck ?> />
									TOEFL (Internet) </label>
									</td>
								</tr>
								<tr>
									<td>&emsp;&emsp;Test Score : 
									<input name="testscore" type="text" id="testscore" value="<?php if(isset($_POST['testtype'])) echo $testscore; ?>" size="4" maxlength="3"/>
									Test Date :
									<input type="text" id="testdate" name="testdate" value="<?php if(isset($testdate))echo $testdate ?>" />
									</td>
								</tr>
							</table>
							</div>
						</div>
						<div class="box" id="other" <?php if(!isset($_POST['submit']) || !isset($_POST['eng']) ||(isset($_POST['submit']) && $_POST['eng']!="other")) {echo "style='display: none;'";}?>>
							<div>
								<table>
								<tr>
								<th><div align="left"><span>&emsp;<strong>Please specify below:</strong> <font color="#FF0000"><?php echo $errresult; ?></font></span></div></th>
								</tr>
								<tr>
								<td colspan="2"><span> &emsp;&emsp;Course Name
								<input name="engcourse" type="text" title="Example: English Language Proficiency Test" value="<?php if(isset($_POST['engcourse'])) echo $_POST['engcourse'];?>"/>
								Result:
								<input name="result" type="text" value="<?php if(isset($_POST['result'])) echo $_POST['result'];?>" size="4" maxlength="3" />
								</span></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<TABLE BORDER="0" >
					<TR >
					<TD style="padding:5px 40px;"><font style="font-family:Arial, Helvetica, sans-serif">
						<input type="button" name="cancel"class="btn1"value="Cancel" onClick="location.href='logout.php'" />
						</font>
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
			<td>&nbsp;
			
			</td>
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
