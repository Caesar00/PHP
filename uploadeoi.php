<?php 
include 'connection.php';
session_start();

if(($_SESSION['lastname']=="")||!isset($_SESSION['scholarqn1'])||!isset($_SESSION['eng'])){
header("Location: EOI_Page1.php");}//force to go to previous page if mandatory field is not set first

$suptitlename1="";
$suptitlename2="";
date_default_timezone_set('Asia/Singapore'); // set to singapore time

$lastname=$_SESSION['lastname'];//used to prevent people from 
$firstname=$_SESSION['firstname'];//directly accessing into these URL
$_SESSION['fullname'] = $firstname." ".$lastname; 

if(isset($_SESSION['country']) && $_SESSION['country'] =="Domestic")
{
	$_SESSION['citizenship']=$_SESSION['country'];
}
if(isset($_SESSION['suptitle1']) && $_SESSION['suptitle1'] !="")
{
	$suptitlename1 =$_SESSION['suptitle1']." ".$_SESSION['supname1'];
}

if(isset($_SESSION['suptitle2']) && $_SESSION['suptitle2'] !="")
{
	$suptitlename2 =$_SESSION['suptitle2']." ".$_SESSION['supname2'];
}
if(isset($_SESSION['testdate'])&&$_SESSION['testdate']!="")
{
	$datecreate = date_create($_SESSION['testdate']);
	$testdate= date_format($datecreate,"Y-m-d");
}

if($_SESSION['lastname']!="")
{
$register ="INSERT into eoi VALUES
('',
'".mysql_real_escape_string($_SESSION['title'])."',
'".mysql_real_escape_string($firstname)."',
'".mysql_real_escape_string($lastname)."',
'".mysql_real_escape_string($_SESSION['citizenship'])."',
'".mysql_real_escape_string($_SESSION['murdoch_sid'])."',
'".mysql_real_escape_string($_SESSION['emailadd'])."',
'".mysql_real_escape_string($_SESSION['tel'])."',
'".mysql_real_escape_string($_SESSION['program'])."',
'".mysql_real_escape_string($_SESSION['school'])."',
'".mysql_real_escape_string($_SESSION['year'])."',
'".mysql_real_escape_string($_SESSION['month'])."',
'".mysql_real_escape_string($_SESSION['PFtime'])."',
'".mysql_real_escape_string($_SESSION['researchinterest1'])."',
'".mysql_real_escape_string($_SESSION['researchinterest2'])."',
'".mysql_real_escape_string($_SESSION['researchinterest3'])."',
'".mysql_real_escape_string($_SESSION['researchinterest4'])."',
'".mysql_real_escape_string($_SESSION['researchinterest5'])."',
'".mysql_real_escape_string($suptitlename1)."',
'".mysql_real_escape_string($_SESSION['supschool1'])."',
'".mysql_real_escape_string($_SESSION['supemail1'])."',
'".mysql_real_escape_string($suptitlename2)."',
'".mysql_real_escape_string($_SESSION['supschool2'])."',
'".mysql_real_escape_string($_SESSION['supemail2'])."',
'".mysql_real_escape_string($_SESSION['degree1'])."',
'".mysql_real_escape_string($_SESSION['duration1'])."',
'".mysql_real_escape_string($_SESSION['yearaward1'])."',
'".mysql_real_escape_string($_SESSION['GPA1'])."',
'".mysql_real_escape_string($_SESSION['completion1'])."',
'".mysql_real_escape_string($_SESSION['institute1'])."',
'".mysql_real_escape_string($_SESSION['degree2'])."',
'".mysql_real_escape_string($_SESSION['duration2'])."',
'".mysql_real_escape_string($_SESSION['yearaward2'])."',
'".mysql_real_escape_string($_SESSION['GPA2'])."',
'".mysql_real_escape_string($_SESSION['completion2'])."',
'".mysql_real_escape_string($_SESSION['institute2'])."',
'".mysql_real_escape_string($_SESSION['degree3'])."',
'".mysql_real_escape_string($_SESSION['duration3'])."',
'".mysql_real_escape_string($_SESSION['yearaward3'])."',
'".mysql_real_escape_string($_SESSION['GPA3'])."',
'".mysql_real_escape_string($_SESSION['completion3'])."',
'".mysql_real_escape_string($_SESSION['institute3'])."',
'NULL',
'".mysql_real_escape_string($_SESSION['position1'])."',
'".mysql_real_escape_string($_SESSION['empinst1'])."',
'".mysql_real_escape_string($_SESSION['yearappoint1'])."',
'".mysql_real_escape_string($_SESSION['position2'])."',
'".mysql_real_escape_string($_SESSION['empinst2'])."',
'".mysql_real_escape_string($_SESSION['yearappoint2'])."',
'".mysql_real_escape_string($_SESSION['position3'])."',
'".mysql_real_escape_string($_SESSION['empinst3'])."',
'".mysql_real_escape_string($_SESSION['yearappoint3'])."',
'".mysql_real_escape_string($_SESSION['pubyear1'])."',
'".mysql_real_escape_string($_SESSION['pubtitle1'])."',
'".mysql_real_escape_string($_SESSION['pubref1'])."',
'".mysql_real_escape_string($_SESSION['pubyear2'])."',
'".mysql_real_escape_string($_SESSION['pubtitle2'])."',
'".mysql_real_escape_string($_SESSION['pubref2'])."',
'".mysql_real_escape_string($_SESSION['pubyear3'])."',
'".mysql_real_escape_string($_SESSION['pubtitle3'])."',
'".mysql_real_escape_string($_SESSION['pubref3'])."',
'".mysql_real_escape_string($_SESSION['pubyear4'])."',
'".mysql_real_escape_string($_SESSION['pubtitle4'])."',
'".mysql_real_escape_string($_SESSION['pubref4'])."',
'".mysql_real_escape_string($_SESSION['pubyear5'])."',
'".mysql_real_escape_string($_SESSION['pubtitle5'])."',
'".mysql_real_escape_string($_SESSION['pubref5'])."',
'".mysql_real_escape_string($_SESSION['qualyear1'])."',
'".mysql_real_escape_string($_SESSION['qualname1'])."',
'".mysql_real_escape_string($_SESSION['institutename1'])."',
'".mysql_real_escape_string($_SESSION['qualyear2'])."',
'".mysql_real_escape_string($_SESSION['qualname2'])."',
'".mysql_real_escape_string($_SESSION['institutename2'])."',
'".mysql_real_escape_string($_SESSION['qualyear3'])."',
'".mysql_real_escape_string($_SESSION['qualname3'])."',
'".mysql_real_escape_string($_SESSION['institutename3'])."',
'".mysql_real_escape_string($_SESSION['qualyear4'])."',
'".mysql_real_escape_string($_SESSION['qualname4'])."',
'".mysql_real_escape_string($_SESSION['institutename4'])."',
'".mysql_real_escape_string($_SESSION['eng'])."',
'".mysql_real_escape_string($_SESSION['engcourse'])."',
'".mysql_real_escape_string($_SESSION['result'])."',
'".mysql_real_escape_string($_SESSION['testtype'])."',
'".mysql_real_escape_string($_SESSION['testscore'])."',
'".mysql_real_escape_string($testdate)."',
'".mysql_real_escape_string($_SESSION['scholarqn1'])."',
'".mysql_real_escape_string($_SESSION['scholarqn2'])."',
'".mysql_real_escape_string($_SESSION['scholarqn3'])."',
'".mysql_real_escape_string($_SESSION['scholarname1'])."',
'".mysql_real_escape_string($_SESSION['sponsor1'])."',
'".mysql_real_escape_string($_SESSION['vpa1'])."',
'".mysql_real_escape_string($_SESSION['scholarduration1'])."',
'".mysql_real_escape_string($_SESSION['purpose1'])."',
'".mysql_real_escape_string($_SESSION['status1'])."',
'".mysql_real_escape_string($_SESSION['scholarname2'])."',
'".mysql_real_escape_string($_SESSION['sponsor2'])."',
'".mysql_real_escape_string($_SESSION['vpa2'])."',
'".mysql_real_escape_string($_SESSION['scholarduration2'])."',
'".mysql_real_escape_string($_SESSION['purpose2'])."',
'".mysql_real_escape_string($_SESSION['status2'])."',
'".mysql_real_escape_string($_SESSION['whyresearch'])."',
now(),
''
)";
$register_res = mysql_query($register) or die (mysql_error());



//extract the auto incremented eoi ID
$eoiid = mysql_insert_id();
$_SESSION['eoi_id']=$eoiid;

if(isset($_SESSION['FOR1'])&&$_SESSION['FOR1']!="")
{
	$for1 ="INSERT into select_for1 VALUES
	('$eoiid','$_SESSION[FOR1]')";
	$uploadfor1 = mysql_query($for1) or die (mysql_error());
}
if(isset($_SESSION['FOR2'])&&$_SESSION['FOR2']!="")
{
	$for2 ="INSERT into select_for1 VALUES
	('$eoiid','$_SESSION[FOR2]')";
	$uploadfor2 = mysql_query($for2) or die (mysql_error());
}
if(isset($_SESSION['FOR3'])&&$_SESSION['FOR3']!="")
{
	$for3 ="INSERT into select_for1 VALUES
	('$eoiid','$_SESSION[FOR3]')";
	$uploadfor3 = mysql_query($for3) or die (mysql_error());
}
}
$_SESSION['lastname']="";
include 'submitapp.php';
?>






