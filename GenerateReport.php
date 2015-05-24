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
if(!isset($_SESSION['staff_id']))
{
header("Location: Login Page.php?page=reportgenerator.php");
}//force to login first
if(isset($_SESSION['staff_id'])&&$_SESSION['status']!="GRO")
{
header("Location: 403error.php");//for non GRO accessing
}
if(!isset($_SESSION['report']))
{
	header("Location: reportgenerator.php");
}
$report =$_SESSION['report'];
$staff_id=$_SESSION['staff_id'];
$get_user = "SELECT * FROM gro_officer WHERE staff_id = '$staff_id'";
$get_user_res = mysql_query($get_user) or die(mysql_error());
while($user = mysql_fetch_array( $get_user_res )) 
{
	$title=$user['salutation'];
	$firstname=$user['firstname'];
	$lastname=$user['lastname'];
}
$fullname = $title." ".$firstname." ".$lastname; // show supervisor full name at top right with welcome message
date_default_timezone_set('Asia/Singapore'); // set to singapore time
$date =  date("m.Y");
$file = "report_".$_SESSION['reportname'].".".$date.".csv";



header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$file);
include "simple_html_dom.php";


$html = str_get_html($report); // give this your HTML string
$fp = fopen("php://output", "w");

foreach($html->find('tr') as $element) {
  $td = array();
  foreach( $element->find('th') as $row) {
    if (strpos(trim($row->class), 'actions') === false && strpos(trim($row->class), 'checker') === false) {
      $td [] = $row->plaintext;
    }
  }
  if (!empty($td)) {
    fputcsv($fp, $td);
  }

  $td = array();
  foreach( $element->find('td') as $row) {
    if (strpos(trim($row->class), 'actions') === false && strpos(trim($row->class), 'checker') === false) {
      $td [] = $row->plaintext;
    }
  }
  if (!empty($td)) {
    fputcsv($fp, $td);
  }
}

fclose($fp);
exit;

?>