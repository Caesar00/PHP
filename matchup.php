<?php
session_start();
include 'connection.php';
/* this shows the error message when the page goes white
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if ($_SESSION['is_admin'])
{
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
}
ini_set('html_errors', 'On');*/

//match for
// - FOR
// - school
// - reasearch keyword
$eoiid="";
$supid = "";
$accept ="";
$eoifor1 ="";
$eoifor2 ="";
$eoifor3 ="";

if(!isset($_SESSION['eoiid']))
{
	header("Location: GRO_ListOfEOI.php");
}

if(isset($_SESSION['eoiid'])){
//select the EOI form ID first
$eoiid = $_SESSION['eoiid'];}

//select FORs from the EOI selected
$eoi_for = "SELECT Rf_No FROM eoi_rsh_interested WHERE eoi_no= '$eoiid'";
$get_eoi_for = mysqli_query($con,$eoi_for) or die (mysqli_error($con));

$i=1;
while ($eoi_forlist = mysqli_fetch_array($get_eoi_for)) 
{
	$eoifor[$i++] = $eoi_forlist['Rf_No'];
}
//checks if there is any NULL FORs
if(isset($eoifor[1]))
{$eoifor1 = $eoifor[1];}
if(isset($eoifor[2]))
{$eoifor2 = $eoifor[2];}
if(isset($eoifor[3]))
{$eoifor3 = $eoifor[3];}
/*				end of EOI				*/


$eoi_research = "select keyword from eoi_rsh_keyword where eoi_no = '$eoiid'";
//select research keywords from the EOI selected
$get_eoi_research = mysqli_query($con,$eoi_research) or die (mysqli_error($con));
$eoi_rsh_count = 1;
while ($eoi_list = mysqli_fetch_array($get_eoi_research)) 
{
	
	//match for research interest
	$eoi_rsh_keywords[$eoi_rsh_count++]=$eoi_list['keyword'];
	
}

$academic_res = mysqli_query($con,"SELECT name, Sc_No, email 
    FROM eoi_academic WHERE eoi_no='$eoi_id'") or die(mysqli_error($con));
$academic_count = 1;
while($academic_row= mysqli_fetch_array($academic_res))
{
	$academic_names[$academic_count]=$academic_row['name'];
        $acadmic_schools[$academic_count]=$academic_row['Sc_No'];
        $academic_emails[$academic_count++]=$academic_row['email'];
}

/*
$refname1 = $eoi_list['title_name1'];
	$refsch1 = $eoi_list['school1'];
	$refemail1 = $eoi_list['email1'];
	$refname2 = $eoi_list['title_name2'];
	$refsch2 = $eoi_list['school2'];
	$refemail2 = $eoi_list['email2'];*/

// create supervisor(s) where clause(s)
if(isset($academic_names))
{
    foreach ($academic_names as $academic_key => $academic_name)
    {
        $super_where .= "(CONCAT(salutation, ' ',firstname, ' ', surname)='$academic_name'
                AND sup.Sc_No='$acadmic_schools[$academic_key]' AND staff_account.email='$academic_emails[$academic_key]') OR ";
    }
}
else
{
    $super_where="";
}

//match for school (from eoi)
$eoi_school_res = mysqli_query($con,"SELECT Sc_No FROM eoi WHERE eoi_no='$eoiid'") or die(mysqli_error($con));
while($eoi_row = mysqli_fetch_array($eoi_school_res))
{
	$eoischool = $eoi_list['Sc_No'];
}
?>
<?php 

/* either match the following criteria
-status is available (Yes)
-match FOR
-match school
-match keyword

check for matching records*/



$sup_match= "SELECT distinct sup_rsh_field.Sup_No
FROM sup_rsh_field INNER JOIN supervisor AS sup
ON sup.Sup_No= sup_rsh_field.Sup_No, staff_account INNER JOIN supervisor AS superv
ON superv.Sup_No=staff_account.S_No WHERE ".$super_where.
" sup.available= '1' AND (
(Rf_No = '$eoifor1' OR Rf_No= '$eoifor2' OR Rf_No= '$eoifor3') OR
(sup.Sc_No= '$eoischool')".(isset($eoi_rsh_keywords) ? " OR (
CONCAT(sup.rsh_keyword1,sup.rsh_keyword2,sup.rsh_keyword3,sup.rsh_keyword4,
sup.rsh_keyword5) REGEXP ('".join("|", $eoi_rsh_keywords)."')))" : ")");
$get_sup_match = mysqli_query($con,$sup_match) or die ($sup_match.mysqli_error($con));
$i=1;
while ($sup_match_res = mysqli_fetch_array($get_sup_match)) 
{
	$sup_matched[$i] = $sup_match_res['staff_id'];
	$_SESSION['sup_matched'.$i]= $sup_matched[$i];
	$i++;
}
if(isset($sup_matched))
{
	$_SESSION['supcount']= mysqli_num_rows($get_sup_match);
	$updatestatus = "UPDATE eoi SET status='APPROVED', gro_reason='$_SESSION[groreason]' WHERE eoi_no='$_SESSION[eoiid]'";
	mysqli_query($con,$updatestatus) or die (mysqli_error($con));
	include 'SDandADRemail.php';
	unset($_SESSION['eoiid']);
	unset($_SESSION['groreason']);
	header("Location: GRO_ListOfEOI.php" );
}
if(!isset($sup_matched))
{
	$_SESSION['groreason'] .= "\n But No Matches Found. Please Register Another Time.";
	$updatestatus = "UPDATE eoi SET status='REJECTED', gro_reason='$_SESSION[groreason]' WHERE eoi_no='$_SESSION[eoiid]'";
	$pending= mysqli_query($con,$updatestatus) or die (mysqli_error($con));
	include 'rejection.php';
	include "rejectionnotification.php";
}
session_commit();
?>


